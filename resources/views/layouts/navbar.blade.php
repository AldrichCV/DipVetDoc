<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dipolog Veterinary Doctors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .navbar-blur {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .mobile-menu-enter {
            transform: translateX(-100%);
            opacity: 0;
        }
        
        .mobile-menu-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }
        
        .mobile-menu-leave {
            transform: translateX(0);
            opacity: 1;
        }
        
        .mobile-menu-leave-active {
            transform: translateX(-100%);
            opacity: 0;
            transition: all 0.3s ease-in;
        }
        
        .nav-link-hover {
            position: relative;
        }
        
        .nav-link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link-hover:hover::after {
            width: 100%;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.3));
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <header 
        x-data="{ 
            mobileMenuOpen: false, 
            scrolled: false,
            init() {
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 20;
                });
            }
        }" 
        :class="scrolled ? 'navbar-blur bg-white/90 shadow-lg' : 'bg-white/95'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                
                <!-- Logo Section -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <img 
                                src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" 
                                alt="Dipvet Logo" 
                                class="h-10 w-10 lg:h-12 lg:w-12 rounded-full object-cover logo-glow group-hover:scale-110 transition-transform duration-300"
                            >
                            <div class="absolute inset-0 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-lg lg:text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                Dipolog Veterinary
                            </h1>
                            <p class="text-xs lg:text-sm text-gray-500 -mt-1">Doctors</p>
                        </div>
                    </a>
                </div>

                <!-- Grouped desktop navigation and login button to the right with space-x-6 -->
                <div class="hidden lg:flex items-center space-x-6">
                    <!-- Desktop Navigation -->
                    <nav class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 py-2">
                            Home
                        </a>
                        <a href="{{ route('home') }}#who-we-are" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 py-2">
                            About
                        </a>
                        <a href="{{ route('home') }}#our-clinic" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 py-2">
                            Clinic
                        </a>
                        <a href="{{ route('home') }}#gallery" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 py-2">
                            Gallery
                        </a>
                        <a href="{{ route('home') }}#reviews" 
                           class="nav-link-hover text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 py-2">
                            Reviews
                        </a>
                    </nav>

                    <!-- Desktop Login Button -->
                    <button
                        onclick="window.location.href='{{ route('login') }}'"
                        class="btn-gradient text-white px-6 py-2.5 rounded-full font-semibold transition-all duration-300 flex items-center space-x-2"
                    >
                        <i class="fas fa-sign-in-alt text-sm"></i>
                        <span>Login</span>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-300"
                        :class="mobileMenuOpen ? 'text-blue-600 bg-blue-50' : ''"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path 
                                x-show="!mobileMenuOpen" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                            <path 
                                x-show="mobileMenuOpen" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileMenuOpen = false"
            class="lg:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-40"
        ></div>

        <!-- Mobile Menu -->
        <div 
            x-show="mobileMenuOpen"
            x-transition:enter="transition-transform ease-out duration-300"
            x-transition:enter-start="transform -translate-x-full"
            x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition-transform ease-in duration-200"
            x-transition:leave-start="transform translate-x-0"
            x-transition:leave-end="transform -translate-x-full"
            class="lg:hidden fixed top-0 left-0 h-full w-80 bg-white shadow-2xl z-50 overflow-y-auto"
        >
            <div class="p-6">
                <!-- Mobile Logo -->
                <div class="flex items-center space-x-3 mb-8">
                    <img 
                        src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" 
                        alt="Dipvet Logo" 
                        class="h-12 w-12 rounded-full object-cover logo-glow"
                    >
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Dipolog Veterinary</h2>
                        <p class="text-sm text-gray-500">Doctors</p>
                    </div>
                </div>

                <!-- Mobile Navigation Links -->
                <nav class="space-y-4">
                    <a href="{{ route('home') }}" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-home w-5"></i>
                        <span class="font-medium">Home</span>
                    </a>
                    <a href="{{ route('home') }}#who-we-are" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-info-circle w-5"></i>
                        <span class="font-medium">About</span>
                    </a>
                    <a href="{{ route('home') }}#our-clinic" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-hospital w-5"></i>
                        <span class="font-medium">Clinic</span>
                    </a>
                    <a href="{{ route('home') }}#gallery" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-images w-5"></i>
                        <span class="font-medium">Gallery</span>
                    </a>
                    <a href="{{ route('home') }}#Contact" 
                       @click="mobileMenuOpen = false"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">
                        <i class="fas fa-star w-5"></i>
                        <span class="font-medium">Reviews</span>
                    </a>
                </nav>

                <!-- Mobile Login Button -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <button
                        onclick="window.location.href='{{ route('login') }}'"
                        class="w-full btn-gradient text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login to Account</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Spacer for fixed navbar -->
    <div class="h-16 lg:h-20"></div>

    <!-- Smooth scroll script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href*="#"]'); // Changed from ^= to *= to catch URLs with anchors
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Extract anchor from full URL or use direct anchor
                    let anchor = '';
                    if (href.includes('#')) {
                        anchor = href.split('#')[1];
                    }
                    
                    if (anchor === '' || anchor === 'Home') {
                        e.preventDefault();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    } else if (anchor) {
                        const target = document.getElementById(anchor);
                        if (target) {
                            e.preventDefault();
                            const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                            window.scrollTo({
                                top: offsetTop,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
