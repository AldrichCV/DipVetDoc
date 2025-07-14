<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Hotel for Pets - Dipolog Veterinary Doctor</title>
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


<!-- Mini Hotel for Pets Section -->
<section class="container my-5">
    <h1>Mini Hotel for Pets</h1>
    <p class="service-description">Our Mini Hotel for Pets offers a safe and comfortable home-like experience for your furry friends when you're away. With cozy rooms, professional staff, and plenty of activities, your pets will enjoy their stay as much as you enjoy your time away.</p>
    
    <!-- Service Details -->
    <h2 class="section-title">What We Offer</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-bed"></i>
                <h4>Comfortable Rooms</h4>
                <p>Your pet will have a clean, cozy room with bedding and toys to feel right at home.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-paw"></i>
                <h4>Playtime and Walks</h4>
                <p>We provide daily playtime and walks to keep your pet active and engaged.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <i class="fas fa-utensils"></i>
                <h4>Meals and Snacks</h4>
                <p>We cater to your pet's dietary needs, providing their favorite meals and snacks.</p>
            </div>
        </div>
    </div>

    <!-- Fee Section -->
    <h2 class="section-title">Service Fee</h2>
    <p class="fee">₱500 per night</p>
    <p class="service-description">We offer a special discount for long-term stays. Please contact us for details about rates for extended visits.</p>

    <!-- Book Now Button -->
    <a href="BookNow" class="btn-book-now">Book Your Pet’s Stay Now</a>
</section>

<!-- Required Bootstrap and FontAwesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
