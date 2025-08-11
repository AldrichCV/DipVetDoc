
<body>
    <div class="login-container">
        <div class="login-header">
            <h1 class="login-title">Register an account</h1>
            <p class="login-subtitle">
                Or <a href="{{ route('login') }}">sign in to your account</a>
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

        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <div class="input-wrapper">
                    <input
                        id="name"
                        class="form-input"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.4 15a7.963 7.963 0 01-14.8 0"/>
                        </svg>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <div class="input-wrapper">
                    <input
                        id="email"
                        class="form-input"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                    />
                      <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper" style="position: relative;">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    <input
                        id="password"
                        class="form-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <button
                        type="button"
                        class="password-toggle"
                        onclick="togglePassword()"
                        aria-label="Toggle password visibility"
                        tabindex="-1"
                    >
                        <svg
                            id="eyeIcon"
                            width="20"
                            height="20"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-wrapper">
                    <input
                        id="password_confirmation"
                        class="form-input"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                     <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                </div>
            </div>

            <!-- Role Toggle -->
            <div class="form-group">
                <label class="form-label">Register As</label>
                <div class="toggle-group">
                    <input
                        type="radio"
                        id="role_client"
                        name="role"
                        value="user"
                        {{ old('role', 'user') == 'user' ? 'checked' : '' }}
                    />
                    <label for="role_client">Client</label>

                    <input
                        type="radio"
                        id="role_staff"
                        name="role"
                        value="vet"
                        {{ old('role') == 'vet' ? 'checked' : '' }}
                    />
                    <label for="role_staff">Vet</label>
                </div>
                @error('role')
                    <p class="error-message" style="margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vet-specific fields (hidden initially) -->
            <div id="vetFields" style="display: none;">
                <div class="form-group">
                    <label for="license_number" class="form-label">Veterinary License Number</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 3.5c0 .83-.67 1.5-1.5 1.5S4 4.33 4 3.5 4.67 2 5.5 2 7 2.67 7 3.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 3.5c0 .83.67 1.5 1.5 1.5S21 4.33 21 3.5 20.33 2 19.5 2 18 2.67 18 3.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6.5 5.5C8 7 9 8 11 9.2c2 1.2 2.5 2 3.5 2.2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.5 5.5c-1.5 1.5-2.5 2.5-4.5 3.7-2 1.2-2.5 2-3.5 2.2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 12.9c0 2.5-1 5-3 6.5s-1 4.6 1 5.1c2 .5 3.5-1 5-2.5s3-2.8 3-5.1c0-2.3-1.2-4-3-5.4" />
                            <circle cx="18.5" cy="16" r="1.9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.8 14.7c1 .2 1.6.6 2.2 1.3" />
                        </svg>

                        <input
                            id="license_number"
                            class="form-input"
                            type="text"
                            name="license_number"
                            value="{{ old('license_number') }}"
                            placeholder="Enter your vet license number"
                        />
                    </div>
                </div>

                <div class="form-group">
                    <label for="clinic_name" class="form-label">Clinic Name</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h3m10-12h3a2 2 0 012 2v10a2 2 0 01-2 2h-3m-6 0h6M9 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 3h6v4H9z"/>
                        </svg>
                        <input
                            id="clinic_name"
                            class="form-input"
                            type="text"
                            name="clinic_name"
                            value="{{ old('clinic_name') }}"
                            placeholder="Enter your clinic name"
                        />
                    </div>
                </div>
            </div>


            <div class="form-options">
                <div class="checkbox-wrapper">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required
                        {{ old('terms') ? 'checked' : '' }}
                    />
                    <label for="terms" class="checkbox-label">I agree to the Terms and Conditions</label>
                </div>
            </div>

            <button type="submit" class="login-button">Register</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const eyeIcon = document.getElementById('eyeIcon');

            const isPassword = password.type === 'password';

            // Toggle type for both password fields
            password.type = isPassword ? 'text' : 'password';
            confirmPassword.type = isPassword ? 'text' : 'password';

            // Optionally change the eye icon style
            if (isPassword) {
                // Open eye
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                        -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            } else {
                // Closed eye
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 
                        0-8.268-2.943-9.542-7a9.956 9.956 
                        0 012.641-4.362m3.695-2.132A9.956 
                        9.956 0 0112 5c4.478 0 8.268 2.943 
                        9.542 7a9.956 9.956 0 01-4.233 
                        5.042M15 12a3 3 0 11-6 0 3 3 0 
                        016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18"/>
                `;
            }
        }

        function toggleVetFields() {
            const vetFields = document.getElementById('vetFields');
            const licenseInput = document.getElementById('license_number');
            const clinicInput = document.getElementById('clinic_name');
            const roleStaff = document.getElementById('role_staff');

            if (roleStaff.checked) {
                vetFields.style.display = 'block';
                licenseInput.setAttribute('required', 'required');
                clinicInput.setAttribute('required', 'required');
            } else {
                vetFields.style.display = 'none';
                licenseInput.removeAttribute('required');
                clinicInput.removeAttribute('required');
            }
        }

        // Initialize on page load and add event listeners to radios
        document.addEventListener('DOMContentLoaded', () => {
            toggleVetFields();
            document.getElementById('role_client').addEventListener('change', toggleVetFields);
            document.getElementById('role_staff').addEventListener('change', toggleVetFields);
        });

        // Error handler for Vet role
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            const roleStaff = document.getElementById('role_staff').checked;
            const licenseInput = document.getElementById('license_number');
            const clinicInput = document.getElementById('clinic_name');

            // Remove previous error styles
            [licenseInput, clinicInput].forEach(input => {
                input.classList.remove('error');
            });

            if (roleStaff) {
                let hasError = false;

                if (!licenseInput.value.trim()) {
                    licenseInput.classList.add('error');
                    hasError = true;
                }
                if (!clinicInput.value.trim()) {
                    clinicInput.classList.add('error');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault(); // Stop form submission
                    alert('Please fill out the required vet information before registering.');
                }
            }
        });

    </script>
</body>

<style>
        /* Your provided styles below... */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .login-subtitle a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .login-subtitle a:hover {
            color: #3730a3;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-input.error {
            border-color: #dc2626;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            padding: 0;
        }

        .password-toggle:hover {
            color: #6b7280;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            accent-color: #4f46e5;
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .forgot-password {
            font-size: 0.875rem;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            color: #3730a3;
        }

        .login-button {
            width: 100%;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            margin-bottom: 1.5rem;
        }

        .login-button:hover {
            background-color: #3730a3;
        }

        .login-button:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        .error-message {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .error-list {
            list-style: disc;
            margin-left: 1.25rem;
        }

        .divider {
            position: relative;
            margin: 1.5rem 0;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e5e7eb;
        }

        .divider span {
            background-color: white;
            color: #6b7280;
            font-size: 0.875rem;
            padding: 0 1rem;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: white;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 0.15s ease-in-out;
        }

        .social-button:hover {
            background-color: #f9fafb;
        }

        /* Toggle badges styling */
        .toggle-group {
            display: flex;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            user-select: none;
            margin-bottom: 1.5rem;
            height: 44px; /* similar height to inputs */
        }

        .toggle-group label {
            flex: 1;
            text-align: center;
            line-height: 44px;
            font-weight: 500;
            color: #6b7280;
            background-color: white;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .toggle-group input[type="radio"] {
            display: none;
        }

        .toggle-group input[type="radio"]:checked + label {
            background-color: #4f46e5;
            color: white;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }
            
            .social-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>