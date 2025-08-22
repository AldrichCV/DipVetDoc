<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Consultations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($consultations->isEmpty())
                <p class="text-center text-gray-500 text-lg italic">No consultations found.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($consultations as $consultation)
                        <div x-data="{ openConsultationModal: false }" class="bg-white border rounded-lg p-6 shadow hover:shadow-md transition flex flex-col justify-between">
                            <!-- Pet & Owner -->
                            <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">
                                {{ $consultation->pet_name ?? 'N/A' }}
                            </h3>
                            <p class="text-gray-600 text-sm text-center"><strong>Owner:</strong> {{ $consultation->owner_name ?? 'N/A' }}</p>
                            <p class="text-gray-600 text-sm text-center"><strong>Status:</strong> 
                                <span class="inline-block px-2 py-1 text-sm font-semibold rounded-full
                                    {{ $consultation->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $consultation->status === 'ongoing' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                            </p>
                            <p class="text-gray-500 text-sm text-center">Vet: {{ $consultation->vet_name ?? 'Unassigned' }}</p>

                            <!-- Update Consultation Button -->
                            <button 
                                @click="openConsultationModal = true"
                                class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Add Consultation
                            </button>

                            <!-- Modal -->
                            <div x-show="openConsultationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white rounded-lg p-6 w-96">
                                    <h3 class="text-lg font-bold mb-4">Update Consultation</h3>
                                    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-2">
                                            <label class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                            <textarea name="diagnosis" class="w-full border rounded px-2 py-1">{{ $consultation->diagnosis }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block text-sm font-medium text-gray-700">Treatment</label>
                                            <textarea name="treatment" class="w-full border rounded px-2 py-1">{{ $consultation->treatment }}</textarea>
                                        </div>
                                        <div class="flex justify-end gap-2 mt-4">
                                            <button type="button" @click="openConsultationModal = false" class="px-3 py-1 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                                            <button type="submit" class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
