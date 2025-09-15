<div class="flex flex-col h-full w-full" x-data="{ activeRoute: window.location.pathname, sidebarExpanded: true }">
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden px-1 sm:px-2 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           x-on:click="activeRoute = '{{ route('dashboard') }}'"
           :class="{ 'bg-blue-100 text-blue-800': activeRoute === '{{ route('dashboard') }}' }"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 focus:bg-blue-200 text-gray-700 transition-colors animate-nav-item"
           :aria-current="activeRoute === '{{ route('dashboard') }}' ? 'page' : undefined"
           aria-label="Go to Dashboard"
        >
            <div class="flex items-center w-full">
                <div class="w-6 text-center flex-shrink-0">
                    <i class="fa-solid fa-home text-lg"></i>
                </div>
                <template x-if="sidebarExpanded">
                    <span class="truncate ml-3">Dashboard</span>
                </template>
            </div>
        </a>

        <!-- Appointments -->
        <a href="{{ route('appointments') }}" 
           x-on:click="activeRoute = '{{ route('appointments') }}'"
           :class="{ 'bg-blue-100 text-blue-800': activeRoute === '{{ route('appointments') }}' }"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 focus:bg-blue-200 text-gray-700 transition-colors animate-nav-item"
           :aria-current="activeRoute === '{{ route('appointments') }}' ? 'page' : undefined"
           aria-label="Go to Appointments"
        >
            <div class="flex items-center w-full">
                <div class="w-6 text-center flex-shrink-0">
                    <i class="fa-solid fa-calendar text-lg"></i>
                </div>
                <template x-if="sidebarExpanded">
                    <span class="truncate ml-3">Appointments</span>
                </template>
            </div>
        </a>

        <!-- Admin-only: Users -->
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('users') }}" 
           x-on:click="activeRoute = '{{ route('users') }}'"
           :class="{ 'bg-blue-100 text-blue-800': activeRoute === '{{ route('users') }}' }"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 focus:bg-blue-200 text-gray-700 transition-colors animate-nav-item"
           :aria-current="activeRoute === '{{ route('users') }}' ? 'page' : undefined"
           aria-label="Go to Users"
        >
            <div class="flex items-center w-full">
                <div class="w-6 text-center flex-shrink-0">
                    <i class="fa-solid fa-users text-lg"></i>
                </div>
                <template x-if="sidebarExpanded">
                    <span class="truncate ml-3">Users</span>
                </template>
            </div>
        </a>
        @endif

        <!-- Vet/Admin: Consultations -->
        @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
        <a href="{{ route('consultations.index') }}" 
           x-on:click="activeRoute = '{{ route('consultations.index') }}'"
           :class="{ 'bg-blue-100 text-blue-800': activeRoute === '{{ route('consultations.index') }}' }"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 focus:bg-blue-200 text-gray-700 transition-colors animate-nav-item"
           :aria-current="activeRoute === '{{ route('consultations.index') }}' ? 'page' : undefined"
           aria-label="Go to Consultations"
        >
            <div class="flex items-center w-full">
                <div class="w-6 text-center flex-shrink-0">
                    <i class="fa-solid fa-clipboard-list text-lg"></i>
                </div>
                <template x-if="sidebarExpanded">
                    <span class="truncate ml-3">Consultations</span>
                </template>
            </div>
        </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="p-4 border-gray-200 overflow-y-auto overflow-x-hidden">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 transition-colors animate-nav-item"
                    aria-label="Log out"
            >
                <div class="flex items-center w-full">
                    <div class="w-6 text-center flex-shrink-0">
                        <i class="fa-solid fa-sign-out-alt text-lg"></i>
                    </div>
                    <template x-if="sidebarExpanded">
                        <span class="truncate ml-3">Logout</span>
                    </template>
                </div>
            </button>
        </form>
    </div>
</div>

