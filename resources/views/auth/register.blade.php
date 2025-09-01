<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Veterinary Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8" 
         x-data="{ 
             loaded: false,
             showElements: false 
         }" 
         x-init="
             setTimeout(() => { loaded = true }, 50);
             setTimeout(() => { showElements = true }, 150);
         ">
        <div class="w-full max-w-md space-y-8">
            <!-- Header -->
            <div class="text-center"
                 x-show="loaded"
                 x-transition:enter="transition ease-out duration-600"
                 x-transition:enter-start="opacity-0 transform -translate-y-6 scale-98"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100">
                <div class="mx-auto h-12 w-12 bg-primary-500 rounded-xl flex items-center justify-center mb-4 transform hover:scale-110 transition-transform duration-200">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8"
                 x-show="showElements"
                 x-transition:enter="transition ease-out duration-700 delay-75"
                 x-transition:enter-start="opacity-0 transform translate-y-6 scale-98"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" 
                      x-data="{
                          showPassword: false,
                          role: '{{ old('role', 'user') }}',
                          showVetFields: {{ old('role') == 'vet' ? 'true' : 'false' }},
                          formVisible: false,
                          togglePassword() {
                              this.showPassword = !this.showPassword;
                          },
                          updateRole(newRole) {
                              this.role = newRole;
                              this.showVetFields = newRole === 'vet';
                          }
                      }" 
                      x-init="setTimeout(() => { formVisible = true }, 250)"
                      novalidate>
                    @csrf

                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[50ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="name" 
                                       name="name" 
                                       type="text" 
                                       value="{{ old('name') }}"
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm @error('name') border-red-300 @enderror"
                                       placeholder="Enter your full name">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[100ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input id="email" 
                                       name="email" 
                                       type="email" 
                                       value="{{ old('email') }}"
                                       required 
                                       autocomplete="username"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm @error('email') border-red-300 @enderror"
                                       placeholder="Enter your email address">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[150ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" 
                                       name="password" 
                                       :type="showPassword ? 'text' : 'password'"
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm @error('password') border-red-300 @enderror"
                                       placeholder="Create a strong password">
                                <button type="button" 
                                        @click="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.641-4.362m3.695-2.132A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.233 5.042M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[200ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password_confirmation" 
                                       name="password_confirmation" 
                                       :type="showPassword ? 'text' : 'password'"
                                       required 
                                       autocomplete="new-password"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm"
                                       placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[250ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Register As
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative">
                                    <input type="radio" 
                                           name="role" 
                                           value="user" 
                                           x-model="role"
                                           @change="updateRole('user')"
                                           {{ old('role', 'user') == 'user' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50 transition-all">
                                        <div class="text-center">
                                            <svg class="h-6 w-6 mx-auto mb-1 text-gray-400 peer-checked:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 peer-checked:text-primary-700">Client</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" 
                                           name="role" 
                                           value="vet" 
                                           x-model="role"
                                           @change="updateRole('vet')"
                                           {{ old('role') == 'vet' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50 transition-all">
                                        <div class="text-center">
                                            <svg class="h-6 w-6 mx-auto mb-1 text-gray-400 peer-checked:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 peer-checked:text-primary-700">Veterinarian</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Vet-specific fields -->
                        <div x-show="showVetFields" 
                             x-transition:enter="transition ease-out duration-400"
                             x-transition:enter-start="opacity-0 transform translate-y-2 scale-98"
                             x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 transform -translate-y-2 scale-98"
                             class="space-y-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            
                            <div class="flex items-center mb-4">
                                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-blue-800">Additional Information Required</span>
                            </div>

                            <!-- License Number -->
                            <div>
                                <label for="license_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Veterinary License Number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <input id="license_number" 
                                           name="license_number" 
                                           type="text" 
                                           value="{{ old('license_number') }}"
                                           :required="showVetFields"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm @error('license_number') border-red-300 @enderror"
                                           placeholder="Enter your veterinary license number">
                                </div>
                                @error('license_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Clinic Name -->
                            <div>
                                <label for="clinic_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Clinic Name
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <input id="clinic_name" 
                                           name="clinic_name" 
                                           type="text" 
                                           value="{{ old('clinic_name') }}"
                                           :required="showVetFields"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors sm:text-sm @error('clinic_name') border-red-300 @enderror"
                                           placeholder="Enter your clinic name">
                                </div>
                                @error('clinic_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start"
                             x-show="formVisible"
                             x-transition:enter="transition ease-out duration-600 delay-[300ms]"
                             x-transition:enter-start="opacity-0 transform translate-y-3"
                             x-transition:enter-end="opacity-100 transform translate-y-0">
                            <div class="flex items-center h-5">
                                <input id="terms" 
                                       name="terms" 
                                       type="checkbox" 
                                       required
                                       {{ old('terms') ? 'checked' : '' }}
                                       class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">
                                    I agree to the 
                                    <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Terms and Conditions</a>
                                    and 
                                    <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                x-show="formVisible"
                                x-transition:enter="transition ease-out duration-600 delay-[350ms]"
                                x-transition:enter-start="opacity-0 transform translate-y-4 scale-98"
                                x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-lg hover:scale-[1.01] active:scale-[0.99]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Create Account
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center"
                 x-show="showElements"
                 x-transition:enter="transition ease-out duration-500 delay-300"
                 x-transition:enter-start="opacity-0 transform translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
                <p class="text-xs text-gray-500">
                    By creating an account, you agree to our terms of service and privacy policy.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
