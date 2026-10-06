@extends('layouts.app')

@section('content')

<style>
    .customer-login-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 60px 0;
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 10% 20%, rgba(201,162,39,.10), transparent 28%),
            radial-gradient(circle at 90% 80%, rgba(201,162,39,.08), transparent 30%),
            #f8f9fb;
    }

    .login-decor {
        position: absolute;
        border: 1px solid rgba(201,162,39,.12);
        border-radius: 50%;
        pointer-events: none;
    }

    .decor-one {
        width: 420px;
        height: 420px;
        top: -240px;
        right: -130px;
    }

    .decor-two {
        width: 300px;
        height: 300px;
        bottom: -190px;
        left: -130px;
    }

    .customer-login-card {
        max-width: 470px;
        margin: auto;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        overflow: hidden;
        box-shadow:
            0 25px 65px rgba(15,23,42,.10),
            0 5px 18px rgba(15,23,42,.04);
        position: relative;
        z-index: 2;
        animation: loginEnter .5s ease-out;
    }

    @keyframes loginEnter {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card-top {
        background:
            radial-gradient(circle at 90% 10%, rgba(201,162,39,.18), transparent 35%),
            linear-gradient(135deg, #111827, #1f2937);
        color: #fff;
        padding: 32px 30px 28px;
        position: relative;
        overflow: hidden;
    }

    .login-card-top::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 50%;
        right: -90px;
        top: -90px;
    }

    .login-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(201,162,39,.14);
        border: 1px solid rgba(201,162,39,.30);
        color: #dfc35c;
        font-size: 23px;
        margin-bottom: 19px;
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

    .login-heading {
        font-size: 28px;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .login-description {
        color: rgba(255,255,255,.68);
        font-size: 13px;
        line-height: 1.6;
        margin: 8px 0 0;
        position: relative;
        z-index: 2;
    }

    .login-card-body {
        padding: 30px;
    }

    .error-alert {
        border: 0;
        border-left: 3px solid #dc2626;
        background: #fef2f2;
        color: #991b1b;
        border-radius: 10px;
        font-size: 12px;
        padding: 11px 13px;
        margin-bottom: 19px;
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
        border-color: #c9a227;
        box-shadow: 0 0 0 3px rgba(201,162,39,.09);
    }

    .login-input::placeholder {
        color: #a1a1aa;
    }

    .password-toggle {
        position: absolute;
        right: 9px;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .password-toggle:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .field-error {
        color: #dc2626;
        font-size: 10px;
        margin-top: 5px;
    }

    .btn-login {
        width: 100%;
        height: 47px;
        border: 1px solid #111827;
        border-radius: 11px;
        background: #111827;
        color: #fff;
        font-size: 13px;
        font-weight: 750;
        transition: .2s ease;
        margin-top: 3px;
    }

    .btn-login:hover {
        background: #000;
        border-color: #000;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(17,24,39,.15);
    }

    .btn-login:disabled {
        opacity: .75;
        cursor: not-allowed;
        transform: none;
    }

    .register-box {
        margin-top: 22px;
        padding: 14px 15px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #eef0f3;
        text-align: center;
        font-size: 12px;
        color: #6b7280;
    }

    .register-box a {
        color: #a98518;
        font-weight: 750;
        text-decoration: none;
    }

    .register-box a:hover {
        color: #80650f;
        text-decoration: underline;
    }

    .secure-note {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 18px;
        color: #9ca3af;
        font-size: 10px;
    }

    .secure-note i {
        color: #6b7280;
    }

    @media (max-width: 575.98px) {

        .customer-login-page {
            padding: 35px 14px;
        }

        .customer-login-card {
            border-radius: 20px;
        }

        .login-card-top {
            padding: 27px 22px 24px;
        }

        .login-card-body {
            padding: 24px 21px 26px;
        }

        .login-heading {
            font-size: 25px;
        }
    }
</style>


<div class="customer-login-page">

    <div class="login-decor decor-one"></div>
    <div class="login-decor decor-two"></div>


    <div class="container position-relative">

        <div class="customer-login-card">

            {{-- Header --}}
            <div class="login-card-top">

                <div class="login-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <div class="login-kicker">
                    Customer Portal
                </div>

                <h1 class="login-heading">
                    Welcome Back
                </h1>

                <p class="login-description">
                    Sign in to manage your catering bookings, food tasting
                    requests and event details.
                </p>

            </div>


            {{-- Body --}}
            <div class="login-card-body">

                @if($errors->any())

                    <div class="error-alert">

                        <div class="fw-bold mb-1">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Unable to sign in
                        </div>

                        <div>
                            {{ $errors->first() }}
                        </div>

                    </div>

                @endif


                @if(session('error'))

                    <div class="error-alert">

                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ session('error') }}

                    </div>

                @endif


                <form
                    method="post"
                    id="customerLoginForm"
                >

                    @csrf


                    {{-- Email --}}
                    <div class="field-group">

                        <label
                            class="field-label"
                            for="customerEmail"
                        >
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-envelope input-icon"></i>

                            <input
                                class="login-input"
                                id="customerEmail"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                                autofocus
                            >

                        </div>

                        @error('email')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="field-group">

                        <label
                            class="field-label"
                            for="customerPassword"
                        >
                            Password
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-lock input-icon"></i>

                            <input
                                class="login-input"
                                id="customerPassword"
                                name="password"
                                type="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="toggleCustomerPassword"
                                aria-label="Show password"
                            >
                                <i
                                    class="bi bi-eye"
                                    id="customerPasswordIcon"
                                ></i>
                            </button>

                        </div>

                        @error('password')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="btn-login"
                        id="customerLoginButton"
                    >
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Sign In
                    </button>

                </form>


                {{-- Register --}}
                <div class="register-box">

                    New to our catering service?

                    <a href="/register">
                        Create your account
                    </a>

                </div>


                <div class="secure-note">

                    <i class="bi bi-shield-lock"></i>

                    Your account information is securely protected.

                </div>

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
     * Password visibility
     */
    const togglePassword =
        document.getElementById('toggleCustomerPassword');

    const password =
        document.getElementById('customerPassword');

    const passwordIcon =
        document.getElementById('customerPasswordIcon');


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
    const form =
        document.getElementById('customerLoginForm');

    const button =
        document.getElementById('customerLoginButton');


    if (form && button) {

        form.addEventListener('submit', function () {

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Signing in...';

        });

    }

});
</script>

@endsection