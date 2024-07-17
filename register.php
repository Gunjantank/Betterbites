<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betterbites";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    
    // Validate inputs (you should sanitize and validate inputs properly)
    
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO registration (name, email, password, city, contact) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $city, $contact);
    
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
