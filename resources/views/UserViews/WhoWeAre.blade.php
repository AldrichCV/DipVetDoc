<section id="who-we-are" class="section py-5">
  <div class="container">
    <h2 class="section-title">Who We Are</h2>
    <div class="row justify-content-center">

      <!-- Compassionate Care Card -->
      <div class="col-md-6 col-lg-4 mb-4 d-flex">
        <div class="card flex-fill">
          <div class="card-body d-flex flex-column text-center">
            <i class="fas fa-paw fa-4x mb-4" style="color: var(--primary-color);"></i>
            <h5 class="card-title">Compassionate Care</h5>
            <p class="section-description flex-grow-1">We are a passionate team of veterinary professionals committed to providing compassionate, high-quality care for your pets. Our clinic is dedicated to your pet’s well-being and happiness.</p>
          </div>
        </div>
      </div>

      <!-- Experienced Veterinarians Card -->
      <div class="col-md-6 col-lg-4 mb-4 d-flex">
        <div class="card flex-fill">
          <div class="card-body d-flex flex-column text-center">
            <i class="fas fa-heartbeat fa-4x mb-4" style="color: var(--primary-color);"></i>
            <h5 class="card-title">Experienced Veterinarians</h5>
            <p class="section-description flex-grow-1">With over 15 years of experience, our team ensures that your pets receive the best care possible. We specialize in both routine and emergency veterinary services.</p>
          </div>
        </div>
      </div>

      <!-- Trusted by Many Card -->
      <div class="col-md-6 col-lg-4 mb-4 d-flex">
        <div class="card flex-fill">
          <div class="card-body d-flex flex-column text-center">
            <i class="fas fa-thumbs-up fa-4x mb-4" style="color: var(--primary-color);"></i>
            <h5 class="card-title">Trusted by Many</h5>
            <p class="section-description flex-grow-1">Our clinic is trusted by hundreds of pet owners. Focusing on expert care and customer satisfaction, we have built lasting relationships with our clients, ensuring their pets receive the best care every time they visit.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
      
        .section-title {
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .section-description {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 40px;
        }
        .section img {
            max-width: 100%;
            border-radius: 8px;
        }
        
        /* Improved Who We Are Section */
      /* Existing styles kept as is... */

/* Ensure all cards in who-we-are section have equal height */
#who-we-are .card {
    display: flex;
    flex-direction: column;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    transition: transform 0.3s ease;
    height: 100%; /* fill column height */
}

#who-we-are .card:hover {
    transform: translateY(-5px);
}

#who-we-are .card-body {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 30px;
    text-align: center;
}

/* Make sure icons and text have consistent spacing */
#who-we-are .card-body i {
    margin-bottom: 20px;
}

/* Stretch cards in each row to the same height */
#who-we-are .row > [class*='col-'] {
    display: flex;
    flex-direction: column;
}

/* Optional: fix min-height for all cards to keep consistent on larger screens */
@media (min-width: 992px) {
    #who-we-are .card {
        min-height: 380px; /* adjust this as needed */
    }
}

        </style>