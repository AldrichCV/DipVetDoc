<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Keep this verification form outside the main form. The email resend button references this form via `form="send-verification"` --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- 2-column grid for fields (Name + Email on top row) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email --}}
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-1">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- First Name --}}
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text"
                    class="mt-1 block w-full @if(empty($user->first_name)) border-red-500 @endif"
                    :value="old('first_name', $user->first_name)" autocomplete="given-name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                @if (empty($user->first_name))
                    <p class="text-xs text-red-500 mt-1">* Required for appointments</p>
                @endif
            </div>

            {{-- Middle Name --}}
            <div>
                <x-input-label for="middle_name" :value="__('Middle Name')" />
                <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full"
                    :value="old('middle_name', $user->middle_name)" />
                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
            </div>

            {{-- Last Name --}}
            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text"
                    class="mt-1 block w-full @if(empty($user->last_name)) border-red-500 @endif"
                    :value="old('last_name', $user->last_name)" autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                @if (empty($user->last_name))
                    <p class="text-xs text-red-500 mt-1">* Required for appointments</p>
                @endif
            </div>

            {{-- Contact Number --}}
            <div>
                <x-input-label for="contact_number" :value="__('Contact Number')" />
                <x-text-input id="contact_number" name="contact_number" type="text"
                    class="mt-1 block w-full @if(empty($user->contact_number)) border-red-500 @endif"
                    :value="old('contact_number', $user->contact_number)" autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                @if (empty($user->contact_number))
                    <p class="text-xs text-red-500 mt-1">* Required for appointments</p>
                @endif
            </div>
        </div>

        {{-- Address (full width) --}}
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @if(empty($user->address)) border-red-500 @endif">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
            @if (empty($user->address))
                <p class="text-xs text-red-500 mt-1">* Required for appointments</p>
            @endif
        </div>

        {{-- Save button --}} 
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>

    {{-- Profile completeness notice --}}
    @php
        $profileIncomplete = empty($user->first_name)
            || empty($user->last_name)
            || empty($user->contact_number)
            || empty($user->address);
    @endphp

    @if ($profileIncomplete)
        <div class="mt-6 p-4 bg-yellow-100 border border-yellow-300 rounded-md">
            <p class="text-sm text-yellow-800 font-medium">
                ⚠️ Your profile is incomplete.  
                Please fill in all required fields (First name, Last name, Contact number, Address) to schedule an appointment.
            </p>
        </div>
    @else
        <div class="mt-6 p-4 bg-green-100 border border-green-300 rounded-md">
            <p class="text-sm text-green-800 font-medium">
                ✅ Your profile is complete. You can now schedule appointments.
            </p>
        </div>
    @endif
</section>
