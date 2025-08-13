<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('The Vet Team') }}
        </h2>
    </x-slot>

  {{-- Pending --}}
@if(!$pendingVets->isEmpty())
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($pendingVets as $vet)
                    <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">
                            {{ $vet->name }}
                        </h3>
                        <ul class="text-gray-600 text-sm space-y-1 text-center">
                            <li><strong>Role:</strong> {{ $vet->role ?? 'N/A' }}</li>
                            <li>
                                <span onclick="selectSpecialization('{{ $vet->id }}')"
                                    class="cursor-pointer inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700 hover:bg-red-200">
                                    {{ $vet->status ?? 'N/A' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif


{{-- Approved --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if ($approvedVets->isEmpty())
                <p class="text-center text-gray-500 text-lg italic">No approved staff found.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($approvedVets as $vet)
                        <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 text-center">
                                {{ $vet->name }}
                            </h3>
                            <ul class="text-gray-600 text-sm space-y-1 text-center">
                                <li><strong>Role:</strong> {{ $vet->specialization ?? 'N/A' }}</li>
                              <li>
                                <span
                                    onclick="toggleActive('{{ $vet->id }}', {{ ($vet->is_active === 'Active') ? 1 : 0 }})"
                                    class="cursor-pointer inline-block px-3 py-1 text-sm font-semibold rounded-full
                                        {{ ($vet->is_active === 'Active') 
                                            ? 'bg-green-100 text-green-700 hover:bg-green-200' 
                                            : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                    {{ $vet->is_active === 'Active' ? 'Active' : 'Inactive' }}
                                </span>
                              </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


 @push('scripts')
<script>
function selectSpecialization(vetId) {
    // First confirmation prompt
    Swal.fire({
        title: 'Accept request access?',
        text: "Do you want to grant authorization to this person?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed',
        cancelButtonText: 'No, cancel'
    }).then((confirmResult) => {
        if (confirmResult.isConfirmed) {
            // Specialization selection prompt
            Swal.fire({
                title: 'Select Specialization',
                html: `
                    <select id="specialization" class="swal2-select">
                        <option value="">-- Select --</option>
                        <option value="Veterinarian">Veterinarian</option>
                        <option value="Veterinary Technician">Veterinary Technician</option>
                        <option value="Veterinary Nurse">Veterinary Nurse</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Senior Handler">Senior Handler</option>
                        <option value="Groomer">Groomer</option>
                        <option value="Junior Handler">Junior Handler</option>
                        <option value="Utility Worker">Utility Worker</option>
                    </select>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    const specialization = Swal.getPopup().querySelector('#specialization').value;
                    if (!specialization) {
                        Swal.showValidationMessage(`Please select a specialization`);
                    }
                    return { specialization: specialization };
                }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/vets/${vetId}/specialization`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                specialization: result.value.specialization,
                                approve: true // tells backend to update status to approved
                            })
                        })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Updated!', 'Specialization has been saved.', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Unable to update specialization.', 'error');
                    });
                }
            });
        }
    });
}

function toggleActive(vetId, currentStatus) {
    const newStatus = currentStatus === 1 ? 0 : 1;
    const statusText = newStatus === 1 ? 'activate' : 'deactivate';

    Swal.fire({
        title: `Are you sure?`,
        text: `Do you want to ${statusText} this vet?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/vets/${vetId}/toggle-active`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ is_active: newStatus }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Updated!', 'Vet status has been updated.', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error', data.error || 'Failed to update status.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Failed to update status.', 'error');
            });
        }
    });
}

</script>
@endpush

</x-app-layout>
