<!-- Extends the application layout (includes navigation, styling, etc.) -->
<x-app-layout>
    
    <!-- Slot for setting the page header title -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Profile</h2>
    </x-slot>

    <!-- Main content area -->
    <div class="p-6">
        <!-- Form to update the user's profile -->
        <form method="POST" action="{{ route('profile.update') }}">
            <!-- CSRF token for security -->
            @csrf

            <!-- Input field for user's name -->
            <div>
                <label>Name</label>
                <!-- `old()` keeps previous input on validation error; fallback is the current user name -->
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border p-2 w-full">
            </div>

            <!-- Input field for user's email -->
            <div>
                <label>Email</label>
                <!-- `old()` keeps previous input on validation error; fallback is the current user email -->
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full">
            </div>

            <!-- Submit button to save the updated info -->
            <button class="bg-blue-500 text-white p-2 mt-3">Save</button>
        </form>
    </div>
</x-app-layout>
