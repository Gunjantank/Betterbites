<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetterBites - Share a Bite, Shine a Light</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        /* Add any additional CSS here or keep it in styles.css */
        header {
            position: absolute; /* Fixes the header to the top */
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999; /* Ensures the header is above other content */
            background-color: rgba(52, 58, 64, 1); /* Solid background color for header */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for a floating effect */
        }

        /* Adjust the body content to account for the fixed header */

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header */
        .navbar-brand {
            font-size: 1.5rem;
            color: #ff7e5f !important;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ff7e5f;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .carousel-inner img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .carousel-item {
            transition: transform 0.s ease-in-out;
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            z-index: 10;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .slogan-container {
            margin: 20px 0;
            position: relative;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slogan {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            white-space: nowrap;
            overflow: hidden;
        }

        .slogan .letter {
            display: inline-block;
            animation: move 2s ease-in-out infinite;
        }

        @keyframes move {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        /* About Us Section */
        .about-us {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            padding: 180px 0;
        }

        .about-us .row {
            display: flex;
            align-items: stretch; /* Ensures both columns have equal height */
        }

        .about-img-wrapper {
            width: 100%; /* Ensure the image spans the full width */
            overflow: hidden;
            border-radius: 15px; /* Round corners of the image */
        }

        .about-img-wrapper img {
            width: 100%;
            height: 100%; /* Ensure the image covers the container */
            object-fit: cover;
            border-radius: 15px; /* Round corners of the image */
        }

        .about-text-wrapper {
            background: rgba(0, 0, 0, 0.6);
            padding: 70px;
            border-radius: 15px;
        }

        .about-text-bg {
            padding: 20px;
        }

        .about-text-bg p {
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-success {
            background-color: #ff7e5f;
            border-color: #ff7e5f;
            border-radius: 20px;
        }

        .btn-success:hover {
            background-color: #feb47b;
            border-color: #feb47b;
        }

        /* Footer */
        .footer {
            background-color: #FFAA33; /* Dark green background */
            color: #fff; /* White text */
            padding: 40px 0;
            position: relative;
        }

        .footer .row {
            align-items: center; /* Vertically center content */
        }

        .footer .social-icons {
            margin-top: 10px;
        }

        .footer .social-icons a {
            color: #fff; /* White color for social icons */
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer .social-icons a:hover {
            color: #90ee90; /* Light green color on hover */
        }

        .footer-logo {
            max-width: 100px; /* Adjust size of the footer logo */
            height: 100px; /* Ensure height matches width for a circle */
            border-radius: 50%; /* Makes the logo circular */
            margin-top: 20px; /* Space above the logo */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .footer h5 {
            margin-bottom: 20px;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 0.875rem;
        }

        /* Goal Section */
        .goal-section {
            padding: 160px 0;
            background-color: #50C878;
        }

        .goal-card {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 60px;
            border-radius: 15px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .goal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .section-heading {
            color: #fff; /* White text color for the heading */
            margin-bottom: 60px; /* Spacing below the heading */
            font-size: 2rem; /* Font size for the heading */
        }

        .goal-card h5 {
            margin-bottom: 20px; /* Spacing below the card title */
            font-size: 1.5rem; /* Font size for the card title */
        }

        .goal-card p {
            margin-bottom: 0; /* Remove bottom margin for card text */
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">BetterBites</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#goals">Goals</a></li>
                    <li class="nav-item"><a class="nav-link" href="Login.php">login</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/img1.jpg" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="images/slide.png" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="images/slidee.jpg" alt="Slide 3">
                </div>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="hero-content">
                <h1>Share a Bite, Shine a Light</h1>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6 about-img-wrapper">
                    <img src="images/about_us.jpg" alt="About Us">
                </div>
                <div class="col-md-6 about-text-wrapper">
                    <div class="about-text-bg">
                        <h2>About Us</h2>
                        <p>Welcome to BetterBites, a platform dedicated to reducing food waste and alleviating hunger. In places like marriage halls, party plots, and large events, excess food often ends up in the trash, despite its potential to make a difference. BetterBites transforms this waste into a beacon of hope by connecting surplus food to those in need. </p><p>Through our platform, not only can you donate food to individuals who need it, but you can also collaborate with NGOs and even fertilizer companies to ensure nothing goes to waste. Join us in making a meaningful impact by turning excess food into a valuable resource for communities and the environment.</p>
                        <a href="donatefood.php" class="btn btn-success"> Become a Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Goals Section -->
    <section id="goals" class="goal-section">
        <div class="container">
            <div class="section-heading">
                <h2>Our Goals</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="goal-card">
                        <h5>Zero Hunger</h5>
                        <p>We strive to end hunger and ensure access to safe and nutritious food for all.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <h5> Responsible Consumption and Production</h5>
                        <p>We promote sustainable consumption and production patterns to minimize waste and ensure resources are used efficiently.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <h5>Community Support</h5>
                        <p>Engaging local communities to participate in food donation and waste reduction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, City, Country</p>
                    <p><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope"></i> contact@betterbites.com</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/logo.jpg" alt="BetterBites Logo" class="footer-logo">
                </div>
                <div class="col-md-4">
                    <h5>About BetterBites</h5>
                    <p>BetterBites is a community-driven platform aimed at reducing food waste and combating hunger through donations and responsible consumption.</p>
                </div>
            </div>
            <div class="copyright">
                &copy; <span id="year"></span> BetterBites. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Set the current year for the copyright notice
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
