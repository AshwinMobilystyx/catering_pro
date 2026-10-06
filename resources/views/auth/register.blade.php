@extends('layouts.app')

@section('content')

<style>
    .customer-register-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 55px 0;
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 10% 20%, rgba(201,162,39,.10), transparent 28%),
            radial-gradient(circle at 90% 80%, rgba(201,162,39,.08), transparent 30%),
            #f8f9fb;
    }

    .register-decor {
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

    .register-card {
        max-width: 550px;
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
        animation: registerEnter .5s ease-out;
    }

    @keyframes registerEnter {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card-top {
        background:
            radial-gradient(circle at 90% 10%, rgba(201,162,39,.18), transparent 35%),
            linear-gradient(135deg, #111827, #1f2937);
        color: #fff;
        padding: 31px 30px 27px;
        position: relative;
        overflow: hidden;
    }

    .register-card-top::after {
        content: "";
        position: absolute;
        width: 185px;
        height: 185px;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 50%;
        right: -90px;
        top: -90px;
    }

    .register-icon {
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
        margin-bottom: 18px;
        position: relative;
        z-index: 2;
    }

    .register-kicker {
        color: #d8bb5b;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .15em;
        margin-bottom: 7px;
        position: relative;
        z-index: 2;
    }

    .register-heading {
        font-size: 28px;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .register-description {
        color: rgba(255,255,255,.68);
        font-size: 13px;
        line-height: 1.6;
        margin: 8px 0 0;
        position: relative;
        z-index: 2;
    }

    .register-body {
        padding: 29px 30px 31px;
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
        margin-bottom: 15px;
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

    .register-input {
        width: 100%;
        height: 46px;
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

    .register-input:focus {
        border-color: #c9a227;
        box-shadow: 0 0 0 3px rgba(201,162,39,.09);
    }

    .register-input::placeholder {
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

    .password-hint {
        color: #9ca3af;
        font-size: 10px;
        margin-top: 5px;
    }

    .btn-register {
        width: 100%;
        height: 47px;
        border: 1px solid #111827;
        border-radius: 11px;
        background: #111827;
        color: #fff;
        font-size: 13px;
        font-weight: 750;
        transition: .2s ease;
        margin-top: 5px;
    }

    .btn-register:hover {
        background: #000;
        border-color: #000;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(17,24,39,.15);
    }

    .btn-register:disabled {
        opacity: .75;
        cursor: not-allowed;
        transform: none;
    }

    .login-box {
        margin-top: 21px;
        padding: 14px 15px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid #eef0f3;
        text-align: center;
        font-size: 12px;
        color: #6b7280;
    }

    .login-box a {
        color: #a98518;
        font-weight: 750;
        text-decoration: none;
    }

    .login-box a:hover {
        color: #80650f;
        text-decoration: underline;
    }

    .secure-note {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 17px;
        color: #9ca3af;
        font-size: 10px;
    }

    .secure-note i {
        color: #6b7280;
    }

    @media (max-width: 575.98px) {

        .customer-register-page {
            padding: 35px 14px;
        }

        .register-card {
            border-radius: 20px;
        }

        .register-card-top {
            padding: 27px 22px 24px;
        }

        .register-body {
            padding: 24px 21px 26px;
        }

        .register-heading {
            font-size: 25px;
        }
    }
</style>


<div class="customer-register-page">

    <div class="register-decor decor-one"></div>
    <div class="register-decor decor-two"></div>


    <div class="container position-relative">

        <div class="register-card">

            {{-- Header --}}
            <div class="register-card-top">

                <div class="register-icon">
                    <i class="bi bi-person-plus"></i>
                </div>

                <div class="register-kicker">
                    Customer Portal
                </div>

                <h1 class="register-heading">
                    Create Your Account
                </h1>

                <p class="register-description">
                    Create an account to manage your catering bookings,
                    event details and food tasting requests.
                </p>

            </div>


            {{-- Form --}}
            <div class="register-body">

                @if($errors->any())

                    <div class="error-alert">

                        <div class="fw-bold mb-1">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Please check the details
                        </div>

                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

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
                    id="customerRegisterForm"
                >

                    @csrf


                    {{-- Full Name --}}
                    <div class="field-group">

                        <label
                            class="field-label"
                            for="name"
                        >
                            Full Name
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-person input-icon"></i>

                            <input
                                class="register-input"
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                autocomplete="name"
                                required
                            >

                        </div>

                        @error('name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


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
                                class="register-input"
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                            >

                        </div>

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div class="field-group">

                        <label
                            class="field-label"
                            for="phone"
                        >
                            Phone Number
                        </label>

                        <div class="input-wrapper">

                            <i class="bi bi-telephone input-icon"></i>

                            <input
                                class="register-input"
                                id="phone"
                                name="phone"
                                type="tel"
                                value="{{ old('phone') }}"
                                placeholder="Enter your phone number"
                                autocomplete="tel"
                                required
                            >

                        </div>

                        @error('phone')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="row g-3">

                        {{-- Password --}}
                        <div class="col-md-6">

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
                                        class="register-input"
                                        id="password"
                                        name="password"
                                        type="password"
                                        placeholder="Create password"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        id="togglePassword"
                                        aria-label="Show password"
                                    >
                                        <i
                                            class="bi bi-eye"
                                            id="passwordIcon"
                                        ></i>
                                    </button>

                                </div>

                                @error('password')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- Confirm Password --}}
                        <div class="col-md-6">

                            <div class="field-group">

                                <label
                                    class="field-label"
                                    for="password_confirmation"
                                >
                                    Confirm Password
                                </label>

                                <div class="input-wrapper">

                                    <i class="bi bi-shield-check input-icon"></i>

                                    <input
                                        class="register-input"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        placeholder="Confirm password"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        id="toggleConfirmPassword"
                                        aria-label="Show confirm password"
                                    >
                                        <i
                                            class="bi bi-eye"
                                            id="confirmPasswordIcon"
                                        ></i>
                                    </button>

                                </div>

                                @error('password_confirmation')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="password-hint">
                        <i class="bi bi-info-circle me-1"></i>
                        Use a strong password that you don't use elsewhere.
                    </div>


                    {{-- Register Button --}}
                    <button
                        type="submit"
                        class="btn-register"
                        id="registerButton"
                    >
                        <i class="bi bi-person-plus me-1"></i>
                        Create Account
                    </button>

                </form>


                {{-- Login --}}
                <div class="login-box">

                    Already have an account?

                    <a href="/login">
                        Sign in here
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
     * Password visibility helper
     */
    function setupPasswordToggle(buttonId, inputId, iconId) {

        const button = document.getElementById(buttonId);
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!button || !input || !icon) {
            return;
        }

        button.addEventListener('click', function () {

            const isPassword =
                input.getAttribute('type') === 'password';

            input.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );

            icon.classList.toggle(
                'bi-eye',
                !isPassword
            );

            icon.classList.toggle(
                'bi-eye-slash',
                isPassword
            );

            button.setAttribute(
                'aria-label',
                isPassword
                    ? 'Hide password'
                    : 'Show password'
            );

        });
    }


    setupPasswordToggle(
        'togglePassword',
        'password',
        'passwordIcon'
    );


    setupPasswordToggle(
        'toggleConfirmPassword',
        'password_confirmation',
        'confirmPasswordIcon'
    );


    /*
     * Register loading state
     */
    const form =
        document.getElementById('customerRegisterForm');

    const button =
        document.getElementById('registerButton');


    if (form && button) {

        form.addEventListener('submit', function () {

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Creating account...';

        });

    }

});
</script>

@endsection