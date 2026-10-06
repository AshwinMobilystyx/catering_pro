@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       PREMIUM CATERING SERVICES PAGE
       ========================================================= */

    .services-page {
        --ink: #171411;
        --ink-soft: #2a211b;
        --cream: #f8f4ed;
        --paper: #fffdf9;
        --gold: #c9985a;
        --gold-light: #e4bd82;
        --brown: #70452b;
        --muted: #766f68;
        --line: #e9e0d5;

        background: var(--cream);
        color: var(--ink);
        overflow: hidden;
    }

    /* =========================================================
       HERO
       ========================================================= */

    .services-hero {
        position: relative;
        min-height: 650px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 82% 20%,
                rgba(201,152,90,.22),
                transparent 27%
            ),
            radial-gradient(
                circle at 10% 90%,
                rgba(201,152,90,.10),
                transparent 28%
            ),
            linear-gradient(
                125deg,
                #100d0a 0%,
                #211812 45%,
                #3b2518 100%
            );
    }

    .services-hero::before {
        content: "";
        position: absolute;
        width: 620px;
        height: 620px;
        right: -260px;
        top: -260px;
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 50%;
        box-shadow:
            0 0 0 80px rgba(255,255,255,.015),
            0 0 0 160px rgba(255,255,255,.012);
        animation: slowRotate 24s linear infinite;
    }

    .services-hero::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        left: -160px;
        bottom: -170px;
        border: 1px solid rgba(201,152,90,.22);
        border-radius: 50%;
    }

    .hero-noise {
        position: absolute;
        inset: 0;
        opacity: .035;
        pointer-events: none;
        background-image:
            radial-gradient(#fff 1px, transparent 1px);
        background-size: 5px 5px;
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
        left: 18%;
    }

    .hero-line.two {
        left: 78%;
    }

    .services-hero-content {
        position: relative;
        z-index: 3;
        padding: 110px 0 105px;
        color: #fff;
    }

    .breadcrumb-custom {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 28px;
        color: rgba(255,255,255,.55);
        font-size: 13px;
        letter-spacing: .3px;
    }

    .breadcrumb-custom a {
        color: rgba(255,255,255,.85);
        text-decoration: none;
        transition: color .25s ease;
    }

    .breadcrumb-custom a:hover {
        color: var(--gold-light);
    }

    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 24px;
        color: var(--gold-light);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2.5px;
    }

    .hero-kicker::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--gold);
    }

    .services-title {
        max-width: 950px;
        margin: 0 0 25px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(52px, 7.5vw, 96px);
        font-weight: 400;
        line-height: .98;
        letter-spacing: -3px;
    }

    .services-title em {
        color: var(--gold-light);
        font-style: italic;
    }

    .hero-description {
        max-width: 650px;
        margin: 0;
        color: rgba(255,255,255,.68);
        font-size: 17px;
        line-height: 1.9;
    }

    .hero-bottom {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 35px;
        margin-top: 42px;
    }

    .hero-stat {
        position: relative;
        padding-right: 35px;
    }

    .hero-stat:not(:last-child)::after {
        content: "";
        position: absolute;
        right: 0;
        top: 4px;
        width: 1px;
        height: 43px;
        background: rgba(255,255,255,.15);
    }

    .hero-stat strong {
        display: block;
        color: #fff;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 27px;
        font-weight: 400;
    }

    .hero-stat span {
        display: block;
        margin-top: 3px;
        color: rgba(255,255,255,.48);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }

    /* =========================================================
       INTRO
       ========================================================= */

    .services-intro {
        padding: 105px 0 55px;
        background: var(--paper);
    }

    .intro-label {
        color: var(--brown);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .intro-title {
        max-width: 820px;
        margin: 13px 0 20px;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--ink);
        font-size: clamp(35px, 5vw, 60px);
        font-weight: 400;
        line-height: 1.08;
        letter-spacing: -1.5px;
    }

    .intro-title em {
        color: var(--brown);
        font-style: italic;
    }

    .intro-text {
        max-width: 690px;
        color: var(--muted);
        font-size: 16px;
        line-height: 1.9;
        margin-bottom: 0;
    }

    /* =========================================================
       SERVICE GRID
       ========================================================= */

    .services-section {
        padding: 55px 0 115px;
        background: var(--paper);
    }

    .service-card-wrap {
        height: 100%;
    }

    .service-card {
        position: relative;
        height: 100%;
        min-height: 490px;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 15px 45px rgba(32,22,14,.055);
        transition:
            transform .45s cubic-bezier(.2,.8,.2,1),
            box-shadow .45s ease,
            border-color .3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: rgba(201,152,90,.45);
        box-shadow: 0 30px 70px rgba(32,22,14,.13);
    }

    .service-image {
        position: relative;
        height: 275px;
        overflow: hidden;
        background:
            linear-gradient(135deg, #2d1b11, #9a633c);
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition:
            transform .8s cubic-bezier(.2,.8,.2,1),
            filter .5s ease;
    }

    .service-card:hover .service-image img {
        transform: scale(1.08);
        filter: saturate(1.08);
    }

    .service-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                to top,
                rgba(13,9,6,.65),
                transparent 55%
            );
        pointer-events: none;
    }

    .service-image::before {
        content: "";
        position: absolute;
        z-index: 2;
        top: -30%;
        left: -130%;
        width: 75px;
        height: 170%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.20),
            transparent
        );
        transform: rotate(20deg);
        transition: left .9s ease;
    }

    .service-card:hover .service-image::before {
        left: 125%;
    }

    .service-number {
        position: absolute;
        z-index: 4;
        top: 18px;
        left: 18px;
        width: 45px;
        height: 45px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 50%;
        background: rgba(12,8,5,.55);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .service-icon {
        position: absolute;
        z-index: 4;
        right: 18px;
        bottom: 18px;
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 50%;
        background: rgba(12,8,5,.55);
        backdrop-filter: blur(8px);
        color: var(--gold-light);
        font-size: 18px;
    }

    .service-card-body {
        min-height: 215px;
        display: flex;
        flex-direction: column;
        padding: 27px 28px 29px;
    }

    .service-card-body h3 {
        margin: 0 0 10px;
        color: var(--ink);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 27px;
        font-weight: 400;
        line-height: 1.15;
    }

    .service-card-body p {
        margin: 0 0 18px;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.75;
    }

    .service-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: auto;
    }

    .service-price {
        color: var(--brown);
        font-size: 16px;
        font-weight: 800;
    }

    .service-price small {
        display: block;
        margin-top: 2px;
        color: #a29b94;
        font-size: 10px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .8px;
    }

    .service-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 11px 17px;
        border: 1px solid #ded2c5;
        border-radius: 50px;
        background: transparent;
        color: var(--ink);
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .7px;
        transition: all .3s ease;
    }

    .service-btn:hover {
        border-color: var(--ink);
        background: var(--ink);
        color: #fff;
    }

    .service-btn i {
        transition: transform .3s ease;
    }

    .service-btn:hover i {
        transform: translateX(4px);
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .empty-services {
        padding: 90px 20px;
        border: 1px dashed #d9cec2;
        border-radius: 6px;
        text-align: center;
        background: #fff;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        display: grid;
        place-items: center;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #f5ede4;
        color: var(--brown);
        font-size: 28px;
    }

    .empty-services h4 {
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 27px;
        font-weight: 400;
    }

    .empty-services p {
        margin: 0;
        color: var(--muted);
    }

    /* =========================================================
       CTA
       ========================================================= */

    .services-cta-section {
        padding: 0 0 110px;
        background: var(--paper);
    }

    .services-cta {
        position: relative;
        overflow: hidden;
        padding: 70px;
        border-radius: 6px;
        background:
            radial-gradient(
                circle at 90% 15%,
                rgba(228,189,130,.22),
                transparent 25%
            ),
            linear-gradient(
                120deg,
                #16110d,
                #332116
            );
        color: #fff;
    }

    .services-cta::before {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        right: -180px;
        bottom: -200px;
        border: 1px solid rgba(228,189,130,.22);
        border-radius: 50%;
    }

    .services-cta::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: 100px;
        top: -100px;
        border: 1px solid rgba(255,255,255,.07);
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
        font-size: 11px;
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

    .services-cta h3 {
        max-width: 700px;
        margin: 0 0 15px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(34px, 5vw, 57px);
        font-weight: 400;
        line-height: 1.05;
    }

    .services-cta p {
        max-width: 620px;
        margin: 0;
        color: rgba(255,255,255,.62);
        line-height: 1.85;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px 25px;
        border-radius: 50px;
        background: var(--gold);
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        transition: all .3s ease;
    }

    .cta-btn:hover {
        background: var(--gold-light);
        color: #211710;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,.25);
    }

    /* =========================================================
       ANIMATIONS
       ========================================================= */

    @keyframes slowRotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes revealUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: revealUp .8s ease both;
    }

    /* =========================================================
       ACCESSIBILITY
       ========================================================= */

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
        .services-hero {
            min-height: 590px;
        }

        .services-hero-content {
            padding: 90px 0;
        }

        .services-title {
            letter-spacing: -2px;
        }

        .services-cta {
            padding: 50px 40px;
        }
    }

    @media (max-width: 767px) {
        .services-hero {
            min-height: 570px;
        }

        .services-hero-content {
            padding: 75px 0;
        }

        .services-title {
            font-size: 50px;
            letter-spacing: -1.5px;
        }

        .hero-description {
            font-size: 15px;
            line-height: 1.8;
        }

        .hero-bottom {
            gap: 22px;
        }

        .hero-stat {
            padding-right: 22px;
        }

        .hero-stat strong {
            font-size: 23px;
        }

        .services-intro {
            padding: 70px 0 40px;
        }

        .services-section {
            padding: 40px 0 75px;
        }

        .service-card {
            min-height: 0;
        }

        .service-image {
            height: 245px;
        }

        .service-card-body {
            min-height: 0;
            padding: 24px;
        }

        .service-card-body h3 {
            font-size: 25px;
        }

        .service-meta {
            align-items: flex-end;
        }

        .services-cta-section {
            padding-bottom: 75px;
        }

        .services-cta {
            padding: 40px 25px;
        }
    }

    @media (max-width: 480px) {
        .services-title {
            font-size: 43px;
        }

        .hero-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .hero-stat:not(:last-child)::after {
            display: none;
        }

        .hero-stat {
            padding-right: 0;
        }

        .service-meta {
            flex-direction: column;
            align-items: stretch;
        }

        .service-btn {
            width: 100%;
        }
    }
</style>


<div class="services-page">

    {{-- =====================================================
         HERO
         ===================================================== --}}
    <section class="services-hero">

        <div class="hero-noise"></div>
        <div class="hero-line one"></div>
        <div class="hero-line two"></div>

        <div class="container">
            <div class="services-hero-content">

                <div class="breadcrumb-custom">
                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>
                        Services
                    </span>
                </div>

                <div class="hero-kicker">
                    Catering for every occasion
                </div>

                <h1 class="services-title">
                    Food made for
                    <br>
                    <em>moments worth celebrating.</em>
                </h1>

                <p class="hero-description">
                    From intimate gatherings to grand celebrations,
                    we create thoughtful menus, beautiful presentations
                    and seamless catering experiences designed around your event.
                </p>

                <div class="hero-bottom">

                    <div class="hero-stat">
                        <strong>4+</strong>
                        <span>Catering Services</span>
                    </div>

                    <div class="hero-stat">
                        <strong>100%</strong>
                        <span>Fresh Preparation</span>
                    </div>

                    <div class="hero-stat">
                        <strong>Custom</strong>
                        <span>Menu Planning</span>
                    </div>

                </div>

            </div>
        </div>
    </section>


    {{-- =====================================================
         INTRO
         ===================================================== --}}
    <section class="services-intro">

        <div class="container">

            <div class="intro-label">
                Our expertise
            </div>

            <h2 class="intro-title">
                More than catering.
                <em>It's part of the celebration.</em>
            </h2>

            <p class="intro-text">
                Every event deserves food that feels intentional.
                We combine fresh ingredients, carefully planned menus,
                elegant presentation and attentive service to create
                an experience your guests will remember.
            </p>

        </div>

    </section>


    {{-- =====================================================
         SERVICES
         ===================================================== --}}
    <section class="services-section">

        <div class="container">

            <div class="row g-4">

                @forelse($services as $index => $s)

                    <div
                        class="col-md-6 col-xl-4 service-card-wrap"
                        style="animation-delay: {{ min($index * 0.08, 0.5) }}s;"
                    >

                        <article class="service-card">

                            {{-- IMAGE --}}
                            <div class="service-image">

                                <div class="service-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                @if($s->image)

                                    <img
                                        src="{{ asset('storage/' . $s->image) }}"
                                        alt="{{ $s->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="w-100 h-100 d-grid"
                                        style="
                                            display:grid;
                                            place-items:center;
                                            color:#fff;
                                            font-size:62px;
                                            background:
                                                radial-gradient(
                                                    circle at 30% 20%,
                                                    rgba(228,189,130,.35),
                                                    transparent 30%
                                                ),
                                                linear-gradient(
                                                    135deg,
                                                    #25160d,
                                                    #9b6239
                                                );
                                        "
                                    >
                                        <i class="bi bi-cup-hot"></i>
                                    </div>

                                @endif


                                <div class="service-icon">

                                    @if(str_contains(strtolower($s->name), 'wedding'))

                                        <i class="bi bi-heart-fill"></i>

                                    @elseif(str_contains(strtolower($s->name), 'corporate'))

                                        <i class="bi bi-building"></i>

                                    @elseif(str_contains(strtolower($s->name), 'birthday'))

                                        <i class="bi bi-balloon-heart-fill"></i>

                                    @elseif(str_contains(strtolower($s->name), 'outdoor'))

                                        <i class="bi bi-tree-fill"></i>

                                    @else

                                        <i class="bi bi-stars"></i>

                                    @endif

                                </div>

                            </div>


                            {{-- CONTENT --}}
                            <div class="service-card-body">

                                <h3>
                                    {{ $s->name }}
                                </h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit($s->description, 135) }}
                                </p>


                                <div class="service-meta">

                                    @if($s->price_from)

                                        <div class="service-price">

                                            ₹{{ number_format($s->price_from) }}

                                            <small>
                                                Starting price
                                            </small>

                                        </div>

                                    @else

                                        <div class="service-price">

                                            Custom

                                            <small>
                                                Quote on request
                                            </small>

                                        </div>

                                    @endif


                                    <a
                                        href="{{ url('/services/' . $s->slug) }}"
                                        class="service-btn"
                                    >
                                        Explore
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-services">

                            <div class="empty-icon">
                                <i class="bi bi-cup-hot"></i>
                            </div>

                            <h4>
                                Services coming soon
                            </h4>

                            <p>
                                We're preparing something delicious for you.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =====================================================
         CTA
         ===================================================== --}}
    <section class="services-cta-section">

        <div class="container">

            <div class="services-cta">

                <div class="cta-content">

                    <div class="row align-items-center g-5">

                        <div class="col-lg-8">

                            <div class="cta-label">
                                Planning something special?
                            </div>

                            <h3>
                                Let's create a menu
                                your guests will talk about.
                            </h3>

                            <p>
                                Tell us about your event, guest count,
                                venue and preferences. We'll help you
                                turn your ideas into a memorable catering
                                experience.
                            </p>

                        </div>

                        <div class="col-lg-4 text-lg-end">

                            <a
                                href="{{ url('/contact') }}"
                                class="cta-btn"
                            >
                                Plan My Event
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