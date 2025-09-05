@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ __('Consultations') }}
    </h2>
</div>
@endsection

@section('content')
<div class="py-6 sm:py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($consultations->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No consultations found</h3>
                <p class="text-gray-500">Get started by adding your first consultation record.</p>
            </div>
        @else
            {{-- Added search and filter section --}}
            <div x-data="{ 
                searchTerm: '', 
                selectedSpecies: '', 
                selectedVisitRange: '',
                filteredCards: []
            }" 
            x-init="
                filteredCards = Array.from(document.querySelectorAll('.consultation-card'));
                $watch('searchTerm', () => filterCards());
                $watch('selectedSpecies', () => filterCards());
                $watch('selectedVisitRange', () => filterCards());
            "
            x-effect="
                function filterCards() {
                    const cards = document.querySelectorAll('.consultation-card');
                    cards.forEach(card => {
                        const petName = card.dataset.petName.toLowerCase();
                        const ownerName = card.dataset.ownerName.toLowerCase();
                        const species = card.dataset.species.toLowerCase();
                        const breed = card.dataset.breed.toLowerCase();
                        const visitCount = parseInt(card.dataset.visitCount);
                        
                        let showCard = true;
                        
                        // Search filter
                        if (searchTerm) {
                            const search = searchTerm.toLowerCase();
                            showCard = petName.includes(search) || 
                                      ownerName.includes(search) || 
                                      species.includes(search) || 
                                      breed.includes(search);
                        }
                        
                        // Species filter
                        if (selectedSpecies && showCard) {
                            showCard = species === selectedSpecies.toLowerCase();
                        }
                        
                        // Visit count filter
                        if (selectedVisitRange && showCard) {
                            if (selectedVisitRange === '1') {
                                showCard = visitCount === 1;
                            } else if (selectedVisitRange === '2-5') {
                                showCard = visitCount >= 2 && visitCount <= 5;
                            } else if (selectedVisitRange === '6+') {
                                showCard = visitCount >= 6;
                            }
                        }
                        
                        card.style.display = showCard ? 'block' : 'none';
                    });
                }
            ">

                     
                <!-- Search and Filter Bar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
                    <div class="flex flex-col lg:flex-row gap-4">

                 <!-- Species Filter -->
                        <div class="lg:w-48">
                            <label for="species-filter" class="block text-sm font-medium text-gray-700 mb-2">Species</label>
                            <select x-model="selectedSpecies" 
                                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">All Species</option>
                                @php
                                    $allSpecies = $consultations->flatMap(function($petConsultations) {
                                        return $petConsultations->pluck('pet_species');
                                    })->unique()->sort();
                                @endphp
                                @foreach($allSpecies as $species)
                                    <option value="{{ $species }}">{{ $species }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Visit Count Filter -->
                        <div class="lg:w-48">
                            <label for="visit-filter" class="block text-sm font-medium text-gray-700 mb-2">Visit Count</label>
                            <select x-model="selectedVisitRange" 
                                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">All Visits</option>
                                <option value="1">1 Visit</option>
                                <option value="2-5">2-5 Visits</option>
                                <option value="6+">6+ Visits</option>
                            </select>
                        </div>
               
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       x-model="searchTerm"
                                       placeholder="Search by pet name, owner, species, or breed..."
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>

                        <!-- Clear Filters Button -->
                        <div class="lg:w-auto flex items-end">
    <button 
        @click="searchTerm = ''; selectedSpecies = ''; selectedVisitRange = ''" 
        class="relative group px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium"
        type="button">
        
        <i class="fa-solid fa-filter-circle-xmark"></i>

        <!-- Tooltip -->
        <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap shadow-md">
            Clear Filters
        </span>
    </button>
</div>

                    </div>
                </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($consultations as $petId => $petConsultations)
                    @php
                        $firstConsult = $petConsultations->first();
                        $consultationCount = $petConsultations->count();
                        $lastConsultDate = $petConsultations->sortByDesc('created_at')->first()->created_at;
                    @endphp

                    {{-- Added data attributes and consultation-card class for filtering --}}
                    <div x-data="{ 
                            openConsultationModal: false, 
                            selected: null, 
                            mode: 'view',
                            activeTab: 'history'
                         }"
                         class="consultation-card bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden group"
                         data-pet-name="{{ $firstConsult->pet_name }}"
                         data-owner-name="{{ $firstConsult->owner_name }}"
                         data-species="{{ $firstConsult->pet_species }}"
                         data-breed="{{ $firstConsult->pet_breed }}"
                         data-visit-count="{{ $consultationCount }}">

                        <!-- Card Header -->
                        <div class="p-4 sm:p-6 border-b border-gray-100">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        {{ $firstConsult->pet_name }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $firstConsult->pet_species }} • {{ $firstConsult->pet_breed }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0 ml-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $consultationCount }} {{ Str::plural('visit', $consultationCount) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="truncate">{{ $firstConsult->owner_name }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Last visit: {{ \Carbon\Carbon::parse($lastConsultDate)->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="p-4 sm:p-6 bg-gray-50">
                            <button @click="openConsultationModal = true; activeTab = 'history'"
                                    class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                                View Records
                            </button>
                        </div>

                        <!-- Enhanced Modal -->
                        <div x-show="openConsultationModal"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-4 print:static print:bg-transparent print:p-0"
                             x-data
                             x-init="$watch('openConsultationModal', value => {
                                if(value) { document.body.style.overflow = 'hidden'; } 
                                else { document.body.style.overflow = ''; }
                             })">

                            <div class="bg-white rounded-xl shadow-2xl relative w-full max-w-4xl max-h-[90vh] overflow-hidden 
                                        print:w-[210mm] print:h-[297mm] print:shadow-none print:rounded-none print:max-w-none print:max-h-none">

                                <!-- Modal Header -->
                                <div class="flex items-center justify-between p-4 sm:p-6 border-b border-gray-200 print:hidden">
                                    <div>
                                        <h2 class="text-xl font-semibold text-gray-900">{{ $firstConsult->pet_name }}</h2>
                                        <p class="text-sm text-gray-600 mt-1">Medical Records</p>
                                    </div>
                                    <button @click="openConsultationModal = false" 
                                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Tab Navigation -->
                                <div class="border-b border-gray-200 print:hidden">
                                    <nav class="flex px-4 sm:px-6">
                                        <button @click="activeTab = 'info'"
                                                :class="activeTab === 'info' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                class="py-3 px-4 border-b-2 font-medium text-sm transition-colors">
                                            Patient Info
                                        </button>
                                        <button @click="activeTab = 'history'"
                                                :class="activeTab === 'history' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                class="py-3 px-4 border-b-2 font-medium text-sm transition-colors">
                                            Consultation History
                                        </button>
                                        <button @click="activeTab = 'new'; mode = 'new'"
                                                :class="activeTab === 'new' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                class="py-3 px-4 border-b-2 font-medium text-sm transition-colors">
                                            + New Consultation
                                        </button>
                                    </nav>
                                </div>

                                <!-- Modal Content -->
                                <div class="overflow-y-auto flex-1" style="max-height: calc(90vh - 140px);">
                                    
                                    <!-- Patient Information Tab -->
                                    <div x-show="activeTab === 'info'" class="p-4 sm:p-6">
                                        <div class="max-w-2xl">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Patient Information</h3>
                                            
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Pet Name</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ $firstConsult->pet_name }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Species</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ $firstConsult->pet_species }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ $firstConsult->pet_breed }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Sex</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ $firstConsult->pet_sex }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ \Carbon\Carbon::parse($firstConsult->date_of_birth)->format('F d, Y') }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Owner</label>
                                                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                                            {{ $firstConsult->owner_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Consultation History Tab -->
                                    <div x-show="activeTab === 'history'" class="p-4 sm:p-6">
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
                                                                ->format('M j, Y'),
                                                    'full_date' => \Carbon\Carbon::parse($c->created_at)
                                                                ->format('F j, Y g:i A'),
                                                ];
                                            })->sortByDesc('date');
                                        @endphp

                                        @if($petDates->isNotEmpty())
                                            <div class="mb-6">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Consultation History</h3>
                                                
                                                <!-- Date Selection -->
                                                <div class="flex flex-wrap gap-2 mb-6">
                                                    @foreach($petDates as $consultation)
                                                        <button 
                                                            @click="selected = '{{ $consultation['date'] }}'"
                                                            :class="selected === '{{ $consultation['date'] }}'
                                                                ? 'bg-blue-600 text-white shadow-sm' 
                                                                : 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300'"
                                                            class="px-4 py-2 border rounded-lg text-sm font-medium transition-colors">
                                                            {{ $consultation['label'] }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Consultation Details -->
                                            <div class="space-y-6">
                                                @foreach($petConsultations as $c)
                                                    @php
                                                        $cDate = \Carbon\Carbon::parse($c->created_at)
                                                            ->timezone('Asia/Manila')
                                                            ->format('Y-m-d');
                                                    @endphp
                                                    <div x-show="selected === '{{ $cDate }}'" 
                                                         class="bg-white border border-gray-200 rounded-xl p-6 space-y-6">
                                                        
                                                        <!-- Consultation Header -->
                                                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                                                            <h4 class="text-lg font-semibold text-gray-900">
                                                                Consultation Details
                                                            </h4>
                                                            <div class="text-sm text-gray-500">
                                                                {{ \Carbon\Carbon::parse($c->created_at)->format('F j, Y g:i A') }}
                                                            </div>
                                                        </div>

                                                        <!-- Vital Signs -->
                                                        <div>
                                                            <h5 class="text-sm font-semibold text-gray-900 mb-3">Vital Signs</h5>
                                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                                <div class="bg-gray-50 rounded-lg p-3">
                                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Body Weight</label>
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $c->body_weight ? $c->body_weight . ' kg' : 'Not recorded' }}
                                                                    </div>
                                                                </div>
                                                                <div class="bg-gray-50 rounded-lg p-3">
                                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Respiratory Rate</label>
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $c->respiratory_rate ? $c->respiratory_rate . ' bpm' : 'Not recorded' }}
                                                                    </div>
                                                                </div>
                                                                <div class="bg-gray-50 rounded-lg p-3">
                                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Temperature</label>
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $c->temperature ? $c->temperature . '°C' : 'Not recorded' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Clinical Information -->
                                                        <div class="space-y-4">
                                                            <div>
                                                                <label class="block text-sm font-semibold text-gray-900 mb-2">Chief Complaint</label>
                                                                <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]">
                                                                    {{ $c->complaint ?: 'No complaint recorded' }}
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-semibold text-gray-900 mb-2">Medication</label>
                                                                <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]">
                                                                    {{ $c->medication ?: 'No medication recorded' }}
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-semibold text-gray-900 mb-2">Prescription</label>
                                                                <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]">
                                                                    {{ $c->prescription ?: 'No prescription recorded' }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Veterinarian Info -->
                                                        <div class="pt-4 border-t border-gray-100">
                                                            <div class="flex items-center text-sm text-gray-600">
                                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                                </svg>
                                                                <span><strong>Veterinarian:</strong> {{ $c->vet_name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-12">
                                                <div class="mx-auto h-16 w-16 text-gray-300 mb-4">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">No consultation history</h3>
                                                <p class="text-gray-500">Start by adding the first consultation record.</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- New Consultation Tab -->
                                    <div x-show="activeTab === 'new'" class="p-4 sm:p-6">
                                        <div class="max-w-2xl">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-6">New Consultation</h3>
                                            
                                            <form action="{{ route('medical.store') }}" method="POST" class="space-y-6">
                                                @csrf
                                                <input type="hidden" name="pet_id" value="{{ $firstConsult->pet_id }}">

                                                <!-- Vital Signs -->
                                                <div>
                                                    <h4 class="text-sm font-semibold text-gray-900 mb-4">Vital Signs</h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">Body Weight (kg)</label>
                                                            <input type="number" name="body_weight" step="0.01" min="0"
                                                                placeholder="e.g. 5.25"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">Respiratory Rate (bpm)</label>
                                                            <input type="number" name="respiratory_rate" step="1" min="0"
                                                                placeholder="e.g. 30"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">Temperature (°C)</label>
                                                            <input type="number" name="temperature" step="0.1" min="20" max="45"
                                                                placeholder="e.g. 38.5"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Clinical Information -->
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Chief Complaint</label>
                                                        <textarea name="complaint" rows="3"
                                                            placeholder="Describe the main reason for this visit..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Medication</label>
                                                        <textarea name="medication" rows="3"
                                                            placeholder="List medications administered or prescribed..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Prescription & Instructions</label>
                                                        <textarea name="prescription" rows="3"
                                                            placeholder="Provide detailed prescription and care instructions..."
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Form Actions -->
                                                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                                                    <button type="button" @click="activeTab = 'history'" 
                                                        class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium">
                                                        Cancel
                                                    </button>
                                                    <button type="submit"
                                                        class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors font-medium">
                                                        Save Consultation
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="border-t border-gray-200 p-4 sm:p-6 bg-gray-50 print:hidden">
                                    <div class="flex flex-col sm:flex-row justify-between gap-3">
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium">{{ $consultationCount }}</span> total consultations
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('consultations.download', $firstConsult->pet_id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        @endif
    </div>
</div>
@endsection
