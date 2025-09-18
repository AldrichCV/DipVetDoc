@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">My Product Requests</h1>

    @if(session('success'))
      <div class="mb-3 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="space-y-3">
        @forelse($requests as $r)
            <div class="p-3 border rounded">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-bold">{{ $r->product->name }} ({{ $r->product->sku }})</div>
                        <div>Qty: {{ $r->quantity }} — Total: ₱{{ number_format($r->total_price,2) }}</div>
                        <div class="text-sm text-gray-600">Requested: {{ $r->created_at->format('M d, Y H:i') }}</div>
                        @if($r->reserve_code)
                          <div class="text-sm">Reserve code: <span class="font-mono">{{ $r->reserve_code }}</span></div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="capitalize">{{ $r->status }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div>No requests yet.</div>
        @endforelse
    </div>
</div>
@endsection
