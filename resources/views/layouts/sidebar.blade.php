<div class="flex flex-col h-full">
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('dipvetAssets/images/vetlogo1.png') }}" alt="Logo" class="h-8 w-8">
            <span x-show="sidebarExpanded" class="font-bold text-blue-600 text-lg">DipVetDoc</span>
        </a>
        <!-- Collapse/Expand Button 
        <button @click="sidebarExpanded = !sidebarExpanded" 
                class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <i class="fa fa-bars"></i>
        </button>-->
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 
                  {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
            <i class="fa fa-home w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Dashboard</span>
        </a>

        <a href="{{ auth()->user()->role === 'user' ? route('my_appointments.index') : route('appointments') }}" 
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 
                  {{ request()->routeIs('my_appointments.index') || request()->routeIs('appointments') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
            <i class="fa fa-calendar w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Appointments</span>
        </a>

        @if(Auth::user()->role === 'admin')
        <a href="{{ route('users') }}" 
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 
                  {{ request()->routeIs('users') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
            <i class="fa fa-users w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Users</span>
        </a>

        <!-- Vet Team 
        <a href="{{ route('vet_team') }}" 
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 
                  {{ request()->routeIs('vet_team') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
            <i class="fa fa-shield-halved w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Vet Team</span>
        </a>-->
        @endif

        @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
        <a href="{{ route('consultations.index') }}" 
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 
                  {{ request()->routeIs('consultations.index') ? 'bg-blue-100 text-blue-600' : 'text-gray-700' }}">
            <i class="fa fa-clipboard-list w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Consultations</span>
        </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">
                <i class="fa fa-sign-out-alt w-6 text-center"></i>
                <span x-show="sidebarExpanded" class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</div>
