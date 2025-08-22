<x-app-layout>
<section id="hero" class="relative h-screen flex items-center py-5" style="background-color: #1E88E5;">
  <div class="container mx-auto px-6 flex flex-col-reverse md:flex-row items-center md:justify-between">
    
    <!-- Text Content -->
    <div class="max-w-xl text-white md:mr-10">
      <h1 class="font-bold text-4xl md:text-5xl leading-tight mb-4">
        We Care About Your Pets
      </h1>
      <p class="text-lg md:text-xl leading-relaxed mb-6">
        Ensuring quality health and wellness services for all pets.
      </p>
      <a href="#services" 
         class="inline-block font-semibold px-6 py-3 rounded-full shadow-md hover:bg-gray-100 transition"
         style="background-color: white; color: #1E88E5;">
        Explore Services
      </a>
    </div>

    <!-- Image -->
    <div class="mb-6 md:mb-0">
      <img src="{{ asset('dipvetAssets/images/petIllustration.png') }}" 
           alt="Pet Illustration" 
           class="w-full max-w-lg md:max-w-xl lg:max-w-2xl">
    </div>

  </div>
</section>

<!-- Who We Are Section -->
<section id="who-we-are" class="py-16 bg-gray-50">
  <div class="container mx-auto px-6">
    <!-- Section Title -->
<h2 class="font-bold text-center text-gray-900 mb-12 text-[30px]">
  Who We Are
</h2>


    <!-- Cards Grid -->
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
      @php
          $cards = [
              ['icon' => 'paw', 'title' => 'Compassionate Care', 'desc' => 'We are a passionate team of veterinary professionals committed to providing compassionate, high-quality care for your pets. Our clinic is dedicated to your pet’s well-being and happiness.'],
              ['icon' => 'heartbeat', 'title' => 'Experienced Veterinarians', 'desc' => 'With over 15 years of experience, our team ensures that your pets receive the best care possible. We specialize in both routine and emergency veterinary services.'],
              ['icon' => 'thumbs-up', 'title' => 'Trusted by Many', 'desc' => 'Our clinic is trusted by hundreds of pet owners. We focus on expert care and customer satisfaction, building lasting relationships and ensuring quality care every visit.']
          ];
      @endphp

      @foreach($cards as $card)
        <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300">
          <!-- Icon with brand color -->
          <i class="fas fa-{{ $card['icon'] }} fa-4x mb-6" style="color: #1E88E5;"></i>
          <!-- Card Title -->
          <h3 class="font-semibold mb-4 text-[24px]">{{ $card['title'] }}</h3>
          <!-- Card Description -->
          <p class="text-gray-700 leading-relaxed text-[16px]">{{ $card['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- About Us Info Section -->
<section id="about-us-info" class="py-16" style="background: #1E88E5;">
  <div class="container mx-auto px-6">
    
    <!-- Section Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-12">
      About Us
    </h2>

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
      
      <!-- Left Content: Text + Image -->
      <div class="lg:w-2/3 text-center lg:text-left">
        <h3 class="text-xl md:text-2xl font-semibold mb-4 text-white">Who We Are</h3>
        <p class="text-white/90 leading-relaxed mb-6">
          We are a passionate team of veterinary professionals dedicated to providing quality care to your pets with a focus on compassion and expertise.
        </p>
        <img src="{{ asset('dipvetAssets/images/team.jpg') }}" 
             alt="Veterinarian Illustration" 
             class="mx-auto lg:mx-0 w-full max-w-2xl rounded-xl shadow-lg">
      </div>

      <!-- Right Content: Info Cards -->
      <div class="lg:w-1/3 flex flex-col gap-6">
        <!-- Opening Hours Card -->
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition-shadow duration-300">
          <i class="fas fa-clock fa-3x mb-4 text-[#1E88E5]"></i>
          <h4 class="text-lg font-semibold mb-2">Opening Hours</h4>
          <p class="text-gray-700 leading-relaxed">
            Mon - Fri: 8 AM - 6 PM <br> Sat: 9 AM - 3 PM <br> Sun: Closed
          </p>
        </div>

        <!-- Years of Experience Card -->
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition-shadow duration-300">
          <i class="fas fa-briefcase-medical fa-3x mb-4 text-[#1E88E5]"></i>
          <h4 class="text-lg font-semibold mb-2">Years of Experience</h4>
          <p class="text-gray-700 leading-relaxed">
            With over 15 years of experience in veterinary care, we are proud to offer expert services to your pets.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- Our Clinic Section -->
<section id="our-clinic" class="py-16" style="background: linear-gradient(to bottom, #f0f8ff, #e0f7fa);">
  <div class="container mx-auto px-6">

    <!-- Section Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center text-[#1E88E5] mb-12">
      Our Clinic
    </h2>

    <div class="flex flex-col gap-12">
      @php
          $clinicSections = [
              ['title' => 'Consultation Room', 'desc' => 'Our clinic\'s consultation room is designed for comfort and convenience.', 'img' => 'consultationRoom.jpg', 'direction' => 'left'],
              ['title' => 'Vaccination Room', 'desc' => 'Our state-of-the-art vaccination room ensures your pets receive the best care.', 'img' => 'vaccinationRoom.jpg', 'direction' => 'right'],
              ['title' => 'Infectious Exam Room', 'desc' => 'Our fully equipped infectious exam room ensures top-quality surgical care.', 'img' => 'infectiousExamRoom.jpg', 'direction' => 'left'],
              ['title' => 'Pharmacy Room', 'desc' => 'Our in-house pharmacy ensures convenient access to pet medications.', 'img' => 'pharmacyRoom.jpg', 'direction' => 'right'],
          ];
      @endphp

      @foreach($clinicSections as $clinic)
        <div class="flex flex-col lg:flex-row items-center gap-8 {{ $clinic['direction'] === 'right' ? 'lg:flex-row-reverse' : '' }}">
          <!-- Image -->
          <div class="rounded-xl overflow-hidden shadow-lg w-full lg:w-1/2">
            <img src="{{ asset('dipvetAssets/images/' . $clinic['img']) }}" 
                 alt="{{ $clinic['title'] }}" 
                 class="w-full h-80 object-cover hover:scale-105 transition-transform duration-300">
          </div>

          <!-- Text Content -->
          <div class="bg-white rounded-xl shadow-md p-6 w-full lg:w-1/2 text-center lg:text-left">
            <h3 class="text-xl md:text-2xl font-semibold text-[#1E88E5] mb-3">{{ $clinic['title'] }}</h3>
            <p class="text-gray-700 leading-relaxed">{{ $clinic['desc'] }}</p>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Learn More Button -->
    <div class="text-center mt-10">
      <a href="{{ url('Clinic') }}" 
         class="inline-block px-6 py-3 text-white font-semibold rounded-full shadow-md hover:shadow-lg transition"
         style="background-color: #1E88E5;">
        Learn More
      </a>
    </div>
  </div>
</section>


<!-- Gallery Section -->
<section id="gallery" class="py-16" style="background: linear-gradient(to bottom, #f0f8ff, #e0f7fa);">
  <div class="container mx-auto px-6">

    <!-- Section Title -->
    <h2 class="text-3xl md:text-4xl font-bold text-center text-[#1E88E5] mb-8">
      Our Gallery
    </h2>

    <!-- Auto-Moving Scrollable Gallery -->
    <div class="overflow-x-auto whitespace-nowrap py-4 -mx-2 scroll-smooth">
      @php
        $galleryImages = [
          'gal1.jpg', 'gal2.jpg', 'gal3.jpg', 'gal4.jpg', 'gal5.jpg', 'gal6.jpg'
        ];
      @endphp

      @foreach($galleryImages as $img)
        <div class="inline-block px-2">
          <img src="{{ asset('dipvetAssets/images/' . $img) }}" 
               alt="Gallery Image" 
               class="h-72 w-auto object-cover rounded-xl shadow-md hover:scale-105 transition-transform duration-300">
        </div>
      @endforeach
    </div>

    <!-- See More Button -->
    <div class="text-center mt-8">
      <a href="{{ url('Gallery') }}" 
         class="inline-block px-6 py-3 text-white font-semibold rounded-full shadow-md hover:shadow-lg transition"
         style="background-color: #1E88E5;">
        See More
      </a>
    </div>

  </div>
</section>

@push('scripts')
<script>
    const galleryScroll = document.getElementById("gallery-scroll");
    const galleryItems = galleryScroll.querySelectorAll('.gallery-item');

    // Prevent multiple cloning
    if (!galleryScroll.dataset.cloned) {
        galleryItems.forEach(item => {
            const clone = item.cloneNode(true);
            galleryScroll.appendChild(clone);
        });
        galleryScroll.dataset.cloned = "true";
    }

    let isDragging = false;
    let startX;
    let scrollStart;
    const originalScrollWidth = galleryScroll.scrollWidth / 2;

    function autoScrollGallery() {
        if (!isDragging) {
            galleryScroll.scrollLeft += 1;
            if (galleryScroll.scrollLeft >= originalScrollWidth) {
                galleryScroll.scrollLeft = 0;
            }
        }
    }

    let scrollInterval = setInterval(autoScrollGallery, 10);

    galleryScroll.addEventListener("mouseenter", () => clearInterval(scrollInterval));
    galleryScroll.addEventListener("mouseleave", () => {
        if (!isDragging) {
            scrollInterval = setInterval(autoScrollGallery, 10);
        }
    });

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

    galleryScroll.style.cursor = 'grab';
</script>
@endpush

</x-app-layout>
