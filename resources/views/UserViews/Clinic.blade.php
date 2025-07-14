@extends('layout')

@section('content')
<!-- Clinic Header -->
<div class="jumbotron text-center" style="background-color: #A7E6FF;">
    <h1 class="display-4">Welcome to Our Clinic</h1>
    <p class="lead">Meet our dedicated team of veterinarians and staff, here to care for your pets.</p>
</div>

<!-- Features of the Clinic Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Features of Our Clinic</h2>
    <div class="row">
        <!-- Mini Hotel Feature -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <img src="{{ asset('dipvetAssets/images/miniHotel2.jpg') }}" class="card-img-top img-fluid" alt="Mini Hotel">
                <div class="card-body">
                    <h5 class="card-title">Mini Hotel</h5>
                    <p class="card-text">
                        A cozy space for your pets to stay while you're away. Our mini hotel provides 
                        comfortable accommodations and constant care for your furry friends.
                    </p>
                </div>
            </div>
        </div>

        <!-- Grooming Feature -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <img src="{{ asset('dipvetAssets/images/grooming.jpg') }}" class="card-img-top img-fluid" alt="Grooming">
                <div class="card-body">
                    <h5 class="card-title">Grooming Services</h5>
                    <p class="card-text">
                        Professional grooming services to keep your pets looking their best. 
                        We handle pets of all sizes with love and care.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Veterinarians and Staff Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Meet Our Team</h2>
    <div class="row">
        <!-- Veterinarian Profile -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('dipvetAssets/images/ricky.jpg') }}" class="card-img-top img-fluid" alt="Veterinarian" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Dr. Rocky Pango II</h5>
                    <p class="card-text">Lead Veterinarian</p>
                    <p>Specializing in general veterinary care, surgeries, and emergency medicine.</p>
                </div>
            </div>
        </div>

        <!-- Dynamic Staff Profiles -->
        @php
            $staff = [
                ['image' => 'rhianne.jpg', 'name' => 'Doc. Rhianne Magdayao', 'role' => 'Vet Nurse', 'description' => 'Expert in animal nursing and post-operative care.'],
                ['image' => 'charlene.jpg', 'name' => 'Doc Charlene', 'role' => 'Veterinary Technician', 'description' => 'Skilled in diagnostics and lab work.'],
                ['image' => 'cashier.jpg', 'name' => 'Emily Clark', 'role' => 'Receptionist', 'description' => 'Your first point of contact and appointment scheduler.'],
                ['image' => 'leonel.jpg', 'name' => 'Nurse Michael Brown', 'role' => 'Veterinary Assistant', 'description' => 'Supports the veterinarians with exams and treatments.'],
                ['image' => 'groomer.jpg', 'name' => 'Sean Davis', 'role' => 'Groomer', 'description' => 'Provides grooming services to pets of all sizes.'],
                ['image' => 'handler.jpg', 'name' => 'David Wilson', 'role' => 'Pet Trainer', 'description' => 'Helps pets with obedience and behavior training.'],
                ['image' => 'pharmaassistant.jpg', 'name' => 'Linda Taylor', 'role' => 'Pharmacy Assistant', 'description' => 'Manages medications and prescriptions for your pets.'],
            ];
        @endphp

        @foreach ($staff as $member)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('dipvetAssets/images/' . $member['image']) }}" class="card-img-top img-fluid" alt="{{ $member['name'] }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $member['name'] }}</h5>
                    <p class="card-text">{{ $member['role'] }}</p>
                    <p>{{ $member['description'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i>
</button>
@endsection

@push('styles')
<style>
    #scrollToTopBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 1000;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #0c71b8;
        color: white;
        border: none;
        outline: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    #scrollToTopBtn:hover {
        background-color: lightskyblue;
        transform: scale(1.1);
    }

    #scrollToTopBtn i {
        font-size: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    scrollToTopBtn.onclick = function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    };
</script>
@endpush
