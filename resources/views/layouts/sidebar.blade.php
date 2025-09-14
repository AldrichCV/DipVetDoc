<div class="flex flex-col h-full">
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" data-ajax data-route="dashboard"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
            <i class="fa fa-home w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Dashboard</span>
        </a>

        <!-- Appointments -->
        <a href="{{ auth()->user()->role === 'user' ? route('appointments') : route('appointments') }}" 
           data-ajax data-route="appointments"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
            <i class="fa fa-calendar w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Appointments</span>
        </a>

        <!-- Admin-only: Users -->
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('users') }}" data-ajax data-route="users"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
            <i class="fa fa-users w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Users</span>
        </a>
        @endif

        <!-- Vet/Admin: Consultations -->
        @if(Auth::user()->role === 'vet' || Auth::user()->role === 'admin')
        <a href="{{ route('consultations.index') }}" data-ajax data-route="consultations"
           class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
            <i class="fa fa-clipboard-list w-6 text-center"></i>
            <span x-show="sidebarExpanded" class="ml-3">Consultations</span>
        </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600">
                <i class="fa fa-sign-out-alt w-6 text-center"></i>
                <span x-show="sidebarExpanded" class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</div>
