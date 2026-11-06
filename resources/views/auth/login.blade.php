@extends('layouts.guest')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@800;900&family=Outfit:wght@400;500;600;700&display=swap');

        body {
            height: 100vh;
            background: url(assets/img/theme/cover_new.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: 'Outfit', sans-serif;
        }

        .main-content footer {
            display: none;
        }

        #login_container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 450px;
            padding: 15px;
            z-index: 10;
        }

        .login-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: none;
            overflow: hidden;
            width: 100%;
        }

        .login-card-header {
            background-color: #f6f6f6;
            border-bottom: 1px solid #eef2f5;
            padding: 35px 20px 30px 20px;
            text-align: center;
        }

        .logo-encore {
            font-family: 'Orbitron', sans-serif;
            font-size: 38px;
            font-weight: 900;
            letter-spacing: 5px;
            color: #000000;
            line-height: 1;
            margin-bottom: 5px;
        }

        .logo-inventory {
            font-family: 'Orbitron', sans-serif;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 5.5px;
            color: #000000;
            line-height: 1;
        }

        .login-card-body {
            padding: 30px 35px 35px 35px;
        }

        .login-title-text {
            font-size: 14px;
            font-weight: 500;
            color: #718096;
            margin-bottom: 25px;
            text-align: left;
        }

        /* Custom input group styling */
        .custom-input-group {
            display: flex;
            align-items: center;
            background-color: #eef2f6;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 8px 14px;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }

        .custom-input-group:focus-within {
            border-color: #cbd5e1;
            background-color: #ffffff;
        }

        .custom-input-group.has-error {
            border-color: #e53e3e;
            box-shadow: 0 0 0 1px #e53e3e;
        }

        .custom-input-icon {
            color: #1a1a1a;
            font-size: 16px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
        }

        .custom-input-wrapper {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            text-align: left;
        }

        .custom-input-wrapper label {
            font-size: 11px;
            font-weight: 600;
            color: #718096;
            margin-bottom: 0;
            line-height: 1.3;
            text-transform: none;
        }

        .custom-input-wrapper input {
            border: none !important;
            background: transparent !important;
            padding: 0 !important;
            font-size: 14px;
            font-weight: 500;
            color: #1a202c;
            outline: none !important;
            width: 100%;
            box-shadow: none !important;
            height: 22px;
        }

        .custom-input-wrapper input::placeholder {
            color: #a0aec0;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #eef2f6 inset !important;
        }

        /* Input group toggle password suffix */
        .custom-input-suffix {
            color: #4a5568;
            cursor: pointer;
            padding-left: 12px;
            border-left: 1px solid #cbd5e0;
            margin-left: 8px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        /* Checkbox list styling */
        .custom-checkbox-container {
            display: flex;
            align-items: center;
        }

        .custom-checkbox {
            border-radius: 4px;
            border-color: #cbd5e0;
            width: 16px;
            height: 16px;
            cursor: pointer;
            margin-top: 0;
        }

        .custom-checkbox:checked {
            background-color: #c32039;
            border-color: #c32039;
        }

        .custom-checkbox-label {
            font-size: 13px;
            font-weight: 600;
            color: #c32039;
            margin-left: 8px;
            cursor: pointer;
            user-select: none;
        }

        .forgot-password-link {
            font-size: 13px;
            font-weight: 500;
            color: #5a738e;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .forgot-password-link:hover {
            color: #2b3a4a;
        }

        /* Red submit button */
        .btn-signin {
            background-color: #c32039;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.1s;
        }

        .btn-signin:hover, .btn-signin:focus {
            background-color: #a51b30;
            color: #ffffff;
        }

        .btn-signin:active {
            transform: scale(0.98);
        }

        /* Google sign in button */
        .btn-signin-google {
            background-color: #ffd2d7;
            color: #c32039;
            border: 1px solid #ffd2d7;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.2s, color 0.2s, border-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-signin-google:hover, .btn-signin-google:focus {
            background-color: #c32039;
            color: #ffffff;
            border-color: #c32039;
        }

        .btn-signin-google i {
            color: inherit;
        }

        /* Validation feedback style override */
        .invalid-feedback {
            text-align: left;
            margin-top: 4px;
            font-size: 12px;
            color: #e53e3e;
        }

        .help-block {
            text-align: left;
            margin-top: 4px;
            font-size: 12px;
            color: #e53e3e;
            display: block;
        }
    </style>
    <div class="container" id="login_container">
        <div class="card login-card">
            <div class="card-header login-card-header">
                <div class="logo-encore">ENCORE</div>
                <div class="logo-inventory">INVENTORY</div>
            </div>

            <div class="card-body login-card-body">
                <div class="login-title-text">{{ __('Login') }}</div>
                <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                    @csrf

                    <div class="form-group mb-3">
                        <div class="custom-input-group @error('email') has-error @enderror">
                            <span class="custom-input-icon"><i class="fa-solid fa-envelope"></i></span>
                            <div class="custom-input-wrapper">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="@error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" placeholder="superadmin@encorecustom.com" autofocus>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="custom-input-group @error('password') has-error @enderror">
                            <span class="custom-input-icon"><i class="fa-solid fa-lock"></i></span>
                            <div class="custom-input-wrapper">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="@error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password" placeholder="••••••••">
                            </div>
                            <span class="custom-input-suffix">
                                <i class="fas fa-eye-slash" id="togglePassword"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check custom-checkbox-container p-0">
                            <input class="custom-checkbox" name="remember" id="customCheckLogin"
                                type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-checkbox-label" for="customCheckLogin">
                                {{ __('Remember me') }}
                            </label>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}" class="forgot-password-link">
                                {{ __('Forgot password?') }}
                            </a>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-signin w-100">{{ __('Log In') }}</button>
                    </div>

                </form>
                
                {{-- <div class="mb-2">
                    <a href="{{ route('google.login') }}" class="btn btn-signin-google w-100">
                        <i class="fa-brands fa-google me-2"></i> {{ __('Sign In With Google') }}
                    </a>
                </div> --}}

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#togglePassword').click(function () {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });

        window.onload = function () {
            document.getElementById("email").focus();
        }
    </script>

    {{-- @push('scripts')
    <script src="{{ asset('js/validation/login.js') }}"></script>
    @endpush --}}
    {!! JsValidator::formRequest('App\Http\Requests\LoginRequest', '#loginForm') !!}

@endsection