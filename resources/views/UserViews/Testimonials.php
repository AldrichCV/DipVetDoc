<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Dipolog Veterinary Doctor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3ABEF9; /* Light Blue */
            --secondary-color: #0056b3; /* Dark Blue */
          
            --card-bg-color: #f7f7f7; /* Light card background */
            --card-hover-color: #e0f7ff; /* Hover effect for cards */
            --shadow-color: rgba(0, 0, 0, 0.1); /* Soft shadow for cards */
        }

        /* Hero Section */
        .jumbotron {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 50px 20px;
            border-bottom: 4px solid var(--secondary-color);
        }

        /* Testimonials Section */
        #testimonials {
            padding: 50px 0;
            background-color: var(--light-color);
        }

        #testimonials h2 {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        /* Testimonial Cards */
        .testimonial-card {
            background: var(--card-bg-color);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 6px 12px var(--shadow-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            margin: 15px;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px var(--shadow-color);
        }

        .testimonial-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid var(--primary-color);
        }

        .testimonial-card h5 {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .testimonial-card p {
            color: #666;
            font-size: 0.95rem;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .testimonial-card {
                margin-bottom: 30px;
            }
        }

        /* Testimonial Section Container */
        .testimonial-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        /* Ensure two columns on medium to large screens */
        .testimonial-card-container {
            flex: 0 0 48%;
        }

        /* Styling for carousel on mobile */
        .carousel-item {
            text-align: center;
        }

    </style>
</head>
<body>

<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid text-white text-center" style="background-color: #A7E6FF;">
    <h1 class="display-4">What Our Clients Say</h1>
    <p class="lead">Heartfelt experiences from our pet-loving community.</p>
</div>

<!-- Testimonials Section -->
<div id="testimonials" class="container">
    <h2 class="text-center">Client Testimonials</h2>
    
    <!-- Testimonial Cards (Two Columns Layout) -->
    <div class="testimonial-container">
        <!-- Testimonial 1 -->
        <div class="testimonial-card-container">
            <div class="testimonial-card">
                <img src="assets/images/client101.jpg" alt="Client 1">
                <h5>John Doe</h5>
                <p>"The vets at Dipolog Veterinary Doctor are amazing! They treated my dog like their own."</p>
            </div>
        </div>
        <!-- Testimonial 2 -->
        <div class="testimonial-card-container">
            <div class="testimonial-card">
                <img src="assets/images/client102.jpg" alt="Client 2">
                <h5>Iza Smith</h5>
                <p>"Professional, caring, and affordable. Highly recommend for all pet lovers."</p>
            </div>
        </div>
        <!-- Testimonial 3 -->
        <div class="testimonial-card-container">
            <div class="testimonial-card">
                <img src="assets/images/client103.jpg" alt="Client 3">
                <h5>Maria Garcia</h5>
                <p>"Their team is the best in Dipolog! They go above and beyond for your pets."</p>
            </div>
        </div>
        <!-- Testimonial 4 -->
        <div class="testimonial-card-container">
            <div class="testimonial-card">
                <img src="assets/images/client104.jpg" alt="Client 4">
                <h5>Lara Lee</h5>
                <p>"Highly recommend their services. I felt comfortable leaving my pet in their care."</p>
            </div>
        </div>
    </div>

    <!-- Optional Carousel for Additional Testimonials -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Testimonial 1 -->
                    <div class="carousel-item active">
                        <div class="testimonial-card mx-auto">
                            <img src="assets/images/client105.jpg" alt="Client 1">
                            <h5>Jeff Doe</h5>
                            <p>"The vets at Dipolog Veterinary Doctor are amazing! They treated my dog like their own."</p>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="carousel-item">
                        <div class="testimonial-card mx-auto">
                            <img src="assets/images/client106.jpg" alt="Client 2">
                            <h5>Jane Smith</h5>
                            <p>"Professional, caring, and affordable. Highly recommend for all pet lovers."</p>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="carousel-item">
                        <div class="testimonial-card mx-auto">
                            <img src="assets/images/client107.jpg" alt="Client 3">
                            <h5>Mark Garcia</h5>
                            <p>"Their team is the best in Dipolog! They go above and beyond for your pets."</p>
                        </div>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
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