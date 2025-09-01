<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Appointments') }}
            </h2>
            <div class="text-sm text-gray-600">
                <span class="hidden sm:inline">Manage your appointments</span>
            </div>
        </div>
    </x-slot>

    <div x-data="appointmentsComponent()" class="py-6 lg:py-12" @keydown.escape="closeVetModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             {{-- Added responsive card layout for mobile and table for desktop --}}
            
             {{-- Mobile Card Layout (hidden on md and up) --}}
            <div class="md:hidden space-y-4">
                @forelse ($appointments as $appointment)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                         {{-- Card Header --}}
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-900">{{ $appointment->pet_name }}</h3>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                        {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                         {{-- Card Body --}}
                        <div class="p-4 space-y-3">
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div>
                                    <span class="text-gray-500 font-medium">Owner:</span>
                                    <p class="text-gray-900 mt-1">{{ $appointment->owner_name }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500 font-medium">Date:</span>
                                    <p class="text-gray-900 mt-1">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500 font-medium">Time:</span>
                                    <p class="text-gray-900 mt-1">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500 font-medium">Reason:</span>
                                    <p class="text-gray-900 mt-1">{{ $appointment->reason_name }}</p>
                                </div>
                            </div>

                             {{-- Mobile Actions --}}
                            @if(in_array($appointment->status, ['pending', 'approved']))
                                <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                                    @if ($appointment->status === 'pending')
                                        <form id="approve-form-{{ $appointment->id }}" 
                                              action="{{ route('my_appointments.updateStatus', [$appointment->id, 'approved']) }}" 
                                              method="POST" class="hidden">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                            <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                        </form>
                                        <button type="button" 
                                                @click="approve({{ $appointment->id }})"
                                                class="flex-1 bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                            Approve
                                        </button>

                                        <form id="cancel-form-{{ $appointment->id }}" 
                                              action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                                              method="POST" class="hidden">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                            <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                        </form>
                                        <button type="button" 
                                                @click="cancelApp({{ $appointment->id }})"
                                                class="flex-1 bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                                            Cancel
                                        </button>

                                    @elseif ($appointment->status === 'approved')
                                        <form id="complete-form-{{ $appointment->id }}" 
                                              action="{{ route('my_appointments.updateStatus', [$appointment->id, 'completed']) }}" 
                                              method="POST" class="hidden">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                            <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                        </form>
                                        <button type="button" 
                                                @click="completeApp({{ $appointment->id }})"
                                                class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                            Complete
                                        </button>

                                        <form id="cancel-form-{{ $appointment->id }}" 
                                              action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                                              method="POST" class="hidden">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                            <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                        </form>
                                        <button type="button" 
                                                @click="cancelApp({{ $appointment->id }})"
                                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                            Cancel
                                        </button>
                                    @endif
                                </div>
                            @endif

                             {{-- Mobile Assigned Personnel --}}
                            @if(auth()->user()->role !== 'vet')
                                <div class="pt-3 border-t border-gray-100">
                                    <span class="text-gray-500 font-medium text-sm">Assigned Personnel:</span>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @php $allVets = $appointment->assigned_personnel ?? []; @endphp
                                        @forelse ($allVets as $vet)
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                                {{ $vet['name'] }}
                                                @isset($vet['role'])
                                                    ({{ $vet['role'] }})
                                                @endisset
                                                <button type="button"
                                                        class="ml-1.5 text-red-500 hover:text-red-700 font-bold"
                                                        @click.stop="removeAssignedVet({{ $appointment->appointment_id }}, {{ isset($vet['user_id']) ? $vet['user_id'] : 'null' }}, $event.target.closest('span'))">
                                                    ×
                                                </button>
                                            </span>
                                        @empty
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                                None
                                            </span>
                                        @endforelse
                                        <button type="button"
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 hover:bg-green-200 transition-colors"
                                                @click="selectActiveVet({{ $appointment->appointment_id }})">
                                            + Assign Vet
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No appointments found</p>
                        <p class="text-gray-400 text-sm mt-1">Appointments will appear here when available</p>
                    </div>
                @endforelse
            </div>

             {{-- Desktop Table Layout (hidden on mobile) --}}
            <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Pet Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Owner Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Time</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Reason</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                                @if(auth()->user()->role !== 'vet')
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Assigned Personnel</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $appointment->pet_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $appointment->owner_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $appointment->reason_name }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center gap-2 
                                                @if(in_array($appointment->status, ['pending', 'approved']))
                                                    pl-3 pr-2
                                                @else
                                                    px-3
                                                @endif
                                                py-1.5 text-sm font-medium rounded-full
                                                {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}">

                                                <span>{{ ucfirst($appointment->status) }}</span>

                                                @if ($appointment->status === 'pending')
                                                    <form id="approve-form-{{ $appointment->id }}" 
                                                          action="{{ route('my_appointments.updateStatus', [$appointment->id, 'approved']) }}" 
                                                          method="POST" class="hidden">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                                        <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                                    </form>
                                                    <button type="button" 
                                                            @click="approve({{ $appointment->id }})"
                                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-green-200 text-green-700 hover:bg-green-300 hover:text-green-900 transition-colors">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>

                                                    <form id="cancel-form-{{ $appointment->id }}" 
                                                          action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                                                          method="POST" class="hidden">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                                        <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                                    </form>
                                                    <button type="button" 
                                                            @click="cancelApp({{ $appointment->id }})"
                                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-red-200 text-red-700 hover:bg-red-300 hover:text-red-900 transition-colors">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>

                                                @elseif ($appointment->status === 'approved')
                                                    <form id="complete-form-{{ $appointment->id }}" 
                                                          action="{{ route('my_appointments.updateStatus', [$appointment->id, 'completed']) }}" 
                                                          method="POST" class="hidden">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                                        <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                                    </form>
                                                    <button type="button" 
                                                            @click="completeApp({{ $appointment->id }})"
                                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-200 text-blue-700 hover:bg-blue-300 hover:text-blue-900 transition-colors">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>

                                                    <form id="cancel-form-{{ $appointment->id }}" 
                                                          action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                                                          method="POST" class="hidden">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="user_id" value="{{ $appointment->owner_id }}">
                                                        <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
                                                    </form>
                                                    <button type="button" 
                                                            @click="cancelApp({{ $appointment->id }})"
                                                            class="flex items-center justify-center w-6 h-6 rounded-full bg-red-200 text-red-700 hover:bg-red-300 hover:text-red-900 transition-colors">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </span>
                                        </div>
                                    </td>

                                    @if(auth()->user()->role !== 'vet')
                                        <td class="px-6 py-4">
                                            @php $allVets = $appointment->assigned_personnel ?? []; @endphp
                                            <div class="flex flex-wrap gap-1">
                                                @forelse ($allVets as $vet)
                                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
                                                        {{ $vet['name'] }}
                                                        @isset($vet['role'])
                                                            ({{ $vet['role'] }})
                                                        @endisset
                                                        <button type="button"
                                                                class="ml-1.5 text-red-500 hover:text-red-700 font-bold"
                                                                @click.stop="removeAssignedVet({{ $appointment->appointment_id }}, {{ isset($vet['user_id']) ? $vet['user_id'] : 'null' }}, $event.target.closest('span'))">
                                                            ×
                                                        </button>
                                                    </span>
                                                @empty
                                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                                        None
                                                    </span>
                                                @endforelse
                                                <button type="button"
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 hover:bg-green-200 transition-colors"
                                                        @click="selectActiveVet({{ $appointment->appointment_id }})">
                                                    + Assign Vet
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'vet' ? 6 : 7 }}" 
                                        class="px-6 py-12 text-center">
                                        <div class="text-gray-400 mb-2">
                                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">No appointments found</p>
                                        <p class="text-gray-400 text-sm mt-1">Appointments will appear here when available</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         {{-- Enhanced Vet Selector Modal with better styling and mobile responsiveness --}}
        <div x-show="vetModalVisible"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
             @click.self.stop="closeVetModal()">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                
                 {{-- Modal Header --}}
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900">
                            Select a Veterinarian
                            <span x-text="selectedAppointmentId ? `(Appointment #${selectedAppointmentId})` : ''" class="text-sm font-normal text-gray-600"></span>
                        </h3>
                        <button @click="closeVetModal()" 
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                 {{-- Modal Body --}}
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                    <template x-if="vets.length === 0">
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium text-lg">No active vets available</p>
                            <p class="text-gray-400 text-sm mt-1">Please check back later or contact an administrator</p>
                        </div>
                    </template>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <template x-for="vet in vets" :key="vet.id">
                            <div class="group cursor-pointer border-2 border-gray-200 rounded-xl p-4 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 transform hover:scale-105"
                                 @click="assignVet(vet.id)"
                                 :title="`Assign ${vet.name}`">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            <span x-text="vet.name.charAt(0).toUpperCase()"></span>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors" x-text="vet.name"></h4>
                                        <p class="text-sm text-gray-600 mt-1" x-text="vet.specialization || 'General Practice'"></p>
                                    </div>
                                </div>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Available
                                    </span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

         {{-- Enhanced Pet Info Modal with better positioning and styling --}}
        <div x-show="petModalVisible"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             x-bind:style="`top: ${modalTop}px; left: ${modalLeft}px; position: fixed;`"
             class="w-72 bg-white border border-gray-200 rounded-xl shadow-2xl p-4 z-50 pointer-events-auto"
             style="display: none;"
             @mouseenter="keepPetModal()"
             @mouseleave="hidePetModal()">
            
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                    <span x-text="(petModalData.pet_name || 'P').charAt(0).toUpperCase()"></span>
                </div>
                <h3 class="font-bold text-lg text-gray-900" x-text="petModalData.pet_name || 'N/A'"></h3>
            </div>

            <template x-if="petModalData.breed || petModalData.age || petModalData.owner_name">
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Breed:</span>
                        <span class="text-sm text-gray-900" x-text="petModalData.breed || 'N/A'"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Age:</span>
                        <span class="text-sm text-gray-900" x-text="petModalData.age || 'N/A'"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Owner:</span>
                        <span class="text-sm text-gray-900" x-text="petModalData.owner_name || 'N/A'"></span>
                    </div>
                </div>
            </template>

            <template x-if="!(petModalData.breed || petModalData.age || petModalData.owner_name)">
                <p class="italic text-gray-500 text-sm mb-4">Pet details not found.</p>
            </template>

            <button @click="viewFullInfo()"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg px-3 py-2 text-sm font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105">
                View Full Info
            </button>
        </div>
    </div>

<script>
    function appointmentsComponent() {
    return {
        petModalVisible: false,
        petModalData: {},
        modalTop: 0,
        modalLeft: 0,
        vets: [],
        vetModalVisible: false,
        selectedAppointmentId: null,

        // Open modal with correct appointment ID
        selectActiveVet(appointmentId) {
            this.selectedAppointmentId = appointmentId; // store current appointment
            fetch('/api/vets/active')
                .then(res => res.json())
                .then(data => {
                    this.vets = data;
                    this.vetModalVisible = true;
                })
                .catch(() => {
                    alert('Failed to load vets.');
                });
        },

        // Assign vet to selected appointment
        assignVet(vetId) {
            if (!this.selectedAppointmentId) {
                Swal.fire('Missing Data', 'Please select an appointment first.', 'warning');
                return;
            }

            if (!vetId) {
                Swal.fire('Missing Data', 'Please select a vet first.', 'warning');
                return;
            }

            fetch('/assign-vet', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // forces Laravel to return JSON
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    vet_id: vetId,
                    appointment_id: this.selectedAppointmentId
                })
            })
            .then(async res => {
                const text = await res.text();
                const contentType = res.headers.get("content-type");

                if (!res.ok) {
                    if (contentType && contentType.includes("application/json")) {
                        const errJson = JSON.parse(text);
                        // ✅ Collect all error messages from Laravel's `errors` object
                        if (errJson.errors) {
                            const allErrors = Object.values(errJson.errors)
                                .flat()
                                .join('<br>'); // join with line breaks
                            throw new Error(allErrors);
                        }
                        throw new Error(errJson.message || `HTTP ${res.status} - ${res.statusText}`);
                    } else {
                        throw new Error(`Server returned non-JSON response:\n${text}`);
                    }
                }

                return JSON.parse(text);
            })
            .then(data => {
                Swal.fire('Success', data.message, 'success').then(() => {
                    this.closeVetModal();
                    location.reload();
                });
            })
            .catch(err => {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: err.message 
                });
            });
        },

        // Close vet modal & reset state
        closeVetModal() {
            this.vetModalVisible = false;
            this.selectedAppointmentId = null;
        },
    
       removeAssignedVet(appointmentId, vetId, badgeEl) {
            if (!appointmentId || !vetId) {
                console.warn("Missing appointmentId or vetId");
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Data',
                    text: 'Missing appointment ID or vet ID. Please try again.',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            Swal.fire({
                title: 'Remove Vet?',
                text: 'Are you sure you want to remove this vet from the appointment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) {
                    return; // user canceled
                }

                // Remove from UI immediately
                if (badgeEl) badgeEl.remove();

                // Send to backend
                fetch(`/assigned-vet/remove`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        appointment_id: appointmentId,
                        vet_id: vetId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Remove response:", data);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Vet removed successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Remove Vet',
                            text: 'The vet could not be removed from this appointment. Please try again.',
                            confirmButtonColor: '#d33'
                        }).then(() => {
                            location.reload();
                        });
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'An error occurred while removing the vet. Please try again later.',
                        confirmButtonColor: '#d33'
                    }).then(() => {
                        location.reload();
                    });
                });
            });
        },

        // Pet modal logic
        showPetModal(event, appointment) {
            this.petModalData = appointment;
            this.petModalVisible = true;

            const rect = event.target.getBoundingClientRect();
            this.modalTop = rect.bottom + window.scrollY + 5;
            this.modalLeft = rect.left + window.scrollX;

            const modalWidth = 256;
            if ((this.modalLeft + modalWidth) > window.innerWidth) {
                this.modalLeft = window.innerWidth - modalWidth - 10;
            }
        },

        hidePetModal() {
            this.petModalVisible = false;
        },

        keepPetModal() {
            this.petModalVisible = true;
        },

        viewFullInfo() {
            if (this.petModalData.pet_code) {
                window.location.href = `/pets/${this.petModalData.pet_code}`;
            } else {
                alert('Pet code not available.');
            }
        },

       approve(id) {
    const form = document.getElementById(`approve-form-${id}`);
    const userId = form.querySelector('input[name="user_id"]').value;
    const petId = form.querySelector('input[name="pet_id"]').value;

    Swal.fire({
        title: "Approve Appointment?",
        text: "This will mark the appointment as approved.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#16a34a", // green
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, approve"
    }).then((result) => {
        if (result.isConfirmed) {
            // Optionally, you can send via fetch for more control
            // or just submit the form (which already has user_id)
            form.submit();
        }
    }).catch((err) => {
        Swal.fire("Error", "Something went wrong!", "error");
        console.error(err);
    });
},

cancelApp(id) {
    const form = document.getElementById(`cancel-form-${id}`);
    const userId = form.querySelector('input[name="user_id"]').value;
    const petId = form.querySelector('input[name="pet_id"]').value;

    Swal.fire({
        title: "Cancel Appointment?",
        text: "This will mark the appointment as cancelled.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33", // red
        cancelButtonColor: "#6b7280", // gray
        confirmButtonText: "Yes, cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    }).catch((err) => {
        Swal.fire("Error", "Something went wrong!", "error");
        console.error(err);
    });
},

completeApp(id) {
    const form = document.getElementById(`complete-form-${id}`);
    const userId = form.querySelector('input[name="user_id"]').value;
    const petId = form.querySelector('input[name="pet_id"]').value;

    Swal.fire({
        title: "Complete Appointment?",
        text: "This will mark the appointment as completed.",
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#2563eb", // blue
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Yes, complete"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    }).catch((err) => {
        Swal.fire("Error", "Something went wrong!", "error");
        console.error(err);
    });
}

    }
}
</script>
</x-app-layout>
