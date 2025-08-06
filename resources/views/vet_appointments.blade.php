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
                                <th class="px-4 py-2 border text-left">Date</th>
                                <th class="px-4 py-2 border text-left">Time</th>
                                <th class="px-4 py-2 border text-left">Reason</th>
                                <th class="px-4 py-2 border text-left">Status</th>
                                <th class="px-4 py-2 border text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $appointment->pet_name }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->appointment_date }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->appointment_time }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->reason }}</td>
                                    <td class="px-4 py-2 border">{{ ucfirst($appointment->status) }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <!-- Edit Button -->
                                        <button
                                            @click="editAppointment({{ json_encode($appointment) }}
)"
                                            class="text-blue-600 hover:underline">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center border">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  <!-- Modal -->
<div x-show="showModal" x-transition
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    style="display: none;">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg" @click.away="showModal = false">
        <h2 class="text-lg font-semibold mb-4">Edit Appointment</h2>

        <form :action="`/appointments/${selectedAppointment.id}`" method="POST">
            @csrf
            @method('PUT')

            <!-- Pet Name (Read-Only) -->
            <div class="mb-4">
                <label class="block mb-1 text-sm">Pet Name</label>
                <input type="text" name="pet_name" :value="selectedAppointment.pet_name"
                       class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" readonly>
            </div>

            <!-- Appointment Date -->
            <div class="mb-4">
                <label class="block mb-1 text-sm">Date</label>
                <input type="date" name="appointment_date" :value="selectedAppointment.appointment_date"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Appointment Time -->
            <div class="mb-4">
                <label class="block mb-1 text-sm">Time</label>
                <input type="time" name="appointment_time" :value="selectedAppointment.appointment_time"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Reason -->
            <div class="mb-4">
                <label class="block mb-1 text-sm">Reason</label>
                <input type="text" name="reason" :value="selectedAppointment.reason"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2"
                          x-text="selectedAppointment.notes"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-2">
                <button type="button" @click="showModal = false"
                        class="px-4 py-2 border rounded text-gray-600">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function appointmentsComponent() {
        return {
            showModal: false,
            selectedAppointment: {},
            editAppointment(appointment) {
                this.selectedAppointment = appointment;
                this.showModal = true;
            }
        };
    }
</script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
