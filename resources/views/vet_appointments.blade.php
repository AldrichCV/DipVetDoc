<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div x-data="appointmentsComponent()" class="py-12 space-y-8">
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
                                    <th class="px-4 py-2 border text-left">Assigned Personnel</th>
                                    <th class="px-4 py-2 border text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-4 py-2 border cursor-pointer text-blue-600 underline"
                                            @mouseenter="showPetModal($event, {{ json_encode($appointment) }})"
                                            @mouseleave="hidePetModal()"
                                        >
                                            {{ $appointment->pet_name }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ $appointment->owner_name }}</td>
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </td>
                                        <td class="px-4 py-2 border">{{ $appointment->reason_name }}</td>
                                        <td class="px-4 py-2 border">
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold rounded
                                                       text-white
                                                       {{ $appointment->status === 'approved' ? 'bg-green-600' : '' }}
                                                       {{ $appointment->status === 'pending' ? 'bg-yellow-500' : '' }}
                                                       {{ $appointment->status === 'cancelled' ? 'bg-red-600' : '' }}
                                                       {{ $appointment->status === 'completed' ? 'bg-blue-600' : '' }}"
                                            >
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $appointment->assigned_personnel_name ?? '-' }}
                                            @if(isset($appointment->assigned_personnel_role))
                                                ({{ $appointment->assigned_personnel_role }})
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border space-x-2">
                                            <!-- Edit and Delete buttons as before -->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-2 text-center border">No appointments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pet Info Modal outside the table -->
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
                showModal: false,
                selectedAppointment: {},

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

                editAppointment(appointment) {
                    this.selectedAppointment = appointment;
                    this.showModal = true;
                },

                viewFullInfo() {
                    if (this.petModalData.pet_code) {
                        window.location.href = `/pets/${this.petModalData.pet_code}`;
                    } else {
                        alert('Pet code not available.');
                    }
                }
            }
        }
    </script>
</x-app-layout>
