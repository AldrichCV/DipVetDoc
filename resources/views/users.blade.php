<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-green-800 font-medium">{{ session('status') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Search and Filter Section -->
                    <div class="mb-6" x-data="{ 
                        searchTerm: '', 
                        selectedRole: '',
                        selectedStatus: '',
                        filteredUsers: @js($users->items()),
                        
                        filterUsers() {
                            this.filteredUsers = @js($users->items()).filter(user => {
                                const matchesSearch = user.name.toLowerCase().includes(this.searchTerm.toLowerCase()) || 
                                                    user.email.toLowerCase().includes(this.searchTerm.toLowerCase());
                                const matchesRole = this.selectedRole === '' || user.role === this.selectedRole;
                                const matchesStatus = this.selectedStatus === '' || (user.status || 'N/A') === this.selectedStatus;
                                
                                return matchesSearch && matchesRole && matchesStatus;
                            });
                        }
                    }" x-init="filterUsers()">
                        
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <!-- Search Input -->
                            <div class="flex-1">
                                <label for="search" class="sr-only">Search users</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="search"
                                        x-model="searchTerm"
                                        @input="filterUsers()"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Search by name or email..."
                                    >
                                </div>
                            </div>

                            <!-- Role Filter -->
                            <div class="sm:w-48">
                                <select 
                                    x-model="selectedRole"
                                    @change="filterUsers()"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">All Roles</option>
                                    <option value="vet">Veterinarian</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="sm:w-48">
                                <select 
                                    x-model="selectedStatus"
                                    @change="filterUsers()"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">All Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>

                        <!-- Users Count -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">
                                Showing <span x-text="filteredUsers.length"></span> of {{ $users->total() }} users
                            </p>
                        </div>

                        <!-- Users Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="user in filteredUsers" :key="user.id">
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <!-- Card Header -->
                                    <div class="p-6 pb-4">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-semibold text-gray-900 truncate" x-text="user.name"></h3>
                                                <p class="text-sm text-gray-600 truncate" x-text="user.email"></p>
                                            </div>
                                            
                                            <!-- Status Badge -->
                                            <span 
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="{
                                                    'bg-green-100 text-green-800': (user.status || 'N/A') === 'approved',
                                                    'bg-red-100 text-red-800': (user.status || 'N/A') !== 'approved'
                                                }"
                                                x-text="user.status || 'N/A'"
                                            ></span>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="px-6 pb-6">
                                        <div class="space-y-3">
                                            <!-- Role -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-500">Role</span>
                                                <span 
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                                                    :class="{
                                                        'bg-blue-600 text-white': user.role === 'vet',
                                                        'bg-blue-100 text-blue-800': user.role !== 'vet'
                                                    }"
                                                    x-text="user.role.charAt(0).toUpperCase() + user.role.slice(1)"
                                                ></span>
                                            </div>

                                            <!-- Created Date -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-500">Joined</span>
                                                <span class="text-sm text-gray-900" x-text="new Date(user.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })"></span>
                                            </div>

                                            <!-- Actions -->
                                            <div class="pt-3 border-t border-gray-100">
                                                <div class="flex space-x-2">
                                                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-3 rounded-md transition-colors duration-200">
                                                        View
                                                    </button>
                                                    <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-3 rounded-md transition-colors duration-200">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Empty State -->
                        <div x-show="filteredUsers.length === 0" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.196M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.196M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                        </div>
                    </div>

                    <!-- Original Laravel Users (Fallback for non-JS users) -->
                    <noscript>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($users as $user)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $user->name }}</h3>
                                                <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ ($user->status ?? '') === 'approved'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-red-100 text-red-800' }}">
                                                {{ $user->status ?? 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="space-y-3">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-500">Role</span>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                    {{ $user->role === 'vet'
                                                        ? 'bg-blue-600 text-white'
                                                        : 'bg-blue-100 text-blue-800' }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <span class="text-sm font-medium text-gray-500">Joined</span>
                                                <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12">
                                    <p class="text-gray-500">No users found.</p>
                                </div>
                            @endforelse
                        </div>
                    </noscript>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>