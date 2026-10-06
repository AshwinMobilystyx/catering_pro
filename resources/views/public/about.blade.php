@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       CATERING PRO — PREMIUM ABOUT PAGE
    ========================================================= */

    .about-page {
        --about-dark: #17110e;
        --about-dark-2: #2a1a12;
        --about-brown: #5b3520;
        --about-gold: #c9955b;
        --about-gold-light: #e8c18f;
        --about-cream: #fbf8f3;
        --about-paper: #fffdf9;
        --about-border: #eadfd3;
        --about-muted: #756d67;

        background: var(--about-cream);
        color: var(--about-dark);
        overflow: hidden;
    }

    .about-page *,
    .about-page *::before,
    .about-page *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .about-hero {
        position: relative;
        min-height: 590px;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        background:
            linear-gradient(
                90deg,
                rgba(18,11,7,.96) 0%,
                rgba(31,18,11,.89) 42%,
                rgba(43,25,15,.64) 75%,
                rgba(43,25,15,.48) 100%
            ),
            url("{{ asset('images/about-catering-pro.jpg') }}") center/cover;
    }

    .about-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .065;
        background-image:
            linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(to bottom, black, transparent);
    }

    .about-hero::after {
        content: "";
        position: absolute;
        width: 620px;
        height: 620px;
        right: -280px;
        top: -260px;
        border: 1px solid rgba(255,255,255,.11);
        border-radius: 50%;
        box-shadow:
            0 0 0 75px rgba(255,255,255,.018),
            0 0 0 150px rgba(255,255,255,.012);
        animation: aboutRotate 24s linear infinite;
    }

    .about-glow {
        position: absolute;
        width: 460px;
        height: 460px;
        right: 8%;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        background: rgba(201,149,91,.13);
        filter: blur(85px);
        animation: aboutGlow 8s ease-in-out infinite;
    }

    .about-glow-two {
        position: absolute;
        width: 320px;
        height: 320px;
        left: -130px;
        bottom: -170px;
        border-radius: 50%;
        border: 1px solid rgba(201,149,91,.13);
        animation: aboutRotateReverse 19s linear infinite;
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        padding: 105px 0 95px;
    }

    .about-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
        color: rgba(255,255,255,.55);
        font-size: 13px;
    }

    .about-breadcrumb a {
        color: #fff;
        text-decoration: none;
        transition: .25s ease;
    }

    .about-breadcrumb a:hover {
        color: var(--about-gold-light);
    }

    .about-label {
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

    .about-label span {
        width: 7px;
        height: 7px;
        flex: 0 0 7px;
        border-radius: 50%;
        background: var(--about-gold-light);
        box-shadow: 0 0 14px rgba(232,193,143,.8);
    }

    .about-hero h1 {
        max-width: 850px;
        margin: 22px 0 20px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(50px, 7vw, 88px);
        line-height: .96;
        font-weight: 500;
        letter-spacing: -3px;
        animation: aboutFadeUp .8s ease both;
    }

    .about-hero h1 span {
        color: var(--about-gold-light);
        font-style: italic;
    }

    .about-hero p {
        max-width: 680px;
        margin: 0;
        color: rgba(255,255,255,.68);
        font-size: 17px;
        line-height: 1.85;
        animation: aboutFadeUp 1s ease both;
    }

    .about-scroll {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 34px;
        color: rgba(255,255,255,.5);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .about-scroll-line {
        width: 38px;
        height: 1px;
        background: rgba(255,255,255,.3);
    }

    /* =========================================================
       STORY
    ========================================================= */

    .about-section {
        position: relative;
        padding: 105px 0;
    }

    .about-image-wrap {
        position: relative;
        padding-right: 25px;
    }

    .about-image {
        position: relative;
        min-height: 550px;
        overflow: hidden;
        border-radius: 26px;
        background: #e8ddd3;
        box-shadow: 0 28px 70px rgba(42,25,14,.13);
    }

    .about-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            transparent 55%,
            rgba(20,10,5,.48)
        );
        pointer-events: none;
    }

    .about-image img {
        display: block;
        width: 100%;
        height: 100%;
        min-height: 550px;
        object-fit: cover;
        transition: transform .8s cubic-bezier(.2,.8,.2,1);
    }

    .about-image:hover img {
        transform: scale(1.045);
    }

    .image-badge {
        position: absolute;
        z-index: 2;
        left: 25px;
        bottom: 25px;
        min-width: 175px;
        padding: 18px 20px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 18px;
        background: rgba(20,12,8,.72);
        color: #fff;
        backdrop-filter: blur(15px);
    }

    .image-badge strong {
        display: block;
        margin-bottom: 4px;
        color: var(--about-gold-light);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 24px;
        font-weight: 500;
    }

    .image-badge small {
        color: rgba(255,255,255,.62);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .about-content {
        padding-left: 25px;
    }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #9a603b;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .section-label::before {
        content: "";
        width: 28px;
        height: 1px;
        background: var(--about-gold);
    }

    .about-content h2 {
        margin: 13px 0 20px;
        color: var(--about-dark);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(38px, 5vw, 58px);
        line-height: 1.03;
        font-weight: 500;
        letter-spacing: -1.8px;
    }

    .about-content h2 span {
        color: #a96e3c;
        font-style: italic;
    }

    .about-description {
        max-width: 620px;
        color: var(--about-muted);
        font-size: 16px;
        line-height: 1.9;
        white-space: pre-line;
    }

    /* =========================================================
       FEATURES
    ========================================================= */

    .about-features {
        margin-top: 38px;
        padding-top: 30px;
        border-top: 1px solid var(--about-border);
    }

    .about-feature {
        display: flex;
        gap: 15px;
        margin-bottom: 22px;
    }

    .about-feature:last-child {
        margin-bottom: 0;
    }

    .feature-icon {
        flex: 0 0 48px;
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        border: 1px solid #ead8c6;
        border-radius: 14px;
        color: #9a603b;
        background: #f8eee4;
        font-size: 17px;
        transition: .3s ease;
    }

    .about-feature:hover .feature-icon {
        color: #fff;
        background: var(--about-dark);
        border-color: var(--about-dark);
        transform: translateY(-3px);
    }

    .about-feature h5 {
        margin: 0 0 5px;
        color: var(--about-dark);
        font-size: 14px;
        font-weight: 850;
    }

    .about-feature p {
        max-width: 450px;
        margin: 0;
        color: #8b817a;
        font-size: 13px;
        line-height: 1.7;
    }

    /* =========================================================
       STATS
    ========================================================= */

    .stats-section {
        padding: 0 0 105px;
    }

    .stats-wrap {
        padding: 8px;
        border: 1px solid var(--about-border);
        border-radius: 25px;
        background: rgba(255,255,255,.55);
    }

    .stat-card {
        height: 100%;
        padding: 30px 18px;
        text-align: center;
        border-radius: 19px;
        background: #fff;
        transition: .35s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(42,25,14,.08);
    }

    .stat-number {
        margin-bottom: 8px;
        color: #a96e3c;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 37px;
        line-height: 1;
        font-weight: 500;
    }

    .stat-title {
        color: #8b8179;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 1.1px;
        text-transform: uppercase;
    }

    /* =========================================================
       VALUES
    ========================================================= */

    .values-section {
        position: relative;
        padding: 105px 0;
        overflow: hidden;
        color: #fff;
        background:
            radial-gradient(circle at 85% 15%, rgba(201,149,91,.14), transparent 30%),
            linear-gradient(135deg, #17110e, #2b1a12);
    }

    .values-section::before {
        content: "";
        position: absolute;
        width: 600px;
        height: 600px;
        right: -280px;
        top: -320px;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 50%;
    }

    .values-section::after {
        content: "";
        position: absolute;
        inset: 0;
        opacity: .025;
        background-image:
            linear-gradient(rgba(255,255,255,.6) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.6) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
    }

    .values-heading {
        position: relative;
        z-index: 1;
        max-width: 730px;
        margin: 0 auto 55px;
        text-align: center;
    }

    .values-heading .section-label {
        color: var(--about-gold-light);
    }

    .values-heading .section-label::before {
        background: var(--about-gold);
    }

    .values-heading h2 {
        margin: 13px 0 14px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(38px, 5vw, 58px);
        line-height: 1.05;
        font-weight: 500;
        letter-spacing: -1.5px;
    }

    .values-heading p {
        margin: 0 auto;
        max-width: 650px;
        color: rgba(255,255,255,.57);
        line-height: 1.8;
        font-size: 15px;
    }

    .value-card {
        position: relative;
        z-index: 1;
        height: 100%;
        padding: 32px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 22px;
        background: rgba(255,255,255,.045);
        backdrop-filter: blur(10px);
        transition: .4s ease;
    }

    .value-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -45px;
        bottom: -45px;
        border: 1px solid rgba(201,149,91,.13);
        border-radius: 50%;
    }

    .value-card:hover {
        transform: translateY(-8px);
        border-color: rgba(201,149,91,.3);
        background: rgba(255,255,255,.07);
        box-shadow: 0 22px 50px rgba(0,0,0,.16);
    }

    .value-icon {
        width: 56px;
        height: 56px;
        display: grid;
        place-items: center;
        margin-bottom: 22px;
        border: 1px solid rgba(201,149,91,.18);
        border-radius: 16px;
        color: var(--about-gold-light);
        background: rgba(201,149,91,.1);
        font-size: 19px;
    }

    .value-card h4 {
        margin-bottom: 10px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 22px;
        font-weight: 500;
    }

    .value-card p {
        margin: 0;
        color: rgba(255,255,255,.52);
        font-size: 13px;
        line-height: 1.8;
    }

    /* =========================================================
       CTA
    ========================================================= */

    .about-cta {
        padding: 95px 0;
        background: var(--about-cream);
    }

    .cta-box {
        position: relative;
        overflow: hidden;
        padding: 65px 35px;
        border-radius: 30px;
        text-align: center;
        color: #fff;
        background:
            radial-gradient(circle at 90% 10%, rgba(232,193,143,.2), transparent 27%),
            linear-gradient(135deg, #21140e, #5b3520);
        box-shadow: 0 28px 70px rgba(42,25,14,.14);
    }

    .cta-box::before {
        content: "";
        position: absolute;
        width: 330px;
        height: 330px;
        left: -190px;
        bottom: -220px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 50%;
    }

    .cta-box::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        right: -90px;
        top: -130px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 50%;
    }

    .cta-box .section-label {
        position: relative;
        z-index: 1;
        color: var(--about-gold-light);
        justify-content: center;
    }

    .cta-box .section-label::before {
        background: var(--about-gold-light);
    }

    .cta-box h2 {
        position: relative;
        z-index: 1;
        margin: 13px 0 12px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(36px, 5vw, 55px);
        line-height: 1.05;
        font-weight: 500;
        letter-spacing: -1.5px;
    }

    .cta-box p {
        position: relative;
        z-index: 1;
        max-width: 650px;
        margin: 0 auto 30px;
        color: rgba(255,255,255,.62);
        line-height: 1.8;
        font-size: 15px;
    }

    .cta-btn {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 14px 24px;
        border-radius: 100px;
        color: #24170f;
        background: var(--about-gold-light);
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
        transition: .3s ease;
        box-shadow: 0 12px 30px rgba(0,0,0,.18);
    }

    .cta-btn:hover {
        color: #24170f;
        background: #fff;
        transform: translateY(-3px);
    }

    /* =========================================================
       ANIMATIONS
    ========================================================= */

    @keyframes aboutFadeUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes aboutGlow {
        0%, 100% {
            transform: translateY(-50%) translate(0, 0);
        }

        50% {
            transform: translateY(-50%) translate(25px, 18px);
        }
    }

    @keyframes aboutRotate {
        from {
            transform: rotate(0);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes aboutRotateReverse {
        from {
            transform: rotate(360deg);
        }

        to {
            transform: rotate(0);
        }
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .about-hero {
            min-height: 510px;
        }

        .about-image-wrap {
            padding-right: 0;
        }

        .about-content {
            padding-left: 0;
        }

        .about-image,
        .about-image img {
            min-height: 460px;
        }

        .about-section {
            padding: 80px 0;
        }

        .stats-section {
            padding-bottom: 80px;
        }
    }

    @media (max-width: 767px) {

        .about-hero {
            min-height: 470px;
            background:
                linear-gradient(
                    90deg,
                    rgba(18,11,7,.94),
                    rgba(31,18,11,.76)
                ),
                url("{{ asset('images/about-catering-pro.jpg') }}") center/cover;
        }

        .about-hero-content {
            padding: 75px 0 65px;
        }

        .about-hero h1 {
            font-size: 52px;
            letter-spacing: -2px;
        }

        .about-hero p {
            font-size: 15px;
        }

        .about-section {
            padding: 65px 0;
        }

        .about-image,
        .about-image img {
            min-height: 360px;
        }

        .about-content h2 {
            font-size: 41px;
        }

        .stats-section {
            padding-bottom: 65px;
        }

        .stat-number {
            font-size: 31px;
        }

        .values-section {
            padding: 70px 0;
        }

        .values-heading {
            margin-bottom: 38px;
        }

        .value-card {
            padding: 27px;
        }

        .about-cta {
            padding: 65px 0;
        }

        .cta-box {
            padding: 45px 23px;
            border-radius: 24px;
        }
    }

    @media (max-width: 480px) {

        .about-hero h1 {
            font-size: 45px;
        }

        .about-label {
            font-size: 9px;
        }

        .about-image,
        .about-image img {
            min-height: 320px;
        }

        .image-badge {
            left: 15px;
            bottom: 15px;
        }

        .about-content h2 {
            font-size: 37px;
        }

        .cta-btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .about-page *,
        .about-page *::before,
        .about-page *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>


@php
    $about = \App\Models\WebsiteSetting::get('about');
@endphp


<div class="about-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="about-hero">

        <div class="about-glow"></div>
        <div class="about-glow-two"></div>

        <div class="container">

            <div class="about-hero-content">

                <div class="about-breadcrumb">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>About Us</span>

                </div>

                <div class="about-label">

                    <span></span>

                    Our Story

                </div>

                <h1>
                    Food that brings
                    <br>
                    <span>people together.</span>
                </h1>

                <p>
                    We create memorable catering experiences with delicious
                    food, thoughtful presentation and service that makes
                    every celebration special.
                </p>

                <div class="about-scroll">

                    <span class="about-scroll-line"></span>

                    Discover our story

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         ABOUT STORY
    ====================================================== --}}

    <section class="about-section">

        <div class="container">

            <div class="row align-items-center g-5">

                {{-- IMAGE --}}

                <div class="col-lg-6">

                    <div class="about-image-wrap">

                        <div class="about-image">

                            <img
                                src="{{ asset('images/about-catering-pro.jpg') }}"
                                alt="Catering team preparing food"
                                loading="lazy"
                            >

                            <div class="image-badge">

                                <strong>Premium</strong>

                                <small>
                                    Catering Experience
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- CONTENT --}}

                <div class="col-lg-6">

                    <div class="about-content">

                        <div class="section-label">
                            About Us
                        </div>

                        <h2>
                            More than food.
                            <br>
                            <span>It's an experience.</span>
                        </h2>

                        @if($about)

                            <div class="about-description">
                                {{ $about }}
                            </div>

                        @else

                            <p class="about-description">
                                We are passionate about creating exceptional
                                food experiences for weddings, corporate events,
                                private celebrations and special occasions.
                            </p>

                        @endif


                        <div class="about-features">

                            <div class="about-feature">

                                <div class="feature-icon">
                                    <i class="bi bi-stars"></i>
                                </div>

                                <div>

                                    <h5>
                                        Quality Ingredients
                                    </h5>

                                    <p>
                                        Carefully selected ingredients prepared
                                        with attention to taste and quality.
                                    </p>

                                </div>

                            </div>


                            <div class="about-feature">

                                <div class="feature-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>

                                <div>

                                    <h5>
                                        Professional Service
                                    </h5>

                                    <p>
                                        A trained team focused on making your
                                        event smooth and memorable.
                                    </p>

                                </div>

                            </div>


                            <div class="about-feature">

                                <div class="feature-icon">
                                    <i class="bi bi-heart-fill"></i>
                                </div>

                                <div>

                                    <h5>
                                        Made With Passion
                                    </h5>

                                    <p>
                                        Every menu is prepared with care,
                                        creativity and attention to detail.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         STATS
    ====================================================== --}}

    <section class="stats-section">

        <div class="container">

            <div class="stats-wrap">

                <div class="row g-2">

                    <div class="col-6 col-lg-3">

                        <div class="stat-card">

                            <div class="stat-number">
                                500+
                            </div>

                            <div class="stat-title">
                                Events Catered
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-lg-3">

                        <div class="stat-card">

                            <div class="stat-number">
                                50+
                            </div>

                            <div class="stat-title">
                                Menu Options
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-lg-3">

                        <div class="stat-card">

                            <div class="stat-number">
                                10K+
                            </div>

                            <div class="stat-title">
                                Guests Served
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-lg-3">

                        <div class="stat-card">

                            <div class="stat-number">
                                100%
                            </div>

                            <div class="stat-title">
                                Commitment
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         VALUES
    ====================================================== --}}

    <section class="values-section">

        <div class="container">

            <div class="values-heading">

                <div class="section-label">
                    What We Believe
                </div>

                <h2>
                    Our values are on the menu.
                </h2>

                <p>
                    Great catering is not only about what is served on the plate.
                    It is about the experience, the people and the little details
                    that guests remember.
                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-4">

                    <div class="value-card">

                        <div class="value-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>

                        <h4>
                            Quality First
                        </h4>

                        <p>
                            From ingredients to presentation, we never compromise
                            on the quality of what we serve.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="value-card">

                        <div class="value-icon">
                            <i class="bi bi-person-heart"></i>
                        </div>

                        <h4>
                            Customer Focus
                        </h4>

                        <p>
                            Every event is different. We listen carefully and
                            create a catering experience around your needs.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="value-card">

                        <div class="value-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>

                        <h4>
                            Reliable Service
                        </h4>

                        <p>
                            Our team takes care of the details so you can focus
                            on enjoying your event with your guests.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CTA
    ====================================================== --}}

    <section class="about-cta">

        <div class="container">

            <div class="cta-box">

                <div class="section-label">
                    Let's Create Something Special
                </div>

                <h2>
                    Planning something special?
                </h2>

                <p>
                    Let's create a menu and catering experience that your
                    guests will remember long after the event is over.
                </p>

                <a
                    href="{{ url('/contact') }}"
                    class="cta-btn"
                >
                    Plan Your Event

                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>

</div>

@endsection