<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterBites - Share a Bite, Shine a Light</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
    <style>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0; 
        padding: 0; 
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        background-color: rgba(52, 58, 64, 1);
        transition: top 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
        height: 90px; /* Set a fixed height for the header */
    }

    .navbar-brand {
        font-size: 1.5rem;
        color: #ff7e5f !important;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: #fff;
        margin-right: 15px; 
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        color: #ff7e5f;
    }

    .btn-warning {
        background-color: #ff7e5f !important;
        border-color: #ff7e5f !important;
        color: #fff !important;
    }

    .btn-warning:hover {
        background-color: #e06b4b !important;
        border-color: #e06b4b !important;
    }

    .navbar-nav .nav-item:last-child {
        margin-left: auto;
    }

    
</style>

</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">BetterBites</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="donatefoood.php">Donate Food</a></li>
                <li class="nav-item"><a class="nav-link" href="recycle.php">Recycle</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
            
        </div>
    </div>
</header>
</body>
</html>
