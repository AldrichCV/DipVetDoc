<div x-data="{ sidebarOpen: false}" class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div :class="sidebarExpanded ? 'w-64' : 'w-16'"
         class="bg-white shadow-lg border-r border-gray-200 flex flex-col z-30 lg:relative fixed inset-y-0 left-0 transform lg:transform-none"
         :class="{ '-translate-x-full': !sidebarOpen }"
         x-show="sidebarOpen || window.innerWidth >= 1024">

        <!-- Logo Section -->
        <div class="p-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" 
            class="flex items-center justify-center lg:justify-start">
            
                <!-- Logo Image (fixed, never shrinks) -->
                <div class="flex-shrink-0 flex items-center justify-center">
                    <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" 
                        alt="Logo" 
                        class="h-8 w-8" />
                </div>

                <!-- Brand Text (only when expanded) -->
                <span x-show="sidebarExpanded" 
                    x-transition 
                    class="ml-3 text-lg font-bold text-blue-600 whitespace-nowrap">
                    DipVetDoc
                </span>
            </a>
            
            <!-- Close Button for Mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <!-- X Mark -->
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586 
                    l4.293-4.293a1 1 0 111.414 1.414L11.414 10 
                    l4.293 4.293a1 1 0 01-1.414 1.414L10 
                    11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 
                    10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
<nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto">
    <!-- Dashboard / Home -->
    <a href="{{ route('dashboard') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
        <x-heroicon-o-home
            class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400' }}" />
        <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">
            {{ auth()->user()->role === 'user' ? __('Home') : __('Dashboard') }}
        </span>
    </a>

    <!-- Admin-only Links -->
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('users') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs('users') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
        <x-heroicon-o-users
            class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('users') ? 'text-blue-600' : 'text-gray-400' }}" />
        <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">{{ __('Users') }}</span>
    </a>

    <a href="{{ route('vet_team') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs('vet_team') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5 justify-between' : 'px-0 py-2.5 justify-center'">
        <div class="flex items-center">
            <x-heroicon-o-shield-check
                class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('vet_team') ? 'text-blue-600' : 'text-gray-400' }}" />
            <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">{{ __('Veterinarians') }}</span>
        </div>
        @if(!empty($pendingCount) && $pendingCount > 0)
        <span x-show="sidebarExpanded || window.innerWidth < 1024"
              class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full shadow-lg">
            {{ $pendingCount }}
        </span>
        @endif
    </a>
    @endif

    <!-- Pets -->
    <a href="{{ auth()->user()->role === 'user' ? route('my_pets') : route('pets') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_pets' : 'pets') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
        <x-heroicon-o-heart
            class="w-5 h-5 flex-shrink-0 {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_pets' : 'pets') ? 'text-blue-600' : 'text-gray-400' }}" />
        <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">
            {{ auth()->user()->role === 'user' ? __('My Pets') : __('Pets') }}
        </span>
    </a>

    <!-- Appointments -->
    <a href="{{ auth()->user()->role === 'user' ? route('my_appointments.index') : route('appointments') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_appointments.index' : 'appointments') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5 justify-between' : 'px-0 py-2.5 justify-center'">
        <div class="flex items-center">
            <x-heroicon-o-calendar
                class="w-5 h-5 flex-shrink-0 {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_appointments.index' : 'appointments') ? 'text-blue-600' : 'text-gray-400' }}" />
            <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">
                {{ __('My Appointments') }}
            </span>
        </div>
        @if(auth()->user()->role !== 'user' && !empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
        <span x-show="sidebarExpanded || window.innerWidth < 1024"
              class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full shadow-lg">
            {{ $pendingAppointmentCount }}
        </span>
        @endif
    </a>

    <!-- Vet-only Links -->
    @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
    <a href="{{ route('consultations.index') }}"
       class="flex items-center text-sm font-medium rounded-lg group {{ request()->routeIs('consultations.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50' }}"
       :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
        <x-heroicon-o-clipboard-document-list
            class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('consultations.index') ? 'text-blue-600' : 'text-gray-400' }}" />
        <span x-show="sidebarExpanded || window.innerWidth < 1024" class="ml-3 whitespace-nowrap">{{ __('Consultations') }}</span>
    </a>
    @endif
</nav>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200 p-3">
            <div x-data="{ profileOpen: false }" class="relative">
                <button @click="profileOpen = !profileOpen"
                        class="w-full flex items-center text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                   <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mb-2">
        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 12H9v-2h2v2zm0-4H9V6h2v4z"/>
        </svg>
    </div>

    <!-- Branding Text -->
    <div x-show="sidebarExpanded || window.innerWidth < 1024" class="text-center">
        <div class="text-sm font-semibold text-gray-800">Dipolog Veterinary</div>
        <div class="text-xs text-gray-500">System v1.0</div>
                    
                </button>

            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 z-20 lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">

        <!-- Mobile Header -->
        <div class="lg:hidden bg-white shadow-sm border-b border-gray-200 px-4 py-3 relative z-10">
            <div class="flex items-center justify-between">
                <button @click="sidebarOpen = true" 
                        class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="h-8 w-8" />
                    <span class="text-lg font-bold text-blue-600">DipVetDoc</span>
                </div>
                
                <div class="w-10"></div> <!-- Spacer for centering -->
            </div>
        </div>
    </div>
</div>