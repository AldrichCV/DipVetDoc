<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Veterinarian Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="vetDashboard()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.todayAppointments">12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Patients</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.activePatients">48</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Completed Today</p>
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.completedToday">8</p>
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
                                <p class="text-2xl font-semibold text-gray-900" x-text="stats.urgentCases">3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Today's Schedule -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Today's Schedule</h3>
                                <button @click="activeTab = 'appointments'" class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                                    View All
                                </button>
                            </div>
                            
                            <div class="space-y-4">
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
                                            <p class="text-xs text-gray-500" x-text="'Owner: ' + appointment.ownerName"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Recent Patients -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <button @click="showNewAppointmentModal = true" 
                                        class="w-full flex items-center px-4 py-3 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    New Appointment
                                </button>
                                <button @click="activeTab = 'patients'" 
                                        class="w-full flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Search Patients
                                </button>
                                <button @click="activeTab = 'reports'" 
                                        class="w-full flex items-center px-4 py-3 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    View Reports
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Patients -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Patients</h3>
                            <div class="space-y-3">
                                <template x-for="patient in recentPatients" :key="patient.id">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-gray-900" x-text="patient.name"></p>
                                            <p class="text-xs text-gray-500" x-text="patient.species + ' • ' + patient.lastVisit"></p>
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
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
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
                        <button @click="activeTab = 'patients'" 
                                :class="activeTab === 'patients' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Patients
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
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Dashboard Overview</h3>
                            <p class="mt-1 text-sm text-gray-500">Your daily statistics and schedule are displayed above.</p>
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
        function vetDashboard() {
            return {
                activeTab: 'dashboard',
                appointmentSearch: '',
                patientSearch: '',
                showNewAppointmentModal: false,
                showNewPatientModal: false,
                
                stats: {
                    todayAppointments: 12,
                    activePatients: 48,
                    completedToday: 8,
                    urgentCases: 3
                },

                newAppointment: {
                    petName: '',
                    ownerName: '',
                    date: '',
                    time: '',
                    reason: ''
                },

                todaySchedule: [
                    { id: 1, time: '9:00 AM', petName: 'Buddy', ownerName: 'John Smith', reason: 'Routine Checkup', status: 'scheduled' },
                    { id: 2, time: '10:30 AM', petName: 'Whiskers', ownerName: 'Sarah Johnson', reason: 'Vaccination', status: 'in-progress' },
                    { id: 3, time: '2:00 PM', petName: 'Max', ownerName: 'Mike Davis', reason: 'Dental Cleaning', status: 'scheduled' },
                    { id: 4, time: '3:30 PM', petName: 'Luna', ownerName: 'Emily Brown', reason: 'Surgery Consultation', status: 'urgent' }
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
                }
            }
        }
    </script>
</x-app-layout>
