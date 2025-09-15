<div x-data="{ open: false }" class="relative">
    <!-- Bell Button -->
    <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 relative">
        <!-- Bell Icon -->
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 
                   6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 
                   6.165 6 8.388 6 11v3.159c0 .538-.214 
                   1.055-.595 1.436L4 17h5m6 0v1a3 3 0 
                   11-6 0v-1m6 0H9" />
        </svg>

        <!-- Notification Badge -->
        @if(($pendingCount ?? 0) + ($pendingAppointmentCount ?? 0) > 0)
            <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs 
                        rounded-full flex items-center justify-center animate-pulse">
                {{ ($pendingCount ?? 0) + ($pendingAppointmentCount ?? 0) }}
            </span>
        @endif
    </button>

    <!-- Dropdown -->
    <div 
        x-show="open" 
        @click.away="open = false" 
        x-transition
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 overflow-hidden">
        
        <!-- Header -->
        <div class="px-4 py-2 border-b flex justify-between items-center">
            <h6 class="font-semibold text-gray-700">Notifications</h6>
            <a href="#!" class="text-sm text-blue-600 hover:underline">Mark all as read</a>
        </div>

        <!-- Notification List -->
        <div class="max-h-60 overflow-y-auto divide-y">
            @forelse($notifications as $note)
                <div class="px-4 py-3 hover:bg-gray-50">
                    <p class="text-sm">{!! $note['message'] !!}</p>
                    <span class="text-xs text-gray-500">
                        {{ $note['icon'] ?? '🔔' }} {{ $note['time'] ?? '' }}
                    </span>
                </div>
            @empty
                <div class="px-4 py-6 text-center text-gray-500 text-sm">
                    No new notifications
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        <div class="px-4 py-2 border-t text-center">
            <a href="#!" class="text-sm text-blue-600 hover:underline">View all</a>
        </div>
    </div>
</div>
