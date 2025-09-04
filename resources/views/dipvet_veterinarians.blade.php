<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('The Vet Team') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    {{ $pendingVets->count() }} Pending
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ $approvedVets->count() }} Approved
                </span>
            </div>
        </div>
    </x-slot>

    <div x-data="vetTeamManager()" class="py-6 space-y-8">
        {{-- Pending Vets Section --}}
        @if(!$pendingVets->isEmpty())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl shadow-sm border border-yellow-200 overflow-hidden">
                <div class="px-6 py-4 bg-yellow-100 border-b border-yellow-200">
                    <h3 class="text-lg font-semibold text-yellow-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Pending Approval ({{ $pendingVets->count() }})
                    </h3>
                    <p class="text-sm text-yellow-700 mt-1">Review and approve new team member requests</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach ($pendingVets as $vet)
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                            <div class="p-5">
                                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-gray-100 rounded-full">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 text-center mb-3">{{ $vet->name }}</h4>
                                <div class="space-y-2 text-sm">
                                    
                                    <div class="flex justify-center mt-4">
                                        <button 
                                            @click="selectSpecialization('{{ $vet->id }}')"
                                            :disabled="loading"
                                            class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 disabled:bg-yellow-400 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                            <svg x-show="!loading" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <svg x-show="loading" class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span x-text="loading ? 'Processing...' : 'Review'"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Approved Vets Section --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Acitve Team Members ({{ $approvedVets->count() }})
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Manage your active veterinary team</p>
                </div>
                <div class="p-6">
                    @if ($approvedVets->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No approved staff</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by approving pending team members.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @foreach ($approvedVets as $vet)
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col">
        <div class="p-5 flex flex-col flex-1">
            
            <!-- Icon -->
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 bg-green-100 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>

            <!-- Name -->
            <h4 class="text-lg font-semibold text-gray-900 text-center">{{ $vet->name }}</h4>

            <!-- Specialization -->
            <p class="text-sm text-gray-600 text-center mt-2 mb-4">
                {{ $vet->specialization ?? 'N/A' }}
            </p>

            <!-- Status Button -->
            <div class="flex justify-center mt-auto">
                <button 
                    @click="toggleActive('{{ $vet->id }}', {{ ($vet->is_active === 'Active') ? 1 : 0 }})"
                    :disabled="loading"
                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2
                        {{ ($vet->is_active === 'Active') 
                            ? 'bg-green-100 text-green-800 hover:bg-green-200 focus:ring-green-500' 
                            : 'bg-red-100 text-red-800 hover:bg-red-200 focus:ring-red-500' }}">
                    <div class="w-2 h-2 rounded-full mr-2 {{ ($vet->is_active === 'Active') ? 'bg-blue-400' : 'bg-red-400' }}"></div>
                    {{ $vet->is_active === 'Active' ? 'Active' : 'Inactive' }}
                </button>
            </div>

        </div>
    </div>
    @endforeach
</div>


                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function vetTeamManager() {
            return {
                loading: false,
                
                async selectSpecialization(vetId) {
                    try {
                        // First confirmation
                        const confirmResult = await Swal.fire({
                            title: 'Accept Request Access?',
                            text: "Do you want to grant authorization to this person?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, proceed',
                            cancelButtonText: 'No, cancel',
                            confirmButtonColor: '#059669',
                            cancelButtonColor: '#dc2626'
                        });

                        if (!confirmResult.isConfirmed) return;

                        // Specialization selection
                        const specializationResult = await Swal.fire({
                            title: 'Select Specialization',
                            html: `
                                <div class="text-left">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Choose a specialization:</label>
                                    <select id="specialization" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Select Specialization --</option>
                                        <option value="Veterinarian">Veterinarian</option>
                                        <option value="Veterinary Technician">Veterinary Technician</option>
                                        <option value="Veterinary Nurse">Veterinary Nurse</option>
                                        <option value="Secretary">Secretary</option>
                                        <option value="Senior Handler">Senior Handler</option>
                                        <option value="Groomer">Groomer</option>
                                        <option value="Junior Handler">Junior Handler</option>
                                        <option value="Utility Worker">Utility Worker</option>
                                    </select>
                                </div>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Save & Approve',
                            cancelButtonText: 'Cancel',
                            confirmButtonColor: '#059669',
                            cancelButtonColor: '#6b7280',
                            preConfirm: () => {
                                const specialization = document.getElementById('specialization').value;
                                if (!specialization) {
                                    Swal.showValidationMessage('Please select a specialization');
                                    return false;
                                }
                                return { specialization };
                            }
                        });

                        if (!specializationResult.isConfirmed) return;

                        this.loading = true;

                        const response = await fetch(`/vets/${vetId}/specialization`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                specialization: specializationResult.value.specialization,
                                approve: true
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            await Swal.fire({
                                title: 'Success!',
                                text: 'Team member has been approved and specialization saved.',
                                icon: 'success',
                                confirmButtonColor: '#059669'
                            });
                            location.reload();
                        } else {
                            throw new Error(data.error || 'Something went wrong');
                        }
                    } catch (error) {
                        await Swal.fire({
                            title: 'Error',
                            text: error.message || 'Unable to update specialization.',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    } finally {
                        this.loading = false;
                    }
                },

                async toggleActive(vetId, currentStatus) {
                    const newStatus = currentStatus === 1 ? 0 : 1;
                    const statusText = newStatus === 1 ? 'activate' : 'deactivate';

                    try {
                        const result = await Swal.fire({
                            title: 'Are you sure?',
                            text: `Do you want to ${statusText} this team member?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, confirm',
                            cancelButtonText: 'Cancel',
                            confirmButtonColor: newStatus === 1 ? '#059669' : '#dc2626',
                            cancelButtonColor: '#6b7280'
                        });

                        if (!result.isConfirmed) return;

                        this.loading = true;

                        const response = await fetch(`/vets/${vetId}/toggle-active`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ is_active: newStatus })
                        });

                        const data = await response.json();

                        if (data.success) {
                            await Swal.fire({
                                title: 'Updated!',
                                text: 'Team member status has been updated.',
                                icon: 'success',
                                confirmButtonColor: '#059669'
                            });
                            location.reload();
                        } else {
                            throw new Error(data.error || 'Failed to update status');
                        }
                    } catch (error) {
                        await Swal.fire({
                            title: 'Error',
                            text: error.message || 'Failed to update status.',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>