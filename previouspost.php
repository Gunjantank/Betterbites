<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'betterbites');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email']; // Get the logged-in user's email

// Fetch user posts
$sql = "SELECT * FROM donatefood WHERE username = '$email'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Posts - BetterBites</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-img {
            height: 200px; /* Medium height */
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
        }
        .btn-custom {
            background-color: #ff7e5f;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e06b4b;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .card-columns {
            column-count: 3; /* Display 3 cards per row */
        }
        .card-img-container {
            width: 100%;
            height: 200px; /* Ensure the image container maintains size */
            overflow: hidden;
        }
        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the image covers the container */
        }
        .container {
            margin-top: 130px; /* Adjust for fixed header */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Previous Posts</h1>
        <div class="card-columns">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<div class="card-img-container">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" class="card-img" alt="Food Image">';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['foodtype']) . '</h5>';
                    echo '<p class="card-text">Price: ' . htmlspecialchars($row['price']) . '</p>';
                    echo '<p class="card-text">Location: ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<p class="card-text">Date: ' . htmlspecialchars($row['time']) . '</p>';
                    echo '<a href="editpost.php?id=' . $row['id'] . '" class="btn btn-custom">Edit</a> ';
                    echo '<a href="deletepost.php?id=' . $row['id'] . '" class="btn btn-delete">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No posts found.</p>';
            }
            ?>
        </div>
    </div>
    
    <!-- Include JavaScript for Bootstrap, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
