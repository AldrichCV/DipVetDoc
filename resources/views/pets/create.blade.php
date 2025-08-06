{{-- Use the application layout --}}
<x-app-layout>

    {{-- Page header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Register Pet') }} {{-- Page title --}}
        </h2>
    </x-slot>

    {{-- Page content wrapper with padding and max width --}}
    <div class="py-12 max-w-4xl mx-auto">
        {{-- Card-like container for the form --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- Form to submit new pet data --}}
            <form action="{{ route('pets.store') }}" method="POST">
                @csrf {{-- CSRF token to protect against cross-site request forgery --}}

                {{-- Pet Name Input --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pet Name</label>
                    <input type="text" name="name" required
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                {{-- Species Input (e.g., Dog, Cat) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Species</label>
                    <input type="text" name="species" required
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                {{-- Breed Input (optional) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Breed (optional)</label>
                    <input type="text" name="breed"
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                {{-- Age Input --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age</label>
                    <input type="number" name="age" min="0" required
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                {{-- Gender Dropdown --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                    <select name="gender" required class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition duration-200">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
