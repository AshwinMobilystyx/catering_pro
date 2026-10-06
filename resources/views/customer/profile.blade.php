@extends('layouts.app')

@section('content')

<style>
    .profile-page {
        min-height: 100vh;
        padding: 45px 0 80px;
        background:
            radial-gradient(circle at 8% 8%, rgba(255,193,7,.10), transparent 25%),
            radial-gradient(circle at 92% 35%, rgba(255,152,0,.07), transparent 25%),
            #f7f7f5;
    }

    /* =========================
       HEADER
    ========================== */

    .profile-header {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 40px;
        margin-bottom: 25px;
        color: #fff;
        background:
            linear-gradient(120deg, #1b1814, #44301b);
        box-shadow: 0 22px 55px rgba(0,0,0,.11);
    }

    .profile-header::before {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        border: 1px solid rgba(255,193,7,.12);
        right: -130px;
        top: -190px;
    }

    .profile-header::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,193,7,.08);
        filter: blur(60px);
        right: 100px;
        bottom: -140px;
    }

    .profile-grid {
        position: absolute;
        inset: 0;
        opacity: .15;
        background-image:
            linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
        background-size: 45px 45px;
    }

    .profile-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .profile-avatar {
        flex: 0 0 78px;
        width: 78px;
        height: 78px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #251b07;
        font-size: 1.8rem;
        font-weight: 900;
        box-shadow: 0 15px 30px rgba(255,152,0,.2);
    }

    .profile-header small {
        display: block;
        color: #ffc107;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .profile-header h1 {
        margin: 0 0 7px;
        font-size: clamp(1.9rem, 4vw, 2.8rem);
        font-weight: 900;
        letter-spacing: -1px;
    }

    .profile-header p {
        margin: 0;
        color: rgba(255,255,255,.62);
        font-size: .85rem;
    }

    /* =========================
       LAYOUT
    ========================== */

    .profile-layout {
        display: grid;
        grid-template-columns: 270px minmax(0, 1fr);
        gap: 22px;
        align-items: start;
    }

    /* =========================
       SIDE CARD
    ========================== */

    .profile-side {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 23px;
        padding: 22px;
        box-shadow: 0 10px 30px rgba(0,0,0,.04);
    }

    .side-profile {
        text-align: center;
        padding: 12px 5px 25px;
        border-bottom: 1px solid #eeeeec;
        margin-bottom: 18px;
    }

    .side-avatar {
        width: 72px;
        height: 72px;
        margin: 0 auto 13px;
        border-radius: 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff4d3;
        color: #a36d00;
        font-size: 1.55rem;
        font-weight: 900;
    }

    .side-profile h4 {
        margin: 0 0 4px;
        font-size: .95rem;
        font-weight: 900;
        color: #222;
    }

    .side-profile p {
        margin: 0;
        color: #999;
        font-size: .72rem;
        word-break: break-word;
    }

    .profile-side-info {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 5px;
    }

    .side-info-icon {
        width: 35px;
        height: 35px;
        flex: 0 0 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f6f6f4;
        color: #a36d00;
        font-size: .82rem;
    }

    .profile-side-info small {
        display: block;
        color: #aaa;
        font-size: .63rem;
        text-transform: uppercase;
        letter-spacing: .8px;
        font-weight: 800;
    }

    .profile-side-info span {
        display: block;
        color: #444;
        font-size: .73rem;
        margin-top: 2px;
        word-break: break-word;
    }

    /* =========================
       FORM CARD
    ========================== */

    .profile-form-card {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.045);
    }

    .form-top {
        padding: 27px 30px;
        border-bottom: 1px solid #eeeeec;
    }

    .form-top-label {
        color: #a26c00;
        font-size: .68rem;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .form-top h2 {
        margin: 0 0 6px;
        font-size: 1.35rem;
        font-weight: 900;
        color: #1d1d1d;
    }

    .form-top p {
        margin: 0;
        color: #999;
        font-size: .78rem;
    }

    .profile-form-body {
        padding: 30px;
    }

    /* =========================
       FIELDS
    ========================== */

    .field {
        margin-bottom: 21px;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        color: #3b3b3b;
        font-size: .75rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .input-wrap {
        position: relative;
    }

    .field-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        pointer-events: none;
        z-index: 2;
    }

    .custom-input,
    .custom-textarea {
        width: 100%;
        border: 1px solid #e1e1de;
        border-radius: 13px;
        background: #fafafa;
        color: #222;
        outline: none;
        transition: .25s ease;
        font-size: .84rem;
    }

    .custom-input {
        height: 52px;
        padding: 0 15px 0 43px;
    }

    .custom-textarea {
        min-height: 130px;
        padding: 14px 15px 14px 43px;
        resize: vertical;
        line-height: 1.6;
    }

    .custom-input:focus,
    .custom-textarea:focus {
        background: #fff;
        border-color: #ffc107;
        box-shadow: 0 0 0 4px rgba(255,193,7,.09);
    }

    /* EMAIL READONLY */
    .account-email {
        background: #f3f3f1;
        color: #888;
        cursor: not-allowed;
    }

    .email-note {
        margin-top: 6px;
        color: #aaa;
        font-size: .65rem;
    }

    /* =========================
       SAVE FOOTER
    ========================== */

    .form-footer {
        padding: 20px 30px;
        border-top: 1px solid #eeeeec;
        background: #fcfcfb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .save-note {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #999;
        font-size: .68rem;
    }

    .save-note i {
        color: #3b9a5e;
        font-size: .9rem;
    }

    .save-btn {
        border: 0;
        border-radius: 12px;
        padding: 12px 23px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #211906;
        font-size: .8rem;
        font-weight: 900;
        transition: .3s ease;
        box-shadow: 0 9px 20px rgba(255,152,0,.18);
    }

    .save-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 13px 27px rgba(255,152,0,.25);
    }

    .save-btn:disabled {
        opacity: .75;
        cursor: not-allowed;
        transform: none;
    }

    /* =========================
       SUCCESS / ERROR
    ========================== */

    .alert-custom {
        margin: 22px 30px 0;
        padding: 13px 15px;
        border-radius: 12px;
        font-size: .78rem;
        border: 0;
    }

    .alert-success-custom {
        background: #eaf8ef;
        color: #287947;
    }

    .alert-error-custom {
        background: #fff0f0;
        color: #a33a3a;
    }

    .alert-error-custom ul {
        margin-bottom: 0;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 991px) {

        .profile-layout {
            grid-template-columns: 1fr;
        }

        .profile-side {
            display: none;
        }
    }

    @media (max-width: 767px) {

        .profile-page {
            padding: 28px 0 60px;
        }

        .profile-header {
            padding: 27px 22px;
            border-radius: 22px;
        }

        .profile-header-content {
            align-items: flex-start;
        }

        .profile-avatar {
            width: 58px;
            height: 58px;
            flex-basis: 58px;
            border-radius: 17px;
            font-size: 1.4rem;
        }

        .profile-form-card {
            border-radius: 20px;
        }

        .form-top,
        .profile-form-body {
            padding: 23px 20px;
        }

        .form-footer {
            padding: 18px 20px;
            align-items: stretch;
            flex-direction: column;
        }

        .save-btn {
            width: 100%;
        }

        .alert-custom {
            margin-left: 20px;
            margin-right: 20px;
        }
    }

    @media (max-width: 480px) {

        .profile-header h1 {
            font-size: 1.75rem;
        }

        .profile-header p {
            font-size: .76rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>


<div class="profile-page">

    <div class="container">

        {{-- =========================
             PROFILE HEADER
        ========================== --}}
        <section class="profile-header">

            <div class="profile-grid"></div>

            <div class="profile-header-content">

                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>

                    <small>My Account</small>

                    <h1>
                        Your Profile
                    </h1>

                    <p>
                        Keep your contact information up to date for smoother
                        event planning and communication.
                    </p>

                </div>

            </div>

        </section>


        {{-- =========================
             MAIN LAYOUT
        ========================== --}}
        <div class="profile-layout">


            {{-- =========================
                 SIDE INFORMATION
            ========================== --}}
            <aside class="profile-side">

                <div class="side-profile">

                    <div class="side-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h4>
                        {{ $user->name }}
                    </h4>

                    <p>
                        {{ $user->email }}
                    </p>

                </div>


                <div class="profile-side-info">

                    <div class="side-info-icon">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <small>Name</small>
                        <span>{{ $user->name }}</span>
                    </div>

                </div>


                <div class="profile-side-info">

                    <div class="side-info-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <div>
                        <small>Email</small>
                        <span>{{ $user->email }}</span>
                    </div>

                </div>


                <div class="profile-side-info">

                    <div class="side-info-icon">
                        <i class="bi bi-telephone"></i>
                    </div>

                    <div>
                        <small>Phone</small>
                        <span>
                            {{ $user->phone ?: 'Not added' }}
                        </span>
                    </div>

                </div>


                <div class="profile-side-info">

                    <div class="side-info-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>
                        <small>Address</small>
                        <span>
                            {{ $user->address ?: 'Not added' }}
                        </span>
                    </div>

                </div>

            </aside>


            {{-- =========================
                 EDIT PROFILE
            ========================== --}}
            <main class="profile-form-card">

                <div class="form-top">

                    <div class="form-top-label">
                        Account Details
                    </div>

                    <h2>
                        Personal Information
                    </h2>

                    <p>
                        Update the information we should use when communicating
                        with you about your catering requests.
                    </p>

                </div>


                {{-- SUCCESS --}}
                @if(session('success'))

                    <div class="alert-custom alert-success-custom">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('success') }}

                    </div>

                @endif


                {{-- ERRORS --}}
                @if($errors->any())

                    <div class="alert-custom alert-error-custom">

                        <strong>
                            Please check the following:
                        </strong>

                        <ul class="mt-2 ps-3">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ url()->current() }}"
                    id="profileForm"
                >

                    @csrf

                    <div class="profile-form-body">

                        <div class="row g-3">

                            {{-- NAME --}}
                            <div class="col-md-6">

                                <div class="field">

                                    <label class="field-label">
                                        Full Name
                                    </label>

                                    <div class="input-wrap">

                                        <i class="bi bi-person field-icon"></i>

                                        <input
                                            type="text"
                                            name="name"
                                            class="custom-input"
                                            value="{{ old('name', $user->name) }}"
                                            placeholder="Enter your full name"
                                            required
                                            autocomplete="name"
                                        >

                                    </div>

                                </div>

                            </div>


                            {{-- PHONE --}}
                            <div class="col-md-6">

                                <div class="field">

                                    <label class="field-label">
                                        Phone Number
                                    </label>

                                    <div class="input-wrap">

                                        <i class="bi bi-telephone field-icon"></i>

                                        <input
                                            type="tel"
                                            name="phone"
                                            class="custom-input"
                                            value="{{ old('phone', $user->phone) }}"
                                            placeholder="Enter phone number"
                                            autocomplete="tel"
                                        >

                                    </div>

                                </div>

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-12">

                                <div class="field">

                                    <label class="field-label">
                                        Email Address
                                    </label>

                                    <div class="input-wrap">

                                        <i class="bi bi-envelope field-icon"></i>

                                        <input
                                            type="email"
                                            class="custom-input account-email"
                                            value="{{ $user->email }}"
                                            readonly
                                        >

                                    </div>

                                    <div class="email-note">
                                        <i class="bi bi-lock-fill me-1"></i>
                                        Your login email cannot be changed here.
                                    </div>

                                </div>

                            </div>


                            {{-- ADDRESS --}}
                            <div class="col-12">

                                <div class="field">

                                    <label class="field-label">
                                        Address
                                    </label>

                                    <div class="input-wrap">

                                        <i class="bi bi-geo-alt field-icon"></i>

                                        <textarea
                                            name="address"
                                            class="custom-textarea"
                                            placeholder="Enter your complete address"
                                        >{{ old('address', $user->address) }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div class="form-footer">

                        <div class="save-note">

                            <i class="bi bi-shield-check"></i>

                            Your profile information is used for your
                            catering requests.

                        </div>

                        <button
                            type="submit"
                            class="save-btn"
                            id="saveProfileBtn"
                        >
                            <i class="bi bi-check2-circle me-1"></i>
                            Save Changes
                        </button>

                    </div>

                </form>

            </main>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('profileForm');
        const button = document.getElementById('saveProfileBtn');

        if (!form || !button) return;

        form.addEventListener('submit', function () {

            button.disabled = true;

            button.innerHTML = `
                <span>
                    <span class="spinner-border spinner-border-sm me-2"
                          role="status"
                          aria-hidden="true"></span>
                    Saving...
                </span>
            `;

        });

    });
</script>

@endsection