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
                    @foreach ($consultations as $petId => $petConsultations)
                        @php
                            $firstConsult = $petConsultations->first();
                            $dates = $petConsultations->map(function ($c) {
                                return \Carbon\Carbon::parse($c->created_at)
                                    ->timezone('Asia/Manila')
                                    ->format('Y-m-d');
                            })->unique();
                        @endphp

                        <div x-data="{ openConsultationModal: false, selected: null, mode: 'view' }"
                             class="bg-white border rounded-lg p-6 shadow hover:shadow-md transition flex flex-col justify-between">

                            <!-- Pet & Owner -->
                            <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">
                                {{ $firstConsult->pet_name }}
                            </h3>
                            <p class="text-gray-600 text-sm text-center">
                                <strong>Owner:</strong> {{ $firstConsult->owner_name }}
                            </p>

                            <!-- Open Modal Button -->
                            <button @click="openConsultationModal = true"
                                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                View
                            </button>

                            <!-- Modal -->
                            <div x-show="openConsultationModal"
                                 x-transition.opacity
                                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 print:static print:bg-transparent"
                                 x-data
                                 x-init="$watch('openConsultationModal', value => {
                                    if(value) { document.body.style.overflow = 'hidden'; } 
                                    else { document.body.style.overflow = ''; }
                                 })">

                                <div class="bg-white rounded-lg shadow-2xl relative w-[794px] h-[1123px] max-w-full max-h-[95vh] overflow-y-auto 
                                            print:w-[210mm] print:h-[297mm] print:shadow-none print:rounded-none">

                                    <!-- Close button -->
                                    <button @click="openConsultationModal = false" 
                                            class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 text-2xl print:hidden">
                                        ✕
                                    </button>

                                    <!-- Content wrapper -->
                                    <div class="p-12">
                                        <!-- Header -->
                                        <div class="text-center mb-10 border-b pb-4">
                                            <h1 class="text-3xl font-bold uppercase">Consultation Record</h1>
                                            <p class="text-gray-600">Dipolog Veterinary Doctor</p>
                                        </div>

                                        <!-- Sections Wrapper -->
                                        <div class="space-y-10">
                                            
                                            <!-- Patient Info -->
                                            <section>
                                                <h2 class="text-lg font-semibold mb-3 border-b pb-2">Patient Information</h2>
                                                <div class="grid grid-cols-2 gap-6">
                                                    <div>
                                                        <label class="block text-sm font-medium">Pet Name</label>
                                                        <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                            value="{{ $firstConsult->pet_name }}" readonly>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Species</label>
                                                        <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                            value="{{ $firstConsult->pet_species }}" readonly>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Breed</label>
                                                        <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                            value="{{ $firstConsult->pet_breed }}" readonly>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Sex</label>
                                                        <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                            value="{{ $firstConsult->pet_sex }}" readonly>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium">Date of Birth</label>
                                                        <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                            value="{{ \Carbon\Carbon::parse($firstConsult->date_of_birth)->format('F d, Y') }}" readonly>
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- Owner Info -->
                                            <section>
                                                <h2 class="text-lg font-semibold mb-3 border-b pb-2">Owner Information</h2>
                                                <input type="text" class="w-full border-b px-2 py-1 bg-gray-100" 
                                                    value="{{ $firstConsult->owner_name }}" readonly>
                                            </section>

                                            <!-- Consultation History -->
                                            <section class="flex flex-col h-full">
                                                <h2 class="text-lg font-semibold mb-3 border-b pb-2">Previous Consultations</h2>

                                                <!-- Date buttons -->
                                                @php
                                                    $realConsultations = $petConsultations->filter(function ($c) {
                                                        return !empty($c->consultation_id);
                                                    });

                                                    $petDates = $realConsultations->map(function ($c) {
                                                        return [
                                                            'id' => $c->consultation_id,
                                                            'date' => \Carbon\Carbon::parse($c->created_at)
                                                                        ->timezone('Asia/Manila')
                                                                        ->format('Y-m-d'),
                                                            'label' => \Carbon\Carbon::parse($c->created_at)
                                                                        ->format('F j, Y'),
                                                        ];
                                                    })->sortByDesc('date');
                                                @endphp

                                                @if($petDates->isNotEmpty())
                                                    <div class="flex flex-wrap gap-2 mb-4 justify-start">
                                                        @foreach($petDates as $consultation)
                                                            <button 
                                                                @click="selected = '{{ $consultation['date'] }}'; mode = 'view'"
                                                                :class="selected === '{{ $consultation['date'] }}' && mode === 'view'
                                                                    ? 'bg-blue-600 text-white' 
                                                                    : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                                                                class="px-3 py-1 rounded-lg text-sm transition">
                                                                {{ $consultation['label'] }}
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Details Wrapper (consistent layout) -->
                                                <div class="mt-6 flex-1 overflow-y-auto space-y-6">
                                                    <!-- View Mode -->
                                                    <template x-if="mode === 'view'">
                                                        <div>
                                                            @foreach($petConsultations as $c)
                                                                @php
                                                                    $cDate = \Carbon\Carbon::parse($c->created_at)
                                                                        ->timezone('Asia/Manila')
                                                                        ->format('Y-m-d');
                                                                @endphp
                                                                <div x-show="selected === '{{ $cDate }}'" class="border p-4 rounded-lg space-y-4">
                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label class="block text-sm font-medium">Body Weight</label>
                                                                            <input type="text" class="w-full border px-2 py-1 bg-gray-50" value="{{ $c->body_weight ?? 'N/A' }}" readonly>
                                                                        </div>
                                                                        <div>
                                                                            <label class="block text-sm font-medium">Respiratory Rate</label>
                                                                            <input type="text" class="w-full border px-2 py-1 bg-gray-50" value="{{ $c->respiratory_rate ?? 'N/A' }}" readonly>
                                                                        </div>
                                                                        <div>
                                                                            <label class="block text-sm font-medium">Temperature</label>
                                                                            <input type="text" class="w-full border px-2 py-1 bg-gray-50" value="{{ $c->temperature ?? 'N/A' }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Complaint</label>
                                                                        <textarea readonly class="w-full border rounded px-3 py-2 h-20 bg-gray-50">{{ $c->complaint ?? 'N/A' }}</textarea>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Medication</label>
                                                                        <textarea readonly class="w-full border rounded px-3 py-2 h-20 bg-gray-50">{{ $c->medication ?? 'N/A' }}</textarea>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Prescription</label>
                                                                        <textarea readonly class="w-full border rounded px-3 py-2 h-20 bg-gray-50">{{ $c->prescription ?? 'N/A' }}</textarea>
                                                                    </div>
                                                                    <div class="text-sm text-gray-600">
                                                                        <p><strong>Vet:</strong> {{ $c->vet_name }}</p>
                                                                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($c->created_at)->format('F j, Y g:i A') }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </template>

                                                    <!-- New Consultation Form -->
                                                    <template x-if="mode === 'new'">
                                                        <div class="border p-4 rounded-lg space-y-4">
                                                            <form action="{{ route('medical.store') }}" method="POST" class="space-y-4">
                                                                @csrf
                                                                <input type="hidden" name="pet_id" value="{{ $firstConsult->pet_id }}">

                                                                <div class="grid grid-cols-2 gap-4">
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Body Weight (kg)</label>
                                                                        <input type="number" name="body_weight" step="0.01" min="0"
                                                                            placeholder="e.g. 5.25"
                                                                            class="w-full border px-2 py-1 rounded">
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Respiratory Rate (breaths/min)</label>
                                                                        <input type="number" name="respiratory_rate" step="1" min="0"
                                                                            placeholder="e.g. 30"
                                                                            class="w-full border px-2 py-1 rounded">
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium">Temperature (°C)</label>
                                                                        <input type="number" name="temperature" step="0.1" min="20" max="45"
                                                                            placeholder="e.g. 38.5"
                                                                            class="w-full border px-2 py-1 rounded">
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label class="block text-sm font-medium">Complaint</label>
                                                                    <textarea name="complaint" class="w-full border rounded px-3 py-2 h-20"></textarea>
                                                                </div>
                                                                <div>
                                                                    <label class="block text-sm font-medium">Medication</label>
                                                                    <textarea name="medication" class="w-full border rounded px-3 py-2 h-20"></textarea>
                                                                </div>
                                                                <div>
                                                                    <label class="block text-sm font-medium">Prescription</label>
                                                                    <textarea name="prescription" class="w-full border rounded px-3 py-2 h-20"></textarea>
                                                                </div>

                                                                <div class="flex justify-end gap-2">
                                                                    <button type="button" @click="mode = 'view'" 
                                                                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- Footer actions -->
                                                <div class="mt-8 border-t pt-6 flex justify-end gap-2">
                                                    <button type="button"
                                                        @click="mode = 'new'"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                        + New Consultation
                                                    </button>

                                                    <a href="{{ route('consultations.download', $firstConsult->pet_id) }}"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                                        Download
                                                    </a>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
