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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                                        <td class="px-4 py-2 border">
                                            <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" onchange="this.form.submit()"
                                                    class="cursor-pointer text-xs font-semibold rounded-full px-3 py-1 w-auto
                                                    border border-blue-600
                                                    focus:outline-none focus:ring-2 focus:ring-blue-400
                                                    {{ $user->role === 'staff'
                                                        ? 'bg-blue-600 text-white'
                                                        : 'bg-blue-100 text-blue-800'
                                                    }}"
                                                    style="appearance:none; -webkit-appearance:none; -moz-appearance:none; padding-right: 1.8rem; min-width: 70px; background-image: url('data:image/svg+xml;charset=US-ASCII,<svg fill=\'%234A90E2\' height=\'8\' viewBox=\'0 0 24 24\' width=\'8\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 0.65rem auto;">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                                </select>
                                             </form>
                                        </td>
                                        <td class="px-4 py-2 border">{{ $user->created_at->format('Y-m-d') }}</td>
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
