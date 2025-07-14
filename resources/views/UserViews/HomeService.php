<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Service - Dipolog Veterinary Doctor</title>
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

        .btn-book-now {
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .btn-book-now:hover {
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


<!-- Home Service Section -->
<section class="container my-5">
    <h1>Home Service</h1>
    <p class="service-description">Our Home Service brings expert veterinary care right to your doorstep. We understand that your pet may be more comfortable in their own environment, so we offer professional consultations, treatments, and wellness checks at home.</p>
    
    <!-- Service Details -->
    <h2 class="section-title">Service Details</h2>
    <p class="service-description">With our Home Service, our team of experienced veterinarians will visit your home to provide care for your pet, including routine check-ups, minor treatments, vaccinations, and more. This service is perfect for pets that are anxious about traveling or for owners who prefer the convenience of home visits.</p>
    
    <h2 class="section-title">Service Fee</h2>
    <p class="fee">Home Service fee starts at **₱800** for a standard visit. Additional fees may apply depending on the location, travel distance, and the complexity of the service provided.</p>
    
    <p class="service-description">For extended services or emergency visits, please contact us for a customized quote.</p>

    <!-- Book Now Button -->
    <a href="BookHomeService" class="btn-book-now">Book a Home Visit</a>
</section>



<!-- Required Bootstrap and FontAwesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
