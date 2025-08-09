<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($pets->isEmpty())
                    <p class="text-center text-gray-500">No pets found.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($pets as $pet)
                            <div class="border rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col items-center">
                                <img
                                    src="{{ asset('images/pets/' . ($pet->pet_code ?? 'default') . '.jpg') }}"
                                    alt="{{ $pet->name }}"
                                    class="w-32 h-32 object-cover rounded-full mb-4"
                                >

                                <h3 class="text-lg font-semibold mb-1 text-center">{{ $pet->name }}</h3>

                                <ul class="text-gray-600 text-sm space-y-1 text-center">
                                    <li><strong>Species:</strong> {{ $pet->species ?? 'N/A' }}</li>
                                    <li><strong>Breed:</strong> {{ $pet->breed ?? 'N/A' }}</li>
                                    <li><strong>Sex:</strong> {{ ucfirst($pet->sex) ?? 'N/A' }}</li>
                                    <li><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($pet->date_of_birth)->format('M d, Y') ?? 'N/A' }}</li>
                                </ul>

                                <span class="mt-4 px-3 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold tracking-wide">
                                    {{ $pet->pet_code }}
                                </span>

                                <div class="mt-4 flex space-x-3">
                                    <a href="{{ route('pets.edit', $pet->pet_code) }}"
                                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('pets.destroy', $pet->pet_code) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this pet?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
