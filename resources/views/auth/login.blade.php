<body>
    <div class="login-page-container">
        <!-- Left: Form -->
        <div class="login-container">
            <div class="login-header">
                <h1 class="login-title">Sign in to your account</h1>
                <p class="login-subtitle">
                    Or <a href="{{ route('register') }}">create a new account</a>
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="error-message">{{ session('status') }}</div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="error-message">
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                        <input type="email" id="email" name="email" class="form-input"
                               placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" id="password" name="password" class="form-input"
                               placeholder="Enter your password" required autocomplete="current-password">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <svg id="eyeIcon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="checkbox-label">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>
                    @endif
                </div>

                <button type="submit" class="login-button">Sign in</button>
            </form>

            <div class="divider"><span>Or continue with</span></div>

            <div class="social-buttons">
                <a href="{{ url('/auth/google') }}" class="social-button google">Google</a>
                <a href="{{ url('/auth/facebook') }}" class="social-button facebook">Facebook</a>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="login-image-container">
            <img src="{{ asset('dipvetAssets/images/trust1.jpg') }}" alt="Login Image">
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        }
    </script>
</body>

<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 1rem;
    }

    .login-page-container {
        display: flex;
        max-width: 900px;
        width: 100%;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .login-container {
        flex: 1;
        padding: 2rem;
        background: white;
    }

    .login-image-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
    }

    .login-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Preserve your original login form styles */
    .login-header { text-align: center; margin-bottom: 2rem; }
    .login-title { font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
    .login-subtitle { color: #6b7280; font-size: 0.9rem; }
    .login-subtitle a { color: #6366f1; font-weight: 500; text-decoration: none; }
    .login-subtitle a:hover { color: #4f46e5; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem; }
    .input-wrapper { position: relative; }
    .form-input { width: 100%; padding: 0.75rem 1rem; padding-left: 2.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; transition: all 0.2s ease-in-out; }
    .form-input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.15); }
    .input-icon { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 1.25rem; height: 1.25rem; color: #9ca3af; }
    .password-toggle { position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0; }
    .form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .checkbox-wrapper input[type="checkbox"] { width: 1rem; height: 1rem; accent-color: #6366f1; }
    .checkbox-label { font-size: 0.875rem; color: #6b7280; }
    .forgot-password { font-size: 0.875rem; color: #6366f1; font-weight: 500; text-decoration: none; }
    .forgot-password:hover { color: #4f46e5; }
    .login-button { width: 100%; background-color: #6366f1; color: white; border: none; border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out; margin-bottom: 1.5rem; }
    .login-button:hover { background-color: #4f46e5; transform: translateY(-2px); }
    .error-message { background-color: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 0.75rem; border-radius: 8px; font-size: 0.875rem; margin-bottom: 1rem; }
    .divider { position: relative; margin: 1.5rem 0; text-align: center; }
    .divider::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background-color: #e5e7eb; }
    .divider span { background-color: white; color: #6b7280; font-size: 0.875rem; padding: 0 1rem; }
    .social-buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .social-button { display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; background-color: white; color: #374151; font-size: 0.9rem; font-weight: 500; text-decoration: none; transition: all 0.2s ease-in-out; }
    .social-button:hover { background-color: #f3f4f6; border-color: #cbd5e1; }

    /* Responsive */
    @media (max-width: 768px) {
        .login-page-container { flex-direction: column; }
        .login-image-container { display: none; }
    }

    html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden; /* Prevent scrolling */
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f3f4f6;
}

</style>

<script>
    function loginWithGoogle() {
  const popup = window.open(
    "/auth/google", 
    "googleLogin", 
    "width=500,height=600"
  );

  // Listen for message from popup
  window.addEventListener("message", (event) => {
    if (event.origin !== window.location.origin) return;

    if (event.data.type === "google-auth-success") {
      console.log("User logged in:", event.data.user);
      popup.close();
    }
  });
}
