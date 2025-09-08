@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Users') }}
    </h2>
</div>
@endsection

@section('content')
    <div x-data="userStatusControl" class="py-4">
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

                    <div x-data="userStatusControl(@js($users->all()))" class="py-4">

    <!-- Filters -->
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
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
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
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
    </div>

   
                    <!-- Users Grid -->
<template x-if="filteredUsers.length > 0">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="user in filteredUsers" :key="user.id">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:border-gray-300 transition-all duration-300 overflow-hidden group">
                <div class="p-6 pb-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <!-- Clickable Name -->
                            <button 
                                class="text-left w-full group/name"
                                @click="selectedUser = user; modalOpen = true"
                                type="button">
                                <h3 class="text-lg font-semibold text-gray-900 truncate group-hover/name:text-blue-600 transition-colors duration-200 flex items-center gap-2" 
                                    x-text="user.name"></h3>
                                <div class="w-0 group-hover/name:w-full h-0.5 bg-blue-600 transition-all duration-200 mt-1"></div>
                            </button>
                            <!-- Role Badge -->
                            <div class="flex items-center gap-2 mt-2">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium flex-shrink-0 transition-colors duration-200"
                                    :class="user.role === 'vet' ? 'bg-blue-600 text-white group-hover:bg-blue-700' : 'bg-blue-100 text-blue-800 group-hover:bg-blue-200'"
                                    x-text="user.role.charAt(0).toUpperCase() + user.role.slice(1)">
                                </span>
                            </div>
                        </div>

                        <!-- Status indicator -->
                        <div class="relative flex-shrink-0 ml-4">
                            <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center">
                                <div 
                                    class="w-3 h-3 rounded-full transition-all duration-200"
                                    :class="{
                                        'bg-green-500 shadow-green-200 shadow-lg': (user.status || 'N/A') === 'active',
                                        'bg-red-500 shadow-red-200 shadow-lg': (user.status || 'N/A') !== 'active'
                                    }"
                                    :title="user.status || 'N/A'">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                        <span class="truncate" x-text="user.email"></span>
                    </div>
                </div>

                <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 group-hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Click name to view details</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

       <!-- Modal -->
                <div x-show="modalOpen"
                    x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                    style="display: none;">
                    
                    <div @click.away="modalOpen = false"
                        class="bg-white rounded-xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-6 relative max-h-[90vh] overflow-y-auto">

                        <!-- Close button -->
                        <button @click="modalOpen = false" 
                                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>

                       <!-- Header with avatar, name, role subtitle, and status badge -->
                        <div class="flex items-center gap-4 mb-6">
                            <!-- Avatar -->
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-xl font-semibold text-gray-500">
                                <span x-text="selectedUser ? selectedUser.name.charAt(0) : '?'"></span>
                            </div>

                            <!-- Name + Role + Status -->
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <!-- Name -->
                                    <h2 class="text-2xl font-bold text-gray-800" x-text="selectedUser ? selectedUser.name : ''"></h2>
                                    
                                    <!-- Status Badge -->
                                    <span 
                                        class="px-3 py-1 rounded-full text-xs font-semibold"
                                        :class="{
                                            'bg-green-100 text-green-800': selectedUser && selectedUser.status === 'approved',
                                            'bg-red-100 text-red-800': selectedUser && selectedUser.status !== 'approved'
                                        }"
                                        x-text="selectedUser 
                                        ? (selectedUser.status === 'approved' ? 'Active' 
                                        : (selectedUser.status ? selectedUser.status.charAt(0).toUpperCase() + selectedUser.status.slice(1) : 'N/A')) 
                                        : 'N/A'">
                                    </span>
                                </div>

                                   <!-- Role + Gear Button -->
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-gray-500" 
                                    x-text="selectedUser ? selectedUser.role.charAt(0).toUpperCase() + selectedUser.role.slice(1) : ''"></p>
                                    
                                    <!-- Gear Button -->
                                    <!-- Gear button to open modal -->
<button 
    @click="$dispatch('open-modal', 'deactivate-user')" 
    class="text-gray-400 hover:text-gray-600"
>
    <i class="bi bi-gear-fill w-5 h-5"></i>
</button>

<!-- Modal Component -->
<x-modal name="deactivate-user">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Deactivate Account</h2>
        <p class="text-sm text-gray-600 mb-6">
        Are you sure you want to deactivate 
        <span class="font-semibold" x-text="selectedUser ? selectedUser.name : ''"></span>?
        </p>

        <div class="flex justify-end gap-3">
            <button 
                @click="$dispatch('close-modal', 'deactivate-user')"    
                class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                Cancel
            </button>
            <button 
                @click="deactivateUser(selectedUser.id)" 
                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Deactivate
            </button>
        </div>
    </div>
</x-modal>

                                </div>
                            </div>
                        </div>  

                       <!-- User info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">

                                    <!-- Full Name (spans full row) -->
                                    <div class="col-span-1 md:col-span-2 bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-500">Full Name:</span>
                                        <span class="text-gray-900"
                                            x-text="selectedUser
                                                ? (selectedUser.first_name || selectedUser.last_name
                                                    ? `${selectedUser.first_name || ''} ${selectedUser.middle_name ? selectedUser.middle_name + ' ' : ''}${selectedUser.last_name || ''}`.trim()
                                                    : 'N/A')
                                                : 'N/A'">
                                        </span>
                                    </div>

                                    <!-- Email -->
                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-500">Email:</span>
                                        <span class="text-gray-900" x-text="selectedUser && selectedUser.email ? selectedUser.email : 'N/A'"></span>
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-500">Contact Number:</span>
                                        <span class="text-gray-900" x-text="selectedUser && selectedUser.contact_number ? selectedUser.contact_number : 'N/A'"></span>
                                    </div>

                                    <!-- Address (full width) -->
                                    <div class="col-span-1 md:col-span-2 bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-500">Address:</span>
                                        <span class="text-gray-900" x-text="selectedUser && selectedUser.address ? selectedUser.address : 'N/A'"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



<!-- Empty State -->
<template x-if="filteredUsers.length === 0">
    <div class="text-center py-12">
        <i class="bi bi-people mx-auto" style="font-size: 3rem; color: #9ca3af;"></i>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
    </div>
</template>


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
@endsection
