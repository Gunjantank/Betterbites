<?php
session_start();
include 'db_connection.php';

$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

function displayCards($filter = '')
{
    global $conn;

    $sql = "SELECT * FROM donatefood";
    if ($filter == 'daily_active') {
        $sql .= " WHERE dailyactive = 'yes'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $food_image = 'foodimage/' . $row['image']; // Ensure the path is correct
            $food_type = $row['foodtype'];
            $price = $row['price'];
            $location = $row['location'];
            $date_time = $row['time'];
            $username = $row['username'];

            echo '
            <div class="card mb-4" style="width: 18rem;">
                <img src="' . htmlspecialchars($food_image) . '" class="card-img-top" alt="Food Image" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Food Type: ' . htmlspecialchars(ucfirst($food_type)) . '</h5>
                    <p class="card-text">Price: ' . htmlspecialchars($price) . '</p>
                    <p class="card-text">Location: ' . htmlspecialchars($location) . '</p>
                    <p class="card-text">Date & Time: ' . htmlspecialchars($date_time) . '</p>
                    <p class="card-text">Uploaded By: ' . htmlspecialchars($username) . '</p>
                </div>
            </div>';
        }
    } else {
        echo "<p>No records found.</p>";
    }
}

displayCards($filter);
?>
