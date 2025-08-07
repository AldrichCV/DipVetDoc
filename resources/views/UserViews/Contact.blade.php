<body>

<!-- Contact Page Header -->
<div class="jumbotron jumbotron-fluid text-white text-center" style="background-color: #A7E6FF;">
    <h1 class="display-4">Get in Touch</h1>
    <p class="lead">We’d love to hear from you! Reach out for inquiries, support, or feedback.</p>
</div>

<!-- Contact Form Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">Contact Information</h3>
    <p><strong>📍 Address:</strong> Highway Sta. Filomena, Dipolog City, Philippines</p>
    <p><strong>📧 Email:</strong>  <a href="https://mail.google.com/dipologvetdoctor@gmail.com">dipologvetdoctor@gmail.com</a></p>
    <p><strong>🔵 Facebook:</strong>  
    <a href="https://www.facebook.com/DipologVeterinaryDoctor" target="_blank" rel="noopener noreferrer">
        @DipologVeterinaryDoctor
    </a>
</p>
    <p><strong>📸 Instagram:</strong>  
    <a href="https://www.instagram.com/dipologveterinarydoctor_ig" target="_blank" rel="noopener noreferrer">
        dipologveterinarydoctor_ig
    </a>
</p>
    <p><strong>📞 Phone:</strong> 0908 994 0255</p>
    <p><strong>🕒 Hours:</strong> Mon-Fri, 9:00 AM - 6:00 PM</p>
        </div>
        
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Google Maps Embed -->
<div class="container my-5">
    <h3 class="text-center">Find Us Here</h3>
    <div class="embed-responsive embed-responsive-16by9">
        <iframe 
            class="embed-responsive-item" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15680.474020264764!2d123.3396646!3d8.5696637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32549710bf2b34c1%3A0x50bd1ae644a3a25a!2sHighway%20Sta.%20Filomena%2C%20Dipolog%20City%2C%20Philippines!5e0!3m2!1sen!2sph!4v1698765432100!5m2!1sen!2sph"
            width="600"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
        :root {
            --primary-color: #3ABEF9; /* Light Blue */
            --secondary-color: #0056b3; /* Dark Blue */
            --light-color: #e9f4fe; /* Light background */
            --card-bg-color: #f7f7f7; /* Light card background */
            --card-hover-color: #e0f7ff; /* Hover effect for cards */
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