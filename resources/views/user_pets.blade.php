<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('My Pets') }}
            </h2>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                    {{ $pets->count() }} {{ Str::plural('pet', $pets->count()) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12" x-data="petManager()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input 
                                type="text" 
                                x-model="searchQuery"
                                placeholder="Search pets by name, species, or breed..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            >
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select x-model="filterSpecies" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[120px]">
                            <option value="">All Species</option>
                            <option value="dog">Dogs</option>
                            <option value="cat">Cats</option>
                            <option value="bird">Birds</option>
                            <option value="fish">Fish</option>
                            <option value="rabbit">Rabbits</option>
                        </select>
                        <select x-model="sortBy" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-w-[120px]">
                            <option value="name">Sort by Name</option>
                            <option value="species">Sort by Species</option>
                            <option value="age">Sort by Age</option>
                        </select>
                    </div>
                </div>
            </div>

            @if ($pets->isEmpty())
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No pets in your collection</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Your pet collection is currently empty. Pets will appear here once they are added to your account.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" x-show="filteredPets.length > 0">
                    @foreach ($pets as $pet)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-gray-300 transition-all duration-300 overflow-hidden group"
                             x-show="petMatchesFilter({{ json_encode($pet) }})"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100">
                            
                            <div class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 aspect-square">
                                <img
                                    src="{{ asset('images/pets/' . ($pet->pet_code ?? 'default') . '.jpg') }}"
                                    alt="{{ $pet->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    onerror="this.src='{{ asset('images/pets/default.jpg') }}'"
                                >
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-2.5 py-1 bg-white/90 backdrop-blur-sm text-xs font-semibold text-gray-700 rounded-full shadow-sm">
                                        {{ $pet->pet_code }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="mb-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $pet->name }}</h3>
                                    <p class="text-sm text-gray-600 capitalize">{{ $pet->species ?? 'Unknown' }} • {{ $pet->breed ?? 'Mixed' }}</p>
                                </div>

                                <div class="space-y-2 mb-5">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="capitalize">{{ $pet->sex ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <span>
                                            @if($pet->date_of_birth)
                                                {{ \Carbon\Carbon::parse($pet->date_of_birth)->age }} years old
                                            @else
                                                Age unknown
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($pet->date_of_birth)->format('M d, Y') ?? 'Unknown' }}</span>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('pets.edit', $pet->pet_code) }}"
                                       class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-medium rounded-lg transition-colors duration-200 border border-emerald-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    <button 
                                        @click="confirmDelete('{{ $pet->name }}', '{{ route('pets.destroy', $pet->pet_code) }}')"
                                        class="inline-flex items-center justify-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200 border border-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div x-show="filteredPets.length === 0" class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No pets found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your search or filter criteria.</p>
                    <button @click="clearFilters()" class="text-blue-600 hover:text-blue-700 font-medium">Clear all filters</button>
                </div>
            @endif
        </div>

        <div x-show="showDeleteModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div x-show="showDeleteModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 @click.away="showDeleteModal = false"
                 class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Remove Pet</h3>
                        <p class="text-sm text-gray-600">This action cannot be undone.</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-6">Are you sure you want to remove <strong x-text="petToDelete"></strong> from your pets?</p>
                <div class="flex gap-3 justify-end">
                    <button @click="showDeleteModal = false" 
                            class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                    <button @click="deletePet()" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200">
                        Remove Pet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function petManager() {
            return {
                searchQuery: '',
                filterSpecies: '',
                sortBy: 'name',
                showDeleteModal: false,
                petToDelete: '',
                deleteUrl: '',
                pets: @json($pets),

                get filteredPets() {
                    let filtered = this.pets.filter(pet => {
                        const matchesSearch = !this.searchQuery || 
                            pet.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            (pet.species && pet.species.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                            (pet.breed && pet.breed.toLowerCase().includes(this.searchQuery.toLowerCase()));
                        
                        const matchesSpecies = !this.filterSpecies || 
                            (pet.species && pet.species.toLowerCase() === this.filterSpecies.toLowerCase());
                        
                        return matchesSearch && matchesSpecies;
                    });

                    return filtered.sort((a, b) => {
                        switch (this.sortBy) {
                            case 'name':
                                return a.name.localeCompare(b.name);
                            case 'species':
                                return (a.species || '').localeCompare(b.species || '');
                            case 'age':
                                const ageA = a.date_of_birth ? new Date().getFullYear() - new Date(a.date_of_birth).getFullYear() : 0;
                                const ageB = b.date_of_birth ? new Date().getFullYear() - new Date(b.date_of_birth).getFullYear() : 0;
                                return ageA - ageB;
                            default:
                                return 0;
                        }
                    });
                },

                petMatchesFilter(pet) {
                    const matchesSearch = !this.searchQuery || 
                        pet.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        (pet.species && pet.species.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                        (pet.breed && pet.breed.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    const matchesSpecies = !this.filterSpecies || 
                        (pet.species && pet.species.toLowerCase() === this.filterSpecies.toLowerCase());
                    
                    return matchesSearch && matchesSpecies;
                },

                confirmDelete(petName, url) {
                    this.petToDelete = petName;
                    this.deleteUrl = url;
                    this.showDeleteModal = true;
                },

                async deletePet() {
                    try {
                        const response = await fetch(this.deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        });

                        if (response.ok) {
                            this.pets = this.pets.filter(pet => pet.name !== this.petToDelete);
                            this.showDeleteModal = false;
                            this.showNotification('Pet removed successfully', 'success');
                        } else {
                            throw new Error('Failed to delete pet');
                        }
                    } catch (error) {
                        console.error('Error deleting pet:', error);
                        this.showNotification('Failed to remove pet', 'error');
                    }
                },

                clearFilters() {
                    this.searchQuery = '';
                    this.filterSpecies = '';
                    this.sortBy = 'name';
                },

                showNotification(message, type) {
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
                    notification.textContent = message;
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }
            }
        }
    </script>
</x-app-layout>
