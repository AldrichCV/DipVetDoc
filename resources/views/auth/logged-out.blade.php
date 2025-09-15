@extends('layouts.app')

@section('content')
<div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-light">
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
