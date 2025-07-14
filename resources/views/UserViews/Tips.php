<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tips & Guide - Dipolog Veterinary Doctor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3ABEF9; /* Light Blue */
            --secondary-color: #0056b3; /* Dark Blue */
       
            --card-bg-color: #f7f7f7; /* Light card background */
            --text-color: #333; /* Default text color */
        }

        /* Hero Section */
        .jumbotron {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 50px 20px;
            border-bottom: 4px solid var(--secondary-color);
        }

        /* Section Styles */
        #tips {
            padding: 50px 0;
            background-color: var(--light-bg-color);
        }

        #tips h2 {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 2rem;
            text-transform: uppercase;
            margin-bottom: 40px;
        }

        /* Card Styles */
        .tip-card {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            text-align: center;
        }

        .tip-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .tip-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .tip-card .card-body {
            padding: 20px;
        }

        .tip-card h5 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .tip-card p {
            color: var(--text-color);
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .tip-card .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        /* Guide Section */
        #guides {
            padding: 50px 0;
        }

        .carousel-inner {
            text-align: center;
        }

        .carousel-item img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .tip-card {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid text-white text-center" style="background-color: #A7E6FF;">
    <h1 class="display-4">Tips & Guide</h1>
    <p class="lead">Expert advice to keep your pets healthy and happy.</p>
</div>

<!-- Tips Section -->
<div id="tips" class="container">
    <h2 class="text-center">Featured Tips</h2>
    <div class="row">
        <!-- Tip 1 -->
        <div class="col-md-4 mb-4">
            <div class="tip-card">
                <img src="assets/images/nutrition.jpg" alt="Tip 1">
                <div class="card-body">
                    <h5>Proper Nutrition</h5>
                    <p>Learn how to balance your pet's diet with the right nutrients for a healthy life.</p>
                    <a href="#" class="read-more"></a>
                </div>
            </div>
        </div>
        <!-- Tip 2 -->
        <div class="col-md-4 mb-4">
            <div class="tip-card">
                <img src="assets/images/exercise.jpg" alt="Tip 2">
                <div class="card-body">
                    <h5>Regular Exercise</h5>
                    <p>Discover the best exercises to keep your pets active and mentally stimulated.</p>
                    <a href="#" class="read-more"></a>
                </div>
            </div>
        </div>
        <!-- Tip 3 -->
        <div class="col-md-4 mb-4">
            <div class="tip-card">
                <img src="assets/images/grooming.jpg" alt="Tip 3">
                <div class="card-body">
                    <h5>Grooming Essentials</h5>
                    <p>Ensure your pets stay clean and comfortable with these grooming tips.</p>
                    <a href="#" class="read-more"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guide Section -->
<div id="guides" class="container">
    <h2 class="text-center">In-Depth Guides</h2>
    <div id="guideCarousel" class="carousel slide mt-4" data-ride="carousel">
        <div class="carousel-inner">
            <!-- Guide 1 -->
            <div class="carousel-item active">
                <img src="assets/images/vaccdate.jpg" alt="Guide 1">
                <h5 class="mt-3">Vaccination Schedule</h5>
                <p>Ensure your pet's health with an up-to-date vaccination routine.</p>
            </div>
            <!-- Guide 2 -->
            <div class="carousel-item">
                <img src="assets/images/commondis.jpg" alt="Guide 2">
                <h5 class="mt-3">Common Illnesses</h5>
                <p>Learn how to identify and prevent common pet illnesses.</p>
            </div>
            <!-- Guide 3 -->
            <div class="carousel-item">
                <img src="assets/images/petsafety.png" alt="Guide 3">
                <h5 class="mt-3">Pet Safety Tips</h5>
                <p>Protect your pets at home and during outdoor activities.</p>
            </div>
        </div>
        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#guideCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#guideCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
    #scrollToTopBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none; /* Hidden by default */
        z-index: 1000; /* Ensures it stays above other elements */
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #0c71b8; /* Button color */
        color: white;
        border: none;
        outline: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    #scrollToTopBtn:hover {
        background-color: lightskyblue; /* Hover color */
        transform: scale(1.1); /* Slight zoom effect */
    }

    #scrollToTopBtn i {
        font-size: 20px; /* Arrow size */
    }
</style>

<script>
    // Get the button
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    // Show the button when the user scrolls down 100px
    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    // Scroll back to the top when the button is clicked
    scrollToTopBtn.onclick = function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth" // Smooth scrolling effect
        });
    };
</script>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>