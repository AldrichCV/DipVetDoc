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
                    <div 
                        x-show="openConsultationModal"
                        x-transition.opacity
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 print:static print:bg-transparent"
                    >
                        <div 
                            @click.away="openConsultationModal = false"
                            class="bg-white rounded-lg shadow-2xl relative p-12 w-[794px] h-[1123px] max-w-full max-h-[95vh] overflow-y-auto print:w-[210mm] print:h-[297mm] print:shadow-none print:rounded-none"
                        >
                            <!-- Close button (hidden in print) -->
                            <button @click="openConsultationModal = false" 
                                    class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 text-2xl print:hidden">
                                ✕
                            </button>

                            <!-- Header -->
                            <div class="text-center mb-8 border-b pb-4">
                                <h1 class="text-3xl font-bold uppercase">Consultation Record</h1>
                                <p class="text-gray-600">Dipolog Veterinary Doctor</p>
                            </div>

                            <!-- Content -->
                           <form action="{{ route('consultations.store') }}" method="POST" class="space-y-8">
                                @csrf
                                <input type="hidden" name="pet_id" value="{{ $consultation->pet_id }}">
                                <!-- Patient Info -->
                                <section>
                                    <h2 class="text-lg font-semibold mb-3 border-b">Patient Information</h2>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium">Pet Name</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->pet_name }}" readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Species</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->pet_species }}" readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Breed</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->pet_breed }}" readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Sex</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->pet_sex }}" readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Date of Birth</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->date_of_birth }}" readonly>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Age</label>
                                            <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                                value="{{ $consultation->pet_age }}" readonly>
                                        </div>
                                    </div>
                                </section>

                                <!-- Owner Info -->
                                <section>
                                    <h2 class="text-lg font-semibold mb-3 border-b">Owner Information</h2>
                                    <input type="text" class="w-full border-b px-2 py-1 bg-gray-100 print:border-0" 
                                        value="{{ $consultation->owner_name }}" readonly>
                                </section>

                                <!-- Consultation -->
                                <section>
                                    <h2 class="text-lg font-semibold mb-3 border-b">Consultation Details</h2>
                                    <div>
                                        <label class="block text-sm font-medium">Diagnosis</label>
                                        <textarea name="diagnosis" class="w-full border rounded px-3 py-2 h-32 print:border-0">{{ $consultation->diagnosis }}</textarea>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium">Treatment</label>
                                        <textarea name="treatment" class="w-full border rounded px-3 py-2 h-32 print:border-0">{{ $consultation->treatment }}</textarea>
                                    </div>
                                </section>

                                <!-- Footer Actions -->
                                <div class="flex justify-end gap-4 pt-6 border-t print:hidden">
                                    <button type="button" @click="openConsultationModal = false" 
                                            class="px-6 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                        Cancel
                                    </button>
                                    <button type="submit" 
                                            class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                                        Save
                                    </button>
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
