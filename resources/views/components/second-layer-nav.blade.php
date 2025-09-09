@props([
    'page' => null,            // e.g., 'users', 'appointments', etc.
])
@php
    // If $page not passed, fallback to current route
    $page = $page ?? str_replace('.', '-', Route::currentRouteName());
@endphp

<div x-data="secondLayerNav()" class="bg-white border-b border-gray-200 shadow-sm sticky top-16 z-30">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center space-x-4 h-16">

            <!-- Dropdown 1 -->
            <div>
                <select x-model="selected1" @change="filterChanged"
                        class="block w-48 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @if($page === 'users')
                        <option value="">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="vet">Veterinarian</option>
                        <option value="user">User</option>
                    @elseif($page === 'appointments')
                        <option value="">All Types</option>
                        <option value="checkup">Checkup</option>
                        <option value="surgery">Surgery</option>
                    @else
                        <option value="">All</option>
                    @endif
                </select>
            </div>

            <!-- Dropdown 2 -->
            <div>
                <select x-model="selected2" @change="filterChanged"
                        class="block w-48 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @if($page === 'users')
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="inactive">Inactive</option>
                    @elseif($page === 'appointments')
                        <option value="">All Status</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                    @else
                        <option value="">All</option>
                    @endif
                </select>
            </div>

            <!-- Search Input -->
            <div class="flex-1 min-w-[200px]">
                <input type="text" x-model="searchQuery"
                       @input="filterChanged"
                       placeholder="{{ $page === 'users' ? 'Search users...' : ($page === 'appointments' ? 'Search appointments...' : 'Search...') }}"
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Clear Filter Button -->
            <div>
                <button @click="clearFilters"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function secondLayerNav() {
        return {
            selected1: '',
            selected2: '',
            searchQuery: '',
            filterChanged() {
                console.log('Filter Changed:', this.selected1, this.selected2, this.searchQuery);
                // Add your custom filtering logic or dispatch an event
            },
            clearFilters() {
                this.selected1 = '';
                this.selected2 = '';
                this.searchQuery = '';
                this.filterChanged();
            }
        }
    }
</script>
