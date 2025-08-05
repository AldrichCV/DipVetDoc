<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-8" >
        {{-- Appointments Table --}}
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-2 text-center border">No appointments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- Insert Appointment Form in Separate Container --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12 pb-20">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">New Appointment</h3>

            <form method="POST" action="{{ route('appointments.store') }}">
    @csrf

    <!-- 🐾 Pet Details Section -->
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

    <!-- Appointment Details Section -->
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
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium mb-1">Reason</label>
                <input type="text" name="reason" class="w-full border border-gray-300 rounded px-3 py-2" required>
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
    </div>
</x-app-layout>
