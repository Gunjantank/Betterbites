<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "betterbites";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prepare SQL statement to fetch password
    $sql = "SELECT * FROM registration WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        
        // Verify password
        if ($password === $stored_password) {
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: login.php?error=user_not_found");
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login or Register</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background:  #FFAA33; /* Dark yellow to light saffron */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    
    .login-container {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        width: 400px;
        text-align: center;
    }
    
    .login-container img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 20px;
    }
    
    .login-container h2 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #333;
    }
    
    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }
    
    .login-container input[type="email"]:hover,
    .login-container input[type="password"]:hover {
        border-color: #FFD700; /* Light saffron on hover */
    }
    
    .login-container button {
        background-color:#ff7e5f; /* Saffron */
        color: white;
        border: none;
        padding: 10px 20px;
        margin-top: 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .login-container button:hover {
        background-color: #FFEBCD; /* Light saffron on hover */
    }
    
    .login-container .register-link {
        color: green;
        text-decoration: none;
        margin-top: 10px;
        display: block;
        font-weight: bold;
    }
    
    .login-container .register-link:hover {
        text-decoration: underline;
    }
    
    .register-form {
        display: none;
    }
</style>
</head>
<body>

<div class="login-container">
    <img src="images/logo.jpg" alt="Logo">
    <h2>Welcome to Family, Let's feed the world</h2>
    
    <form id="login-form" class="login-form" method="post" action="login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    
    <form id="register-form" class="register-form" method="post" action="register.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="contact" placeholder="Contact (10 digits)" pattern="\d{10}" required>
        <button type="submit">Register</button>
    </form>
    
    <a href="#" id="toggle-link" class="register-link" onclick="toggleForm()">New to Family? Register</a>
</div>

<script>
    function toggleForm() {
        var loginForm = document.getElementById("login-form");
        var registerForm = document.getElementById("register-form");
        var toggleLink = document.getElementById("toggle-link");
        
        if (loginForm.style.display === "none") {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
            toggleLink.textContent = "New to Family? Register";
        } else {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
            toggleLink.textContent = "Family member? Login";
        }
    }
</script>

</body>
</html>
