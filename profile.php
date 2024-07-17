<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include 'db_connection.php';

// Fetch user details
$email = $_SESSION['email'];
$sql = "SELECT * FROM registration WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        $newEmail = $_POST['email'];
        $newPassword = $_POST['password'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];

        // Update user details
        $sql = "UPDATE registration SET email = ?, password = ?, city = ?, contact = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $newEmail, $newPassword, $city, $contact, $email);
        if ($stmt->execute()) {
            // Update session email if email is changed
            if ($newEmail != $email) {
                $_SESSION['email'] = $newEmail;
            }
            echo "<script>alert('Profile updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating profile.');</script>";
        }
        $stmt->close();
    }

    // Handle delete request
    if (isset($_POST['delete_post'])) {
        $postId = $_POST['post_id'];

        // Delete the post
        $sql = "DELETE FROM donatefood WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        if ($stmt->execute()) {
            echo "<script>alert('Post deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting post.');</script>";
        }
        $stmt->close();
    }
}

// Fetch user posts
function fetchUserPosts($conn, $email) {
    $sql = "SELECT * FROM donatefood WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result();
}
?>

<?php include 'donateheader.php'; ?>

<div class="container mt-5">
    <h2>Profile</h2>
    <form method="POST" class="mb-4">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
        </div>
        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
    </form>

    <div class="mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#postsModal">Your Posts</button>
    </div>

    <!-- Modal for posts -->
    <div class="modal fade" id="postsModal" tabindex="-1" role="dialog" aria-labelledby="postsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postsModalLabel">Your Posts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        $posts = fetchUserPosts($conn, $email);
                        if ($posts->num_rows > 0) {
                            while ($post = $posts->fetch_assoc()) {
                                $imagePath = 'foodimage/' . $post['filename'];
                                $foodType = htmlspecialchars($post['foodtype']);
                                $price = htmlspecialchars($post['price']);
                                $location = htmlspecialchars($post['location']);
                                $dateTime = htmlspecialchars($post['time']);
                                $postId = $post['id'];
                        ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="<?php echo htmlspecialchars($imagePath); ?>" class="card-img-top" alt="Food Image" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $foodType; ?></h5>
                                        <p class="card-text">Price: <?php echo $price; ?></p>
                                        <p class="card-text">Location: <?php echo $location; ?></p>
                                        <p class="card-text">Date & Time: <?php echo $dateTime; ?></p>
                                        <form method="POST" onsubmit="return confirmDelete();">
                                            <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                            <button type="submit" name="delete_post" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        } else {
                            echo '<p>No posts found.</p>';
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'webfooter.php'; ?>

<!-- CSS Styles for Profile Page -->
<style>
.container {
    max-width: 800px;
}

form .form-group {
    margin-bottom: 15px;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.modal-content {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.card {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card:hover {
    transform: scale(1.05);
}

.card-body {
    padding: 15px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.card-text {
    margin-bottom: 10px;
}
</style>

<!-- JavaScript for Delete Confirmation -->
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this post?");
}
</script>
