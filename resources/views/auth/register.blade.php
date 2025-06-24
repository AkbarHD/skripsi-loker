@extends('layouts.app')

@section('content')
    <style>
        .auth-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 2rem;
            position: relative;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="20" cy="80" r="0.5" fill="white" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .auth-header h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .auth-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .auth-body {
            padding: 2.5rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
            flex: 1;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: inherit;
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-input.is-invalid,
        .form-select.is-invalid,
        .form-textarea.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            margin-top: 0.5rem;
            color: #ef4444;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-primary-custom {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .form-section {
            border-left: 4px solid #667eea;
            padding-left: 1rem;
            margin: 2rem 0;
        }

        .form-section-title {
            color: #667eea;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .progress-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .progress-step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
            position: relative;
            color: #6b7280;
        }

        .progress-step.active {
            background: #667eea;
            color: white;
        }

        .progress-step::after {
            content: '';
            position: absolute;
            left: 100%;
            width: calc(100vw / 6);
            height: 2px;
            background: #e5e7eb;
            z-index: -1;
        }

        .progress-step:last-child::after {
            display: none;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .gender-option {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .gender-option:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .gender-option.selected {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }

        .gender-option input {
            display: none;
        }

        @media (max-width: 768px) {
            .auth-container {
                padding: 10px;
            }

            .auth-body {
                padding: 1.5rem;
            }

            .auth-header {
                padding: 1.5rem;
            }

            .auth-header h2 {
                font-size: 1.5rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .gender-options {
                flex-direction: column;
            }
        }
    </style>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join us and start your journey</p>
            </div>

            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-section">
                        <div class="form-section-title">Personal Information</div>

                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Full Name') }}</label>
                            <input id="name" type="text" class="form-input @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" autocomplete="name" autofocus
                                placeholder="Enter your full name">

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Enter your email address">

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="no_hp" class="form-label">{{ __('Phone Number') }}</label>
                                <input id="no_hp" type="text" class="form-input @error('no_hp') is-invalid @enderror"
                                    name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp"
                                    placeholder="Phone number">

                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_lahir" class="form-label">{{ __('Date of Birth') }}</label>
                                <input id="tgl_lahir" type="date"
                                    class="form-input @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
                                    value="{{ old('tgl_lahir') }}" required autocomplete="tgl_lahir">

                                @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('Address') }}</label>
                            <textarea id="address" class="form-textarea @error('address') is-invalid @enderror" name="address" required
                                autocomplete="address" placeholder="Enter your complete address">{{ old('address') }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Gender') }}</label>
                            <div class="gender-options">
                                <div class="gender-option {{ old('gender') == 'male' ? 'selected' : '' }}"
                                    onclick="selectGender('male', this)">
                                    <input type="radio" name="gender" value="male"
                                        {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    👨 Male
                                </div>
                                <div class="gender-option {{ old('gender') == 'female' ? 'selected' : '' }}"
                                    onclick="selectGender('female', this)">
                                    <input type="radio" name="gender" value="female"
                                        {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    👩 Female
                                </div>
                            </div>

                            @error('gender')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">Security</div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-input @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Create a strong password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-input" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Confirm your password">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-custom">
                        {{ __('Create Account') }}
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
        function selectGender(value, element) {
            // Remove selected class from all options
            document.querySelectorAll('.gender-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class to clicked option
            element.classList.add('selected');

            // Set the radio button
            element.querySelector('input[type="radio"]').checked = true;
        }
    </script>
@endsection
