@extends('layouts.app') {{-- Or your master layout --}}

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow p-5">
        <h2 class="text-center text-danger">You are logged out</h2>
        <p class="text-center text-muted">Your session has ended. Please log in again to continue.</p>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary">Go to Login</a>
        </div>
    </div>
</div>
@endsection
@if(isset($initiator) && $initiator)
<script>
    // This tab triggered logout → go straight to login
    localStorage.setItem("forceLogoutOthers", Date.now());
    window.location.href = "{{ route('login') }}";
</script>
@else
<script>
    // Just a safety check in case this page loads without being the initiator
    window.addEventListener("storage", (event) => {
        if (event.key === "forceLogoutOthers") {
            window.location.href = "{{ route('logged-out') }}";
        }
    });
</script>
@endif

