@extends('layouts.app')

@section('content')

<style>
    .service-page {
        background: #faf8f5;
    }

    .service-hero {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #24150f;
    }

    .service-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: .48;
    }

    .service-hero-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(25, 14, 9, .94) 0%, rgba(25, 14, 9, .72) 45%, rgba(25, 14, 9, .20) 100%);
    }

    .service-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 90px 0;
    }

    .service-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,.72);
        font-size: 14px;
        margin-bottom: 24px;
    }

    .service-breadcrumb a {
        color: #fff;
        text-decoration: none;
    }

    .service-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border: 1px solid rgba(255,255,255,.25);
        background: rgba(255,255,255,.08);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        font-size: 13px;
        letter-spacing: .4px;
        margin-bottom: 18px;
    }

    .service-hero h1 {
        font-size: clamp(42px, 6vw, 72px);
        line-height: 1.04;
        font-weight: 800;
        max-width: 850px;
        margin-bottom: 22px;
    }

    .service-hero-description {
        max-width: 720px;
        color: rgba(255,255,255,.82);
        font-size: 18px;
        line-height: 1.8;
    }

    .service-price {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-top: 28px;
        padding: 12px 18px;
        border-radius: 14px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.16);
        backdrop-filter: blur(10px);
    }

    .service-price small {
        color: rgba(255,255,255,.65);
    }

    .service-content {
        padding: 80px 0;
    }

    .service-info-card {
        background: #fff;
        border: 1px solid #eee5dc;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 15px 45px rgba(54, 30, 17, .07);
        position: sticky;
        top: 100px;
    }

    .service-info-card h4 {
        font-weight: 750;
        margin-bottom: 22px;
    }

    .service-feature {
        display: flex;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #f0e9e2;
    }

    .service-feature:last-child {
        border-bottom: 0;
    }

    .feature-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        border-radius: 12px;
        background: #f7eee7;
        color: #8a4b2c;
        display: grid;
        place-items: center;
        font-size: 18px;
    }

    .service-feature strong {
        display: block;
        margin-bottom: 3px;
    }

    .service-feature span {
        color: #777;
        font-size: 14px;
    }

    .service-main-image {
        width: 100%;
        height: 460px;
        object-fit: cover;
        border-radius: 26px;
        box-shadow: 0 20px 50px rgba(45, 25, 15, .12);
    }

    .service-fallback-image {
        height: 460px;
        border-radius: 26px;
        background:
            radial-gradient(circle at 20% 20%, rgba(255,255,255,.18), transparent 30%),
            linear-gradient(135deg, #5f2e19, #c8895d);
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 90px;
        box-shadow: 0 20px 50px rgba(45, 25, 15, .12);
    }

    .service-copy {
        padding-top: 36px;
    }

    .service-copy .eyebrow {
        color: #9a603b;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .service-copy h2 {
        font-size: clamp(30px, 4vw, 46px);
        font-weight: 800;
        margin: 10px 0 18px;
        color: #2a1a13;
    }

    .service-copy p {
        color: #6f6863;
        line-height: 1.9;
        font-size: 17px;
    }

    .service-cta {
        margin-top: 35px;
        padding: 50px;
        border-radius: 28px;
        background: linear-gradient(135deg, #3a2115, #704025);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .service-cta::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        right: -100px;
        top: -120px;
        background: rgba(255,255,255,.06);
    }

    .service-cta h3 {
        font-weight: 800;
        margin-bottom: 10px;
    }

    .service-cta p {
        color: rgba(255,255,255,.72);
        max-width: 600px;
    }

    .btn-service {
        background: #d79a68;
        color: #fff;
        border: 0;
        padding: 13px 24px;
        font-weight: 700;
        border-radius: 50px;
    }

    .btn-service:hover {
        background: #c98754;
        color: #fff;
    }

    .btn-outline-service {
        color: #fff;
        border: 1px solid rgba(255,255,255,.35);
        padding: 13px 24px;
        border-radius: 50px;
        font-weight: 600;
    }

    .btn-outline-service:hover {
        background: #fff;
        color: #3a2115;
    }

    .whatsapp-service {
        position: fixed;
        right: 22px;
        bottom: 22px;
        width: 54px;
        height: 54px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: #25d366;
        color: #fff;
        text-decoration: none;
        font-size: 25px;
        z-index: 1000;
        box-shadow: 0 8px 25px rgba(0,0,0,.18);
    }

    @media (max-width: 991px) {
        .service-info-card {
            position: static;
            margin-top: 35px;
        }

        .service-main-image,
        .service-fallback-image {
            height: 380px;
        }
    }

    @media (max-width: 575px) {
        .service-hero-content {
            padding: 70px 0;
        }

        .service-hero-description {
            font-size: 16px;
        }

        .service-content {
            padding: 55px 0;
        }

        .service-main-image,
        .service-fallback-image {
            height: 300px;
            border-radius: 20px;
        }

        .service-info-card {
            padding: 24px;
            border-radius: 20px;
        }

        .service-cta {
            padding: 32px 24px;
            border-radius: 22px;
        }

        .whatsapp-service {
            right: 15px;
            bottom: 15px;
        }
    }
</style>

<div class="service-page">

    {{-- HERO --}}
    <section class="service-hero">

        @if($service->image)
            <div
                class="service-hero-bg"
                style="background-image:url('{{ asset('storage/' . $service->image) }}');">
            </div>
        @endif

        <div class="service-hero-overlay"></div>

        <div class="container">
            <div class="service-hero-content">

                <div class="service-breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ url('/services') }}">Services</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>{{ $service->name }}</span>
                </div>

                <div class="service-label">
                    <i class="bi bi-stars"></i>
                    Premium Catering Service
                </div>

                <h1>{{ $service->name }}</h1>

                <p class="service-hero-description">
                    {{ $service->description }}
                </p>

                @if($service->price_from)
                    <div class="service-price">
                        <div>
                            <small>Starting from</small>
                            <div class="fs-4 fw-bold">
                                ₹{{ number_format($service->price_from) }}
                            </div>
                        </div>
                        <i class="bi bi-arrow-up-right fs-4"></i>
                    </div>
                @endif

            </div>
        </div>
    </section>


    {{-- MAIN CONTENT --}}
    <section class="service-content">

        <div class="container">

            <div class="row g-5 align-items-start">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    @if($service->image)

                        <img
                            src="{{ asset('storage/' . $service->image) }}"
                            class="service-main-image"
                            alt="{{ $service->name }}">

                    @else

                        <div class="service-fallback-image">
                            <i class="bi bi-cup-hot"></i>
                        </div>

                    @endif


                    <div class="service-copy">

                        <div class="eyebrow">
                            What we offer
                        </div>

                        <h2>
                            Delicious food.
                            Beautifully served.
                        </h2>

                        <p>
                            {{ $service->description }}
                        </p>

                        <div class="row g-3 mt-3">

                            <div class="col-md-6">
                                <div class="service-feature">
                                    <div class="feature-icon">
                                        <i class="bi bi-check2-circle"></i>
                                    </div>
                                    <div>
                                        <strong>Freshly Prepared</strong>
                                        <span>Quality ingredients and carefully prepared menus.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="service-feature">
                                    <div class="feature-icon">
                                        <i class="bi bi-menu-button-wide"></i>
                                    </div>
                                    <div>
                                        <strong>Custom Menu</strong>
                                        <span>Build a menu according to your event and guests.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="service-feature">
                                    <div class="feature-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div>
                                        <strong>Professional Team</strong>
                                        <span>Experienced staff handling your event professionally.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="service-feature">
                                    <div class="feature-icon">
                                        <i class="bi bi-heart"></i>
                                    </div>
                                    <div>
                                        <strong>Memorable Experience</strong>
                                        <span>We take care of the details while you enjoy the event.</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- RIGHT CARD --}}
                <div class="col-lg-4">

                    <div class="service-info-card">

                        <h4>
                            Plan your event
                        </h4>

                        <p class="text-muted mb-4">
                            Tell us about your event and our team will help you create the perfect menu.
                        </p>

                        <div class="service-feature">
                            <div class="feature-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div>
                                <strong>Choose your date</strong>
                                <span>Tell us when your event is happening.</span>
                            </div>
                        </div>

                        <div class="service-feature">
                            <div class="feature-icon">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div>
                                <strong>Guest count</strong>
                                <span>We'll recommend the right quantity and menu.</span>
                            </div>
                        </div>

                        <div class="service-feature">
                            <div class="feature-icon">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div>
                                <strong>Get a quotation</strong>
                                <span>Receive a personalised proposal for your event.</span>
                            </div>
                        </div>

                        <a
                            href="{{ url('/login') }}"
                            class="btn btn-service w-100 mt-4">
                            Request Booking
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <a
                            href="{{ url('/services') }}"
                            class="btn btn-light rounded-pill w-100 mt-2">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back to Services
                        </a>

                    </div>

                </div>

            </div>


            {{-- CTA --}}
            <div class="service-cta mt-5">

                <div class="row align-items-center g-4">

                    <div class="col-lg-8">

                        <div class="text-uppercase small fw-bold opacity-75 mb-2">
                            Ready to celebrate?
                        </div>

                        <h3>
                            Let's create a menu your guests will remember.
                        </h3>

                        <p class="mb-0">
                            Share your event details with us and we'll help you plan
                            the food, service and experience.
                        </p>

                    </div>

                    <div class="col-lg-4">

                        <div class="d-flex flex-wrap gap-2 justify-content-lg-end">

                            <a
                                href="{{ url('/login') }}"
                                class="btn btn-service">
                                Start Planning
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>

                            <a
                                href="{{ url('/contact') }}"
                                class="btn btn-outline-service">
                                Contact Us
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


{{-- WhatsApp --}}
@php
    $whatsapp = \App\Models\WebsiteSetting::get('whatsapp');
@endphp

@if($whatsapp)

    <a
        href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}"
        target="_blank"
        rel="noopener"
        class="whatsapp-service"
        aria-label="Chat on WhatsApp">

        <i class="bi bi-whatsapp"></i>

    </a>

@endif

@endsection