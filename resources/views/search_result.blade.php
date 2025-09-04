{{-- resources/views/search/results.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                
                @if($results->isEmpty())
                    <p class="text-gray-500">No results found for 
                        <span class="font-semibold">"{{ request('q') }}"</span>.
                    </p>
                @else
                    <p class="mb-4 text-gray-600">
                        Showing <span class="font-semibold">{{ $results->count() }}</span> result(s) for 
                        <span class="font-semibold">"{{ request('q') }}"</span>.
                    </p>

                    <ul class="space-y-4">
                        @foreach($results as $item)
                            <li class="border-b border-gray-200 pb-4">
                                <h3 class="text-lg font-semibold text-blue-600">
                                    {{ $item->title ?? $item->name ?? 'Untitled' }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ $item->description ?? Str::limit($item->content ?? '', 120) }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
