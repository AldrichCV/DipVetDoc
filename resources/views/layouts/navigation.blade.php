<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity duration-200">
                        <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="block h-10 w-auto" />
                        <span class="hidden md:block text-xl font-bold text-blue-600">DipVetDoc</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">
          
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('users')" :active="request()->routeIs('users')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">

                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            {{ __('Users') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('vet_team')" :active="request()->routeIs('vet_team')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">

                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('Veterinarians') }}

                            @if(!empty($pendingCount) && $pendingCount > 0)
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse shadow-lg">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </x-nav-link>

                        <x-nav-link :href="route('pets')" :active="request()->routeIs('pets')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">
             
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            {{ __('Pets') }}
                        </x-nav-link>

                        <x-nav-link :href="route('appointments')" :active="request()->routeIs('appointments')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">
                       
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('Appointments') }}

                            @if(!empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
                                 Enhanced notification badge with animation 
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse shadow-lg">
                                    {{ $pendingAppointmentCount }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'vet')
                        <x-nav-link :href="route('appointments')" :active="request()->routeIs('appointments')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">
                         
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('Appointments') }}

                            @if(!empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
                               
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse shadow-lg">
                                    {{ $pendingAppointmentCount }}
                                </span>
                            @endif
                        </x-nav-link>

                        <x-nav-link :href="route('consultations.index')" :active="request()->routeIs('consultations.index')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-gray-50">
                            
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ __('Consultations') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
 
         
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 bg-gray-50 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-200">
                            <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="flex items-center px-3 py-2 rounded-lg">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')"
                    class="flex items-center px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    {{ __('Users') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('vet_team')" :active="request()->routeIs('vet_team')"
                    class="flex items-center justify-between px-3 py-2 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('Veterinarians') }}
                    </div>
                    @if(!empty($pendingCount) && $pendingCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('pets')" :active="request()->routeIs('pets')"
                    class="flex items-center px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    {{ __('Pets') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('appointments')" :active="request()->routeIs('appointments')"
                    class="flex items-center justify-between px-3 py-2 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('Appointments') }}
                    </div>
                    @if(!empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                            {{ $pendingAppointmentCount }}
                        </span>
                    @endif
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->role === 'vet')
                <x-responsive-nav-link :href="route('appointments')" :active="request()->routeIs('appointments')"
                    class="flex items-center justify-between px-3 py-2 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('Appointments') }}
                    </div>
                    @if(!empty($pendingAppointmentCount) && $pendingAppointmentCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                            {{ $pendingAppointmentCount }}
                        </span>
                    @endif
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('consultations.index')" :active="request()->routeIs('consultations.index')"
                    class="flex items-center px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('Consultations') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="px-4 py-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        <div class="text-xs text-amber-600 capitalize font-medium">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="flex items-center px-3 py-2 rounded-lg text-red-600"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
