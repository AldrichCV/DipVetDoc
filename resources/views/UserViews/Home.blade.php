<div class="carousel-inner">
    <div class="carousel-item active">
        <!-- Video Background -->
        <div class="video-container position-relative">
            <video class="d-block w-100" autoplay loop muted playsinline style="object-fit: cover; height: 100vh;">
                <source src="{{ asset('dipvetAssets/images/vetvideo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <!-- Overlay gradient -->
            <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
        </div>

        <!-- Captions -->
        <div class="carousel-caption d-none d-md-block">
            <h5 class="animated fadeInDown">We Care About Your Pets</h5>
            <p class="animated fadeInUp delay-1s">Ensuring quality health and wellness services for all pets.</p>
        </div>
    </div>
</div>


<!-- Who We Are Section -->
<section id="who-we-are" class="section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Who We Are</h2>
        <div class="row justify-content-center">
            @php
                $cards = [
                    ['icon' => 'paw', 'title' => 'Compassionate Care', 'desc' => 'We are a passionate team of veterinary professionals committed to providing compassionate, high-quality care for your pets. Our clinic is dedicated to your pet’s well-being and happiness.'],
                    ['icon' => 'heartbeat', 'title' => 'Experienced Veterinarians', 'desc' => 'With over 15 years of experience, our team ensures that your pets receive the best care possible. We specialize in both routine and emergency veterinary services.'],
                    ['icon' => 'thumbs-up', 'title' => 'Trusted by Many', 'desc' => 'Our clinic is trusted by hundreds of pet owners. We focus on expert care and customer satisfaction, building lasting relationships and ensuring quality care every visit.']
                ];
            @endphp

            @foreach($cards as $card)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-{{ $card['icon'] }} fa-4x mb-4" style="color: var(--primary-color);"></i>
                            <h5 class="card-title">{{ $card['title'] }}</h5>
                            <p class="section-description">{{ $card['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About Us Info Section -->
<section id="about-us-info" class="section py-5" style="background: linear-gradient(to bottom, #f0f8ff, #e0f7fa);">
    <div class="container">
        <h2 class="section-title text-center mb-5" style="font-size: 2.5rem; color: #3ABEF9;">About Us</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="p-4 text-center">
                    <h5>Who We Are</h5>
                    <p>We are a passionate team of veterinary professionals dedicated to providing quality care to your pets with a focus on compassion and expertise.</p>
                    <img src="{{ asset('dipvetAssets/images/team.jpg') }}" alt="Veterinarian Illustration" class="img-fluid" style="max-width: 600px; height: auto; border-radius: 10px;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="border border-primary p-4 rounded mb-4 text-center">
                    <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                    <h5>Opening Hours</h5>
                    <p>Mon - Fri: 8 AM - 6 PM <br> Sat: 9 AM - 3 PM <br> Sun: Closed</p>
                </div>

                <div class="border border-primary p-4 rounded text-center">
                    <i class="fas fa-briefcase-medical fa-3x mb-3 text-primary"></i>
                    <h5>Years of Experience</h5>
                    <p>With over 15 years of experience in veterinary care, we are proud to offer expert services to your pets.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Clinic Section -->
<section id="our-clinic" class="section py-5" style="background: linear-gradient(to bottom, #f0f8ff, #e0f7fa);">
    <div class="container">
        <h2 class="section-title text-center mb-5" style="font-size: 2.5rem; color: #3ABEF9;">Our Clinic</h2>
        <div class="row">
            @php
                $clinicSections = [
                    ['title' => 'Consultation Room', 'desc' => 'Our clinic\'s reception area is designed for comfort and convenience.', 'img' => 'consultationRoom.jpg', 'direction' => 'left', 'width' => '350px'],
                    ['title' => 'Vaccination Room', 'desc' => 'Our state-of-the-art vaccination room ensures your pets receive the best care.', 'img' => 'vaccinationRoom.jpg', 'direction' => 'right', 'width' => '1000px'],
                    ['title' => 'Infectious Exam Room', 'desc' => 'Our fully equipped infectious exam room ensures top-quality surgical care.', 'img' => 'infectiousExamRoom.jpg', 'direction' => 'left', 'width' => '350px'],
                    ['title' => 'Pharmacy Room', 'desc' => 'Our in-house pharmacy ensures convenient access to pet medications.', 'img' => 'pharmacy room.jpg', 'direction' => 'right', 'width' => '850px'],
                ];
            @endphp

            @foreach($clinicSections as $clinic)
                <div class="col-md-6 mb-4 d-flex flex-column align-items-center {{ $clinic['direction'] === 'right' ? 'flex-md-row-reverse' : '' }}">
                    <div class="clinic-image-container" style="position: relative; overflow: hidden; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <img src="{{ asset('dipvetAssets/images/' . $clinic['img']) }}" alt="{{ $clinic['title'] }}" class="img-fluid mb-4" style="height: 350px; object-fit: cover; width: {{ $clinic['width'] }};">
                        <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); border-radius: 15px;"></div>
                    </div>
                    <div class="text-center mt-4" style="padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <h5 class="card-title" style="font-size: 1.3rem; color: #0056b3;">{{ $clinic['title'] }}</h5>
                        <p class="card-text" style="font-size: 1rem; color: #555;">{{ $clinic['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('Clinic') }}" class="btn btn-primary px-4 py-2" style="font-size: 1.2rem; border-radius: 30px; background-color: #3ABEF9; border: none;">Learn More</a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="section py-5" style="background: linear-gradient(to bottom, #f0f8ff, #e0f7fa);">
    <div class="container">
        <h2 class="section-title text-center mb-5" style="font-size: 2.5rem; color: #3ABEF9;">Our Gallery</h2>

        <!-- Auto-Moving Scrollable Gallery -->
        <div id="gallery-scroll" class="gallery-scroll-container" style="overflow: hidden; white-space: nowrap; padding: 10px; position: relative;">
            <!-- Image 1 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal1.jpg') }}" alt="Gallery Image 1" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            <!-- Image 2 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal2.jpg') }}" alt="Gallery Image 2" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            <!-- Image 3 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal3.jpg') }}" alt="Gallery Image 3" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            <!-- Image 4 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal4.jpg') }}" alt="Gallery Image 4" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            <!-- Image 5 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal5.jpg') }}" alt="Gallery Image 5" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            <!-- Image 6 -->
            <div class="gallery-item d-inline-block mx-2">
                <img src="{{ asset('dipvetAssets/images/gal6.jpg') }}" alt="Gallery Image 6" class="img-fluid" style="height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
        </div>

        <!-- Learn More Button -->
        <div class="text-center mt-4">
            <a href="{{ url('Gallery') }}" class="btn btn-primary px-4 py-2" style="font-size: 1.2rem;  border-radius: 30px; background-color: #3ABEF9; border: none;">
                See More
            </a>
        </div>
    </div>
</section>


<script>
    const galleryScroll = document.getElementById("gallery-scroll");

    // Clone all gallery items and append them for seamless looping
    const galleryItems = galleryScroll.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        const clone = item.cloneNode(true);
        galleryScroll.appendChild(clone);
    });

    let isDragging = false;
    let startX;
    let scrollStart;

    // Width of original gallery content (before cloning)
    const originalScrollWidth = galleryScroll.scrollWidth / 2;

    function autoScrollGallery() {
        if (!isDragging) {
            galleryScroll.scrollLeft += 1; // Adjust speed here

            // Reset to start after scrolling through original content width
            if (galleryScroll.scrollLeft >= originalScrollWidth) {
                galleryScroll.scrollLeft = 0;
            }
        }
    }

    let scrollInterval = setInterval(autoScrollGallery, 10);

    // Pause auto-scroll on hover
    galleryScroll.addEventListener("mouseenter", () => clearInterval(scrollInterval));
    galleryScroll.addEventListener("mouseleave", () => {
        if (!isDragging) {
            scrollInterval = setInterval(autoScrollGallery, 10);
        }
    });

    // Dragging handlers
    galleryScroll.addEventListener("mousedown", (e) => {
        isDragging = true;
        startX = e.pageX - galleryScroll.offsetLeft;
        scrollStart = galleryScroll.scrollLeft;
        clearInterval(scrollInterval);
        galleryScroll.style.cursor = 'grabbing';
    });

    galleryScroll.addEventListener("mouseleave", () => {
        if (isDragging) {
            isDragging = false;
            scrollInterval = setInterval(autoScrollGallery, 10);
            galleryScroll.style.cursor = 'grab';
        }
    });

    galleryScroll.addEventListener("mouseup", () => {
        if (isDragging) {
            isDragging = false;
            scrollInterval = setInterval(autoScrollGallery, 10);
            galleryScroll.style.cursor = 'grab';
        }
    });

    galleryScroll.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - galleryScroll.offsetLeft;
        const walk = (startX - x) * 2;
        galleryScroll.scrollLeft = scrollStart + walk;
    });

    // Set grab cursor
    galleryScroll.style.cursor = 'grab';
</script>

