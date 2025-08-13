<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div class="mb-4 text-green-600 font-semibold">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto w-full">
                        <table class="w-full border border-gray-200 table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border text-left">ID</th>
                                    <th class="px-4 py-2 border text-left">Name</th>
                                    <th class="px-4 py-2 border text-left">Email</th>
                                    <th class="px-4 py-2 border text-left">Role</th>
                                    <th class="px-4 py-2 border text-left">Created At</th>
                                    <th class="px-4 py-2 border text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <span class="inline-block text-xs font-semibold rounded-full px-3 py-1
                                                {{ $user->role === 'vet'
                                                    ? 'bg-blue-600 text-white'
                                                    : 'bg-blue-100 text-blue-800'
                                                }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-2 border">{{ $user->created_at->format('M d, Y') }}</td>
                                      <td class="px-4 py-2 border text-center">
                                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                            {{ ($user->status ?? '') === 'approved' 
                                                ? 'bg-green-100 text-green-700' 
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ $user->status ?? 'N/A' }}
                                        </span>
                                    </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 text-center border">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination if you have it --}}
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
