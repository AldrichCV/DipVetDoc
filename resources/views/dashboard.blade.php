@extends('layouts.app')
@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Home/Dashboard') }}
    </h2>
</div>
@endsection
@php
    $page = 'dashboard';
@endphp
@section('content')
    <div class="py-4" x-data="adminVetDashboard()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            
            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Enhanced stats for admin with clinic overview -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Staff</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.activeStaff">8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.todayAppointments">24</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Daily Revenue</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.dailyRevenue">$2,840</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Urgent Cases</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.urgentCases">5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Clinic Overview -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Clinic Overview</h3>
                                <button @click="activeTab = 'staff'" class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                                    Manage Staff
                                </button>
                            </div>
                            
                            <!-- Added staff performance and clinic status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Staff Performance Today</h4>
                                    <div class="space-y-2">
                                        <template x-for="staff in staffPerformance" :key="staff.id">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600" x-text="staff.name"></span>
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-sm font-medium" x-text="staff.appointments + ' appointments'"></span>
                                                    <div class="w-16 bg-gray-200 rounded-full h-2">
                                                        <div class="bg-blue-600 h-2 rounded-full" :style="`width: ${(staff.appointments / 8) * 100}%`"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Clinic Status</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Operating Rooms</span>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">3/4 Available</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Equipment Status</span>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">All Operational</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Inventory</span>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">2 Low Stock</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h4 class="font-medium text-gray-900">Today's Schedule Overview</h4>
                                <template x-for="appointment in todaySchedule" :key="appointment.id">
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-900" x-text="appointment.time"></p>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full" 
                                                      :class="getStatusClass(appointment.status)" 
                                                      x-text="appointment.status"></span>
                                            </div>
                                            <p class="text-sm text-gray-600" x-text="appointment.petName + ' - ' + appointment.reason"></p>
                                            <p class="text-xs text-gray-500" x-text="'Vet: ' + appointment.assignedVet + ' | Owner: ' + appointment.ownerName"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Quick Actions & Alerts -->
                <div class="space-y-6">
                    <!-- Enhanced admin actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Actions</h3>
                            <div class="space-y-3">
                                <button @click="activeTab = 'staff'" 
                                        class="w-full flex items-center px-4 py-3 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Manage Staff
                                </button>
                                <button @click="activeTab = 'inventory'" 
                                        class="w-full flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Inventory Management
                                </button>
                                <button @click="activeTab = 'reports'" 
                                        class="w-full flex items-center px-4 py-3 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Financial Reports
                                </button>
                                <button @click="showNewAppointmentModal = true" 
                                        class="w-full flex items-center px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    New Appointment
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- System Alerts -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">System Alerts</h3>
                            <div class="space-y-3">
                                <template x-for="alert in systemAlerts" :key="alert.id">
                                    <div class="flex items-start p-3 rounded-lg" :class="getAlertClass(alert.type)">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 mt-0.5" :class="getAlertIconClass(alert.type)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium" x-text="alert.title"></p>
                                            <p class="text-xs mt-1" x-text="alert.message"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200">
                    <!-- Added admin-specific tabs -->
                    <nav class="-mb-px flex flex-wrap space-x-2 sm:space-x-8 px-6" aria-label="Tabs">
                        <button @click="activeTab = 'dashboard'" 
                                :class="activeTab === 'dashboard' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Dashboard
                        </button>
                        <button @click="activeTab = 'appointments'" 
                                :class="activeTab === 'appointments' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Appointments
                        </button>
                        <button @click="activeTab = 'staff'" 
                                :class="activeTab === 'staff' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Staff Management
                        </button>
                        <button @click="activeTab = 'patients'" 
                                :class="activeTab === 'patients' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Patients
                        </button>
                        <button @click="activeTab = 'inventory'" 
                                :class="activeTab === 'inventory' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Inventory
                        </button>
                        <button @click="activeTab = 'reports'" 
                                :class="activeTab === 'reports' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Reports
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Dashboard Tab -->
                    <div x-show="activeTab === 'dashboard'" class="space-y-6">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Admin Dashboard Overview</h3>
                            <p class="mt-1 text-sm text-gray-500">Your clinic statistics and staff performance are displayed above.</p>
                        </div>
                    </div>

                    <!-- Appointments Tab -->
                    <div x-show="activeTab === 'appointments'" class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <input type="text" x-model="appointmentSearch" placeholder="Search appointments..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                            <button @click="showNewAppointmentModal = true" 
                                    class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                New Appointment
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="appointment in filteredAppointments" :key="appointment.id">
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900" x-text="appointment.petName"></div>
                                                    <div class="text-sm text-gray-500" x-text="appointment.ownerName"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900" x-text="appointment.date"></div>
                                                <div class="text-sm text-gray-500" x-text="appointment.time"></div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900" x-text="appointment.reason"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full" 
                                                      :class="getStatusClass(appointment.status)" 
                                                      x-text="appointment.status"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <button @click="editAppointment(appointment)" class="text-amber-600 hover:text-amber-900">Edit</button>
                                                <button @click="completeAppointment(appointment.id)" class="text-green-600 hover:text-green-900">Complete</button>
                                                <button @click="cancelAppointment(appointment.id)" class="text-red-600 hover:text-red-900">Cancel</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Patients Tab -->
                    <div x-show="activeTab === 'patients'" class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <input type="text" x-model="patientSearch" placeholder="Search patients..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                            <button @click="showNewPatientModal = true" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                New Patient
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="patient in filteredPatients" :key="patient.id">
                                <div class="bg-gray-50 rounded-lg p-6 hover:bg-gray-100 transition-colors cursor-pointer" 
                                     @click="viewPatient(patient)">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900" x-text="patient.name"></h3>
                                            <p class="text-sm text-gray-500" x-text="patient.species + ' • ' + patient.breed"></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium">Owner:</span> <span x-text="patient.ownerName"></span></p>
                                        <p><span class="font-medium">Age:</span> <span x-text="patient.age"></span></p>
                                        <p><span class="font-medium">Last Visit:</span> <span x-text="patient.lastVisit"></span></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Reports Tab -->
                    <div x-show="activeTab === 'reports'" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Statistics</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Total Appointments</span>
                                        <span class="text-lg font-semibold text-gray-900">247</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Completed</span>
                                        <span class="text-lg font-semibold text-green-600">198</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Cancelled</span>
                                        <span class="text-lg font-semibold text-red-600">23</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">No Shows</span>
                                        <span class="text-lg font-semibold text-yellow-600">26</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Services</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Routine Checkup</span>
                                        <span class="text-lg font-semibold text-gray-900">89</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Vaccination</span>
                                        <span class="text-lg font-semibold text-gray-900">67</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Dental Cleaning</span>
                                        <span class="text-lg font-semibold text-gray-900">34</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Surgery</span>
                                        <span class="text-lg font-semibold text-gray-900">28</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Management Tab -->
                    <div x-show="activeTab === 'staff'" class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <input type="text" x-model="staffSearch" placeholder="Search staff..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                            <button @click="showNewStaffModal = true" 
                                    class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                Add Staff Member
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="staff in filteredStaff" :key="staff.id">
                                <div class="bg-gray-50 rounded-lg p-6 hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900" x-text="staff.name"></h3>
                                            <p class="text-sm text-gray-500" x-text="staff.role"></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium">Status:</span> 
                                            <span class="px-2 py-1 text-xs rounded-full" 
                                                  :class="staff.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" 
                                                  x-text="staff.status"></span>
                                        </p>
                                        <p><span class="font-medium">Today's Appointments:</span> <span x-text="staff.todayAppointments"></span></p>
                                        <p><span class="font-medium">Specialization:</span> <span x-text="staff.specialization"></span></p>
                                    </div>
                                    <div class="mt-4 flex space-x-2">
                                        <button @click="editStaff(staff)" class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                            Edit
                                        </button>
                                        <button @click="viewStaffSchedule(staff)" class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200">
                                            Schedule
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Inventory Tab -->
                    <div x-show="activeTab === 'inventory'" class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <input type="text" x-model="inventorySearch" placeholder="Search inventory..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            </div>
                            <button @click="showNewInventoryModal = true" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Add Item
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="item in filteredInventory" :key="item.id">
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900" x-text="item.name"></div>
                                                <div class="text-sm text-gray-500" x-text="item.description"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="item.category"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="item.quantity + ' ' + item.unit"></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full" 
                                                      :class="getInventoryStatusClass(item.status)" 
                                                      x-text="item.status"></span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <button @click="editInventoryItem(item)" class="text-blue-600 hover:text-blue-900">Edit</button>
                                                <button @click="restockItem(item)" class="text-green-600 hover:text-green-900">Restock</button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- New Staff Modal -->
                    <div x-show="showNewStaffModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
                         @click.self="showNewStaffModal = false">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <div class="mt-3">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Add Staff Member</h3>
                                <form @submit.prevent="addStaffMember()" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" x-model="newStaff.name" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Role</label>
                                        <input type="text" x-model="newStaff.role" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Specialization</label>
                                        <input type="text" x-model="newStaff.specialization" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <select x-model="newStaff.status" 
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                            <option value="active">Active</option>
                                            <option value="off-duty">Off-Duty</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" @click="showNewStaffModal = false" 
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                            Cancel
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700">
                                            Add Staff
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- New Inventory Modal -->
                    <div x-show="showNewInventoryModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
                         @click.self="showNewInventoryModal = false">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <div class="mt-3">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Add Inventory Item</h3>
                                <form @submit.prevent="addInventoryItem()" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" x-model="newInventoryItem.name" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <input type="text" x-model="newInventoryItem.description" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Category</label>
                                        <input type="text" x-model="newInventoryItem.category" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                        <input type="number" x-model.number="newInventoryItem.quantity" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Unit</label>
                                        <input type="text" x-model="newInventoryItem.unit" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <select x-model="newInventoryItem.status" 
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                            <option value="in-stock">In Stock</option>
                                            <option value="low-stock">Low Stock</option>
                                            <option value="out-of-stock">Out of Stock</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" @click="showNewInventoryModal = false" 
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                            Cancel
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700">
                                            Add Item
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- New Appointment Modal -->
                    <div x-show="showNewAppointmentModal" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
                         @click.self="showNewAppointmentModal = false">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <div class="mt-3">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">New Appointment</h3>
                                <form @submit.prevent="createAppointment()" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                                        <input type="text" x-model="newAppointment.petName" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Owner Name</label>
                                        <input type="text" x-model="newAppointment.ownerName" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" x-model="newAppointment.date" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Time</label>
                                        <input type="time" x-model="newAppointment.time" required 
                                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Reason</label>
                                        <textarea x-model="newAppointment.reason" rows="3" 
                                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500"></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" @click="showNewAppointmentModal = false" 
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                            Cancel
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700">
                                            Create Appointment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Appointment Modal -->
        <div x-show="showNewAppointmentModal" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
             @click.self="showNewAppointmentModal = false">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">New Appointment</h3>
                    <form @submit.prevent="createAppointment()" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                            <input type="text" x-model="newAppointment.petName" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Owner Name</label>
                            <input type="text" x-model="newAppointment.ownerName" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" x-model="newAppointment.date" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Time</label>
                            <input type="time" x-model="newAppointment.time" required 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Reason</label>
                            <textarea x-model="newAppointment.reason" rows="3" 
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500"></textarea>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" @click="showNewAppointmentModal = false" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700">
                                Create Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function adminVetDashboard() {
            return {
                activeTab: 'dashboard',
                appointmentSearch: '',
                patientSearch: '',
                staffSearch: '',
                inventorySearch: '',
                showNewAppointmentModal: false,
                showNewPatientModal: false,
                showNewStaffModal: false,
                showNewInventoryModal: false,
                
                stats: {
                    activeStaff: 8,
                    todayAppointments: 24,
                    dailyRevenue: '$2,840',
                    urgentCases: 5
                },

                newAppointment: {
                    petName: '',
                    ownerName: '',
                    date: '',
                    time: '',
                    reason: ''
                },

                newStaff: {
                    name: '',
                    role: '',
                    specialization: '',
                    status: 'active'
                },

                newInventoryItem: {
                    name: '',
                    description: '',
                    category: '',
                    quantity: 1,
                    unit: '',
                    status: 'in-stock'
                },

                staffPerformance: [
                    { id: 1, name: 'Dr. Sarah Johnson', appointments: 6 },
                    { id: 2, name: 'Dr. Mike Davis', appointments: 4 },
                    { id: 3, name: 'Dr. Emily Brown', appointments: 8 },
                    { id: 4, name: 'Dr. James Wilson', appointments: 3 }
                ],

                staff: [
                    { id: 1, name: 'Dr. Sarah Johnson', role: 'Senior Veterinarian', status: 'active', todayAppointments: 6, specialization: 'Surgery' },
                    { id: 2, name: 'Dr. Mike Davis', role: 'Veterinarian', status: 'active', todayAppointments: 4, specialization: 'Internal Medicine' },
                    { id: 3, name: 'Dr. Emily Brown', role: 'Veterinarian', status: 'active', todayAppointments: 8, specialization: 'Dermatology' },
                    { id: 4, name: 'Dr. James Wilson', role: 'Veterinarian', status: 'off-duty', todayAppointments: 0, specialization: 'Cardiology' },
                    { id: 5, name: 'Lisa Martinez', role: 'Veterinary Technician', status: 'active', todayAppointments: 12, specialization: 'Laboratory' },
                    { id: 6, name: 'John Smith', role: 'Veterinary Assistant', status: 'active', todayAppointments: 8, specialization: 'General Care' }
                ],

                inventory: [
                    { id: 1, name: 'Rabies Vaccine', description: 'Annual vaccination', category: 'Vaccines', quantity: 15, unit: 'doses', status: 'in-stock' },
                    { id: 2, name: 'Surgical Gloves', description: 'Sterile latex gloves', category: 'Supplies', quantity: 5, unit: 'boxes', status: 'low-stock' },
                    { id: 3, name: 'Antibiotics', description: 'Broad spectrum', category: 'Medications', quantity: 25, unit: 'bottles', status: 'in-stock' },
                    { id: 4, name: 'X-Ray Film', description: 'Digital imaging', category: 'Equipment', quantity: 2, unit: 'packs', status: 'low-stock' }
                ],

                systemAlerts: [
                    { id: 1, type: 'warning', title: 'Low Inventory', message: 'Surgical gloves running low - 5 boxes remaining' },
                    { id: 2, type: 'info', title: 'Staff Schedule', message: 'Dr. Wilson scheduled for emergency on-call tonight' },
                    { id: 3, type: 'error', title: 'Equipment Maintenance', message: 'X-Ray machine #2 requires scheduled maintenance' }
                ],

                todaySchedule: [
                    { id: 1, time: '9:00 AM', petName: 'Buddy', ownerName: 'John Smith', reason: 'Routine Checkup', status: 'scheduled', assignedVet: 'Dr. Johnson' },
                    { id: 2, time: '10:30 AM', petName: 'Whiskers', ownerName: 'Sarah Johnson', reason: 'Vaccination', status: 'in-progress', assignedVet: 'Dr. Davis' },
                    { id: 3, time: '2:00 PM', petName: 'Max', ownerName: 'Mike Davis', reason: 'Dental Cleaning', status: 'scheduled', assignedVet: 'Dr. Brown' },
                    { id: 4, time: '3:30 PM', petName: 'Luna', ownerName: 'Emily Brown', reason: 'Surgery Consultation', status: 'urgent', assignedVet: 'Dr. Johnson' }
                ],

                appointments: [
                    { id: 1, petName: 'Buddy', ownerName: 'John Smith', date: '2024-01-15', time: '9:00 AM', reason: 'Routine Checkup', status: 'scheduled' },
                    { id: 2, petName: 'Whiskers', ownerName: 'Sarah Johnson', date: '2024-01-15', time: '10:30 AM', reason: 'Vaccination', status: 'in-progress' },
                    { id: 3, petName: 'Max', ownerName: 'Mike Davis', date: '2024-01-15', time: '2:00 PM', reason: 'Dental Cleaning', status: 'scheduled' },
                    { id: 4, petName: 'Luna', ownerName: 'Emily Brown', date: '2024-01-15', time: '3:30 PM', reason: 'Surgery Consultation', status: 'urgent' }
                ],

                patients: [
                    { id: 1, name: 'Buddy', species: 'Dog', breed: 'Golden Retriever', age: '5 years', ownerName: 'John Smith', lastVisit: '2024-01-10' },
                    { id: 2, name: 'Whiskers', species: 'Cat', breed: 'Persian', age: '3 years', ownerName: 'Sarah Johnson', lastVisit: '2024-01-08' },
                    { id: 3, name: 'Max', species: 'Dog', breed: 'German Shepherd', age: '7 years', ownerName: 'Mike Davis', lastVisit: '2024-01-05' },
                    { id: 4, name: 'Luna', species: 'Cat', breed: 'Siamese', age: '2 years', ownerName: 'Emily Brown', lastVisit: '2024-01-12' }
                ],

                recentPatients: [
                    { id: 1, name: 'Buddy', species: 'Dog', lastVisit: 'Today' },
                    { id: 2, name: 'Whiskers', species: 'Cat', lastVisit: 'Yesterday' },
                    { id: 3, name: 'Max', species: 'Dog', lastVisit: '3 days ago' }
                ],

                get filteredAppointments() {
                    if (!this.appointmentSearch) return this.appointments;
                    return this.appointments.filter(appointment => 
                        appointment.petName.toLowerCase().includes(this.appointmentSearch.toLowerCase()) ||
                        appointment.ownerName.toLowerCase().includes(this.appointmentSearch.toLowerCase()) ||
                        appointment.reason.toLowerCase().includes(this.appointmentSearch.toLowerCase())
                    );
                },

                get filteredPatients() {
                    if (!this.patientSearch) return this.patients;
                    return this.patients.filter(patient => 
                        patient.name.toLowerCase().includes(this.patientSearch.toLowerCase()) ||
                        patient.ownerName.toLowerCase().includes(this.patientSearch.toLowerCase()) ||
                        patient.species.toLowerCase().includes(this.patientSearch.toLowerCase())
                    );
                },

                get filteredStaff() {
                    if (!this.staffSearch) return this.staff;
                    return this.staff.filter(staff => 
                        staff.name.toLowerCase().includes(this.staffSearch.toLowerCase()) ||
                        staff.role.toLowerCase().includes(this.staffSearch.toLowerCase()) ||
                        staff.specialization.toLowerCase().includes(this.staffSearch.toLowerCase())
                    );
                },

                get filteredInventory() {
                    if (!this.inventorySearch) return this.inventory;
                    return this.inventory.filter(item => 
                        item.name.toLowerCase().includes(this.inventorySearch.toLowerCase()) ||
                        item.category.toLowerCase().includes(this.inventorySearch.toLowerCase())
                    );
                },

                getStatusClass(status) {
                    const classes = {
                        'scheduled': 'bg-blue-100 text-blue-800',
                        'in-progress': 'bg-yellow-100 text-yellow-800',
                        'completed': 'bg-green-100 text-green-800',
                        'cancelled': 'bg-red-100 text-red-800',
                        'urgent': 'bg-red-100 text-red-800'
                    };
                    return classes[status] || 'bg-gray-100 text-gray-800';
                },

                getAlertClass(type) {
                    const classes = {
                        'warning': 'bg-yellow-50 border border-yellow-200',
                        'error': 'bg-red-50 border border-red-200',
                        'info': 'bg-blue-50 border border-blue-200'
                    };
                    return classes[type] || 'bg-gray-50 border border-gray-200';
                },

                getAlertIconClass(type) {
                    const classes = {
                        'warning': 'text-yellow-600',
                        'error': 'text-red-600',
                        'info': 'text-blue-600'
                    };
                    return classes[type] || 'text-gray-600';
                },

                getInventoryStatusClass(status) {
                    const classes = {
                        'in-stock': 'bg-green-100 text-green-800',
                        'low-stock': 'bg-yellow-100 text-yellow-800',
                        'out-of-stock': 'bg-red-100 text-red-800'
                    };
                    return classes[status] || 'bg-gray-100 text-gray-800';
                },

                createAppointment() {
                    // Add the new appointment to the list
                    const newId = Math.max(...this.appointments.map(a => a.id)) + 1;
                    this.appointments.push({
                        id: newId,
                        ...this.newAppointment,
                        status: 'scheduled'
                    });
                    
                    // Reset form and close modal
                    this.newAppointment = { petName: '', ownerName: '', date: '', time: '', reason: '' };
                    this.showNewAppointmentModal = false;
                    
                    // Show success message (you can integrate with your notification system)
                    alert('Appointment created successfully!');
                },

                addStaffMember() {
                    const newId = Math.max(...this.staff.map(s => s.id)) + 1;
                    this.staff.push({
                        id: newId,
                        ...this.newStaff,
                        todayAppointments: 0
                    });

                    this.newStaff = { name: '', role: '', specialization: '', status: 'active' };
                    this.showNewStaffModal = false;

                    alert('Staff member added successfully!');
                },

                addInventoryItem() {
                    const newId = Math.max(...this.inventory.map(i => i.id)) + 1;
                    this.inventory.push({
                        id: newId,
                        ...this.newInventoryItem
                    });

                    this.newInventoryItem = { name: '', description: '', category: '', quantity: 1, unit: '', status: 'in-stock' };
                    this.showNewInventoryModal = false;

                    alert('Inventory item added successfully!');
                },

                editAppointment(appointment) {
                    // Implement edit functionality
                    console.log('Edit appointment:', appointment);
                },

                completeAppointment(id) {
                    const appointment = this.appointments.find(a => a.id === id);
                    if (appointment) {
                        appointment.status = 'completed';
                    }
                },

                cancelAppointment(id) {
                    const appointment = this.appointments.find(a => a.id === id);
                    if (appointment) {
                        appointment.status = 'cancelled';
                    }
                },

                viewPatient(patient) {
                    // Implement patient view functionality
                    console.log('View patient:', patient);
                },

                editStaff(staff) {
                    console.log('Edit staff:', staff);
                },

                viewStaffSchedule(staff) {
                    console.log('View staff schedule:', staff);
                },

                editInventoryItem(item) {
                    console.log('Edit inventory item:', item);
                },

                restockItem(item) {
                    console.log('Restock item:', item);
                }
            }
        }
    </script>
    @endsection
