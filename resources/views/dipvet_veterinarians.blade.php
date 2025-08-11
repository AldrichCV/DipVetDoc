<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('The Vet Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($vets->isEmpty())
                    <p class="text-center text-gray-500 text-lg italic">No staff found.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($vets as $vet)
                            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                                {{-- Name --}}
                                <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">
                                    {{ $vet->name }}
                                </h3>

                                {{-- Role --}}
                                <ul class="text-gray-600 text-sm space-y-1 text-center">
                                    <li>
                                        <strong>Role:</strong> {{ $vet->role ?? 'N/A' }}
                                    </li>
                                </ul>

                                {{-- Action Buttons --}}
                                <div class="mt-4 flex justify-center space-x-3">
                                    <a href="{{ url('#') }}"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                                        Edit
                                    </a>

                                    <form method="POST"
                                        onsubmit="return confirm('Are you sure you want to remove this vet?');">
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
