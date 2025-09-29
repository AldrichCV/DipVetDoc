<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('layouts.partials.head-assets')

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- x-cloak style -->
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="font-sans antialiased bg-white" x-data>
    <div class="min-h-screen flex justify-center" x-cloak>
        <!-- Page wrapper -->
        <div class="w-full max-w-[1550px] mx-auto flex flex-col h-screen bg-white shadow-md" 
             x-data="{ sidebarExpanded: true }" 
             x-cloak>

            <!-- Mobile Header -->
            <div class="lg:hidden bg-white shadow-sm border-b border-gray-200 px-4 py-3 relative z-10" x-cloak>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="h-8 w-8" />
                        <span class="text-lg font-bold text-blue-600">DipVetDoc</span>
                    </div>
                </div>
            </div>

            <!-- Navbar -->
            @auth
            <div id="navigation" class="hidden lg:block" x-cloak>
                {!! Cache::remember('navbar_' . auth()->id(), now()->addHour(), function () {
                    return view('layouts.navigation')->render();
                }) !!}
            </div>
            @endauth

            <!-- Content area: sidebar + main -->
            <div class="flex flex-1 overflow-hidden" x-cloak>
                <!-- Sidebar -->
                @auth
                <aside id="sidebar"
                       x-cloak
                       class="hidden lg:flex bg-white flex-col transition-all duration-200"
                       x-data
                       :class="$store.sidebar.expanded ? 'w-64' : 'w-16'">
                    <div class="flex-1 overflow-y-auto">
                        {!! Cache::remember('sidebar_' . auth()->id(), now()->addHour(), function () {
                            return view('layouts.sidebar')->render();
                        }) !!}
                    </div>
                </aside>
                @endauth

                <!-- Main content -->
                <main id="main-content" class="flex-1 overflow-y-auto p-4 relative" 
                      x-data="{ loading: true }" 
                      x-init="window.addEventListener('load', () => loading = false)">
                    
                    <!-- Preloader -->
                    <div x-show="loading" 
                         class="absolute inset-0 flex items-center justify-center bg-white z-50">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-600"></div>
                    </div>

                    <!-- Actual content -->
                    <div x-show="!loading" x-cloak>
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <!-- Mobile Bottom Navbar -->
        @auth
        <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-md z-50" x-cloak>
            <div class="flex justify-around items-center py-2">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users') }}" class="flex flex-col items-center text-sm {{ request()->routeIs('users') ? 'text-blue-600' : 'text-gray-500' }}">
                        <i class="fa fa-users text-lg"></i>
                    </a>
                    <a href="{{ route('vet_team') }}" class="flex flex-col items-center text-sm {{ request()->routeIs('vet_team') ? 'text-blue-600' : 'text-gray-500' }}">
                        <i class="fa fa-shield-halved text-lg"></i>
                    </a>
                @endif

                <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-sm {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-home text-lg"></i>
                </a>
                
                <a href="{{ route('appointments') }}" class="flex flex-col items-center text-sm {{ request()->routeIs('appointments') ? 'text-blue-600' : 'text-gray-500' }}">
                    <i class="fa fa-calendar text-lg"></i>
                </a>

                @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
                    <a href="{{ route('consultations.index') }}" class="flex flex-col items-center text-sm {{ request()->routeIs('consultations.index') ? 'text-blue-600' : 'text-gray-500' }}">
                        <i class="fa fa-clipboard-list text-lg"></i>
                    </a>
                @endif
            </div>
        </nav>
        @endauth
    </div>

    <!-- Alpine + SPA navigation -->
    <script>
        const isAuthenticated = @json(auth()->check());
        window.addEventListener("pageshow", event => {
            if (event.persisted && !isAuthenticated) location.href = "{{ route('logged-out') }}";
        });
        window.addEventListener("popstate", () => { if (!isAuthenticated) location.href = "{{ route('logged-out') }}"; });
        if (!isAuthenticated) history.pushState(null, null, location.href);
        window.addEventListener("storage", event => {
            if (event.key === "forceLogout" || event.key === "forceLogoutOthers") location.href = "{{ route('logged-out') }}";
        });
    </script>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>
