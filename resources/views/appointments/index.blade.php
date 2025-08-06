<x-app-layout>
    {{-- Page header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Appointments</h2>
    </x-slot>

    {{-- Main content wrapper --}}
    <div class="p-6">
        <div class="overflow-x-auto">
            {{-- Appointments table --}}
            <table class="min-w-full bg-white border border-gray-200 rounded shadow">
                {{-- Table Header --}}
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-2 border-b">Pet Name</th>
                        <th class="px-4 py-2 border-b">Service</th>
                        <th class="px-4 py-2 border-b">Date</th>
                        <th class="px-4 py-2 border-b">Time</th>
                        <th class="px-4 py-2 border-b">Status</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody>
                    {{-- Loop through each appointment --}}
                    @forelse($appointments as $appointment)
                        <tr class="border-t hover:bg-gray-50">
                            {{-- Display pet name --}}
                            <td class="px-4 py-2">{{ $appointment->pet_name }}</td>

                            {{-- Display service type --}}
                            <td class="px-4 py-2">{{ $appointment->service }}</td>

                            {{-- Format and display appointment date --}}
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </td>

                            {{-- Format and display appointment time --}}
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </td>

                            {{-- Display status with color-coded badge --}}
                            <td class="px-4 py-2">
                                @php
                                    // Define color classes for different statuses
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                    ];

                                    // Normalize status string
                                    $status = strtolower($appointment->status);

                                    // Get badge class based on status or use default gray
                                    $badgeClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                @endphp

                                {{-- Status badge --}}
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        {{-- If no appointments exist --}}
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                No appointments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
