<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Supplies - Dipolog Veterinary Doctor</title>
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

        /* Page Title */
        h1 {
            color: var(--primary-color);
            font-size: 3rem;
            font-weight: bold;
        }

        .section-title {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .service-description {
            font-size: 1.2rem;
            color: #666;
        }

        .fee {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .btn-shop-now {
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .btn-shop-now:hover {
            background-color: #2b95d1;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .service-card {
            background-color: var(--card-bg-color);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 20px;
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
    </style>
</head>
<body>


<!-- Pet Supplies/Store Section -->
<section class="container my-5">
    <h1>Pet Supplies</h1>
    <p class="service-description">Our pet store offers a wide range of high-quality products to keep your pets happy and healthy. From pet food to grooming tools, toys, and accessories, we’ve got everything your furry friend needs.</p>
    
    <!-- Product Categories -->
    <h2 class="section-title">What We Offer</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-dog"></i>
                <h4>Pet Food</h4>
                <p>We offer a variety of high-quality food options for dogs, cats, and other pets, ensuring proper nutrition for all stages of life.</p>
                <a href="PetFood" class="read-more">Shop Now</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-leaf"></i>
                <h4>Grooming Tools</h4>
                <p>Our grooming products include brushes, shampoos, and clippers to keep your pet looking and feeling their best.</p>
                <a href="GroomingTools" class="read-more">Shop Now</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-bone"></i>
                <h4>Toys & Accessories</h4>
                <p>Fun toys and useful accessories to keep your pet entertained and comfortable in every situation.</p>
                <a href="ToysAccessories" class="read-more">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- Fee Section -->
    <h2 class="section-title">Service Fee</h2>
    <p class="fee">Prices for Pet Supplies vary based on the product. Browse our store to see the range of affordable prices starting from ₱50.</p>
    <p class="service-description">We also offer special discounts for bulk purchases. Please contact us for details about discounts on large orders or subscription packages for pet food and supplies.</p>

    <!-- Shop Now Button -->
    <a href="Store" class="btn-shop-now">Shop Now</a>
</section>

<!-- Footer Section -->
<footer class="text-center py-4" style="background-color: #3ABEF9; color: white;">
    <p>&copy; 2024 Dipolog Veterinary Doctor | All Rights Reserved</p>
</footer>

<!-- Required Bootstrap and FontAwesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
