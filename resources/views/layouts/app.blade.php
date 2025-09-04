<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('dipvetAssets/images/vetlogo1.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('dipvetAssets/images/vetlogo1.png') }}">

        <title>DipVetDoc | Dipolog Veterinary Doctor</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div x-data="{ sidebarExpanded: true }" class="flex h-screen bg-gray-50">

    <!-- Sidebar -->
    @auth
    <aside 
        :class="sidebarExpanded ? 'w-64' : 'w-16'" 
        class="bg-white shadow-lg border-r border-gray-200 h-screen fixed flex flex-col transition-all duration-300 ease-in-out">
        @include('layouts.sidebar')
    </aside>
    @endauth

    <!-- Main content (Navbar + Page content) -->
    <div 
        :class="sidebarExpanded ? 'ml-64' : 'ml-16'" 
        class="flex-1 flex flex-col h-screen overflow-auto transition-all duration-300 ease-in-out">

        @auth    
            @include('layouts.navigation')
        @endauth

        <!-- Your page content -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>


    </div>

</div>
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        @stack('scripts')
    </body>
</html>
