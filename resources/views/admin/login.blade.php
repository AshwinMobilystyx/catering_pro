<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Admin Login | {{ config('app.name', 'Catering Pro') }}</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        :root {
            --gold: #c9a227;
            --gold-dark: #a98518;
            --dark: #111827;
            --dark-soft: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                radial-gradient(
                    circle at 10% 15%,
                    rgba(201,162,39,.12),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 85%,
                    rgba(201,162,39,.10),
                    transparent 28%
                ),
                #f5f6f8;

            color: var(--dark);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 18px;
            position: relative;
            overflow: hidden;
        }

        .decor-circle {
            position: absolute;
            border: 1px solid rgba(201,162,39,.12);
            border-radius: 50%;
            pointer-events: none;
        }

        .circle-one {
            width: 420px;
            height: 420px;
            top: -220px;
            right: -160px;
        }

        .circle-two {
            width: 300px;
            height: 300px;
            bottom: -180px;
            left: -140px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(255,255,255,.96);
            border: 1px solid rgba(229,231,235,.9);
            border-radius: 25px;
            overflow: hidden;
            box-shadow:
                0 25px 70px rgba(15,23,42,.12),
                0 5px 18px rgba(15,23,42,.04);

            position: relative;
            z-index: 2;

            animation: cardEnter .5s ease-out;
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-top {
            background:
                radial-gradient(
                    circle at 90% 10%,
                    rgba(201,162,39,.2),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    var(--dark),
                    var(--dark-soft)
                );

            color: #fff;
            padding: 34px 32px 30px;
            position: relative;
            overflow: hidden;
        }

        .login-top::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 50%;
            right: -90px;
            top: -90px;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: rgba(201,162,39,.14);
            border: 1px solid rgba(201,162,39,.3);

            color: #e0c45c;
            font-size: 23px;

            margin-bottom: 20px;

            position: relative;
            z-index: 2;
        }

        .login-kicker {
            color: #d8bb5b;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .15em;
            margin-bottom: 7px;
            position: relative;
            z-index: 2;
        }

        .login-title {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .login-subtitle {
            margin: 8px 0 0;
            color: rgba(255,255,255,.65);
            font-size: 13px;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .login-body {
            padding: 30px 32px 32px;
        }

        .alert-error {
            border: 0;
            border-left: 3px solid #dc2626;
            background: #fef2f2;
            color: #991b1b;
            border-radius: 10px;
            font-size: 12px;
            padding: 11px 13px;
            margin-bottom: 18px;
        }

        .field-group {
            margin-bottom: 17px;
        }

        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 750;
            color: #374151;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
            z-index: 2;
        }

        .login-input {
            width: 100%;
            height: 47px;
            border: 1px solid #dfe3e8;
            border-radius: 11px;
            background: #fff;

            padding: 0 43px;

            font-size: 13px;
            color: #111827;

            outline: none;
            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .login-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,162,39,.09);
        }

        .login-input::placeholder {
            color: #a1a1aa;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);

            border: 0;
            background: transparent;

            width: 32px;
            height: 32px;

            border-radius: 8px;

            color: #9ca3af;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .login-button {
            width: 100%;
            height: 47px;

            border: 1px solid var(--dark);
            border-radius: 11px;

            background: var(--dark);
            color: #fff;

            font-size: 13px;
            font-weight: 750;

            transition:
                transform .2s ease,
                background .2s ease,
                box-shadow .2s ease;

            margin-top: 4px;
        }

        .login-button:hover {
            background: #000;
            border-color: #000;
            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(17,24,39,.16);
        }

        .login-button:disabled {
            opacity: .75;
            cursor: not-allowed;
            transform: none;
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            margin-top: 20px;

            color: #9ca3af;
            font-size: 10px;
        }

        .secure-note i {
            color: #6b7280;
        }

        .brand-footer {
            text-align: center;
            margin-top: 18px;
            color: #9ca3af;
            font-size: 10px;
        }

        .invalid-feedback-custom {
            color: #dc2626;
            font-size: 10px;
            margin-top: 5px;
        }

        @media (max-width: 575.98px) {

            .login-wrapper {
                padding: 18px 14px;
            }

            .login-card {
                border-radius: 20px;
            }

            .login-top {
                padding: 28px 23px 25px;
            }

            .login-body {
                padding: 25px 22px 27px;
            }

            .login-title {
                font-size: 25px;
            }

        }

    </style>

</head>


<body>

<div class="login-wrapper">

    <div class="decor-circle circle-one"></div>
    <div class="decor-circle circle-two"></div>


    <div class="login-card">

        {{-- Header --}}
        <div class="login-top">

            <div class="brand-mark">
                <i class="bi bi-grid-1x2-fill"></i>
            </div>

            <div class="login-kicker">
                Secure Administration
            </div>

            <h1 class="login-title">
                Admin Login
            </h1>

            <p class="login-subtitle">
                Sign in to manage your catering website, bookings,
                menu, gallery and business content.
            </p>

        </div>


        {{-- Login Form --}}
        <div class="login-body">

            @if($errors->any())

                <div class="alert-error">

                    <div class="fw-bold mb-1">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Login failed
                    </div>

                    <div>
                        {{ $errors->first() }}
                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="alert-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ session('error') }}

                </div>

            @endif


            <form
                method="post"
                id="adminLoginForm"
            >

                @csrf


                {{-- Email --}}
                <div class="field-group">

                    <label
                        class="field-label"
                        for="email"
                    >
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-envelope input-icon"></i>

                        <input
                            class="login-input"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                    @error('email')

                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Password --}}
                <div class="field-group">

                    <label
                        class="field-label"
                        for="password"
                    >
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="bi bi-lock input-icon"></i>

                        <input
                            class="login-input"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Show password"
                        >
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>

                    </div>

                    @error('password')

                        <div class="invalid-feedback-custom">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Login --}}
                <button
                    type="submit"
                    class="login-button"
                    id="loginButton"
                >
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Sign In
                </button>

            </form>


            <div class="secure-note">
                <i class="bi bi-shield-lock"></i>
                Secure admin access
            </div>

        </div>

    </div>


    <div class="brand-footer">
        {{ config('app.name', 'Catering Pro') }} · Admin Portal
    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
     * Password visibility
     */
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (togglePassword && password && passwordIcon) {

        togglePassword.addEventListener('click', function () {

            const isPassword =
                password.getAttribute('type') === 'password';

            password.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );

            passwordIcon.classList.toggle(
                'bi-eye',
                !isPassword
            );

            passwordIcon.classList.toggle(
                'bi-eye-slash',
                isPassword
            );

            togglePassword.setAttribute(
                'aria-label',
                isPassword
                    ? 'Hide password'
                    : 'Show password'
            );

        });

    }


    /*
     * Login loading state
     */
    const form = document.getElementById('adminLoginForm');
    const button = document.getElementById('loginButton');

    if (form && button) {

        form.addEventListener('submit', function () {

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Signing in...';

        });

    }

});

</script>

</body>

</html>