<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('dipvetAssets/images/vetlogo1.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('dipvetAssets/images/vetlogo1.png') }}">

    <title>DipVetDoc | Dipolog Veterinary Doctor</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css"/>

    <!-- Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex justify-center">

        <!-- Page wrapper (centered container) -->
    <div class="w-full max-w-[1550px] mx-auto flex flex-col h-screen bg-white shadow-md"
     x-data="{ sidebarExpanded: true }">



            <!-- Navbar -->
            @auth
                <div class="hidden lg:block">
                    @include('layouts.navigation')
                </div>
            @endauth

            <!-- Mobile Header -->
            <div class="lg:hidden bg-white shadow-sm border-b border-gray-200 px-4 py-3 relative z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="h-8 w-8" />
                        <span class="text-lg font-bold text-blue-600">DipVetDoc</span>
                    </div>
                </div>
            </div>
            
            <!-- Content area with sidebar + main -->
            <div class="flex flex-1 overflow-hidden">

                <!-- Sidebar -->
                @auth
               <aside 
                    class="hidden lg:flex bg-white border-r border-gray-200 flex-col transition-all duration-300"
                    :class="sidebarExpanded ? 'w-64' : 'w-16'">
                    
                    <!-- Sidebar content -->
                    <div class="flex-1 overflow-y-auto">
                        @include('layouts.sidebar')
                    </div>
                </aside>

                @endauth

                <!-- Main content -->
                <main id="main-content" class="flex-1 overflow-y-auto p-4">
    @yield('content')
</main>

            </div>
        </div>

        <!-- Mobile Bottom Navbar -->
        @auth
        <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-md z-50">
            <div class="flex justify-around items-center py-2">
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('users') }}" 
                   class="flex flex-col items-center text-sm {{ request()->routeIs('users') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-users text-lg"></i>
                </a>
                <a href="{{ route('vet_team') }}" 
                   class="flex flex-col items-center text-sm {{ request()->routeIs('vet_team') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-shield-halved text-lg"></i>
                </a>
                @endif

                <a href="{{ route('dashboard') }}" 
                   class="flex flex-col items-center text-sm {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-home text-lg"></i>
                </a>
                
                <a href="{{ route('appointments') }}"
                   class="flex flex-col items-center text-sm {{ request()->routeIs('appointments') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-calendar text-lg"></i>
                </a>

                @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
                <a href="{{ route('consultations.index') }}" 
                   class="flex flex-col items-center text-sm {{ request()->routeIs('consultations.index') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-clipboard-list text-lg"></i>
                </a>
                @endif
            </div>
        </nav>
        @endauth
    </div>

    @if(isset($triggerLogoutEvent) && $triggerLogoutEvent)
    <script>
        localStorage.setItem("forceLogout", Date.now());
    </script>
    @endif

    <script>
        window.addEventListener("storage", (event) => {
            if (event.key === "forceLogoutOthers") {
                window.location.href = "{{ route('logged-out') }}";
            }
        });
    </script>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>
