<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div x-data="appointmentsComponent()" class="py-12 space-y-8" @keydown.escape="closeVetModal()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto w-full mb-6">
                        <table class="w-full border border-gray-200 table-auto">
                           <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left">Pet Name</th>
                                <th class="px-4 py-2 border text-left">Owner Name</th>
                                <th class="px-4 py-2 border text-left">Date</th>
                                <th class="px-4 py-2 border text-left">Time</th>
                                <th class="px-4 py-2 border text-left">Reason</th>
                                <th class="px-4 py-2 border text-left">Status</th>

                                {{-- Hide only if vet --}}
                                @if(auth()->user()->role !== 'vet')
                                    <th class="px-4 py-2 border text-left">Assigned Personnel</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $appointment->pet_name }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->owner_name }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $appointment->reason_name }}</td>

                              <td class="px-4 py-2 border">
    <div class="flex items-center">
        <span class="inline-flex items-center gap-2 
            @if(in_array($appointment->status, ['pending', 'approved']))
                pl-3 pr-2
            @else
                px-4
            @endif
            py-1.5 text-sm font-semibold rounded-full shadow-sm
            {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-700 hover:bg-green-200' : '' }}
            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : '' }}
            {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700 hover:bg-red-200' : '' }}
            {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-700 hover:bg-blue-200' : '' }}">
            
            <!-- Status text -->
            <span>{{ ucfirst($appointment->status) }}</span>

            <!-- Action buttons depending on status -->
            @if ($appointment->status === 'pending')
                <!-- Approve -->
                <form id="approve-form-{{ $appointment->id }}" 
                    action="{{ route('my_appointments.updateStatus', [$appointment->id, 'approved']) }}" 
                    method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <button type="button" 
                    @click="approve({{ $appointment->id }})"
                    class="flex items-center justify-center w-5 h-5 rounded-full bg-green-200 text-green-700 hover:bg-green-300 hover:text-green-900 transition">
                    ✓
                </button>

                <!-- Cancel -->
                <form id="cancel-form-{{ $appointment->id }}" 
                    action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                    method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <button type="button" 
                    @click="cancelApp({{ $appointment->id }})"
                    class="flex items-center justify-center w-5 h-5 rounded-full bg-red-200 text-red-700 hover:bg-red-300 hover:text-red-900 transition">
                    ✕
                </button>
            
            @elseif ($appointment->status === 'approved')
                <!-- Completed -->
                <form id="complete-form-{{ $appointment->id }}" 
                    action="{{ route('my_appointments.updateStatus', [$appointment->id, 'completed']) }}" 
                    method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <button type="button" 
                    @click="completeApp({{ $appointment->id }})"
                    class="flex items-center justify-center w-5 h-5 rounded-full bg-blue-200 text-blue-700 hover:bg-blue-300 hover:text-blue-900 transition">
                    ✓
                </button>

                <!-- Cancel -->
                <form id="cancel-form-{{ $appointment->id }}" 
                    action="{{ route('my_appointments.updateStatus', [$appointment->id, 'cancelled']) }}" 
                    method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <button type="button" 
                    @click="cancelApp({{ $appointment->id }})"
                    class="flex items-center justify-center w-5 h-5 rounded-full bg-red-200 text-red-700 hover:bg-red-300 hover:text-red-900 transition">
                    ✕
                </button>
            @endif
        </span>
    </div>
</td>



                                   {{-- Hide entire column if vet --}}
                                    @if(auth()->user()->role !== 'vet')
                                        <td class="px-4 py-2 border">
                                            @php $allVets = $appointment->assigned_personnel ?? []; @endphp

                                            @forelse ($allVets as $vet)
                                                <span
                                                    class="cursor-pointer inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full
                                                        bg-blue-100 text-blue-700 hover:bg-blue-200 mr-1 mb-1"
                                                    title="{{ $vet['role'] ?? '' }}"
                                                >
                                                    <span>{{ $vet['name'] }}</span>
                                                    @isset($vet['role'])
                                                        ({{ $vet['role'] }})
                                                    @endisset

                                                    <!-- Remove button -->
                                                    <button
                                                        type="button"
                                                        class="ml-2 text-red-500 hover:text-red-700 font-bold text-lg pointer-events-auto"
                                                        @click.stop="
                                                            removeAssignedVet(
                                                                {{ $appointment->appointment_id }},
                                                                {{ isset($vet['user_id']) ? $vet['user_id'] : 'null' }},
                                                                $event.target.closest('span')
                                                            );
                                                        "
                                                    >
                                                        &times;
                                                    </button>
                                                </span>
                                            @empty
                                                <span
                                                    class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                                        bg-red-100 text-red-700 hover:bg-red-200 mr-1 mb-1"
                                                    title="No vets assigned"
                                                >
                                                    None
                                                </span>
                                            @endforelse

                                            <!-- Assign Vet button -->
                                            <button
                                                type="button"
                                                class="inline-block mt-2 px-3 py-1 text-sm font-semibold rounded-full
                                                    bg-green-100 text-green-700 hover:bg-green-200"
                                                @click="selectActiveVet({{ $appointment->appointment_id }})"
                                            >
                                                + Assign Vet
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    {{-- adjust colspan based on role --}}
                                    <td colspan="{{ auth()->user()->role === 'vet' ? 6 : 7 }}" 
                                        class="px-4 py-2 text-center border">
                                        No appointments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vet Selector Modal -->
        <div
            x-show="vetModalVisible"
            x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click.self.stop="closeVetModal()" 
        >
            <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 overflow-y-auto max-h-[80vh]">
                <!-- Modal Title -->
                <h3 class="text-xl font-semibold mb-4">
                    Select a Veterinarian <span x-text="selectedAppointmentId"></span>
                </h3>

                <!-- No Vets Available -->
                <template x-if="vets.length === 0">
                    <p class="text-center text-gray-500">No active vets available.</p>
                </template>

                <!-- Vet List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <template x-for="vet in vets" :key="vet.id">
                        <div
                            class="cursor-pointer border rounded p-4 hover:bg-blue-100 transition shadow-sm"
                            @click="assignVet(vet.id)"
                            :title="`Assign ${vet.name}`"
                        >
                            <h4 class="font-semibold text-lg text-gray-800" x-text="vet.name"></h4>
                            <p class="text-sm text-gray-600 mt-1" x-text="vet.specialization ?? 'No specialization'"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Pet Info Modal -->
        <div
            x-show="petModalVisible"
            x-transition
            x-bind:style="`top: ${modalTop}px; left: ${modalLeft}px; position: fixed;`"
            class="w-64 bg-white border border-gray-300 rounded shadow-lg p-4 z-50 pointer-events-auto"
            style="display: none;"
            @mouseenter="keepPetModal()"
            @mouseleave="hidePetModal()"
        >
            <h3 class="font-semibold text-lg mb-2" x-text="petModalData.pet_name ?? 'N/A'"></h3>

            <template x-if="petModalData.breed || petModalData.age || petModalData.owner_name">
                <div>
                    <p><strong>Breed:</strong> <span x-text="petModalData.breed ?? 'N/A'"></span></p>
                    <p><strong>Age:</strong> <span x-text="petModalData.age ?? 'N/A'"></span></p>
                    <p><strong>Owner:</strong> <span x-text="petModalData.owner_name ?? 'N/A'"></span></p>
                </div>
            </template>

            <template x-if="!(petModalData.breed || petModalData.age || petModalData.owner_name)">
                <p class="italic text-gray-500">Pet details not found.</p>
            </template>

            <button
                @click="viewFullInfo()"
                class="mt-4 w-full bg-blue-600 text-white rounded px-3 py-2 hover:bg-blue-700 transition"
            >
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
                        document.getElementById(`approve-form-${id}`).submit();
                    }
                }).catch((err) => {
                    Swal.fire("Error", "Something went wrong!", "error");
                    console.error(err);
                });
            },

            cancelApp(id) {
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
                        document.getElementById(`cancel-form-${id}`).submit();
                    }
                }).catch((err) => {
                    Swal.fire("Error", "Something went wrong!", "error");
                    console.error(err);
                });
            },

            completeApp(id) {
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
                        document.getElementById(`complete-form-${id}`).submit();
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
