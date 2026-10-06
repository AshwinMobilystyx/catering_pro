@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       CATERING BRAND SYSTEM
       ========================================================= */

    :root {
        --brand-ink: #171614;
        --brand-charcoal: #24221f;
        --brand-cream: #f8f5ef;
        --brand-paper: #fffdf9;
        --brand-gold: #c6a15b;
        --brand-gold-dark: #9d793b;
        --brand-brown: #654d35;
        --brand-muted: #716d66;
        --brand-line: #e9e3d8;
        --brand-soft: #f3eee5;
    }

    .home-page {
        background: var(--brand-paper);
        color: var(--brand-ink);
        overflow: hidden;
    }

    .home-page *,
    .home-page *::before,
    .home-page *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       GLOBAL TYPOGRAPHY
       ========================================================= */

    .home-page h1,
    .home-page h2,
    .home-page h3,
    .home-page h4,
    .home-page h5 {
        font-family: Georgia, "Times New Roman", serif;
        letter-spacing: -.025em;
    }

    .home-page p {
        line-height: 1.75;
    }

    .brand-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: var(--brand-gold-dark);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .brand-eyebrow::before {
        content: "";
        width: 28px;
        height: 1px;
        background: currentColor;
    }

    .brand-title {
        font-size: clamp(38px, 5vw, 68px);
        line-height: 1.02;
        font-weight: 600;
        margin: 12px 0 18px;
    }

    .brand-copy {
        color: var(--brand-muted);
        font-size: 16px;
        max-width: 680px;
    }

    .brand-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 48px;
        padding: 0 23px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .02em;
        text-decoration: none;
        transition: .25s ease;
    }

    .brand-btn-dark {
        color: #fff;
        background: var(--brand-ink);
        border: 1px solid var(--brand-ink);
    }

    .brand-btn-dark:hover {
        color: #fff;
        background: var(--brand-gold-dark);
        border-color: var(--brand-gold-dark);
        transform: translateY(-2px);
    }

    .brand-btn-light {
        color: var(--brand-ink);
        background: #fff;
        border: 1px solid rgba(255,255,255,.7);
    }

    .brand-btn-light:hover {
        color: var(--brand-ink);
        transform: translateY(-2px);
        background: var(--brand-cream);
    }

    .brand-btn-outline {
        color: var(--brand-ink);
        background: transparent;
        border: 1px solid var(--brand-line);
    }

    .brand-btn-outline:hover {
        color: #fff;
        background: var(--brand-ink);
        border-color: var(--brand-ink);
        transform: translateY(-2px);
    }

    /* =========================================================
       HERO
       ========================================================= */

    .brand-hero {
        position: relative;
        min-height: min(780px, 88vh);
        overflow: hidden;
        background: var(--brand-ink);
    }

    .brand-hero .hero-media {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.02);
        animation: heroZoom 12s ease-out infinite alternate;
    }

    @keyframes heroZoom {
        from {
            transform: scale(1.02);
        }

        to {
            transform: scale(1.08);
        }
    }

    .brand-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                90deg,
                rgba(10,9,8,.82) 0%,
                rgba(10,9,8,.58) 42%,
                rgba(10,9,8,.18) 78%,
                rgba(10,9,8,.25) 100%
            );
        z-index: 1;
    }

    .hero-content-new {
        position: relative;
        z-index: 3;
        min-height: min(780px, 88vh);
        display: flex;
        align-items: center;
        padding: 90px 0;
    }

    .hero-inner {
        max-width: 760px;
        color: #fff;
    }

    .hero-kicker-new {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #e3c77e;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .2em;
        margin-bottom: 18px;
    }

    .hero-kicker-new::before {
        content: "";
        width: 35px;
        height: 1px;
        background: #e3c77e;
    }

    .hero-inner h1 {
        font-size: clamp(48px, 7vw, 92px);
        line-height: .94;
        font-weight: 500;
        letter-spacing: -.045em;
        margin: 0;
        max-width: 850px;
    }

    .hero-inner h1 span {
        color: #e1c57c;
        font-style: italic;
    }

    .hero-inner p {
        max-width: 650px;
        margin: 26px 0 0;
        color: rgba(255,255,255,.78);
        font-size: 17px;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 30px;
    }

    .hero-scroll {
        position: absolute;
        z-index: 4;
        bottom: 30px;
        right: 30px;
        color: rgba(255,255,255,.65);
        font-size: 9px;
        letter-spacing: .18em;
        text-transform: uppercase;
        writing-mode: vertical-rl;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hero-scroll::after {
        content: "";
        width: 1px;
        height: 55px;
        background: rgba(255,255,255,.35);
    }

    .hero-arrow {
        z-index: 5;
        width: 58px;
        opacity: .8;
    }

    .hero-arrow:hover {
        opacity: 1;
    }

    .hero-dots {
        z-index: 5;
        bottom: 27px;
    }

    .hero-dots button {
        width: 25px !important;
        height: 2px !important;
        border: 0 !important;
        border-radius: 0 !important;
    }

    /* =========================================================
       FALLBACK HERO
       ========================================================= */

    .brand-hero-fallback {
        background:
            radial-gradient(circle at 85% 15%, rgba(198,161,91,.24), transparent 30%),
            linear-gradient(120deg, #171614, #34291d);
    }

    .brand-hero-fallback::before {
        content: "";
        position: absolute;
        width: 520px;
        height: 520px;
        border: 1px solid rgba(198,161,91,.18);
        border-radius: 50%;
        right: -180px;
        top: -180px;
    }

    .brand-hero-fallback::after {
        background:
            linear-gradient(
                90deg,
                rgba(10,9,8,.45),
                rgba(10,9,8,.1)
            );
    }

    /* =========================================================
       TRUST STRIP
       ========================================================= */

    .brand-trust {
        background: var(--brand-cream);
        border-bottom: 1px solid var(--brand-line);
    }

    .trust-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
    }

    .trust-item-new {
        min-height: 112px;
        padding: 22px 20px;
        display: flex;
        align-items: center;
        gap: 13px;
        border-right: 1px solid var(--brand-line);
    }

    .trust-item-new:last-child {
        border-right: 0;
    }

    .trust-icon-new {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 50%;
        border: 1px solid rgba(198,161,91,.45);
        color: var(--brand-gold-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .trust-item-new strong {
        display: block;
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .trust-item-new span {
        color: var(--brand-muted);
        font-size: 10px;
    }

    /* =========================================================
       SECTIONS
       ========================================================= */

    .brand-section {
        padding: 105px 0;
    }

    .brand-section-soft {
        background: var(--brand-cream);
    }

    .section-heading {
        max-width: 800px;
    }

    .section-heading h2 {
        font-size: clamp(38px, 5vw, 62px);
        line-height: 1.03;
        font-weight: 500;
        margin: 13px 0 18px;
    }

    .section-heading p {
        color: var(--brand-muted);
        font-size: 15px;
        max-width: 670px;
    }

    .section-link {
        color: var(--brand-ink);
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        border-bottom: 1px solid var(--brand-gold);
        padding-bottom: 5px;
    }

    .section-link:hover {
        color: var(--brand-gold-dark);
    }

    /* =========================================================
       SERVICES
       ========================================================= */

    .service-card-new {
        height: 100%;
        background: #fff;
        border: 1px solid var(--brand-line);
        position: relative;
        overflow: hidden;
        transition: .35s ease;
    }

    .service-card-new:hover {
        transform: translateY(-7px);
        box-shadow: 0 22px 50px rgba(35,29,20,.11);
    }

    .service-image-wrap {
        height: 290px;
        overflow: hidden;
        background: var(--brand-soft);
    }

    .service-image-wrap img,
    .service-image-placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .service-card-new:hover .service-image-wrap img {
        transform: scale(1.07);
    }

    .service-image-placeholder {
        display: grid;
        place-items: center;
        background:
            linear-gradient(135deg, #dfc7aa, #8d6242);
        color: #fff;
        font-size: 50px;
    }

    .service-content {
        padding: 25px;
    }

    .service-number {
        color: var(--brand-gold-dark);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .15em;
    }

    .service-content h3 {
        font-size: 25px;
        margin: 8px 0 9px;
        font-weight: 600;
    }

    .service-content p {
        color: var(--brand-muted);
        font-size: 13px;
        margin-bottom: 17px;
    }

    .service-link {
        color: var(--brand-ink);
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .service-link i {
        color: var(--brand-gold-dark);
        transition: .2s ease;
    }

    .service-card-new:hover .service-link i {
        margin-left: 5px;
    }

    /* =========================================================
       ABOUT
       ========================================================= */

    .about-image-wrap {
        position: relative;
        padding: 0 35px 35px 0;
    }

    .about-image-wrap::after {
        content: "";
        position: absolute;
        width: 72%;
        height: 72%;
        right: 0;
        bottom: 0;
        border: 1px solid var(--brand-gold);
        z-index: 0;
    }

    .about-main-image,
    .about-placeholder {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 570px;
        object-fit: cover;
    }

    .about-placeholder {
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 100px;
        background:
            linear-gradient(135deg, #a8734e, #43271a);
    }

    .about-badge {
        position: absolute;
        z-index: 3;
        bottom: 55px;
        left: -22px;
        background: var(--brand-ink);
        color: #fff;
        padding: 18px 22px;
        min-width: 150px;
    }

    .about-badge strong {
        display: block;
        font-family: Georgia, serif;
        font-size: 28px;
        color: #e0c27a;
    }

    .about-badge span {
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: rgba(255,255,255,.65);
    }

    .feature-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 18px;
        margin: 25px 0 30px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--brand-charcoal);
        font-size: 12px;
        font-weight: 700;
    }

    .feature-item i {
        color: var(--brand-gold-dark);
        font-size: 16px;
    }

    /* =========================================================
       PROCESS
       ========================================================= */

    .process-card {
        height: 100%;
        padding: 32px 28px;
        border-top: 1px solid var(--brand-line);
        position: relative;
        transition: .3s ease;
    }

    .process-card:hover {
        background: #fff;
        box-shadow: 0 18px 45px rgba(35,29,20,.07);
    }

    .process-number {
        font-family: Georgia, serif;
        font-size: 52px;
        color: var(--brand-gold);
        line-height: 1;
        margin-bottom: 23px;
    }

    .process-card h3 {
        font-size: 25px;
        margin-bottom: 10px;
    }

    .process-card p {
        color: var(--brand-muted);
        font-size: 13px;
        margin: 0;
    }

    /* =========================================================
       PACKAGES
       ========================================================= */

    .package-card-new {
        height: 100%;
        background: #fff;
        border: 1px solid var(--brand-line);
        overflow: hidden;
        position: relative;
        transition: .35s ease;
    }

    .package-card-new:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 50px rgba(35,29,20,.11);
    }

    .package-card-new.featured {
        border-color: var(--brand-gold);
    }

    .package-image {
        width: 100%;
        height: 270px;
        object-fit: cover;
        display: block;
        transition: transform .6s ease;
    }

    .package-card-new:hover .package-image {
        transform: scale(1.05);
    }

    .package-image-wrap {
        overflow: hidden;
        position: relative;
        background: var(--brand-brown);
    }

    .package-placeholder {
        height: 270px;
        display: grid;
        place-items: center;
        background:
            linear-gradient(135deg, #8e6241, #3c2619);
        color: #fff;
        font-size: 65px;
    }

    .package-badge-new {
        position: absolute;
        top: 16px;
        left: 16px;
        padding: 7px 11px;
        background: var(--brand-gold);
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .package-content {
        padding: 27px;
    }

    .package-content h3 {
        font-size: 28px;
        margin-bottom: 12px;
    }

    .package-price {
        color: var(--brand-gold-dark);
        font-family: Georgia, serif;
        font-size: 30px;
        font-weight: 600;
    }

    .package-price small {
        color: var(--brand-muted);
        font-family: inherit;
        font-size: 11px;
    }

    .package-description {
        color: var(--brand-muted);
        font-size: 13px;
        min-height: 48px;
        margin: 12px 0 20px;
    }

    /* =========================================================
       GALLERY
       ========================================================= */

    .gallery-tile {
        display: block;
        position: relative;
        overflow: hidden;
        background: var(--brand-ink);
    }

    .gallery-tile img,
    .gallery-placeholder {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;
        transition: transform .6s ease;
    }

    .gallery-tile:hover img {
        transform: scale(1.07);
    }

    .gallery-placeholder {
        display: grid;
        place-items: center;
        color: #fff;
    }

    .gallery-overlay {
        position: absolute;
        inset: auto 0 0;
        padding: 35px 18px 18px;
        background: linear-gradient(transparent, rgba(0,0,0,.72));
        color: #fff;
        opacity: 0;
        transition: .3s ease;
    }

    .gallery-tile:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay strong {
        font-size: 13px;
    }

    /* =========================================================
       TESTIMONIALS
       ========================================================= */

    .testimonial-card {
        height: 100%;
        background: #fff;
        border: 1px solid var(--brand-line);
        padding: 30px;
        position: relative;
    }

    .quote-mark {
        position: absolute;
        top: 17px;
        right: 23px;
        font-family: Georgia, serif;
        font-size: 55px;
        color: #eee5d5;
        line-height: 1;
    }

    .testimonial-stars {
        color: var(--brand-gold);
        font-size: 11px;
        letter-spacing: 2px;
        margin-bottom: 18px;
    }

    .testimonial-text {
        font-family: Georgia, serif;
        font-size: 21px;
        line-height: 1.45;
        color: var(--brand-charcoal);
        margin-bottom: 25px;
    }

    .testimonial-person {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        overflow: hidden;
        background: var(--brand-soft);
        display: grid;
        place-items: center;
        color: var(--brand-gold-dark);
    }

    .testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .testimonial-person strong {
        display: block;
        font-size: 12px;
    }

    .testimonial-person span {
        color: var(--brand-muted);
        font-size: 10px;
    }

    /* =========================================================
       CTA
       ========================================================= */

    .final-cta {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 85% 10%, rgba(198,161,91,.22), transparent 30%),
            linear-gradient(120deg, #171614, #30261c);
        color: #fff;
        padding: 75px 65px;
    }

    .final-cta::before {
        content: "";
        position: absolute;
        width: 430px;
        height: 430px;
        border: 1px solid rgba(198,161,91,.16);
        border-radius: 50%;
        right: -190px;
        top: -210px;
    }

    .final-cta h2 {
        font-size: clamp(38px, 5vw, 62px);
        line-height: 1.03;
        max-width: 760px;
    }

    .final-cta p {
        max-width: 670px;
        color: rgba(255,255,255,.62);
    }

    /* =========================================================
       ANIMATION
       ========================================================= */

    .fade-up {
        animation: fadeUp .7s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991.98px) {

        .brand-section {
            padding: 80px 0;
        }

        .trust-grid {
            grid-template-columns: 1fr 1fr;
        }

        .trust-item-new:nth-child(2) {
            border-right: 0;
        }

        .trust-item-new:nth-child(-n+2) {
            border-bottom: 1px solid var(--brand-line);
        }

        .hero-inner h1 {
            font-size: clamp(48px, 9vw, 75px);
        }

        .about-image-wrap {
            padding-right: 20px;
            margin-bottom: 20px;
        }

        .about-main-image,
        .about-placeholder {
            height: 480px;
        }

        .final-cta {
            padding: 55px 35px;
        }
    }

    @media (max-width: 767.98px) {

        .brand-section {
            padding: 65px 0;
        }

        .brand-hero,
        .hero-content-new {
            min-height: 720px;
        }

        .brand-hero::after {
            background:
                linear-gradient(
                    180deg,
                    rgba(10,9,8,.55),
                    rgba(10,9,8,.78)
                );
        }

        .hero-inner h1 {
            font-size: clamp(43px, 13vw, 65px);
        }

        .hero-inner p {
            font-size: 14px;
        }

        .hero-scroll {
            display: none;
        }

        .hero-arrow {
            display: none;
        }

        .trust-grid {
            grid-template-columns: 1fr;
        }

        .trust-item-new {
            border-right: 0;
            border-bottom: 1px solid var(--brand-line);
        }

        .trust-item-new:last-child {
            border-bottom: 0;
        }

        .service-image-wrap {
            height: 240px;
        }

        .about-main-image,
        .about-placeholder {
            height: 400px;
        }

        .about-badge {
            left: 10px;
            bottom: 25px;
        }

        .feature-list {
            grid-template-columns: 1fr;
        }

        .gallery-tile img,
        .gallery-placeholder {
            height: 220px;
        }

        .gallery-overlay {
            opacity: 1;
        }

        .final-cta {
            padding: 45px 25px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .brand-hero .hero-media {
            animation: none;
        }

        .service-card-new,
        .package-card-new,
        .gallery-tile img,
        .service-image-wrap img {
            transition: none;
        }
    }
</style>


<div class="home-page">

    {{-- =====================================================
         HERO
         ===================================================== --}}

    @if($banners->count())

        <div
            id="heroCarousel"
            class="carousel slide brand-hero"
            data-bs-ride="carousel"
            data-bs-interval="6500"
        >

            <div class="carousel-inner">

                @foreach($banners as $banner)

                    <div class="carousel-item @if($loop->first) active @endif">

                        <section class="brand-hero">

                            <picture>

                                @if($banner->mobile_image)

                                    <source
                                        media="(max-width: 768px)"
                                        srcset="{{ asset('storage/'.$banner->mobile_image) }}"
                                    >

                                @endif

                                <img
                                    class="hero-media"
                                    src="{{ asset('storage/'.$banner->image) }}"
                                    alt="{{ $banner->title }}"
                                >

                            </picture>


                            <div class="container hero-content-new">

                                <div class="hero-inner fade-up">

                                    <div class="hero-kicker-new">

                                        {{ \App\Models\WebsiteSetting::get(
                                            'hero_badge',
                                            'Premium Catering & Events'
                                        ) }}

                                    </div>


                                    <h1>

                                        {{ $banner->title }}

                                    </h1>


                                    @if($banner->subtitle)

                                        <p>
                                            {{ $banner->subtitle }}
                                        </p>

                                    @endif


                                    <div class="hero-actions">

                                        @if($banner->button_text)

                                            <a
                                                href="{{ $banner->button_url ?: '/contact' }}"
                                                class="brand-btn brand-btn-light"
                                            >
                                                {{ $banner->button_text }}

                                                <i class="bi bi-arrow-up-right"></i>
                                            </a>

                                        @endif


                                        @if($banner->secondary_button_text)

                                            <a
                                                href="{{ $banner->secondary_button_url ?: '/gallery' }}"
                                                class="brand-btn"
                                                style="color:#fff;border:1px solid rgba(255,255,255,.45);"
                                            >
                                                {{ $banner->secondary_button_text }}
                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </section>

                    </div>

                @endforeach

            </div>


            @if($banners->count() > 1)

                <button
                    class="carousel-control-prev hero-arrow"
                    type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide="prev"
                >
                    <span class="carousel-control-prev-icon"></span>
                </button>


                <button
                    class="carousel-control-next hero-arrow"
                    type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide="next"
                >
                    <span class="carousel-control-next-icon"></span>
                </button>


                <div class="carousel-indicators hero-dots">

                    @foreach($banners as $banner)

                        <button
                            type="button"
                            data-bs-target="#heroCarousel"
                            data-bs-slide-to="{{ $loop->index }}"
                            class="@if($loop->first) active @endif"
                        ></button>

                    @endforeach

                </div>

            @endif

            <div class="hero-scroll">
                Discover
            </div>

        </div>

    @else

        <section class="brand-hero brand-hero-fallback">

            <div class="container hero-content-new">

                <div class="hero-inner fade-up">

                    <div class="hero-kicker-new">

                        {{ \App\Models\WebsiteSetting::get(
                            'hero_badge',
                            'Premium Catering & Events'
                        ) }}

                    </div>


                    <h1>
                        {{ \App\Models\WebsiteSetting::get(
                            'hero_title',
                            'Exceptional Catering for Every Celebration'
                        ) }}
                    </h1>


                    <p>

                        {{ \App\Models\WebsiteSetting::get(
                            'hero_subtitle',
                            'Fresh food, beautiful presentation and reliable event service.'
                        ) }}

                    </p>


                    <div class="hero-actions">

                        <a
                            href="/contact"
                            class="brand-btn brand-btn-light"
                        >
                            Plan My Event
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                        <a
                            href="/gallery"
                            class="brand-btn"
                            style="color:#fff;border:1px solid rgba(255,255,255,.45);"
                        >
                            See Our Work
                        </a>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         TRUST STRIP
         ===================================================== --}}

    <section class="brand-trust">

        <div class="container">

            <div class="trust-grid">

                <div class="trust-item-new">

                    <div class="trust-icon-new">
                        <i class="bi bi-heart"></i>
                    </div>

                    <div>
                        <strong>Made for celebrations</strong>
                        <span>Weddings & special events</span>
                    </div>

                </div>


                <div class="trust-item-new">

                    <div class="trust-icon-new">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <div>
                        <strong>Custom menus</strong>
                        <span>Built around your taste</span>
                    </div>

                </div>


                <div class="trust-item-new">

                    <div class="trust-icon-new">
                        <i class="bi bi-people"></i>
                    </div>

                    <div>
                        <strong>Professional team</strong>
                        <span>Service from setup to finish</span>
                    </div>

                </div>


                <div class="trust-item-new">

                    <div class="trust-icon-new">
                        <i class="bi bi-chat-heart"></i>
                    </div>

                    <div>
                        <strong>Easy consultation</strong>
                        <span>Call, WhatsApp or enquire</span>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         SERVICES
         ===================================================== --}}

    <section class="brand-section">

        <div class="container">

            <div class="row align-items-end g-4 mb-5">

                <div class="col-lg-8">

                    <div class="brand-eyebrow">
                        Choose your experience
                    </div>

                    <div class="section-heading">

                        <h2>
                            Everything you need to host a
                            <em>memorable</em> event.
                        </h2>

                        <p>
                            From intimate family functions to large celebrations,
                            choose the service and let us take care of the food,
                            presentation and experience.
                        </p>

                    </div>

                </div>


                <div class="col-lg-4 text-lg-end">

                    <a
                        href="/services"
                        class="section-link"
                    >
                        Explore all services
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>

                </div>

            </div>


            <div class="row g-4">

                @foreach($services as $s)

                    <div class="col-md-6 col-lg-3">

                        <article class="service-card-new">

                            <div class="service-image-wrap">

                                @if($s->image)

                                    <img
                                        src="{{ asset('storage/'.$s->image) }}"
                                        alt="{{ $s->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="service-image-placeholder">
                                        🍽️
                                    </div>

                                @endif

                            </div>


                            <div class="service-content">

                                <div class="service-number">
                                    0{{ $loop->iteration }}
                                </div>

                                <h3>
                                    {{ $s->name }}
                                </h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit(
                                        $s->short_description,
                                        105
                                    ) }}
                                </p>

                                <a
                                    href="/services/{{ $s->slug }}"
                                    class="service-link"
                                >
                                    Explore service
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =====================================================
         ABOUT
         ===================================================== --}}

    <section class="brand-section brand-section-soft">

        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="about-image-wrap">

                        @if(\App\Models\WebsiteSetting::get('about_image'))

                            <img
                                src="{{ asset(
                                    'storage/'.
                                    \App\Models\WebsiteSetting::get('about_image')
                                ) }}"
                                class="about-main-image"
                                alt="About our catering service"
                                loading="lazy"
                            >

                        @else

                            <div class="about-placeholder">
                                🍲
                            </div>

                        @endif


                        <div class="about-badge">

                            <strong>01</strong>

                            <span>
                                Food · Service · Memories
                            </span>

                        </div>

                    </div>

                </div>


                <div class="col-lg-6">

                    <div class="brand-eyebrow">
                        More than just food
                    </div>


                    <div class="section-heading">

                        <h2>
                            The kind of catering people
                            <em>talk about</em> after the event.
                        </h2>

                        <p>

                            {{ \App\Models\WebsiteSetting::get(
                                'about',
                                'We bring thoughtful menus, warm service and beautiful presentation to celebrations of every size.'
                            ) }}

                        </p>

                    </div>


                    <div class="feature-list">

                        <div class="feature-item">
                            <i class="bi bi-check2-circle"></i>
                            Freshly prepared
                        </div>

                        <div class="feature-item">
                            <i class="bi bi-check2-circle"></i>
                            Custom menus
                        </div>

                        <div class="feature-item">
                            <i class="bi bi-check2-circle"></i>
                            Professional team
                        </div>

                        <div class="feature-item">
                            <i class="bi bi-check2-circle"></i>
                            Event-day support
                        </div>

                    </div>


                    <a
                        href="/about"
                        class="brand-btn brand-btn-dark"
                    >
                        Our story
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         PROCESS
         ===================================================== --}}

    <section class="brand-section">

        <div class="container">

            <div class="section-heading text-center mx-auto mb-5">

                <div class="brand-eyebrow">
                    Simple process
                </div>

                <h2>
                    You enjoy the occasion.
                    <em>We handle the details.</em>
                </h2>

                <p class="mx-auto">
                    A simple journey from the first enquiry to the final plate.
                </p>

            </div>


            <div class="row g-0">

                <div class="col-md-4">

                    <div class="process-card">

                        <div class="process-number">
                            01
                        </div>

                        <h3>
                            Tell us about your event
                        </h3>

                        <p>
                            Share your date, guest count, venue and the kind
                            of celebration you are planning.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="process-card">

                        <div class="process-number">
                            02
                        </div>

                        <h3>
                            Build your menu
                        </h3>

                        <p>
                            Explore packages, dishes and add-ons. We can also
                            customise the menu around your preferences.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="process-card">

                        <div class="process-number">
                            03
                        </div>

                        <h3>
                            Relax & celebrate
                        </h3>

                        <p>
                            Our team takes care of preparation, setup and
                            service so you can spend time with your guests.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         PACKAGES
         ===================================================== --}}

    <section class="brand-section brand-section-soft">

        <div class="container">

            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">

                <div>

                    <div class="brand-eyebrow">
                        Our best sellers
                    </div>

                    <div class="section-heading">

                        <h2>
                            Packages made <em>easy.</em>
                        </h2>

                        <p>
                            Pick a starting point and customise it for your event.
                        </p>

                    </div>

                </div>


                <a
                    href="/packages"
                    class="brand-btn brand-btn-outline"
                >
                    Compare packages
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>


            <div class="row g-4">

                @foreach($packages as $p)

                    <div class="col-md-4">

                        <article
                            class="package-card-new
                            @if($loop->first) featured @endif"
                        >

                            <div class="package-image-wrap">

                                @if($p->image)

                                    <img
                                        src="{{ asset('storage/'.$p->image) }}"
                                        class="package-image"
                                        alt="{{ $p->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="package-placeholder">
                                        🍽️
                                    </div>

                                @endif


                                @if($loop->first)

                                    <div class="package-badge-new">
                                        <i class="bi bi-star-fill me-1"></i>
                                        Popular Choice
                                    </div>

                                @endif

                            </div>


                            <div class="package-content">

                                <h3>
                                    {{ $p->name }}
                                </h3>


                                <div class="package-price">

                                    @if($p->price_per_person)

                                        ₹{{ number_format($p->price_per_person) }}

                                        <small>
                                            / person
                                        </small>

                                    @else

                                        Custom quote

                                    @endif

                                </div>


                                <p class="package-description">

                                    {{ \Illuminate\Support\Str::limit(
                                        $p->description,
                                        125
                                    ) }}

                                </p>


                                <a
                                    href="/packages"
                                    class="brand-btn brand-btn-dark w-100"
                                >
                                    View & customise
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =====================================================
         GALLERY
         ===================================================== --}}

    @if($gallery->count())

        <section class="brand-section">

            <div class="container">

                <div class="row align-items-end mb-5">

                    <div class="col-lg-8">

                        <div class="brand-eyebrow">
                            Real events. Real moments.
                        </div>

                        <div class="section-heading">

                            <h2>
                                A glimpse of the celebrations
                                <em>we create.</em>
                            </h2>

                        </div>

                    </div>


                    <div class="col-lg-4 text-lg-end">

                        <a
                            href="/gallery"
                            class="section-link"
                        >
                            View full gallery
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>

                </div>


                <div class="row g-3">

                    @foreach($gallery->take(6) as $item)

                        <div class="col-6 col-lg-4">

                            <a
                                href="/gallery"
                                class="gallery-tile"
                            >

                                @if($item->type === 'image' && $item->file_path)

                                    <img
                                        src="{{ asset('storage/'.$item->file_path) }}"
                                        alt="{{ $item->title }}"
                                        loading="lazy"
                                    >

                                @elseif($item->thumbnail)

                                    <img
                                        src="{{ asset('storage/'.$item->thumbnail) }}"
                                        alt="{{ $item->title }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="gallery-placeholder">
                                        <i class="bi bi-play-circle fs-1"></i>
                                    </div>

                                @endif


                                <div class="gallery-overlay">

                                    <strong>
                                        {{ $item->title }}
                                    </strong>

                                </div>

                            </a>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         TESTIMONIALS
         ===================================================== --}}

    @if($testimonials->count())

        <section class="brand-section brand-section-soft">

            <div class="container">

                <div class="section-heading text-center mx-auto mb-5">

                    <div class="brand-eyebrow">
                        Guest love
                    </div>

                    <h2>
                        Good food gets remembered.
                        <em>Great service gets recommended.</em>
                    </h2>

                </div>


                <div class="row g-4">

                    @foreach($testimonials->take(3) as $t)

                        <div class="col-md-4">

                            <article class="testimonial-card">

                                <div class="quote-mark">
                                    “
                                </div>


                                <div class="testimonial-stars">

                                    @for($x = 1; $x <= ($t->rating ?: 5); $x++)

                                        <i class="bi bi-star-fill"></i>

                                    @endfor

                                </div>


                                <p class="testimonial-text">
                                    “{{ $t->testimonial }}”
                                </p>


                                <div class="testimonial-person">

                                    <div class="testimonial-avatar">

                                        @if($t->image)

                                            <img
                                                src="{{ asset('storage/'.$t->image) }}"
                                                alt="{{ $t->customer_name }}"
                                                loading="lazy"
                                            >

                                        @else

                                            <i class="bi bi-person"></i>

                                        @endif

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $t->customer_name }}
                                        </strong>

                                        <span>
                                            {{ $t->designation }}
                                        </span>

                                    </div>

                                </div>

                            </article>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         FINAL CTA
         ===================================================== --}}

    <section class="brand-section pt-0">

        <div class="container">

            <div class="final-cta">

                <div
                    class="row align-items-center g-4 position-relative"
                    style="z-index:2"
                >

                    <div class="col-lg-8">

                        <div
                            class="brand-eyebrow"
                            style="color:#e1c57c;"
                        >
                            Your date could be next
                        </div>

                        <h2 class="mt-3 mb-3">

                            Let’s create a menu your guests
                            will <em>remember.</em>

                        </h2>

                        <p class="lead mb-0">

                            Tell us your occasion, date and guest count.
                            We’ll help you plan the rest.

                        </p>

                    </div>


                    <div class="col-lg-4 text-lg-end">

                        <a
                            href="/contact"
                            class="brand-btn brand-btn-light"
                        >
                            Get a free quote
                            <i class="bi bi-arrow-up-right"></i>
                        </a>


                        <div
                            class="small mt-3"
                            style="color:rgba(255,255,255,.45)"
                        >
                            Prefer WhatsApp? Use the chat button.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
     * Subtle reveal animation for cards when available.
     */
    const animatedItems = document.querySelectorAll(
        '.service-card-new, .package-card-new, .testimonial-card, .process-card'
    );

    if ('IntersectionObserver' in window) {

        const observer = new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('fade-up');

                        observer.unobserve(entry.target);

                    }

                });

            },
            {
                threshold: 0.12
            }
        );

        animatedItems.forEach(function (item) {
            observer.observe(item);
        });

    }

});
</script>

@endsection