<nav class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-4">
                       
            <!-- Toggle Button -->
           <button @click="$store.sidebar.toggle()" 
        class="hidden lg:block p-1.5 rounded-lg hover:bg-gray-100 transition-colors duration-200 focus:outline-none">
    <x-heroicon-o-bars-3 x-show="!$store.sidebar.expanded" class="w-5 h-5 text-gray-600" />
    <x-heroicon-o-x-mark x-show="$store.sidebar.expanded" class="w-5 h-5 text-gray-600" />
</button>

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ asset('dipvetAssets/images/dip_vet_doc.png') }}" 
                     alt="Logo" class="h-12 w-12">
                <span class="font-bold text-blue-600 text-2xl">DipVetDoc</span>
            </a>
    
            </div>
            
            <div class="flex items-center space-x-4">

               <!-- Notifications -->
               <div class="relative">
                   <x-notifications />
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-2">
                            <div class="px-4 py-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                        <div class="text-xs text-blue-600 capitalize font-medium">{{ Auth::user()->role }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <x-dropdown-link :href="route('profile.edit')" data-ajax class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ __('Profile Settings') }}
                                </x-dropdown-link>

                                <x-dropdown-link href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ __('Preferences') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Sign Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
