@extends('layout')

<!-- Hero Section -->
<div class="jumbotron text-center">
    <h1 class="display-4">Our Gallery</h1>
    <p class="lead">Snapshots of care, compassion, and love for pets at Dipolog Veterinary Doctor.</p>
</div>

<!-- Gallery Section -->
<div class="container" id="gallery">
    <h2 class="text-center mb-5">Discover Our Work</h2>

    <!-- Image-Text Rows -->
    @php
        $infoSections = [
            ['img1' => 'oreo.jpg', 'img2' => 'dog.jpg', 'title' => 'Happy Pets in Our Clinic', 'text' => 'Experience a welcoming environment...'],
            ['img1' => 'catheter.jpg', 'img2' => 'isolate.jpg', 'title' => 'Advanced Medical Facilities', 'text' => 'Our clinic is equipped...'],
            ['img1' => 'dog1.jpg', 'img2' => 'husky.jpg', 'title' => 'Outdoor Fun for Pets', 'text' => 'We provide safe and engaging...'],
            ['img1' => 'trust1.jpg', 'img2' => 'trust2.jpg', 'title' => 'Trusted by Pet Owners', 'text' => 'We’ve built a reputation...'],
        ];
    @endphp

    @foreach($infoSections as $index => $section)
        <div class="row image-text-row mb-5 {{ $index % 2 !== 0 ? 'flex-row-reverse' : '' }}">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6">
                        <img class="custom-image" src="{{ asset('dipvetAssets/images/' . $section['img1']) }}" alt="">
                    </div>
                    <div class="col-6">
                        <img class="custom-image" src="{{ asset('dipvetAssets/images/' . $section['img2']) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-container">
                <h4>{{ $section['title'] }}</h4>
                <p>{{ $section['text'] }}</p>
            </div>
        </div>
    @endforeach

    <h2 class="text-center mb-5">Pet Patients Gallery</h2>

    <!-- Pet Cards -->
    <div class="row">
        @php
            $pets = [
                ['name' => 'Fluffy', 'img' => 'pet1.jpg', 'desc' => 'Fluffy came in for a checkup...'],
                ['name' => 'Max', 'img' => 'pet2.jpg', 'desc' => 'Max visited us for grooming...'],
                ['name' => 'Bella', 'img' => 'pet3.jpg', 'desc' => 'Bella’s vaccination day...'],
                ['name' => 'Charlie', 'img' => 'pet4.jpg', 'desc' => 'Charlie had his nails trimmed...'],
                ['name' => 'Lucy', 'img' => 'pet5.jpg', 'desc' => 'Lucy enjoyed a relaxing bath...'],
                ['name' => 'Rocky', 'img' => 'pet6.jpg', 'desc' => 'Rocky received expert treatment...'],
                ['name' => 'Simba', 'img' => 'pet7.jpg', 'desc' => 'Simba’s day at the vet...'],
                ['name' => 'Milo', 'img' => 'pet8.jpg', 'desc' => 'Milo’s teeth cleaning session...'],
                ['name' => 'Luna', 'img' => 'pet9.jpg', 'desc' => 'Luna was treated like royalty...'],
                ['name' => 'Buddy', 'img' => 'pet10.jpg', 'desc' => 'Buddy is now healthier...'],
                ['name' => 'Oscar', 'img' => 'pet11.jpg', 'desc' => 'Oscar loved all the attention...'],
                ['name' => 'Daisy', 'img' => 'pet12.jpg', 'desc' => 'Daisy left with a wagging tail...'],
            ];
        @endphp

        @foreach($pets as $pet)
            <div class="col-md-3 mb-4">
                <div class="pet-card">
                    <img src="{{ asset('dipvetAssets/images/' . $pet['img']) }}" alt="{{ $pet['name'] }}">
                    <h5>{{ $pet['name'] }}</h5>
                    <p>{{ $pet['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>


