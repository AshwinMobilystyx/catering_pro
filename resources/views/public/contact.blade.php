@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       CATERING PRO — PREMIUM CONTACT PAGE
    ========================================================= */

    .contact-page {
        --cp-dark: #17110e;
        --cp-dark-2: #2b1a12;
        --cp-brown: #5b3520;
        --cp-gold: #c9955b;
        --cp-gold-light: #e8c18f;
        --cp-cream: #fbf8f3;
        --cp-paper: #fffdf9;
        --cp-border: #eadfd3;
        --cp-muted: #756d67;

        background: var(--cp-cream);
        color: var(--cp-dark);
        overflow: hidden;
    }

    .contact-page *,
    .contact-page *::before,
    .contact-page *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .contact-hero {
        position: relative;
        min-height: 570px;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        background:
            linear-gradient(
                90deg,
                rgba(18,11,7,.96) 0%,
                rgba(34,20,12,.89) 48%,
                rgba(45,26,15,.66) 100%
            ),
            url("{{ asset('images/contact-bg.jpg') }}") center/cover;
    }

    .contact-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .06;
        background-image:
            linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(to bottom, black, transparent);
    }

    .contact-hero::after {
        content: "";
        position: absolute;
        width: 600px;
        height: 600px;
        right: -270px;
        top: -290px;
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 50%;
        box-shadow:
            0 0 0 70px rgba(255,255,255,.018),
            0 0 0 140px rgba(255,255,255,.01);
        animation: contactRotate 22s linear infinite;
    }

    .hero-glow {
        position: absolute;
        width: 480px;
        height: 480px;
        right: 7%;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        background: rgba(201,149,91,.13);
        filter: blur(90px);
        animation: floatGlow 8s ease-in-out infinite;
    }

    .hero-glow-two {
        position: absolute;
        width: 320px;
        height: 320px;
        left: -150px;
        bottom: -170px;
        border: 1px solid rgba(201,149,91,.14);
        border-radius: 50%;
        animation: contactRotateReverse 17s linear infinite;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 820px;
        padding: 105px 0 95px;
    }

    .contact-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
        color: rgba(255,255,255,.55);
        font-size: 13px;
    }

    .contact-breadcrumb a {
        color: #fff;
        text-decoration: none;
        transition: .25s ease;
    }

    .contact-breadcrumb a:hover {
        color: var(--cp-gold-light);
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 9px 15px;
        border: 1px solid rgba(255,255,255,.16);
        border-radius: 100px;
        background: rgba(255,255,255,.055);
        backdrop-filter: blur(12px);
        color: #edcfaa;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.6px;
        text-transform: uppercase;
    }

    .hero-label span {
        width: 7px;
        height: 7px;
        flex: 0 0 7px;
        border-radius: 50%;
        background: var(--cp-gold-light);
        box-shadow: 0 0 15px rgba(232,193,143,.8);
    }

    .contact-hero h1 {
        max-width: 820px;
        margin: 22px 0 20px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(50px, 7vw, 88px);
        line-height: .96;
        font-weight: 500;
        letter-spacing: -3px;
        animation: fadeUp .8s ease both;
    }

    .contact-hero h1 span {
        color: var(--cp-gold-light);
        font-style: italic;
    }

    .contact-hero p {
        max-width: 680px;
        margin: 0;
        color: rgba(255,255,255,.68);
        font-size: 17px;
        line-height: 1.85;
        animation: fadeUp 1s ease both;
    }

    .hero-scroll {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 35px;
        color: rgba(255,255,255,.5);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .hero-scroll-line {
        width: 40px;
        height: 1px;
        background: rgba(255,255,255,.3);
    }

    /* =========================================================
       CONTACT SECTION
    ========================================================= */

    .contact-section {
        position: relative;
        padding: 105px 0;
    }

    .contact-intro-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #9a603b;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .contact-intro-label::before {
        content: "";
        width: 28px;
        height: 1px;
        background: var(--cp-gold);
    }

    .contact-info-title {
        margin: 13px 0 14px;
        color: var(--cp-dark);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(36px, 5vw, 52px);
        line-height: 1.05;
        font-weight: 500;
        letter-spacing: -1.5px;
    }

    .contact-info-description {
        max-width: 530px;
        margin-bottom: 35px;
        color: var(--cp-muted);
        font-size: 15px;
        line-height: 1.85;
    }

    /* =========================================================
       CONTACT INFO CARDS
    ========================================================= */

    .contact-info-card {
        display: flex;
        align-items: center;
        gap: 17px;
        margin-bottom: 13px;
        padding: 18px;
        border: 1px solid var(--cp-border);
        border-radius: 18px;
        background: rgba(255,255,255,.78);
        box-shadow: 0 10px 30px rgba(42,25,14,.04);
        transition: .35s ease;
    }

    .contact-info-card:hover {
        transform: translateX(6px);
        border-color: rgba(201,149,91,.38);
        box-shadow: 0 18px 40px rgba(42,25,14,.09);
        background: #fff;
    }

    .contact-icon {
        flex: 0 0 54px;
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border: 1px solid #ead8c6;
        border-radius: 15px;
        color: #9a603b;
        background: #f8eee4;
        font-size: 18px;
        transition: .3s ease;
    }

    .contact-info-card:hover .contact-icon {
        color: #fff;
        border-color: var(--cp-dark);
        background: var(--cp-dark);
    }

    .contact-info-card small {
        display: block;
        margin-bottom: 4px;
        color: #9b9088;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .contact-info-card strong {
        display: block;
        color: var(--cp-dark);
        font-size: 14px;
        font-weight: 750;
        word-break: break-word;
    }

    /* =========================================================
       WHATSAPP CTA
    ========================================================= */

    .contact-bottom-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 25px;
        padding: 21px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 19px;
        color: #fff;
        background:
            radial-gradient(circle at 100% 0%, rgba(201,149,91,.16), transparent 35%),
            linear-gradient(135deg, #1b120d, #332016);
    }

    .contact-bottom-cta h5 {
        margin: 0 0 4px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 19px;
        font-weight: 500;
    }

    .contact-bottom-cta p {
        margin: 0;
        color: rgba(255,255,255,.5);
        font-size: 12px;
    }

    .whatsapp-btn {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 100px;
        color: #fff;
        background: #25d366;
        text-decoration: none;
        font-size: 11px;
        font-weight: 850;
        transition: .3s ease;
    }

    .whatsapp-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37,211,102,.24);
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .contact-form-card {
        position: relative;
        overflow: hidden;
        padding: 40px;
        border: 1px solid var(--cp-border);
        border-radius: 27px;
        background: #fff;
        box-shadow: 0 28px 75px rgba(42,25,14,.09);
    }

    .contact-form-card::before {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        top: -150px;
        right: -100px;
        border: 1px solid rgba(201,149,91,.12);
        border-radius: 50%;
    }

    .contact-form-card::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        bottom: -90px;
        left: -70px;
        border: 1px solid rgba(201,149,91,.1);
        border-radius: 50%;
    }

    .form-heading {
        position: relative;
        z-index: 1;
        margin-bottom: 30px;
    }

    .form-heading-label {
        color: #9a603b;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 1.7px;
        text-transform: uppercase;
    }

    .form-heading h2 {
        margin: 8px 0 7px;
        color: var(--cp-dark);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 31px;
        line-height: 1.1;
        font-weight: 500;
    }

    .form-heading p {
        margin: 0;
        color: #8b8179;
        font-size: 13px;
        line-height: 1.7;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-group {
        position: relative;
        z-index: 1;
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #40362f;
        font-size: 11px;
        font-weight: 850;
        letter-spacing: .2px;
    }

    .required {
        color: #b5523e;
    }

    .form-control-custom {
        width: 100%;
        min-height: 53px;
        padding: 13px 15px;
        border: 1px solid #e4dcd5;
        border-radius: 13px;
        outline: none;
        color: var(--cp-dark);
        background: #fcfaf7;
        font-size: 14px;
        transition: .25s ease;
    }

    .form-control-custom::placeholder {
        color: #aaa19b;
    }

    .form-control-custom:hover {
        border-color: #d8c7b8;
        background: #fff;
    }

    .form-control-custom:focus {
        border-color: var(--cp-gold);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(201,149,91,.11);
    }

    textarea.form-control-custom {
        min-height: 145px;
        resize: vertical;
        line-height: 1.7;
    }

    .btn-send {
        position: relative;
        z-index: 2;
        width: 100%;
        min-height: 54px;
        border: 0;
        border-radius: 100px;
        padding: 14px 24px;
        color: #24170f;
        background: linear-gradient(135deg, #e8c18f, #c9955b);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .2px;
        cursor: pointer;
        box-shadow: 0 13px 30px rgba(170,112,59,.2);
        transition: .3s ease;
    }

    .btn-send:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #f0d0a4, #d3a06a);
        box-shadow: 0 18px 35px rgba(170,112,59,.28);
    }

    .btn-send:active {
        transform: translateY(0);
    }

    .btn-send:disabled {
        opacity: .7;
        cursor: not-allowed;
        transform: none;
    }

    /* =========================================================
       ALERTS
    ========================================================= */

    .alert-custom {
        position: relative;
        z-index: 2;
        border: 0;
        border-radius: 13px;
        padding: 13px 15px;
        margin-bottom: 22px;
        font-size: 12px;
        line-height: 1.6;
    }

    .alert-success-custom {
        border: 1px solid #ccebd8;
        color: #24683f;
        background: #f0faf4;
    }

    .alert-error-custom {
        border: 1px solid #efd0d0;
        color: #963e3e;
        background: #fff5f5;
    }

    .alert-error-custom ul {
        margin-bottom: 0;
    }

    /* =========================================================
       FLOATING WHATSAPP
    ========================================================= */

    .floating-whatsapp {
        position: fixed;
        right: 22px;
        bottom: 22px;
        z-index: 999;
        width: 57px;
        height: 57px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 50%;
        color: #fff;
        background: #25d366;
        text-decoration: none;
        font-size: 22px;
        box-shadow: 0 10px 28px rgba(37,211,102,.3);
        animation: pulseWhatsApp 2.7s infinite;
        transition: .3s ease;
    }

    .floating-whatsapp:hover {
        color: #fff;
        transform: scale(1.08);
    }

    /* =========================================================
       ANIMATIONS
    ========================================================= */

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatGlow {
        0%, 100% {
            transform: translateY(-50%) translate(0, 0);
        }

        50% {
            transform: translateY(-50%) translate(25px, 20px);
        }
    }

    @keyframes contactRotate {
        from {
            transform: rotate(0);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes contactRotateReverse {
        from {
            transform: rotate(360deg);
        }

        to {
            transform: rotate(0);
        }
    }

    @keyframes pulseWhatsApp {
        0%, 100% {
            box-shadow: 0 10px 28px rgba(37,211,102,.3);
        }

        50% {
            box-shadow:
                0 10px 28px rgba(37,211,102,.3),
                0 0 0 12px rgba(37,211,102,.07);
        }
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .contact-hero {
            min-height: 500px;
        }

        .contact-section {
            padding: 80px 0;
        }

        .contact-form-card {
            padding: 32px;
        }
    }

    @media (max-width: 767px) {

        .contact-hero {
            min-height: 460px;
            background:
                linear-gradient(
                    90deg,
                    rgba(18,11,7,.95),
                    rgba(34,20,12,.76)
                ),
                url("{{ asset('images/contact-bg.jpg') }}") center/cover;
        }

        .hero-content {
            padding: 75px 0 65px;
        }

        .contact-hero h1 {
            font-size: 51px;
            letter-spacing: -2px;
        }

        .contact-hero p {
            font-size: 15px;
        }

        .contact-section {
            padding: 65px 0;
        }

        .contact-info-title {
            font-size: 41px;
        }

        .contact-form-card {
            padding: 27px 22px;
            border-radius: 22px;
        }
    }

    @media (max-width: 575px) {

        .contact-hero h1 {
            font-size: 45px;
        }

        .contact-hero p {
            font-size: 14px;
        }

        .contact-bottom-cta {
            flex-direction: column;
            align-items: stretch;
        }

        .whatsapp-btn {
            width: 100%;
        }

        .floating-whatsapp {
            right: 15px;
            bottom: 15px;
            width: 54px;
            height: 54px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .contact-page *,
        .contact-page *::before,
        .contact-page *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>


@php
    $phone = \App\Models\WebsiteSetting::get('phone');
    $email = \App\Models\WebsiteSetting::get('email');
    $whatsapp = \App\Models\WebsiteSetting::get('whatsapp');
@endphp


<div class="contact-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="contact-hero">

        <div class="hero-glow"></div>
        <div class="hero-glow-two"></div>

        <div class="container">

            <div class="hero-content">

                <div class="contact-breadcrumb">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>Contact</span>

                </div>

                <div class="hero-label">

                    <span></span>

                    Let's Talk

                </div>

                <h1>
                    Let's plan your
                    <br>
                    <span>perfect event.</span>
                </h1>

                <p>
                    Tell us what you have in mind and our catering team
                    will help you create a memorable food experience
                    for your guests.
                </p>

                <div class="hero-scroll">

                    <span class="hero-scroll-line"></span>

                    Start a conversation

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTACT CONTENT
    ====================================================== --}}

    <section class="contact-section">

        <div class="container">

            <div class="row g-5 align-items-start">

                {{-- =================================================
                     LEFT — CONTACT INFORMATION
                ================================================== --}}

                <div class="col-lg-5">

                    <div class="contact-intro-label">
                        Get In Touch
                    </div>

                    <h2 class="contact-info-title">
                        We'd love to hear from you.
                    </h2>

                    <p class="contact-info-description">
                        Whether you're planning a wedding, corporate event,
                        birthday party or a private celebration, share your
                        requirements with us. Our team will get back to you
                        and help you plan everything smoothly.
                    </p>


                    {{-- PHONE --}}

                    @if($phone)

                        <div class="contact-info-card">

                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>

                            <div>

                                <small>
                                    Call Us
                                </small>

                                <strong>
                                    {{ $phone }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    {{-- EMAIL --}}

                    @if($email)

                        <div class="contact-info-card">

                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>

                            <div>

                                <small>
                                    Email Us
                                </small>

                                <strong>
                                    {{ $email }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    {{-- WHATSAPP --}}

                    @if($whatsapp)

                        <div class="contact-info-card">

                            <div class="contact-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>

                            <div>

                                <small>
                                    WhatsApp
                                </small>

                                <strong>
                                    {{ $whatsapp }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    {{-- QUICK WHATSAPP CTA --}}

                    @if($whatsapp)

                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', $whatsapp);
                        @endphp

                        <div class="contact-bottom-cta">

                            <div>

                                <h5>
                                    Need a quick response?
                                </h5>

                                <p>
                                    Chat with our team directly on WhatsApp.
                                </p>

                            </div>

                            <a
                                href="https://wa.me/{{ $waNumber }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="whatsapp-btn"
                            >

                                <i class="bi bi-whatsapp"></i>

                                Chat Now

                            </a>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                     RIGHT — ENQUIRY FORM
                ================================================== --}}

                <div class="col-lg-7">

                    <div class="contact-form-card">

                        <div class="form-heading">

                            <div class="form-heading-label">
                                Event Enquiry
                            </div>

                            <h2>
                                Tell us about your event.
                            </h2>

                            <p>
                                Fill in your details and we'll get back to you shortly.
                            </p>

                        </div>


                        {{-- SUCCESS MESSAGE --}}

                        @if(session('success'))

                            <div class="alert-custom alert-success-custom">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                {{ session('success') }}

                            </div>

                        @endif


                        {{-- VALIDATION ERRORS --}}

                        @if($errors->any())

                            <div class="alert-custom alert-error-custom">

                                <strong>
                                    Please check the following:
                                </strong>

                                <ul class="mb-0 mt-2 ps-3">

                                    @foreach($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            method="POST"
                            action="{{ url('/contact') }}"
                            id="contactForm"
                        >

                            @csrf

                            <div class="row">


                                {{-- NAME --}}

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>
                                            Name
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ old('name') }}"
                                            class="form-control-custom"
                                            placeholder="Enter your name"
                                            required
                                            autocomplete="name"
                                        >

                                    </div>

                                </div>


                                {{-- PHONE --}}

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>
                                            Phone
                                        </label>

                                        <input
                                            type="tel"
                                            name="phone"
                                            value="{{ old('phone') }}"
                                            class="form-control-custom"
                                            placeholder="Enter phone number"
                                            autocomplete="tel"
                                        >

                                    </div>

                                </div>


                                {{-- EMAIL --}}

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>
                                            Email
                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            class="form-control-custom"
                                            placeholder="Enter email address"
                                            autocomplete="email"
                                        >

                                    </div>

                                </div>


                                {{-- SUBJECT --}}

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>
                                            Subject
                                        </label>

                                        <input
                                            type="text"
                                            name="subject"
                                            value="{{ old('subject') }}"
                                            class="form-control-custom"
                                            placeholder="e.g. Wedding Catering"
                                        >

                                    </div>

                                </div>


                                {{-- MESSAGE --}}

                                <div class="col-12">

                                    <div class="form-group">

                                        <label>
                                            Message
                                            <span class="required">*</span>
                                        </label>

                                        <textarea
                                            name="message"
                                            class="form-control-custom"
                                            placeholder="Tell us about your event, date, guest count, venue or any special requirements..."
                                            required
                                        >{{ old('message') }}</textarea>

                                    </div>

                                </div>

                            </div>


                            <button
                                type="submit"
                                class="btn-send"
                                id="sendEnquiryBtn"
                            >

                                <span class="btn-text">

                                    <i class="bi bi-send-fill me-2"></i>

                                    Send Enquiry

                                </span>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     FLOATING WHATSAPP
========================================================= --}}

@if($whatsapp)

    @php
        $waNumber = preg_replace('/[^0-9]/', '', $whatsapp);
    @endphp

    <a
        href="https://wa.me/{{ $waNumber }}"
        target="_blank"
        rel="noopener noreferrer"
        class="floating-whatsapp"
        aria-label="Chat on WhatsApp"
        title="Chat on WhatsApp"
    >
        <i class="bi bi-whatsapp"></i>
    </a>

@endif


<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('contactForm');
    const button = document.getElementById('sendEnquiryBtn');

    if (!form || !button) {
        return;
    }

    form.addEventListener('submit', function () {

        button.disabled = true;

        button.innerHTML = `
            <span>
                <span
                    class="spinner-border spinner-border-sm me-2"
                    role="status"
                    aria-hidden="true">
                </span>
                Sending...
            </span>
        `;

    });

});
</script>

@endsection