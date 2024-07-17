<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Destroy the session if the logout button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - BetterBites</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(120deg, #f5f7fa, #c3cfe2);
            color: #333;
            text-align: center;
            padding: 100px 0;
            overflow: hidden;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -30px;
            left: -30px;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.4));
            border-radius: 15px;
            z-index: -1;
            animation: pulse 4s infinite ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .container h1 {
            font-size: 2.5rem;
            color: #ff6f61;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }

        .container p {
            font-size: 1.125rem;
            color: #555;
            margin-bottom: 30px;
            animation: fadeInUp 1.5s ease-out;
        }

        .fly-away-btn {
            background: linear-gradient(135deg, #ff6f61, #e06b4b);
            border: none;
            color: #fff;
            font-size: 1.5rem;
            padding: 15px 30px;
            border-radius: 50px;
            transition: all 0.4s ease;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
            z-index: 1;
            font-weight: bold;
        }

        .fly-away-btn:hover {
            background: linear-gradient(135deg, #e06b4b, #ff6f61);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .fly-away-btn:focus {
            outline: none;
        }

        .fly-away-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.4s ease;
            transform: scale(0);
            z-index: -1;
        }

        .fly-away-btn:hover::before {
            transform: scale(1);
        }

        .fly-away-btn::after {
            content: '→';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.4s ease;
        }

        .fly-away-btn:hover::after {
            color: #fff;
            transform: translateY(-50%) translateX(10px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Blast Off!</h1>
        <p>Your journey with us has been stellar! Ready to soar into new adventures?</p>
        <form method="POST">
            <button type="submit" class="fly-away-btn">Fly Away</button>
        </form>
    </div>
</body>
</html>
