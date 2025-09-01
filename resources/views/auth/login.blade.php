<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4" 
      x-data="{ 
          loaded: false, 
          showForm: false, 
          showHeader: false, 
          showFields: false, 
          showSocial: false,
          showImage: false 
      }"
      x-init="
          setTimeout(() => loaded = true, 100);
          setTimeout(() => showImage = true, 200);
          setTimeout(() => showForm = true, 400);
          setTimeout(() => showHeader = true, 600);
          setTimeout(() => showFields = true, 800);
          setTimeout(() => showSocial = true, 1000);
      ">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden"
         x-show="loaded"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        <div class="flex flex-col lg:flex-row min-h-[600px]">
            <div class="flex-1 p-8 lg:p-12 flex flex-col justify-center"
                 x-show="showForm"
                 x-transition:enter="transition ease-out duration-600 delay-200"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center mb-8"
                         x-show="showHeader"
                         x-transition:enter="transition ease-out duration-500 delay-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Welcome back</h1>
                        <p class="text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium transition-colors">
                                Sign up for free
                            </a>
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg"
                             x-show="showFields"
                             x-transition:enter="transition ease-out duration-400 delay-500"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            <p class="text-green-800 text-sm">{{ session('status') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg"
                             x-show="showFields"
                             x-transition:enter="transition ease-out duration-400 delay-500"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            <ul class="text-red-800 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 001.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-6"
                          x-show="showFields"
                          x-transition:enter="transition ease-out duration-500 delay-400"
                          x-transition:enter-start="opacity-0 translate-y-4"
                          x-transition:enter-end="opacity-100 translate-y-0"
                          x-data="{ 
                              emailFocused: false, 
                              passwordFocused: false,
                              isSubmitting: false 
                          }"
                          @submit="isSubmitting = true">
                        @csrf

                        <div x-show="showFields"
                            x-transition:enter="transition ease-out duration-400 delay-500"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0">

                            <!-- Animate label -->
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2"
                                x-show="showFields"
                                x-transition:enter="transition ease-out duration-400 delay-500"
                                x-transition:enter-start="opacity-0 translate-x-4"
                                x-transition:enter-end="opacity-100 translate-x-0">
                                Email address
                            </label>

                            <!-- Input container -->
                            <div class="relative">
                                <!-- SVG always visible, vertically centered -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors duration-200"
                                        :class="{ 'text-blue-500': emailFocused }" 
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 
                                            0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 
                                            8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>

                                <!-- Input -->
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 transform hover:scale-[1.01]"
                                    placeholder="Enter your email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus
                                    @focus="emailFocused = true"
                                    @blur="emailFocused = false"
                                >
                            </div>
                        </div>


                            <div x-show="showFields"
                            x-transition:enter="transition ease-out duration-400 delay-600"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0">

                            <!-- Animate label -->
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2"
                                x-show="showFields"
                                x-transition:enter="transition ease-out duration-400 delay-600"
                                x-transition:enter-start="opacity-0 translate-x-4"
                                x-transition:enter-end="opacity-100 translate-x-0">
                                Password
                            </label>

                            <!-- Input container -->
                            <div class="relative">
                                <!-- Lock SVG always visible -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors duration-200"
                                        :class="{ 'text-blue-500': passwordFocused }"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>

                                <!-- Password input -->
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 transform hover:scale-[1.01]"
                                    placeholder="Enter your password" 
                                    required 
                                    autocomplete="current-password"
                                    @focus="passwordFocused = true"
                                    @blur="passwordFocused = false"
                                >

                                <!-- Eye toggle button -->
                                <button 
                                    type="button" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center transform transition-transform duration-200 hover:scale-110 z-10"
                                    onclick="togglePassword()"
                                >
                                    <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between"
                             x-show="showFields"
                             x-transition:enter="transition ease-out duration-400 delay-700"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="remember" 
                                    name="remember" 
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <label for="remember" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500 font-medium transition-colors">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed"
                            x-show="showFields"
                            x-transition:enter="transition ease-out duration-400 delay-800"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            :disabled="isSubmitting"
                        >
                            <span x-show="!isSubmitting">Sign in</span>
                            <span x-show="isSubmitting" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Signing in...
                            </span>
                        </button>
                    </form>

                    <div class="mt-8"
                         x-show="showSocial"
                         x-transition:enter="transition ease-out duration-400 delay-900"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3"
                         x-show="showSocial"
                         x-transition:enter="transition ease-out duration-500 delay-1000"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <a id="googleLoginBtn"
                        href="{{ url('/auth/google') }}" 
                        class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-200 transform hover:scale-105 hover:shadow-md">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <span class="ml-2">Google</span>
                        </a>
                        <a 
                            href="{{ url('/auth/facebook') }}" 
                            class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-all duration-200 transform hover:scale-105 hover:shadow-md"
                        >
                            <svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="ml-2">Facebook</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex lg:flex-1 relative"
                 x-show="showImage"
                 x-transition:enter="transition ease-out duration-700 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-8 scale-105"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-500 opacity-80"></div>
                <img 
                    src="{{ asset('dipvetAssets/images/trust1.jpg') }}" 
                    alt="Login illustration" 
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 flex items-center justify-center p-12"
                     x-show="showImage"
                     x-transition:enter="transition ease-out duration-600 delay-800"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="text-center text-white">
                        <h2 class="text-3xl font-bold mb-4">Welcome to our platform</h2>
                        <p class="text-lg opacity-90">Join thousands of users who trust us with their business</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

       document.getElementById("googleLoginBtn").addEventListener("click", function(e) {
    e.preventDefault(); // Prevent immediate navigation

    // Show toast
    Toastify({
    text: "Redirecting to Google login...",
    duration: 2500,
    close: true,
    gravity: "top",
    position: "right",
    style: {
        background: "linear-gradient(to right, #3fbff1ff, #06b6d4)", // vet-themed gradient
        color: "#ffffff",
        fontWeight: "600",
        fontSize: "1.1rem",          // bigger font for readability
        padding: "1rem 1.5rem",      // more space around text
        borderRadius: "5px",        // smoother corners
        boxShadow: "0 6px 16px rgba(0, 0, 0, 0.2)", // stronger shadow
        fontFamily: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",
        display: "flex",
        alignItems: "center",
        gap: "0.5rem"               // space for an optional icon
    }
}).showToast();


    // Continue to the link after a short delay
    setTimeout(() => {
        window.location.href = this.href;
    }, 500); // wait 0.5s so user sees the toast
});
    </script>
</body>
</html>
