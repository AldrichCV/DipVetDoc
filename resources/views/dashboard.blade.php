{{-- Dashboard View using Blade Components --}}
<x-app-layout>
    {{-- Header Slot - This section will be inserted into the layout's header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} {{-- Display the word "Dashboard" --}}
        </h2>
    </x-slot>

    {{-- Main Content Padding --}}
    <div class="py-12">
        {{-- Centered Container with Max Width --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- White Box with Shadow and Rounded Corners --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Inner Padding and Text Styling --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }} {{-- Notification message when user is logged in --}}

                    {{-- Horizontal Button Group --}}
                    <div class="mt-6 flex flex-wrap gap-4">
                        {{-- Button to Create a New Appointment --}}
                        <a href="{{ route('appointments.create') }}"
                           class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
                            Book Appointment
                        </a>

                        {{-- Button to View All User Appointments --}}
                        <a href="{{ route('appointments.index') }}"
                           class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition duration-200">
                            My Appointments
                        </a>

                        {{-- Button to Register a New Pet --}}
                        <a href="{{ route('pets.create') }}"
                           class="px-4 py-2 bg-purple-600 text-white font-semibold rounded hover:bg-purple-700 transition duration-200">
                            Register Pet
                        </a>

                        {{-- Button to View All User Pets --}}
                        <a href="{{ route('pets.index') }}"
                           class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600 transition duration-200">
                            My Pets
                        </a>
                    </div>
                    {{-- End Button Group --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
