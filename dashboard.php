<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include 'db_connection.php';

// Function to get the username from the registration table
function getUsername($conn, $email) {
    $sql = "SELECT name FROM registration WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['name'];
        } else {
            return 'Unknown';
        }
    } else {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
}

// Fetch food data
function fetchFoodData($conn, $filter = '') {
    $sql = "SELECT * FROM donatefood";
    if ($filter == 'daily_active') {
        $sql .= " WHERE dailyactive = 'yes'";
    }
    $result = $conn->query($sql);
    return $result;
}

// Determine the filter
$filter = '';
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

// Get the username from the session
$username = getUsername($conn, $_SESSION['email']);
?>

<?php include 'dashboardheader.php'; ?>

<div class="container mt-5">

    <div class="mb-4">
        <a href="?filter=recently_uploaded" class="btn" style="background-color: #ff7e5f; color: white;">Recently Uploaded</a>
        <a href="?filter=daily_active" class="btn" style="background-color: #ff7e5f; color: white;">Daily Active</a>
    </div>

    <div class="row" id="foodCards">
        <?php
        $result = fetchFoodData($conn, $filter);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = 'foodimage/' . $row['filename']; // Use filename from database
                $foodType = $row['foodtype'];
                $price = $row['price'];
                $location = $row['location'];
                $dateTime = $row['time'];
                
                // Format date and time
                $date = date('Y-m-d', strtotime($dateTime));
                $timeAgo = timeAgo($dateTime);
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Ensure image path is correct -->
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" class="card-img-top" alt="Food Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($foodType); ?></h5>
                        <p class="card-text"><i class="bi bi-cash-coin"></i> <?php echo htmlspecialchars($price == 0 ? 'Free' : $price); ?></p>
                        <p class="card-text"><i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($location); ?></p>
                        <p class="card-text"><i class="bi bi-calendar-fill"></i> <?php echo htmlspecialchars($date); ?></p>
                        <p class="card-text"><i class="bi bi-clock-fill"></i> <?php echo htmlspecialchars($timeAgo); ?></p>
                        <p class="card-text"><i class="bi bi-person-fill"></i> <?php echo htmlspecialchars($username); ?></p>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<p>No food items found.</p>';
        }
        ?>
    </div>
</div>

<?php include 'webfooter.php'; ?>

<!-- CSS Styles for Card -->
<style>
.card {
    border: 1px solid #ddd;
    border-radius: 5px;
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
    color: black; /* Set text color to black */
}

.card-text i {
    margin-right: 5px; /* Add space between icon and text */
    color: black; /* Set icon color to black */
}

/* Button Styles */
.btn {
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
}
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<?php
// Function to calculate time ago
function timeAgo($datetime, $full = false) {
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . ($diff->$k > 1 ? $v . 's' : $v);
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
