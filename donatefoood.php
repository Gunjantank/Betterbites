<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    // Database connection
    include 'db_connection.php';

    $food_type = $_POST['food_type'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $daily_active = $_POST['daily_active'];
    $username = $_SESSION['email'];
    $date_time = date('Y-m-d H:i:s');

    // Handle file upload
    $target_dir = "foodimage/";
    $file_name = basename($_FILES["food_image"]["name"]); // Get the filename
    $target_file = $target_dir . $file_name; // Construct the full path
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["food_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (allow up to 5 MB)
    if ($_FILES["food_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["food_image"]["tmp_name"], $target_file)) {
            // Insert data into database
            $sql = "INSERT INTO donatefood (filename, foodtype, price, location, dailyactive, username, time)
                    VALUES ('$file_name', '$food_type', '$price', '$location', '$daily_active', '$username', '$date_time')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Food donation successfully uploaded!');</script>";
                $_SESSION['form_submitted'] = true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Prevent form resubmission on refresh
if (isset($_SESSION['form_submitted'])) {
    unset($_SESSION['form_submitted']);
    echo '<script>if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); }</script>';
}
?>

<?php include 'donateheader.php'; ?>

<div class="container">
    <br><br>
    <form id="donateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="food_image">Food Image:</label>
            <input type="file" class="form-control" id="food_image" name="food_image" required>
        </div>
        <div class="form-group">
            <label for="food_type">Food Type:</label>
            <select class="form-control" id="food_type" name="food_type" required>
                <option value="vegetarian" style="background-color: #ff7e5f; color: black;">Vegetarian</option>
                <option value="non vegetarian" style="background-color: #ff7e5f; color: black;">Non-Vegetarian</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <select class="form-control" id="price" name="price" required>
                <option value="free" style="background-color: #ff7e5f; color: black;">Free</option>
                <option value="10" style="background-color: #ff7e5f; color: black;">10₹ per plate</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="complete address" required>
        </div>
        <div class="form-group">
            <label for="daily_active">Daily Active:</label>
            <select class="form-control" id="daily_active" name="daily_active" required>
                <option value="yes" style="background-color: #ff7e5f; color: black;">Yes</option>
                <option value="no" style="background-color: #ff7e5f; color: black;">No</option>
            </select>
        </div>
        <button type="button" class="btn" style="background-color: #ff7e5f; color: black;" onclick="previewDonation()">Preview</button>
    </form>

    <div id="previewCard" class="card" style="display: none; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -20%); z-index: 1000;">
        <img id="previewImage" class="card-img-top" src="" alt="Food Image" style="width: 100%; height: auto; object-fit: cover; max-height: 300px;">
        <div class="card-body">
            <h5 class="card-title" id="previewFoodType"></h5>
            <p class="card-text" id="previewPrice"></p>
            <p class="card-text" id="previewLocation"></p>
            <p class="card-text" id="previewDailyActive"></p>
            <p class="card-text" id="previewUsername"></p>
            <p class="card-text" id="previewDateTime"></p>
            <button type="submit" form="donateForm" class="btn" style="background-color: #ff7e5f; color: black;" id="uploadButton">Upload</button>
            <button type="button" class="btn btn-secondary" id="cancelButton" onclick="cancelPreview()">Cancel</button>
        </div>
    </div>
</div>

<?php include 'webfooter.php'; ?>

<script>
function previewDonation() {
    var foodImage = document.getElementById('food_image').files[0];
    var foodType = document.getElementById('food_type').value;
    var price = document.getElementById('price').value;
    var location = document.getElementById('location').value;
    var dailyActive = document.getElementById('daily_active').value;
    var username = '<?php echo $_SESSION["email"]; ?>';
    var dateTime = new Date().toLocaleString();

    if (foodImage) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('previewImage').src = e.target.result;
        }
        reader.readAsDataURL(foodImage);
    }

    document.getElementById('previewFoodType').innerText = "Food Type: " + foodType;
    document.getElementById('previewPrice').innerText = "Price: " + price;
    document.getElementById('previewLocation').innerText = "Location: " + location;
    document.getElementById('previewDailyActive').innerText = "Daily Active: " + dailyActive;
    document.getElementById('previewUsername').innerText = "Username: " + username;
    document.getElementById('previewDateTime').innerText = "Date & Time: " + dateTime;

    document.getElementById('previewCard').style.display = 'block';
}

function cancelPreview() {
    document.getElementById('previewCard').style.display = 'none';
}
</script>
