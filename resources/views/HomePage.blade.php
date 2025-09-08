<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DipVetDoc | Dipolog Veterinary Doctor</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Enhanced animation keyframes with more variety and smoothness */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-left {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fade-in-right {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes rotate-in {
            from {
                opacity: 0;
                transform: rotate(-10deg) scale(0.9);
            }
            to {
                opacity: 1;
                transform: rotate(0deg) scale(1);
            }
        }

        @keyframes slide-in-bottom {
            from {
                opacity: 0;
                transform: translateY(100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce-in {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Animation classes with staggered delays */
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-fade-in-left {
            animation: fade-in-left 0.8s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fade-in-right 0.8s ease-out forwards;
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out forwards;
        }

        .animate-scale-in {
            animation: scale-in 0.6s ease-out forwards;
        }

        .animate-rotate-in {
            animation: rotate-in 0.8s ease-out forwards;
        }

        .animate-slide-in-bottom {
            animation: slide-in-bottom 1s ease-out forwards;
        }

        .animate-bounce-in {
            animation: bounce-in 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Staggered animation delays */
        .animate-delay-100 { animation-delay: 0.1s; }
        .animate-delay-200 { animation-delay: 0.2s; }
        .animate-delay-300 { animation-delay: 0.3s; }
        .animate-delay-400 { animation-delay: 0.4s; }
        .animate-delay-500 { animation-delay: 0.5s; }
        .animate-delay-600 { animation-delay: 0.6s; }

        /* Initial hidden state for animations */
        .animate-on-scroll {
            opacity: 0;
        }

        .gallery-scroll {
            animation: scroll 30s linear infinite;
        }

        .gallery-scroll.paused {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
@include('layouts.navbar') 
<body class="font-sans antialiased">

<div x-data="homepageComponent()">
    <section class="relative flex items-center justify-center overflow-hidden pt-19 pb-15" style="background: linear-gradient(135deg, #1E88E5 0%, #1565C0 50%, #0D47A1 100%);">
        
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-white space-y-8 animate-on-scroll" 
                     x-intersect.once="$el.classList.add('animate-fade-in-left'); $el.classList.remove('animate-on-scroll')">
                    <div class="space-y-4">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight animate-on-scroll" 
                            x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up'); $el.classList.remove('animate-on-scroll'); }, 200)">
                            <span class="text-white-300">Dipolog Veterinary Doctor</span>
                        </h1>
                        <p class="text-xl md:text-2xl leading-relaxed animate-on-scroll" 
                           style="color: #E3F2FD;"
                           x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up', 'animate-delay-300'); $el.classList.remove('animate-on-scroll'); }, 400)">
                            Compassionate care for your beloved pets with state-of-the-art medical facilities
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 animate-on-scroll" 
                         x-intersect.once="setTimeout(() => { $el.classList.add('animate-slide-in-bottom'); $el.classList.remove('animate-on-scroll'); }, 600)">
                        <a href="{{ route('login') }}" 
                           class="text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl" 
                           style="background: #1E88E5;">
                            Book Appointment
                        </a>
                        <button class="border-2 bg-white text-blue-600 hover:bg-blue-50 font-semibold px-8 py-4 rounded-full transition-all duration-300" style="border-color: #1E88E5;">
                            Learn More
                        </button>
                    </div>
                </div>

                <div class="relative animate-on-scroll" 
                     x-intersect.once="$el.classList.add('animate-fade-in-right'); $el.classList.remove('animate-on-scroll')">
                    <div class="relative z-10">
                        <img src="dipvetAssets/images/dipvetIllustration.png?height=500&width=600" 
                             alt="Veterinary Care" 
                             class="w-full h-auto">
                    </div>
                    
                    <div class="absolute top-10 -right-8 w-40 h-40 bg-yellow-400 rounded-full opacity-80 animate-float"></div>
<div class="absolute bottom-10 -left-8 w-32 h-32 bg-white rounded-full opacity-60 animate-bounce"></div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll" 
                 x-intersect.once="$el.classList.add('animate-fade-in-down'); $el.classList.remove('animate-on-scroll')">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Who We Are</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    We are dedicated veterinary professionals committed to providing exceptional care for your pets
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @php
        $cards = [
            ['icon' => 'stethoscope', 'color' => 'from-blue-500 to-blue-600', 'title' => 'Health Checkups', 'desc' => 'Comprehensive health examinations to keep your pets in optimal condition with preventive care'],
            ['icon' => 'syringe', 'color' => 'from-blue-500 to-blue-600', 'title' => 'Vaccinations', 'desc' => 'Complete vaccination programs to protect your pets from diseases and maintain their immunity'],
            ['icon' => 'paw', 'color' => 'from-blue-500 to-blue-600', 'title' => 'Compassionate Care', 'desc' => 'We are a passionate team of veterinary professionals committed to providing compassionate, high-quality care for your pets.']
        ];
    @endphp

    @foreach ($cards as $index => $card)
        <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll"
             x-intersect.once="setTimeout(() => { $el.classList.add('animate-scale-in', 'animate-delay-{{ ($index + 1) * 100 }}'); $el.classList.remove('animate-on-scroll'); }, {{ $index * 200 }})">

            <!-- Icon + Title side by side -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 bg-gradient-to-br {{ $card['color'] }} rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 animate-on-scroll"
                     x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in'); $el.classList.remove('animate-on-scroll'); }, {{ ($index * 200) + 300 }})">
                    <i class="fas fa-{{ $card['icon'] }} text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $card['title'] }}</h3>
            </div>

            <p class="text-gray-600 leading-relaxed">{{ $card['desc'] }}</p>
        </div>
    @endforeach
</div>

        </div>
    </section>
    
    <section id="who-we-are" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 animate-on-scroll" 
                     x-intersect.once="$el.classList.add('animate-fade-in-left'); $el.classList.remove('animate-on-scroll')">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight animate-on-scroll"
                            x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up'); $el.classList.remove('animate-on-scroll'); }, 200)">
                            About <span class="text-blue-600">DipVetDoc</span>
                        </h2>
                        <p class="text-xl text-gray-600 leading-relaxed animate-on-scroll"
                           x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 400)">
                            With over 15 years of experience in veterinary medicine, we provide comprehensive care for all types of pets in a comfortable and modern environment.
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed animate-on-scroll"
                           x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up', 'animate-delay-300'); $el.classList.remove('animate-on-scroll'); }, 600)">
                            Our team of certified veterinarians and support staff are dedicated to ensuring your pets receive the highest quality medical care with compassion and understanding.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center p-6 bg-blue-50 rounded-2xl animate-on-scroll"
                             x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in'); $el.classList.remove('animate-on-scroll'); }, 800)">
                            <div class="text-3xl font-bold text-blue-600 mb-2">500+</div>
                            <div class="text-gray-600">Happy Pets</div>
                        </div>
                        <div class="text-center p-6 bg-green-50 rounded-2xl animate-on-scroll"
                             x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 1000)">
                            <div class="text-3xl font-bold text-green-600 mb-2">15+</div>
                            <div class="text-gray-600">Years Experience</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative animate-on-scroll" 
                     x-intersect.once="$el.classList.add('animate-rotate-in'); $el.classList.remove('animate-on-scroll')">
                    <div class="relative backdrop-blur-sm bg-white/10 rounded-3xl p-8">
                        <img src="dipvetAssets/images/team.jpg?height=400&width=500" 
                             alt="Our Team" 
                             class="w-full h-auto rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our-clinic" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll" 
                 x-intersect.once="$el.classList.add('animate-fade-in-down'); $el.classList.remove('animate-on-scroll')">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Our Clinic</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    State-of-the-art facilities designed for the comfort and care of your beloved pets
                </p>
            </div>
            
            <div class="space-y-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6 animate-on-scroll" 
                         x-intersect.once="$el.classList.add('animate-fade-in-left'); $el.classList.remove('animate-on-scroll')">
                        <h3 class="text-3xl font-bold text-gray-800 animate-on-scroll"
                            x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up'); $el.classList.remove('animate-on-scroll'); }, 200)">Modern Equipment</h3>
                        <p class="text-lg text-gray-600 leading-relaxed animate-on-scroll"
                           x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 400)">
                            Our clinic is equipped with the latest veterinary technology including digital X-ray machines, ultrasound equipment, and advanced surgical tools to provide accurate diagnoses and effective treatments.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-right'); $el.classList.remove('animate-on-scroll'); }, 600)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Digital X-ray and Imaging
                            </li>
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-right', 'animate-delay-100'); $el.classList.remove('animate-on-scroll'); }, 700)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Advanced Surgical Suite
                            </li>
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-right', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 800)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                In-house Laboratory
                            </li>
                        </ul>
                    </div>
                    <div class="relative animate-on-scroll" 
                         x-intersect.once="$el.classList.add('animate-scale-in'); $el.classList.remove('animate-on-scroll')">
                        <img src="dipvetAssets/images/facilities.jpg?height=400&width=500" 
                             alt="Modern Equipment" 
                             class="w-full h-auto rounded-2xl shadow-2xl">
                    </div>
                </div>
                
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="relative lg:order-1 animate-on-scroll" 
                         x-intersect.once="$el.classList.add('animate-rotate-in'); $el.classList.remove('animate-on-scroll')">
                        <img src="dipvetAssets/images/miniHotel2.jpg?height=400&width=500" 
                             alt="Comfortable Environment" 
                             class="w-full h-auto rounded-2xl shadow-2xl">
                    </div>
                    <div class="space-y-6 lg:order-2 animate-on-scroll" 
                         x-intersect.once="$el.classList.add('animate-fade-in-right'); $el.classList.remove('animate-on-scroll')">
                        <h3 class="text-3xl font-bold text-gray-800 animate-on-scroll"
                            x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up'); $el.classList.remove('animate-on-scroll'); }, 200)">Comfortable Environment</h3>
                        <p class="text-lg text-gray-600 leading-relaxed animate-on-scroll"
                           x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-up', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 400)">
                            We've designed our clinic to be a stress-free environment for both pets and their owners, with comfortable waiting areas, spacious examination rooms, and calming atmospheres throughout.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-left'); $el.classList.remove('animate-on-scroll'); }, 600)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Spacious Waiting and Exam Rooms
                            </li>
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-left', 'animate-delay-100'); $el.classList.remove('animate-on-scroll'); }, 700)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Separate Areas for Cats and Dogs
                            </li>
                            <li class="flex items-center text-gray-600 animate-on-scroll"
                                x-intersect.once="setTimeout(() => { $el.classList.add('animate-fade-in-left', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 800)">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                Calming Decor and Soothing Music
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll" 
                 x-intersect.once="$el.classList.add('animate-fade-in-down'); $el.classList.remove('animate-on-scroll')">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Our Gallery</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Take a look at our modern facilities and happy moments with our furry patients
                </p>
            </div>
            
            <div x-data="galleryComponent()" class="relative overflow-hidden rounded-2xl shadow-2xl animate-on-scroll"
                 x-intersect.once="$el.classList.add('animate-scale-in'); $el.classList.remove('animate-on-scroll')">
                <div class="absolute top-4 right-4 z-10 flex gap-2">
                    <button @click="pauseScroll()" 
                            :class="isPaused ? 'bg-green-500' : 'bg-gray-500'"
                            class="text-white p-3 rounded-full shadow-lg hover:scale-110 transition-all duration-300 animate-bounce-in">
                        <i :class="isPaused ? 'fas fa-play' : 'fas fa-pause'"></i>
                    </button>
                    <button @click="resumeScroll()" 
                            class="bg-blue-500 text-white p-3 rounded-full shadow-lg hover:scale-110 transition-all duration-300 animate-bounce-in animate-delay-100">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                
                <div class="flex gallery-scroll" 
                    :class="{ 'paused': isPaused }"
                    @mouseenter="pauseScroll()" 
                    @mouseleave="resumeScroll()">

                    <div class="flex gap-6 px-3">
                        @php
                            $gallery = [
                                ['src' => 'dipvetAssets/images/trust1.jpg?height=300&width=400', 'alt' => 'Clinic Reception'],
                                ['src' => 'dipvetAssets/images/trust2.jpg?height=300&width=400', 'alt' => 'Examination Room'],
                                ['src' => 'dipvetAssets/images/gal1.jpg?height=300&width=400', 'alt' => 'Surgery Room'],
                                ['src' => 'dipvetAssets/images/gal2.jpg?height=300&width=400', 'alt' => 'Happy Pets'],
                                ['src' => 'dipvetAssets/images/gal4.jpg?height=300&width=400', 'alt' => 'Waiting Area'],
                                ['src' => 'dipvetAssets/images/gal5.jpg?height=300&width=400', 'alt' => 'Laboratory'],
                            ];
                        @endphp

                        @foreach ($gallery as $item)
                            <img src="{{ $item['src'] }}" 
                                alt="{{ $item['alt'] }}" 
                                class="h-80 w-96 object-cover rounded-xl shadow-lg flex-shrink-0 hover:scale-105 transition-transform duration-300">
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reviews" class="py-16 bg-gradient-to-br from-blue-50 to-indigo-100" x-data="testimonialsComponent()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll" 
                 x-intersect.once="$el.classList.add('animate-fade-in-down'); $el.classList.remove('animate-on-scroll')">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it. Here's what pet owners have to say about their experience with DipVetDoc.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <template x-for="(testimonial, index) in testimonials" :key="testimonial.name">
                    <div class="bg-white rounded-2xl shadow-lg p-8 transform transition-all duration-300 hover:scale-105 hover:shadow-xl opacity-0"
                         x-init="setTimeout(() => { $el.style.opacity = '1'; $el.classList.add('animate-bounce-in'); }, index * 200)"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        
                        <div class="flex items-center mb-4">
                            <template x-for="star in 5" :key="star">
                                <svg class="w-5 h-5" 
                                     :class="star <= testimonial.rating ? 'text-yellow-400' : 'text-gray-300'"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </template>
                            <span class="ml-2 text-sm text-gray-600" x-text="testimonial.rating + '/5'"></span>
                        </div>

                        <blockquote class="text-gray-700 mb-6 leading-relaxed" x-text="testimonial.text"></blockquote>

                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-lg"
                                 x-text="testimonial.name.charAt(0)"></div>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-900" x-text="testimonial.name"></h4>
                                <p class="text-sm text-gray-600">
                                    <span x-text="testimonial.petName"></span> • <span x-text="testimonial.petType"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="flex justify-center space-x-2 mb-8 animate-on-scroll"
                 x-intersect.once="$el.classList.add('animate-fade-in-up'); $el.classList.remove('animate-on-scroll')">
                <template x-for="(page, index) in Math.ceil(allTestimonials.length / testimonialsPerPage)" :key="index">
                    <button @click="currentPage = index"
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="currentPage === index ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'">
                    </button>
                </template>
            </div>

            <div class="flex justify-center space-x-4 animate-on-scroll"
                 x-intersect.once="$el.classList.add('animate-slide-in-bottom'); $el.classList.remove('animate-on-scroll')">
                <button @click="toggleAutoScroll()"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isAutoScrolling" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m6-10V4a2 2 0 00-2-2H5a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2V4z"></path>
                        <path x-show="isAutoScrolling" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-text="isAutoScrolling ? 'Pause' : 'Auto-scroll'"></span>
                </button>
            </div>

            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="bg-white rounded-xl p-6 shadow-lg animate-on-scroll"
                     x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in'); $el.classList.remove('animate-on-scroll'); }, 0)">
                    <div class="text-3xl font-bold text-blue-600 mb-2">500+</div>
                    <div class="text-gray-600">Happy Clients</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg animate-on-scroll"
                     x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in', 'animate-delay-100'); $el.classList.remove('animate-on-scroll'); }, 200)">
                    <div class="text-3xl font-bold text-green-600 mb-2">4.9</div>
                    <div class="text-gray-600">Average Rating</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg animate-on-scroll"
                     x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in', 'animate-delay-200'); $el.classList.remove('animate-on-scroll'); }, 400)">
                    <div class="text-3xl font-bold text-purple-600 mb-2">1000+</div>
                    <div class="text-gray-600">Pets Treated</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg animate-on-scroll"
                     x-intersect.once="setTimeout(() => { $el.classList.add('animate-bounce-in', 'animate-delay-300'); $el.classList.remove('animate-on-scroll'); }, 600)">
                    <div class="text-3xl font-bold text-orange-600 mb-2">5</div>
                    <div class="text-gray-600">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
function homepageComponent() {
    return {
        init() {
            console.log('[v0] Homepage component initialized with enhanced animations');
            
            // Add intersection observer for performance optimization
            this.setupScrollAnimations();
        },
        
        setupScrollAnimations() {
            // Create intersection observer for better performance
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            // Observe elements that need animation
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        }
    }
}

function galleryComponent() {
    return {
        isPaused: false,
        
        init() {
            console.log('[v0] Gallery component initialized with enhanced controls');
        },
        
        pauseScroll() {
            this.isPaused = true;
            console.log('[v0] Gallery paused');
        },
        
        resumeScroll() {
            this.isPaused = false;
            console.log('[v0] Gallery resumed');
        }
    }
}

function testimonialsComponent() {
    return {
        currentPage: 0,
        testimonialsPerPage: 3,
        isAutoScrolling: false,
        autoScrollInterval: null,
        
        allTestimonials: [
            {
                name: "Sarah Johnson",
                petName: "Bella",
                petType: "Golden Retriever",
                rating: 5,
                text: "Dr. Smith and the team at DipVetDoc are absolutely wonderful! They took such great care of Bella during her surgery and the follow-up care was exceptional. I wouldn't trust anyone else with my furry family member."
            },
            {
                name: "Michael Chen",
                petName: "Whiskers",
                petType: "Persian Cat",
                rating: 5,
                text: "The staff here is incredibly knowledgeable and caring. Whiskers was very anxious, but they made him feel comfortable immediately. The facility is clean and modern, and the prices are very reasonable."
            },
            {
                name: "Emily Rodriguez",
                petName: "Max",
                petType: "German Shepherd",
                rating: 5,
                text: "I've been bringing Max here for 3 years now, and the consistency in quality care is remarkable. They remember Max by name and always provide personalized attention. Highly recommend!"
            },
            {
                name: "David Thompson",
                petName: "Luna",
                petType: "Border Collie",
                rating: 4,
                text: "Great experience overall! Luna received excellent care during her vaccination visit. The veterinarian explained everything clearly and answered all my questions patiently."
            },
            {
                name: "Jessica Martinez",
                petName: "Oliver",
                petType: "Maine Coon",
                rating: 5,
                text: "Emergency visit at 2 AM and they were there for us! Oliver had eaten something he shouldn't have, and the night staff was professional and caring. They saved his life!"
            },
            {
                name: "Robert Wilson",
                petName: "Buddy",
                petType: "Labrador Mix",
                rating: 5,
                text: "The preventive care program here is fantastic. Buddy gets regular check-ups and the staff always catches potential issues early. It's given me such peace of mind as a pet owner."
            }
        ],

        get testimonials() {
            const start = this.currentPage * this.testimonialsPerPage;
            return this.allTestimonials.slice(start, start + this.testimonialsPerPage);
        },

        init() {
            console.log('[v0] Testimonials component initialized');
            // Start auto-scroll after a brief delay to ensure proper rendering
            setTimeout(() => {
                this.startAutoScroll();
            }, 1000);
        },

        nextPage() {
            const maxPage = Math.ceil(this.allTestimonials.length / this.testimonialsPerPage) - 1;
            this.currentPage = this.currentPage >= maxPage ? 0 : this.currentPage + 1;
        },

        startAutoScroll() {
            this.isAutoScrolling = true;
            this.autoScrollInterval = setInterval(() => {
                this.nextPage();
            }, 5000);
        },

        stopAutoScroll() {
            this.isAutoScrolling = false;
            if (this.autoScrollInterval) {
                clearInterval(this.autoScrollInterval);
                this.autoScrollInterval = null;
            }
        },

        toggleAutoScroll() {
            if (this.isAutoScrolling) {
                this.stopAutoScroll();
            } else {
                this.startAutoScroll();
            }
        }
    }
}
</script>
@include('layouts.footer')
</body>
</html>
