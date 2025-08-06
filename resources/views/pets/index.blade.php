{{-- resources/views/pets/index.blade.php --}}

{{-- Use the main application layout --}}
<x-app-layout>

    {{-- Page header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Pets') }}
        </h2>
    </x-slot>

    {{-- Main content padding --}}
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            {{-- Container for the card --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Check if the user has any pets --}}
                    @if ($pets->isEmpty())
                        {{-- Message if no pets are registered --}}
                        <p>You haven't registered any pets yet.</p>
                    @else
                        {{-- Table to display the list of pets --}}
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    {{-- Table column headers --}}
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Species</th>
                                    <th class="px-4 py-2 text-left">Breed</th>
                                    <th class="px-4 py-2 text-left">Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop through each pet and display its info in a table row --}}
                                @foreach ($pets as $pet)
                                    <tr class="border-t border-gray-300 dark:border-gray-600">
                                        <td class="px-4 py-2">{{ $pet->name }}</td>
                                        <td class="px-4 py-2">{{ $pet->species }}</td>
                                        <td class="px-4 py-2">{{ $pet->breed }}</td>
                                        <td class="px-4 py-2">{{ $pet->age }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
