@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       PREMIUM CATERING PACKAGES PAGE
       ========================================================= */

    .packages-page {
        --ink: #171411;
        --ink-soft: #2b211a;
        --cream: #f7f3ec;
        --paper: #fffdf9;
        --gold: #c69a61;
        --gold-light: #e4c28e;
        --brown: #71472d;
        --muted: #756d65;
        --line: #e8ded2;
        --green: #4d814b;

        min-height: 100vh;
        overflow: hidden;
        background: var(--paper);
        color: var(--ink);
    }

    /* =========================================================
       HERO
       ========================================================= */

    .packages-hero {
        position: relative;
        min-height: 610px;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        background:
            radial-gradient(
                circle at 84% 18%,
                rgba(198,154,97,.25),
                transparent 28%
            ),
            radial-gradient(
                circle at 12% 90%,
                rgba(198,154,97,.10),
                transparent 25%
            ),
            linear-gradient(
                125deg,
                #100d0a,
                #211812 48%,
                #40291b
            );
    }

    .packages-hero::before {
        content: "";
        position: absolute;
        width: 650px;
        height: 650px;
        right: -310px;
        top: -300px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
        box-shadow:
            0 0 0 80px rgba(255,255,255,.014),
            0 0 0 160px rgba(255,255,255,.01);
        animation: rotateSlow 25s linear infinite;
    }

    .packages-hero::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        left: -175px;
        bottom: -185px;
        border: 1px solid rgba(198,154,97,.2);
        border-radius: 50%;
    }

    .packages-grid {
        position: absolute;
        inset: 0;
        opacity: .035;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(255,255,255,.45) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.45) 1px, transparent 1px);
        background-size: 60px 60px;
        mask-image: linear-gradient(
            to bottom,
            black,
            transparent
        );
    }

    .hero-line {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 1px;
        background: linear-gradient(
            to bottom,
            transparent,
            rgba(255,255,255,.08),
            transparent
        );
    }

    .hero-line.one {
        left: 17%;
    }

    .hero-line.two {
        left: 80%;
    }

    .packages-hero-content {
        position: relative;
        z-index: 3;
        padding: 105px 0 100px;
    }

    .packages-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 28px;
        color: rgba(255,255,255,.52);
        font-size: 13px;
    }

    .packages-breadcrumb a {
        color: rgba(255,255,255,.86);
        text-decoration: none;
        transition: color .25s ease;
    }

    .packages-breadcrumb a:hover {
        color: var(--gold-light);
    }

    .packages-kicker {
        display: inline-flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 23px;
        color: var(--gold-light);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2.5px;
    }

    .packages-kicker::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--gold);
    }

    .packages-title {
        max-width: 920px;
        margin: 0 0 25px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(55px, 8vw, 100px);
        line-height: .94;
        font-weight: 400;
        letter-spacing: -3px;
    }

    .packages-title em {
        color: var(--gold-light);
        font-style: italic;
    }

    .packages-subtitle {
        max-width: 700px;
        margin: 0;
        color: rgba(255,255,255,.66);
        font-size: 17px;
        line-height: 1.9;
    }

    .hero-note {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 37px;
        color: rgba(255,255,255,.44);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .hero-note i {
        color: var(--gold);
        font-size: 17px;
    }

    /* =========================================================
       CONTENT
       ========================================================= */

    .packages-content {
        padding: 95px 0 115px;
        background: var(--paper);
    }

    .section-heading {
        max-width: 780px;
        margin: 0 auto 58px;
        text-align: center;
    }

    .eyebrow {
        color: var(--brown);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2.2px;
    }

    .section-heading h2 {
        margin: 12px 0 17px;
        color: var(--ink);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(36px, 5vw, 58px);
        font-weight: 400;
        line-height: 1.05;
        letter-spacing: -1.5px;
    }

    .section-heading h2 em {
        color: var(--brown);
        font-style: italic;
    }

    .section-heading p {
        margin: 0;
        color: var(--muted);
        font-size: 16px;
        line-height: 1.85;
    }

    /* =========================================================
       PACKAGE CARD
       ========================================================= */

    .package-wrapper {
        height: 100%;
        animation: cardReveal .7s ease both;
    }

    .package-card {
        position: relative;
        height: 100%;
        min-height: 625px;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 15px 45px rgba(40,25,15,.055);
        transition:
            transform .45s cubic-bezier(.2,.8,.2,1),
            box-shadow .45s ease,
            border-color .3s ease;
    }

    .package-card:hover {
        transform: translateY(-10px);
        border-color: rgba(198,154,97,.48);
        box-shadow: 0 30px 70px rgba(40,25,15,.13);
    }

    .package-card.popular {
        border: 2px solid var(--gold);
        transform: translateY(-8px);
        box-shadow: 0 28px 70px rgba(130,72,39,.13);
    }

    .package-card.popular:hover {
        transform: translateY(-17px);
    }

    /* =========================================================
       PACKAGE IMAGE
       ========================================================= */

    .package-image {
        position: relative;
        height: 240px;
        overflow: hidden;
        background:
            linear-gradient(
                135deg,
                #2d1a0f,
                #9d6540
            );
    }

    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition:
            transform .8s cubic-bezier(.2,.8,.2,1),
            filter .5s ease;
    }

    .package-card:hover .package-image img {
        transform: scale(1.08);
        filter: saturate(1.08);
    }

    .package-image::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(
                to top,
                rgba(15,9,5,.58),
                transparent 60%
            );
    }

    .package-image::before {
        content: "";
        position: absolute;
        z-index: 3;
        top: -20%;
        left: -130%;
        width: 75px;
        height: 160%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.22),
            transparent
        );
        transform: rotate(20deg);
        transition: left .9s ease;
    }

    .package-card:hover .package-image::before {
        left: 125%;
    }

    /* =========================================================
       BADGES
       ========================================================= */

    .popular-badge {
        position: absolute;
        z-index: 5;
        top: 17px;
        left: 17px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 3px;
        background: var(--gold);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        box-shadow: 0 8px 22px rgba(0,0,0,.16);
    }

    .popular-badge i {
        font-size: 12px;
    }

    .package-index {
        position: absolute;
        z-index: 5;
        top: 17px;
        right: 17px;
        width: 43px;
        height: 43px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.24);
        border-radius: 50%;
        background: rgba(25,14,8,.62);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* =========================================================
       BODY
       ========================================================= */

    .package-body {
        min-height: 385px;
        display: flex;
        flex-direction: column;
        padding: 30px;
    }

    .package-name {
        margin: 0 0 9px;
        color: var(--ink);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 29px;
        font-weight: 400;
        line-height: 1.1;
    }

    .package-description {
        min-height: 48px;
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.75;
    }

    .package-price {
        display: flex;
        align-items: baseline;
        gap: 6px;
        margin: 21px 0 17px;
        padding-bottom: 17px;
        border-bottom: 1px solid #eee6de;
    }

    .package-price strong {
        color: var(--brown);
        font-size: 38px;
        font-weight: 800;
        line-height: 1;
    }

    .package-price span {
        color: #8e847b;
        font-size: 12px;
    }

    .guest-range {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 13px;
        margin-bottom: 17px;
        border: 1px solid #e9dfd5;
        border-radius: 3px;
        background: #faf6f1;
        color: #624b3d;
        font-size: 12px;
        font-weight: 700;
    }

    .guest-range i {
        color: var(--brown);
        font-size: 15px;
    }

    .package-features {
        padding: 0;
        margin: 0 0 23px;
        list-style: none;
    }

    .package-features li {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 6px 0;
        color: #5f5752;
        font-size: 13px;
        line-height: 1.5;
    }

    .package-features li i {
        flex: 0 0 auto;
        margin-top: 1px;
        color: var(--green);
        font-size: 14px;
    }

    .package-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        width: 100%;
        margin-top: auto;
        padding: 14px 20px;
        border: 1px solid var(--ink);
        border-radius: 50px;
        background: var(--ink);
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        transition: all .3s ease;
    }

    .package-button:hover {
        border-color: var(--brown);
        background: var(--brown);
        color: #fff;
        transform: translateY(-2px);
    }

    .package-button i {
        transition: transform .3s ease;
    }

    .package-button:hover i {
        transform: translateX(4px);
    }

    /* =========================================================
       COMPARISON STRIP
       ========================================================= */

    .compare-strip {
        margin-top: 70px;
        padding: 30px;
        border: 1px solid var(--line);
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 12px 35px rgba(40,25,15,.045);
    }

    .compare-item {
        display: flex;
        align-items: center;
        gap: 13px;
        color: #665b54;
        font-size: 13px;
    }

    .compare-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #f7eee5;
        color: var(--brown);
        font-size: 16px;
    }

    .compare-item strong {
        margin-bottom: 3px;
        color: var(--ink);
        font-size: 13px;
    }

    .compare-item span {
        color: #928981;
        font-size: 11px;
    }

    /* =========================================================
       CTA
       ========================================================= */

    .packages-cta {
        position: relative;
        overflow: hidden;
        margin-top: 80px;
        padding: 68px;
        border-radius: 5px;
        background:
            radial-gradient(
                circle at 90% 15%,
                rgba(228,194,142,.22),
                transparent 27%
            ),
            linear-gradient(
                120deg,
                #15110d,
                #352317
            );
        color: #fff;
    }

    .packages-cta::before {
        content: "";
        position: absolute;
        width: 370px;
        height: 370px;
        right: -190px;
        bottom: -210px;
        border: 1px solid rgba(228,194,142,.18);
        border-radius: 50%;
    }

    .packages-cta::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: 100px;
        top: -100px;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 50%;
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }

    .cta-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        color: var(--gold-light);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .cta-label::before {
        content: "";
        width: 30px;
        height: 1px;
        background: var(--gold);
    }

    .packages-cta h3 {
        max-width: 700px;
        margin: 0 0 15px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(35px, 5vw, 57px);
        font-weight: 400;
        line-height: 1.04;
    }

    .packages-cta p {
        max-width: 640px;
        margin: 0;
        color: rgba(255,255,255,.62);
        line-height: 1.85;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 15px 25px;
        border-radius: 50px;
        background: var(--gold);
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        transition: all .3s ease;
    }

    .cta-button:hover {
        background: var(--gold-light);
        color: #211710;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,.25);
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .empty-packages {
        padding: 90px 20px;
        border: 1px dashed #d8ccbf;
        border-radius: 5px;
        background: #fff;
        text-align: center;
    }

    .empty-icon {
        width: 78px;
        height: 78px;
        display: grid;
        place-items: center;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #f4ece3;
        color: var(--brown);
        font-size: 29px;
    }

    .empty-packages h3 {
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 28px;
        font-weight: 400;
    }

    .empty-packages p {
        margin: 0;
        color: var(--muted);
    }

    /* =========================================================
       ANIMATIONS
       ========================================================= */

    @keyframes rotateSlow {
        from {
            transform: rotate(0);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes cardReveal {
        from {
            opacity: 0;
            transform: translateY(28px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
            scroll-behavior: auto !important;
        }
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .package-card.popular,
        .package-card.popular:hover {
            transform: none;
        }

        .package-card {
            min-height: 600px;
        }

        .compare-strip {
            padding: 25px;
        }
    }

    @media (max-width: 767px) {

        .packages-hero {
            min-height: 550px;
        }

        .packages-hero-content {
            padding: 80px 0;
        }

        .packages-title {
            font-size: 55px;
            letter-spacing: -2px;
        }

        .packages-subtitle {
            font-size: 15px;
            line-height: 1.8;
        }

        .packages-content {
            padding: 70px 0 80px;
        }

        .package-image {
            height: 225px;
        }

        .package-body {
            min-height: 365px;
        }

        .packages-cta {
            padding: 45px 28px;
        }
    }

    @media (max-width: 575px) {

        .packages-hero {
            min-height: 500px;
        }

        .packages-hero-content {
            padding: 65px 0;
        }

        .packages-title {
            font-size: 46px;
            letter-spacing: -1.5px;
        }

        .hero-note {
            line-height: 1.6;
        }

        .packages-content {
            padding: 60px 0 75px;
        }

        .package-image {
            height: 205px;
        }

        .package-body {
            min-height: 0;
            padding: 25px;
        }

        .package-name {
            font-size: 26px;
        }

        .package-price strong {
            font-size: 34px;
        }

        .compare-strip {
            padding: 22px;
        }

        .compare-item {
            align-items: flex-start;
        }

        .packages-cta {
            padding: 38px 24px;
        }
    }
</style>


<div class="packages-page">

    {{-- =====================================================
         HERO
         ===================================================== --}}
    <section class="packages-hero">

        <div class="packages-grid"></div>

        <div class="hero-line one"></div>
        <div class="hero-line two"></div>

        <div class="container">

            <div class="packages-hero-content">

                <div class="packages-breadcrumb">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>
                        Packages
                    </span>

                </div>

                <div class="packages-kicker">
                    Flexible catering packages
                </div>

                <h1 class="packages-title">
                    Pick your package.
                    <br>
                    <em>Make it yours.</em>
                </h1>

                <p class="packages-subtitle">
                    Thoughtfully designed catering packages for weddings,
                    corporate events, birthdays and celebrations of every size.
                    Choose a starting point and customise it around your event.
                </p>

                <div class="hero-note">
                    <i class="bi bi-stars"></i>
                    Fresh menus · Flexible guest counts · Personalised service
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
         ===================================================== --}}
    <section class="packages-content">

        <div class="container">

            <div class="section-heading">

                <div class="eyebrow">
                    Our Packages
                </div>

                <h2>
                    Something delicious for
                    <em>every celebration.</em>
                </h2>

                <p>
                    Compare our packages and choose the one that fits
                    your guest count, occasion and budget.
                </p>

            </div>


            {{-- =================================================
                 PACKAGES
                 ================================================= --}}
            <div class="row g-4 justify-content-center">

                @forelse($packages as $index => $p)

                    @php
                        $features = is_array($p->features)
                            ? $p->features
                            : (
                                is_string($p->features)
                                    ? json_decode($p->features, true) ?? []
                                    : []
                            );

                        $isPopular =
                            $index === 1 ||
                            strtolower($p->name) === 'gold package';
                    @endphp


                    <div
                        class="col-md-6 col-xl-4 package-wrapper"
                        style="animation-delay: {{ min($index * 0.12, 0.5) }}s;"
                    >

                        <article
                            class="package-card {{ $isPopular ? 'popular' : '' }}"
                        >

                            {{-- IMAGE --}}
                            <div class="package-image">

                                @if($p->image)

                                    <img
                                        src="{{ asset('storage/' . $p->image) }}"
                                        alt="{{ $p->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="w-100 h-100"
                                        style="
                                            display:grid;
                                            place-items:center;
                                            color:#fff;
                                            font-size:65px;
                                            background:
                                                radial-gradient(
                                                    circle at 30% 20%,
                                                    rgba(228,194,142,.35),
                                                    transparent 30%
                                                ),
                                                linear-gradient(
                                                    135deg,
                                                    #2d1a0f,
                                                    #9d6540
                                                );
                                        "
                                    >
                                        <i class="bi bi-gift"></i>
                                    </div>

                                @endif


                                @if($isPopular)

                                    <div class="popular-badge">
                                        <i class="bi bi-fire"></i>
                                        Most Popular
                                    </div>

                                @endif


                                <div class="package-index">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                            </div>


                            {{-- BODY --}}
                            <div class="package-body">

                                <h3 class="package-name">
                                    {{ $p->name }}
                                </h3>


                                @if($p->description)

                                    <p class="package-description">
                                        {{ \Illuminate\Support\Str::limit($p->description, 120) }}
                                    </p>

                                @else

                                    <p class="package-description">
                                        A thoughtfully curated catering
                                        experience designed for your celebration.
                                    </p>

                                @endif


                                <div class="package-price">

                                    <strong>
                                        ₹{{ number_format($p->price_per_person) }}
                                    </strong>

                                    <span>
                                        / person
                                    </span>

                                </div>


                                <div class="guest-range">

                                    <i class="bi bi-people-fill"></i>

                                    <span>
                                        Designed for
                                        {{ number_format($p->min_guests) }}
                                        –
                                        {{ number_format($p->max_guests) }}
                                        guests
                                    </span>

                                </div>


                                @if(count($features))

                                    <ul class="package-features">

                                        @foreach($features as $feature)

                                            <li>
                                                <i class="bi bi-check-circle-fill"></i>

                                                <span>
                                                    {{ $feature }}
                                                </span>
                                            </li>

                                        @endforeach

                                    </ul>

                                @else

                                    <ul class="package-features">

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Freshly prepared menu
                                        </li>

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Professional catering team
                                        </li>

                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Event-day support
                                        </li>

                                    </ul>

                                @endif


                                <a
                                    href="{{ url('/login') }}"
                                    class="package-button"
                                >
                                    Choose This Package
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-packages">

                            <div class="empty-icon">
                                <i class="bi bi-gift"></i>
                            </div>

                            <h3>
                                Packages coming soon
                            </h3>

                            <p>
                                We're preparing some delicious options
                                for your next event.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- =================================================
                 COMPARISON STRIP
                 ================================================= --}}
            <div class="compare-strip">

                <div class="row g-4">

                    <div class="col-md-4">

                        <div class="compare-item">

                            <div class="compare-icon">
                                <i class="bi bi-sliders"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Customisable
                                </strong>

                                <span>
                                    Adjust dishes and services
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="compare-item">

                            <div class="compare-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Flexible Guest Count
                                </strong>

                                <span>
                                    Packages for different event sizes
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="compare-item">

                            <div class="compare-icon">
                                <i class="bi bi-chat-heart"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Personalised Support
                                </strong>

                                <span>
                                    Our team helps plan your event
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 CTA
                 ================================================= --}}
            <div class="packages-cta">

                <div class="cta-content">

                    <div class="row align-items-center g-5">

                        <div class="col-lg-8">

                            <div class="cta-label">
                                Need something different?
                            </div>

                            <h3>
                                Build a package
                                around your event.
                            </h3>

                            <p>
                                Tell us your guest count, occasion,
                                food preferences and budget. We'll help
                                you create a customised catering plan
                                instead of forcing your event into a fixed package.
                            </p>

                        </div>

                        <div class="col-lg-4 text-lg-end">

                            <a
                                href="{{ url('/contact') }}"
                                class="cta-button"
                            >
                                Create My Package
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection