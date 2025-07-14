<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Dipolog Veterinary Doctor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3ABEF9; /* Light Blue */
            --secondary-color: #0056b3; /* Dark Blue */
            --light-color: #e9f4fe; /* Light background */
            --card-bg-color: #f7f7f7; /* Light card background */
            --card-hover-color: #e0f7ff; /* Hover effect for cards */
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        /* Jumbotron Styles */
        .jumbotron {
            background-color: var(--primary-color);
            color: white;
            border-bottom: 4px solid var(--secondary-color);
        }

        /* Services Section */
        #services {
            padding: 50px 0;
        }

        #services h2 {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .service-card {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 350px; /* Ensures consistent height */
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; /* Even spacing for content */
        }

        .service-card:hover {
            background-color: var(--card-hover-color);
            transform: translateY(-5px);
        }

        .service-card i {
            font-size: 50px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .service-card h4 {
            font-weight: bold;
            color: var(--secondary-color);
        }

        .service-card p {
            color: #666;
        }

        .service-card .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            display: inline-block;
        }

        /* Responsive Styling */
        @media (max-width: 767px) {
            .service-card {
                margin-bottom: 30px;
            }
        }

        /* Scroll to Top Button */
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
</head>
<body>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid text-center" style="background-color: #A7E6FF;">
    <div class="container">
        <h1 class="display-4" style="color: #003366;">Dipolog Veterinary Doctor</h1>
        <p class="lead" style="color: #0056b3;">Caring for your pets with love and expertise.</p>
    </div>
</div>


<div class="container" id="services">
    <h2 class="text-center mb-4">Explore Our Services</h2>
    <div class="row d-flex align-items-stretch">
        <!-- Full Grooming Card -->
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-heart"></i>
                <h4>Full Grooming</h4>
                <p>A comprehensive service that includes a bath, haircut, nail trimming, ear cleaning, and brushing for a fresh, clean look, ensuring your pet feels their best.</p>
                <a href="FullGrooming" class="read-more"></a>
            </div>
        </div>
        
        <!-- Mini Hotel for Pets Card -->
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-hotel"></i>
                <h4>Mini Hotel for Pets</h4>
                <p>Our cozy and safe mini hotel provides a home-like experience for your pets while you're away. They will enjoy comfort and care in a controlled, friendly environment.</p>
                <a href="MiniHotel" class="read-more"></a>
            </div>
        </div>
        
        <!-- Pet Supplies Card -->
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-box"></i>
                <h4>Pet Supplies</h4>
                <p>High-quality pet food, accessories, and other essentials for your furry friend.</p>
                <a href="PetSupplies" class="read-more"></a>
            </div>
        </div>
    </div>

    <!-- Additional Services -->
    <div class="row d-flex align-items-stretch mt-4">
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-syringe"></i>
                <h4>Vaccination and Deworming</h4>
                <p>Essential vaccinations and deworming services to keep your pet healthy and protected against common diseases.</p>
                <a href="Vaccination" class="read-more"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-stethoscope"></i>
                <h4>Consultation</h4>
                <p>Professional veterinary advice and medical consultations for all your pet's health concerns.</p>
                <a href="Consultation" class="read-more"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-home"></i>
                <h4>Home Service</h4>
                <p>Convenient at-home veterinary services for your pet's comfort and care.</p>
                <a href="HomeService" class="read-more"></a>
            </div>
        </div>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i>
</button>

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

<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
