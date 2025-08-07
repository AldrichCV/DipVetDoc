<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto w-full">
                        <table class="w-full border border-gray-200 table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border text-left">ID</th>
                                    <th class="px-4 py-2 border text-left">Name</th>
                                    <th class="px-4 py-2 border text-left">Species</th>
                                    <th class="px-4 py-2 border text-left">Breed</th>
                                    <th class="px-4 py-2 border text-left">Sex</th>
                                    <th class="px-4 py-2 border text-left">Birth Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pets as $pet)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $pet->pet_code }}</td>
                                        <td class="px-4 py-2 border">{{ $pet->name }}</td>
                                        <td class="px-4 py-2 border">{{ $pet->species }}</td>
                                        <td class="px-4 py-2 border">{{ $pet->breed }}</td>
                                        <td class="px-4 py-2 border">{{ ucfirst($pet->sex) }}</td>
                                        <td class="px-4 py-2 border">{{ $pet->date_of_birth }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 text-center border">No pets found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
