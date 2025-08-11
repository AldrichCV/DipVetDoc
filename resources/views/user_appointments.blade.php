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
                                @if(auth()->user()->role === 'admin')
                                    <th class="px-4 py-2 border text-left">Owner</th>
                                @endif
                                <th class="px-4 py-2 border text-left">Date</th>
                                <th class="px-4 py-2 border text-left">Time</th>
                                <th class="px-4 py-2 border text-left">Service</th>
                                <th class="px-4 py-2 border text-left">Status</th>
                                <th class="px-4 py-2 border text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $appointment->pet_name }}</td>
                                    @if(auth()->user()->role === 'admin')
                                        <td class="px-4 py-2 border">{{ $appointment->owner_name }}</td>
                                    @endif
                                    <td class="px-4 py-2 border">{{ $appointment->appointment_date }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->appointment_time }}</td>
                                    <td class="px-4 py-2 border">{{ $appointment->reason_name }}</td>
                                    <td class="px-4 py-2 border">{{ ucfirst($appointment->status) }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <button
                                            @click="editAppointment({{ json_encode($appointment) }})"
                                            class="text-blue-600 hover:underline">
                                            Edit
                                        </button>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                        </form>
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

<!-- Modal -->
<div x-show="showModal" x-transition
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg" @click.away="showModal = false">
        <h2 class="text-lg font-semibold mb-4">Edit Appointment</h2>

        <form :action="`/appointments/${selectedAppointment.id}`" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 text-sm">Pet Name</label>
                <input type="text" name="pet_name" x-bind:value="selectedAppointment.pet_name"
                       class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" readonly>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm">Date</label>
                <input type="date" name="appointment_date" x-bind:value="selectedAppointment.appointment_date"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm">Time</label>
                <input type="time" name="appointment_time" x-bind:value="selectedAppointment.appointment_time"
                       class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm">Service</label>
                <select name="reason" x-model="selectedAppointment.reason"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Select --</option>
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

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="3" x-model="selectedAppointment.notes"
                          class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

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

@if(auth()->user()->role !== 'admin')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-12 pb-20">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold mb-4">New Appointment</h3>

            <form method="POST" action="{{ route('my_appointments.store') }}">
                @csrf

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Pet Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Pet Name</label>
                            <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Species</label>
                            <input type="text" name="species" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Breed</label>
                            <input type="text" name="breed" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Sex</label>
                            <select name="sex" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Select --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                    </div>
                </div>

                <hr class="my-6 border-t border-gray-300">

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Appointment Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Appointment Date</label>
                            <input type="date" name="appointment_date" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Appointment Time</label>
                            <input type="time" name="appointment_time" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Service</label>
                            <select name="reason" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Select --</option>
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

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                            <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

</x-app-layout>
