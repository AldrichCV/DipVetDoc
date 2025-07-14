
<body>
<!-- Hero Section -->
<div class="jumbotron text-center" style="background-color: #A7E6FF;">
    <div class="container">
        <h1 class="display-4">About Us</h1>
        <p class="lead">Meet the team and learn about our mission to care for your pets.</p>
    </div>
</div>

<!-- About Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Who We Are</h2>
    <p class="text-center">
        At Dipolog Veterinary Doctor, we are dedicated to providing compassionate, professional, and expert care for your pets. 
        With years of experience and modern facilities, we ensure your furry friends receive the best possible treatment. 
    </p>
    <div class="row">
        <div class="col-md-6">
            <h4>Our Mission</h4>
            <p>
                Our mission is to improve the health and well-being of your pets by delivering high-quality veterinary services 
                and fostering trust with pet owners. We treat every pet as part of our family.
            </p>
        </div>
        <div class="col-md-6">
            <h4>Why Choose Us?</h4>
            <ul>
                <li>State-of-the-art facilities</li>
                <li>Experienced and compassionate veterinarians</li>
                <li>Comprehensive services for all your pet needs</li>
                <li>Personalized care for every pet</li>
            </ul>
        </div>
    </div>
</div>

<!-- Image Gallery -->
<div class="container my-5">
    <h2 class="text-center mb-4">Our Clinic and Team</h2>
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/clinic.jpg" class="card-img-top" alt="Our Clinic">
                <div class="card-body">
                    <h5 class="card-title">Modern Facilities</h5>
                    <p class="card-text">Equipped with advanced tools to provide top-notch care for your pets.</p>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/team.jpg" class="card-img-top" alt="Our Team">
                <div class="card-body">
                    <h5 class="card-title">Dedicated Team</h5>
                    <p class="card-text">Our team of experienced veterinarians and staff treat every pet like family.</p>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/patients.jpg" class="card-img-top" alt="Happy Patients">
                <div class="card-body">
                    <h5 class="card-title">Happy Patients</h5>
                    <p class="card-text">See the smiles of the pets we've helped and their satisfied owners.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i>
</button>


    <style>
        :root {
            --primary-color: #3ABEF9;
            --secondary-color: #0056b3;
            --light-color: #e9f4fe;
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .jumbotron {
            background-color: var(--primary-color);
            color: white;
            border-bottom: 4px solid var(--secondary-color);
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        footer {
            background-color: var(--primary-color);
            color: white;
        }

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
