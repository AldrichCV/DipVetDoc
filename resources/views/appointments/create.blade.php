<x-app-layout>
    {{-- Header slot to define the page title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-white">
            Book Appointment
        </h2>
    </x-slot>

    {{-- Main content container, centers the form --}}
    <div class="flex justify-center items-center p-6">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded px-8 py-6">
            
            {{-- Display success message if appointment is booked --}}
            @if(session('success'))
                <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
            @endif

            {{-- Appointment booking form --}}
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf {{-- CSRF token for security --}}

                {{-- Pet Name Input --}}
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Pet Name:</label>
                    <input type="text" name="pet_name" required
                        class="w-full mt-1 p-2 border rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                {{-- Service Dropdown --}}
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Service:</label>
                    <select name="service" required
                        class="w-full mt-1 p-2 border rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="Consultation">Consultation</option>
                        <option value="Vaccination">Vaccination</option>
                        <option value="Surgery">Surgery</option>
                    </select>
                </div>

                {{-- Appointment Date Input --}}
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Date:</label>
                    <input type="date" name="appointment_date" required
                        class="w-full mt-1 p-2 border rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                {{-- Appointment Time Input --}}
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Time:</label>
                    <input type="time" name="appointment_time" required
                        class="w-full mt-1 p-2 border rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>

                {{-- Optional Notes Input --}}
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Notes:</label>
                    <textarea name="notes"
                        class="w-full mt-1 p-2 border rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        rows="3"></textarea>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold p-2 rounded transition">
                    Book Appointment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
