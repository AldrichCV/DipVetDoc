@extends('layouts.app')

@section('header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" x-data="{ showNewAppointmentModal: false }">
     <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pet Appointments') }}
    </h2>
    @if(auth()->user()->role !== 'admin')
        <button 
            @click="showNewAppointmentModal = true"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New Appointment
        </button>

         {{-- Moved new appointment modal inside header section for proper Alpine.js scope --}}
        <div x-show="showNewAppointmentModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center z-50 p-4"
             style="display: none;"
             @keydown.escape="showNewAppointmentModal = false">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto" 
                 @click.away="showNewAppointmentModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 transform scale-90 translate-y-4">
                
                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold">Schedule New Appointment</h2>
                    </div>
                    <button @click="showNewAppointmentModal = false" 
                            class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-2 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('my_appointments.store') }}" class="p-6">
                    @csrf

                    <div class="space-y-8">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Pet Information
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pet Name *</label>
                                    <input type="text" name="name" 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           required placeholder="Enter pet's name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                                    <select name="species" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                        <option value="">-- Select Species --</option>
                                        <optgroup label="Companion Animals">
                                            <option value="Dog">Dog</option>
                                            <option value="Cat">Cat</option>
                                            <option value="Rabbit">Rabbit</option>
                                            <option value="Guinea Pig">Guinea Pig</option>
                                            <option value="Hamster">Hamster</option>
                                            <option value="Ferret">Ferret</option>
                                            <option value="Bird">Bird</option>
                                            <option value="Reptile">Reptile</option>
                                            <option value="Fish">Fish</option>
                                        </optgroup>
                                        <optgroup label="Livestock">
                                            <option value="Cattle">Cattle</option>
                                            <option value="Horse">Horse</option>
                                            <option value="Pig">Pig</option>
                                            <option value="Goat">Goat</option>
                                            <option value="Sheep">Sheep</option>
                                            <option value="Chicken">Chicken</option>
                                            <option value="Duck">Duck</option>
                                            <option value="Turkey">Turkey</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                                    <input type="text" name="breed" 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Enter breed (optional)">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Sex *</label>
                                    <select name="sex" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                        <option value="">-- Select Sex --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                    <input 
                                        type="date" 
                                        name="date_of_birth" 
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        :max="new Date().toISOString().split('T')[0]"
                                    >
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Appointment Details
                            </h4>
                            
                            <div x-data="timeValidation()" x-init="initializeNewAppointment()">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Date *</label>
                                        <input 
                                            type="date" 
                                            name="appointment_date" 
                                            x-model="appointmentDate"
                                            @change="updateTimeRange"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required
                                            :min="new Date().toISOString().split('T')[0]"
                                        >
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Time *</label>
                                        <input 
                                            type="time" 
                                            name="appointment_time" 
                                            x-model="appointmentTime"
                                            :min="minTime"
                                            :max="maxTime"
                                            @input="validateTime($event)"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required
                                        >
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Service *</label>
                                        <select name="reason" 
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                                required>
                                            <option value="">-- Select Service --</option>
                                            <option value="1">Check-up</option>
                                            <option value="2">Deworming</option>
                                            <option value="3">Home Service</option>
                                            <option value="4">Laboratories</option>
                                            <option value="5">Non-Surgical Procedures</option>
                                            <option value="6">Surgical Procedures</option>
                                            <option value="7">Therapies</option>
                                            <option value="8">Tick & Flea Preventive</option>
                                            <option value="9">Vaccinations</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                                    <textarea name="notes" rows="4" 
                                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                              placeholder="Add any additional notes, special instructions, or concerns about your pet..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200 bg-gray-50/50 px-6 py-4 rounded-b-2xl">
                        <button type="button" @click="showNewAppointmentModal = false"
                                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-all duration-200 hover:shadow-sm">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Schedule Appointment
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection

@section('content')
<div x-data="appointmentsComponent()" class="py-6 lg:py-4" @keydown.escape="closeVetModal()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Added responsive card layout for mobile and table for desktop --}}
        
        {{-- Mobile Card Layout (hidden on md and up) --}}
        <div class="md:hidden space-y-4">
            <template x-for="appointment in filteredAppointments" :key="appointment.id">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    {{-- Card Header --}}
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900" x-text="appointment.pet_name"></h3>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full"
                                      :class="getStatusClass(appointment.status)"
                                      x-text="appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)">
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-4 space-y-3">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            @if(auth()->user()->role === 'admin')
                                <div>
                                    <span class="text-gray-500 font-medium">Owner:</span>
                                    <p class="text-gray-900 mt-1" x-text="appointment.owner_name"></p>
                                </div>
                            @endif
                            <div>
                                <span class="text-gray-500 font-medium">Date:</span>
                                <p class="text-gray-900 mt-1" x-text="formatDate(appointment.appointment_date)"></p>
                            </div>
                            <div>
                                <span class="text-gray-500 font-medium">Time:</span>
                                <p class="text-gray-900 mt-1" x-text="formatTime(appointment.appointment_time)"></p>
                            </div>
                            <div>
                                <span class="text-gray-500 font-medium">Service:</span>
                                <p class="text-gray-900 mt-1" x-text="appointment.reason_name"></p>
                            </div>
                            {{-- Added assigned vet display for mobile --}}
                            <div class="col-span-2">
                                <span class="text-gray-500 font-medium">Assigned Vet:</span>
                                <div class="mt-1">
                                    <template x-if="appointment.vet_name">
                                        <button @click="showVetDetails(appointment)" 
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span x-text="appointment.vet_name"></span>
                                        </button>
                                    </template>
                                    <template x-if="!appointment.vet_name">
                                        <button @click="assignVet(appointment)" 
                                                class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Assign Vet
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Removed mobile action buttons --}}
                    </div>
                </div>
            </template>

            <div x-show="filteredAppointments.length === 0" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                <div class="text-gray-400 mb-2">
                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">No appointments found</p>
                <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filter criteria</p>
            </div>
        </div>

        {{-- Desktop Table Layout (hidden on mobile) --}}
        <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input 
                                type="text" 
                                x-model="searchTerm"
                                placeholder="Search appointments..."
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            >
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select x-model="statusFilter" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <select x-model="serviceFilter" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Services</option>
                            <option value="1">Check-up</option>
                            <option value="2">Deworming</option>
                            <option value="3">Home Service</option>
                            <option value="4">Laboratories</option>
                            <option value="5">Non-Surgical Procedures</option>
                            <option value="6">Surgical Procedures</option>
                            <option value="7">Therapies</option>
                            <option value="8">Tick & Flea Preventive</option>
                            <option value="9">Vaccinations</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Pet Name</th>
                            @if(auth()->user()->role === 'admin')
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Owner Name</th>
                            @endif
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Time</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Service</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                            {{-- Added Assigned Vet column --}}
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Assigned Vet</th>
                            {{-- Removed Actions column header --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="appointment in filteredAppointments" :key="appointment.id">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900" x-text="appointment.pet_name"></td>
                                @if(auth()->user()->role === 'admin')
                                    <td class="px-6 py-4 text-sm text-gray-700" x-text="appointment.owner_name"></td>
                                @endif
                                <td class="px-6 py-4 text-sm text-gray-700" x-text="formatDate(appointment.appointment_date)"></td>
                                <td class="px-6 py-4 text-sm text-gray-700" x-text="formatTime(appointment.appointment_time)"></td>
                                <td class="px-6 py-4 text-sm text-gray-700" x-text="appointment.reason_name"></td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium rounded-full"
                                          :class="getStatusClass(appointment.status)"
                                          x-text="appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)">
                                    </span>
                                </td>
                                
                                {{-- Added assigned vet display with conditional rendering --}}
                                <td class="px-6 py-4">
                                    <template x-if="appointment.vet_name">
                                        <button @click="showVetDetails(appointment)" 
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span x-text="appointment.vet_name"></span>
                                        </button>
                                    </template>
                                    <template x-if="!appointment.vet_name">
                                        <button @click="assignVet(appointment)" 
                                                class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Assign Vet
                                        </button>
                                    </template>
                                </td>
                                {{-- Removed Actions column data --}}
                            </tr>
                        </template>

                        <tr x-show="filteredAppointments.length === 0">
                            {{-- Updated colspan to account for removed Actions column --}}
                            <td :colspan="@if(auth()->user()->role === 'admin') 7 @else 6 @endif" class="px-6 py-12 text-center">
                                <div class="text-gray-400 mb-2">
                                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">No appointments found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filter criteria</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Assign Vet Modal --}}
    <div x-show="showAssignVetModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
         style="display: none;">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto" 
             @click.away="closeAssignVetModal()"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95">
            
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Assign Veterinarian</h2>
                <button @click="closeAssignVetModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Select a veterinarian for:</p>
                    <p class="font-medium text-gray-900" x-text="selectedAppointmentForVet.pet_name"></p>
                </div>

                <div class="space-y-3">
                    <template x-for="vet in availableVets" :key="vet.id">
                        <button @click="confirmVetAssignment(vet)" 
                                class="w-full p-4 text-left border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900" x-text="vet.name"></p>
                                    <p class="text-sm text-gray-600" x-text="vet.specialization"></p>
                                </div>
                            </div>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- Vet Details Modal --}}
    <div x-show="showVetDetailsModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
         style="display: none;">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto" 
             @click.away="closeVetDetailsModal()"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95">
            
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Veterinarian Details</h2>
                <button @click="closeVetDetailsModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900" x-text="selectedVetDetails.name"></h3>
                    <p class="text-gray-600" x-text="selectedVetDetails.specialization"></p>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Status</p>
                        <span class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full"
                              :class="selectedVetDetails.is_active === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                              x-text="selectedVetDetails.is_active"></span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Assigned to</p>
                        <p class="text-gray-900" x-text="selectedAppointmentForVet.pet_name"></p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button @click="reassignVet()" 
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                        Reassign Vet
                    </button>
                    <button @click="closeVetDetailsModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Removed new appointment modal from here since it's now in header section --}}
</div>

<script>
    function appointmentsComponent() {
        return {
            {{-- Removed showModal and selectedAppointment properties --}}
            searchTerm: '',
            statusFilter: '',
            serviceFilter: '',
            appointments: @json($appointments),
            {{-- Added new properties for vet assignment functionality --}}
            showAssignVetModal: false,
            showVetDetailsModal: false,
            selectedAppointmentForVet: {},
            selectedVetDetails: {},
            availableVets: @json($availableVets ?? []),

            get filteredAppointments() {
                return this.appointments.filter(appointment => {
                    const matchesSearch = !this.searchTerm || 
                        appointment.pet_name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                        appointment.owner_name?.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                        appointment.reason_name.toLowerCase().includes(this.searchTerm.toLowerCase());
                    
                    const matchesStatus = !this.statusFilter || appointment.status === this.statusFilter;
                    const matchesService = !this.serviceFilter || appointment.reason == this.serviceFilter;
                    
                    return matchesSearch && matchesStatus && matchesService;
                });
            },

            {{-- Added vet assignment methods --}}
            assignVet(appointment) {
                this.selectedAppointmentForVet = appointment;
                this.fetchAvailableVets();
                this.showAssignVetModal = true;
            },

            closeAssignVetModal() {
                this.showAssignVetModal = false;
                this.selectedAppointmentForVet = {};
            },

            fetchAvailableVets() {
                fetch('/api/vets/active')
                    .then(res => res.json())
                    .then(data => {
                        console.log('Available vets:', data); // debug
                        this.availableVets = data;
                    });
            },

            /*confirmVetAssignment(vet) {
                fetch('/assign-vet', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        appointment_id: this.selectedAppointmentForVet.id,
                        vet_id: vet.id,
                    }),
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.closeAssignVetModal();
                            window.location.reload();
                        }
                    });
            },*/

            showVetDetails(appointment) {
                this.selectedAppointmentForVet = appointment;
                this.selectedVetDetails = {
                    name: appointment.vet_name,
                    specialization: appointment.specialization || 'General Practice',
                    is_active: 'Active'
                };
                this.showVetDetailsModal = true;
            },

            closeVetDetailsModal() {
                this.showVetDetailsModal = false;
                this.selectedVetDetails = {};
                this.selectedAppointmentForVet = {};
            },

            reassignVet() {
                this.closeVetDetailsModal();
                this.assignVet(this.selectedAppointmentForVet);
            },

            async confirmVetAssignment(vet) {
                try {
                    const response = await fetch(`/appointments/${this.selectedAppointmentForVet.id}/assign-vet`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            vet_id: vet.id,
                            appointment_id: this.selectedAppointmentForVet.id
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update the appointment in the local array
                        const appointmentIndex = this.appointments.findIndex(app => app.id === this.selectedAppointmentForVet.id);
                        if (appointmentIndex !== -1) {
                            this.appointments[appointmentIndex].vet_id = vet.id;
                            this.appointments[appointmentIndex].vet_name = vet.name;
                            this.appointments[appointmentIndex].vet_specialization = vet.specialization;
                        }

                        this.closeAssignVetModal();
                        
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Success!',
                                text: `${vet.name} has been assigned to this appointment.`,
                                icon: 'success',
                                confirmButtonColor: '#059669'
                            });
                        } else {
                            alert(`${vet.name} has been assigned to this appointment.`);
                        }
                    } else {
                        throw new Error(data.error || 'Failed to assign veterinarian');
                    }
                } catch (error) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Error',
                            text: error.message || 'Failed to assign veterinarian.',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    } else {
                        alert('Failed to assign veterinarian: ' + error.message);
                    }
                }
            },

            closeVetModal() {
                this.closeAssignVetModal();
                this.closeVetDetailsModal();
            },

            {{-- Removed editAppointment and deleteAppointment methods --}}

            formatDateTime(date, time) {
                const dateTime = new Date(`${date} ${time}`);
                return dateTime.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            },

            formatDate(date) {
                const dateObj = new Date(date);
                return dateObj.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            },

            formatTime(time) {
                const [hour, minute] = time.split(':').map(Number);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const displayHour = hour % 12 || 12;
                return `${displayHour}:${minute.toString().padStart(2, '0')} ${ampm}`;
            },

            getStatusClass(status) {
                const classes = {
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'confirmed': 'bg-blue-100 text-blue-800',
                    'completed': 'bg-green-100 text-green-800',
                    'cancelled': 'bg-red-100 text-red-800'
                };
                return classes[status] || 'bg-gray-100 text-gray-800';
            }
        };
    }

    function timeValidation() {
        return {
            appointmentDate: '',
            appointmentTime: '',
            minTime: '08:00',
            maxTime: '17:30',

            initializeTime(appointment) {
                if (appointment) {
                    this.appointmentDate = appointment.appointment_date;
                    this.appointmentTime = appointment.appointment_time;
                    this.updateTimeRange();
                }
            },

            initializeNewAppointment() {
                this.appointmentDate = '';
                this.appointmentTime = '08:00';
                this.minTime = '08:00';
                this.maxTime = '17:30';
            },

            updateTimeRange() {
                if (!this.appointmentDate) return;
                const day = new Date(this.appointmentDate).getDay();

                if (day === 0) {
                    this.minTime = '09:00';
                    this.maxTime = '16:30';
                } else {
                    this.minTime = '08:00';
                    this.maxTime = '17:30';
                }

                if (!this.appointmentTime || this.appointmentTime < this.minTime || this.appointmentTime > this.maxTime) {
                    this.appointmentTime = this.minTime;
                }
            },

            validateTime(event) {
                const time = event.target.value;

                if (time >= '12:00' && time <= '12:59') {
                    this.appointmentTime = '13:00';
                    this.showAlert('warning', 'Lunch Break', 'Appointments cannot be scheduled between 12:00 PM and 12:59 PM.');
                    return;
                }

                if (time < this.minTime) {
                    this.appointmentTime = this.minTime;
                    this.showAlert('error', 'Too Early', `Opening time is ${this.formatTime(this.minTime)}.`);
                    return;
                }

                if (time > this.maxTime) {
                    this.appointmentTime = this.maxTime;
                    this.showAlert('error', 'Too Late', `Last available appointment is at ${this.formatTime(this.maxTime)}.`);
                    return;
                }
            },

            formatTime(timeStr) {
                let [hour, minute] = timeStr.split(':').map(Number);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                hour = hour % 12 || 12;
                return `${hour}:${minute.toString().padStart(2, '0')} ${ampm}`;
            },

            showAlert(type, title, text) {
                // Fallback to browser alert if SweetAlert is not available
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: type,
                        title: title,
                        text: text,
                        confirmButtonText: 'OK'
                    });
                } else {
                    alert(`${title}: ${text}`);
                }
            }
        };
    }
</script>
@endsection
