<div x-data="{ sidebarOpen: false, sidebarExpanded: true }" class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div :class="sidebarExpanded ? 'w-64' : 'w-16'" 
         class="bg-white shadow-lg border-r border-gray-200 transition-all duration-300 ease-in-out flex flex-col z-30 lg:relative fixed inset-y-0 left-0 transform lg:transform-none"
         :class="{ '-translate-x-full': !sidebarOpen }"
         x-show="sidebarOpen || window.innerWidth >= 1024">
        
        <!-- Logo Section -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 hover:opacity-80 transition-opacity duration-200">
                <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="h-8 w-8 flex-shrink-0" />
                <span x-show="sidebarExpanded" x-transition class="text-lg font-bold text-blue-600 whitespace-nowrap">DipVetDoc</span>
            </a>
            
            <!-- Toggle Button -->
            <button @click="sidebarExpanded = !sidebarExpanded" 
                    class="hidden lg:block p-1.5 rounded-lg hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          :d="sidebarExpanded ? 'M11 19l-7-7 7-7M21 12H3' : 'M13 5l7 7-7 7M5 12h14'"></path>
                </svg>
            </button>
            
            <!-- Close Button for Mobile -->
            <button @click="sidebarOpen = false" 
                    class="lg:hidden p-1.5 rounded-lg hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto">
            <!-- Dashboard / Home -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                      {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
               :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">
                    {{ auth()->user()->role === 'user' ? __('Home') : __('Dashboard') }}
                </span>
            </a>

            <!-- Admin-only Links -->
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('users') }}" 
                   class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                          {{ request()->routeIs('users') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                   :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('users') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">{{ __('Users') }}</span>
                </a>

                <a href="{{ route('vet_team') }}" 
                   class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                          {{ request()->routeIs('vet_team') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                   :class="sidebarExpanded ? 'px-3 py-2.5 justify-between' : 'px-0 py-2.5 justify-center'">
                    <div class="flex items-center" :class="sidebarExpanded ? '' : 'justify-center'">
                        <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('vet_team') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">{{ __('Veterinarians') }}</span>
                    </div>
                    @if(!empty($pendingCount) && $pendingCount > 0)
                        <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition 
                              class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse shadow-lg">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>
            @endif

            <!-- Pets / My Pets -->
            <a href="{{ auth()->user()->role === 'user' ? route('my_pets') : route('pets') }}" 
               class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                      {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_pets' : 'pets') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
               :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_pets' : 'pets') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">
                    {{ auth()->user()->role === 'user' ? __('My Pets') : __('Pets') }}
                </span>
            </a>

            <!-- Appointments / My Appointments -->
            <a href="{{ auth()->user()->role === 'user' ? route('my_appointments.index') : route('appointments') }}" 
               class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                      {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_appointments.index' : 'appointments') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
               :class="sidebarExpanded ? 'px-3 py-2.5 justify-between' : 'px-0 py-2.5 justify-center'">
                <div class="flex items-center" :class="sidebarExpanded ? '' : 'justify-center'">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs(auth()->user()->role === 'user' ? 'my_appointments.index' : 'appointments') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">
                        {{ auth()->user()->role === 'user' ? __('My Appointments') : __('My Appointments') }}
                    </span>
                </div>
                @if(auth()->user()->role !== 'user' && !empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
                    <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition 
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse shadow-lg">
                        {{ $pendingAppointmentCount }}
                    </span>
                @endif
            </a>

            <!-- Vet-only Links -->
            @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
                <a href="{{ route('consultations.index') }}" 
                   class="flex items-center text-sm font-medium rounded-lg transition-all duration-200 group
                          {{ request()->routeIs('consultations.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                   :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('consultations.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 whitespace-nowrap">{{ __('Consultations') }}</span>
                </a>
            @endif
        </nav>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200 p-3">
            <div x-data="{ profileOpen: false }" class="relative">
                <button @click="profileOpen = !profileOpen" 
                        class="w-full flex items-center text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="sidebarExpanded ? 'px-3 py-2.5' : 'px-0 py-2.5 justify-center'">
                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div x-show="sidebarExpanded || window.innerWidth < 1024" x-transition class="ml-3 text-left flex-1 min-w-0">
                        <div class="font-medium text-gray-900 truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                    </div>
                    <svg x-show="sidebarExpanded || window.innerWidth < 1024" x-transition 
                         class="w-4 h-4 text-gray-400 transition-transform duration-200 flex-shrink-0 ml-2" 
                         :class="{ 'rotate-180': profileOpen }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Profile Dropdown -->
                <div x-show="profileOpen && (sidebarExpanded || window.innerWidth < 1024)" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('Profile') }}
                    </a>

                    <div class="border-t border-gray-100 my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
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
