@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       CATERING PRO — PREMIUM GALLERY
    ========================================================= */

    .gallery-page {
        --gp-dark: #17110e;
        --gp-dark-2: #2b1a12;
        --gp-brown: #59331f;
        --gp-gold: #c9955b;
        --gp-gold-light: #e8c18f;
        --gp-cream: #fbf8f3;
        --gp-paper: #fffdf9;
        --gp-border: #eadfd3;
        --gp-muted: #756d67;

        min-height: 100vh;
        background: var(--gp-cream);
        color: var(--gp-dark);
        overflow: hidden;
    }

    .gallery-page *,
    .gallery-page *::before,
    .gallery-page *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .gallery-hero {
        position: relative;
        min-height: 560px;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        background:
            radial-gradient(circle at 82% 18%, rgba(201,149,91,.28), transparent 28%),
            radial-gradient(circle at 10% 80%, rgba(255,255,255,.06), transparent 25%),
            linear-gradient(135deg, #17110e 0%, #382117 48%, #5b3520 100%);
    }

    .gallery-hero::before {
        content: "";
        position: absolute;
        width: 600px;
        height: 600px;
        right: -220px;
        top: -300px;
        border: 1px solid rgba(255,255,255,.11);
        border-radius: 50%;
        box-shadow:
            0 0 0 70px rgba(255,255,255,.018),
            0 0 0 140px rgba(255,255,255,.012);
        animation: galleryRotate 22s linear infinite;
    }

    .gallery-hero::after {
        content: "";
        position: absolute;
        width: 380px;
        height: 380px;
        left: -200px;
        bottom: -220px;
        border: 1px solid rgba(201,149,91,.18);
        border-radius: 50%;
        animation: galleryRotateReverse 18s linear infinite;
    }

    .gallery-grid-bg {
        position: absolute;
        inset: 0;
        opacity: .055;
        background-image:
            linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(to bottom, black 20%, transparent 95%);
    }

    .gallery-hero-glow {
        position: absolute;
        width: 520px;
        height: 520px;
        right: 8%;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,149,91,.13), transparent 65%);
        filter: blur(10px);
        pointer-events: none;
    }

    .gallery-hero-content {
        position: relative;
        z-index: 2;
        padding: 105px 0 95px;
        max-width: 850px;
    }

    .gallery-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
        color: rgba(255,255,255,.58);
        font-size: 13px;
        letter-spacing: .2px;
    }

    .gallery-breadcrumb a {
        color: #fff;
        text-decoration: none;
        transition: .25s ease;
    }

    .gallery-breadcrumb a:hover {
        color: var(--gp-gold-light);
    }

    .gallery-badge {
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
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .gallery-badge i {
        color: var(--gp-gold-light);
    }

    .gallery-title {
        margin: 22px 0 20px;
        max-width: 850px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(48px, 7vw, 88px);
        line-height: .96;
        font-weight: 500;
        letter-spacing: -3px;
    }

    .gallery-title span {
        color: var(--gp-gold-light);
        font-style: italic;
    }

    .gallery-subtitle {
        max-width: 690px;
        margin: 0;
        color: rgba(255,255,255,.68);
        font-size: 17px;
        line-height: 1.85;
    }

    .hero-scroll {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 36px;
        color: rgba(255,255,255,.52);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .hero-scroll-line {
        width: 42px;
        height: 1px;
        background: rgba(255,255,255,.35);
    }

    /* =========================================================
       MAIN CONTENT
    ========================================================= */

    .gallery-content {
        padding: 100px 0 90px;
        position: relative;
    }

    .section-heading {
        max-width: 760px;
        margin-bottom: 38px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #9a603b;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .eyebrow::before {
        content: "";
        width: 28px;
        height: 1px;
        background: var(--gp-gold);
    }

    .section-heading h2 {
        margin: 12px 0 13px;
        color: var(--gp-dark);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(36px, 5vw, 58px);
        line-height: 1.05;
        font-weight: 500;
        letter-spacing: -1.8px;
    }

    .section-heading p {
        max-width: 650px;
        margin: 0;
        color: var(--gp-muted);
        font-size: 16px;
        line-height: 1.85;
    }

    /* =========================================================
       TOOLBAR
    ========================================================= */

    .gallery-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 32px;
        padding: 10px;
        border: 1px solid var(--gp-border);
        border-radius: 18px;
        background: rgba(255,255,255,.8);
        box-shadow: 0 15px 45px rgba(49,29,17,.055);
        backdrop-filter: blur(14px);
    }

    .gallery-filters {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .gallery-filter {
        border: 1px solid transparent;
        background: transparent;
        color: #66574d;
        padding: 10px 17px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: .25s ease;
    }

    .gallery-filter:hover {
        color: var(--gp-dark);
        background: #f7eee5;
    }

    .gallery-filter.active {
        color: #fff;
        background: var(--gp-dark);
        box-shadow: 0 8px 20px rgba(23,17,14,.16);
    }

    .gallery-count {
        padding: 0 12px;
        color: #8d8178;
        font-size: 12px;
        font-weight: 700;
    }

    /* =========================================================
       MASONRY-STYLE GRID
    ========================================================= */

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 18px;
    }

    .gallery-entry {
        grid-column: span 4;
        min-width: 0;
    }

    .gallery-entry:nth-child(5n + 1) {
        grid-column: span 8;
    }

    .gallery-entry:nth-child(5n + 2),
    .gallery-entry:nth-child(5n + 3) {
        grid-column: span 4;
    }

    .gallery-entry:nth-child(5n + 4),
    .gallery-entry:nth-child(5n + 5) {
        grid-column: span 6;
    }

    .gallery-item {
        position: relative;
        height: 330px;
        overflow: hidden;
        border-radius: 24px;
        background: #e9ded4;
        cursor: pointer;
        box-shadow: 0 12px 35px rgba(49,29,17,.075);
        transition:
            transform .45s cubic-bezier(.2,.8,.2,1),
            box-shadow .45s ease;
    }

    .gallery-entry:nth-child(5n + 1) .gallery-item {
        height: 430px;
    }

    .gallery-entry:nth-child(5n + 4) .gallery-item,
    .gallery-entry:nth-child(5n + 5) .gallery-item {
        height: 390px;
    }

    .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 65px rgba(49,29,17,.16);
    }

    .gallery-item img,
    .gallery-item video {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .85s cubic-bezier(.2,.8,.2,1);
    }

    .gallery-item:hover img,
    .gallery-item:hover video {
        transform: scale(1.075);
    }

    .gallery-item::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(0,0,0,.02) 20%,
            rgba(0,0,0,.03) 45%,
            rgba(17,9,5,.82) 100%
        );
        opacity: .65;
        pointer-events: none;
        transition: opacity .35s ease;
    }

    .gallery-item:hover::after {
        opacity: .9;
    }

    .gallery-overlay {
        position: absolute;
        z-index: 3;
        inset: auto 0 0;
        padding: 25px;
        pointer-events: none;
    }

    .gallery-info {
        color: #fff;
        transform: translateY(8px);
        transition: transform .35s ease;
    }

    .gallery-item:hover .gallery-info {
        transform: translateY(0);
    }

    .gallery-info h5 {
        margin: 0 0 5px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 21px;
        font-weight: 500;
    }

    .gallery-info span {
        color: rgba(255,255,255,.65);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .gallery-zoom {
        position: absolute;
        z-index: 4;
        top: 18px;
        right: 18px;
        width: 44px;
        height: 44px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 50%;
        color: #fff;
        background: rgba(17,10,6,.45);
        backdrop-filter: blur(10px);
        opacity: 0;
        transform: scale(.75);
        transition: .3s ease;
    }

    .gallery-item:hover .gallery-zoom {
        opacity: 1;
        transform: scale(1);
    }

    .video-play-badge {
        position: absolute;
        z-index: 4;
        left: 50%;
        top: 50%;
        width: 64px;
        height: 64px;
        display: grid;
        place-items: center;
        transform: translate(-50%, -50%);
        border: 1px solid rgba(255,255,255,.32);
        border-radius: 50%;
        color: #fff;
        background: rgba(154,96,59,.9);
        box-shadow: 0 15px 40px rgba(0,0,0,.22);
        font-size: 23px;
        pointer-events: none;
    }

    /* =========================================================
       VIDEO SECTION
    ========================================================= */

    .videos-section {
        margin-top: 105px;
        padding-top: 5px;
    }

    .video-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--gp-border);
        border-radius: 25px;
        background: #fff;
        box-shadow: 0 14px 40px rgba(49,29,17,.06);
        transition: .4s ease;
    }

    .video-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 65px rgba(49,29,17,.13);
    }

    .video-wrapper {
        position: relative;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: #1a100c;
    }

    .video-wrapper video,
    .video-wrapper iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
        object-fit: cover;
    }

    .video-body {
        padding: 23px 24px 25px;
    }

    .video-body h4 {
        margin: 0 0 7px;
        color: var(--gp-dark);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 22px;
        font-weight: 500;
    }

    .video-body p {
        margin: 0;
        color: var(--gp-muted);
        font-size: 14px;
        line-height: 1.75;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .empty-gallery {
        padding: 90px 25px;
        text-align: center;
        border: 1px dashed #dccbbd;
        border-radius: 25px;
        background: #fff;
    }

    .empty-gallery-icon {
        width: 82px;
        height: 82px;
        display: grid;
        place-items: center;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #f7ede4;
        font-size: 34px;
    }

    .empty-gallery h3 {
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-weight: 500;
    }

    /* =========================================================
       CTA
    ========================================================= */

    .gallery-cta {
        position: relative;
        overflow: hidden;
        margin-top: 90px;
        padding: 62px;
        border-radius: 30px;
        color: #fff;
        background:
            radial-gradient(circle at 90% 10%, rgba(232,193,143,.25), transparent 27%),
            radial-gradient(circle at 0% 100%, rgba(255,255,255,.04), transparent 30%),
            linear-gradient(135deg, #21140e, #59321f);
        box-shadow: 0 25px 70px rgba(35,19,11,.15);
    }

    .gallery-cta::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -100px;
        bottom: -170px;
        border: 1px solid rgba(255,255,255,.09);
        border-radius: 50%;
    }

    .gallery-cta h3 {
        position: relative;
        z-index: 1;
        margin: 8px 0 11px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.08;
        font-weight: 500;
    }

    .gallery-cta p {
        position: relative;
        z-index: 1;
        max-width: 650px;
        margin: 0;
        color: rgba(255,255,255,.66);
        line-height: 1.8;
    }

    .cta-button {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 14px 24px;
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 100px;
        color: #21140e;
        background: var(--gp-gold-light);
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        box-shadow: 0 12px 30px rgba(0,0,0,.16);
        transition: .3s ease;
    }

    .cta-button:hover {
        color: #21140e;
        background: #fff;
        transform: translateY(-3px);
    }

    /* =========================================================
       LIGHTBOX
    ========================================================= */

    .gallery-lightbox {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 25px;
        background: rgba(8,5,3,.94);
        backdrop-filter: blur(14px);
    }

    .gallery-lightbox.show {
        display: flex;
        animation: lightboxFade .22s ease;
    }

    .lightbox-content {
        position: relative;
        max-width: 1200px;
        max-height: 90vh;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .lightbox-content img {
        display: block;
        max-width: 100%;
        max-height: 86vh;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 35px 100px rgba(0,0,0,.5);
    }

    .lightbox-close {
        position: fixed;
        z-index: 2;
        top: 22px;
        right: 25px;
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 50%;
        color: #fff;
        background: rgba(255,255,255,.1);
        cursor: pointer;
        backdrop-filter: blur(10px);
        transition: .25s ease;
    }

    .lightbox-close:hover {
        background: rgba(255,255,255,.2);
        transform: rotate(90deg);
    }

    /* =========================================================
       ANIMATIONS
    ========================================================= */

    @keyframes galleryRotate {
        from { transform: rotate(0); }
        to { transform: rotate(360deg); }
    }

    @keyframes galleryRotateReverse {
        from { transform: rotate(360deg); }
        to { transform: rotate(0); }
    }

    @keyframes lightboxFade {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {
        .gallery-hero {
            min-height: 500px;
        }

        .gallery-entry,
        .gallery-entry:nth-child(5n + 1),
        .gallery-entry:nth-child(5n + 2),
        .gallery-entry:nth-child(5n + 3),
        .gallery-entry:nth-child(5n + 4),
        .gallery-entry:nth-child(5n + 5) {
            grid-column: span 6;
        }

        .gallery-entry .gallery-item,
        .gallery-entry:nth-child(5n + 1) .gallery-item,
        .gallery-entry:nth-child(5n + 4) .gallery-item,
        .gallery-entry:nth-child(5n + 5) .gallery-item {
            height: 340px;
        }

        .gallery-cta {
            padding: 48px;
        }
    }

    @media (max-width: 767px) {
        .gallery-hero {
            min-height: 450px;
        }

        .gallery-hero-content {
            padding: 72px 0 65px;
        }

        .gallery-title {
            font-size: 51px;
            letter-spacing: -2px;
        }

        .gallery-subtitle {
            font-size: 15px;
        }

        .gallery-content {
            padding: 70px 0;
        }

        .section-heading h2 {
            font-size: 39px;
        }

        .gallery-toolbar {
            align-items: flex-start;
        }

        .gallery-count {
            padding: 3px 8px 5px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .gallery-entry,
        .gallery-entry:nth-child(5n + 1),
        .gallery-entry:nth-child(5n + 2),
        .gallery-entry:nth-child(5n + 3),
        .gallery-entry:nth-child(5n + 4),
        .gallery-entry:nth-child(5n + 5) {
            grid-column: 1;
        }

        .gallery-entry .gallery-item,
        .gallery-entry:nth-child(5n + 1) .gallery-item,
        .gallery-entry:nth-child(5n + 4) .gallery-item,
        .gallery-entry:nth-child(5n + 5) .gallery-item {
            height: 310px;
        }

        .gallery-item:hover {
            transform: none;
        }

        .gallery-overlay {
            padding: 20px;
        }

        .gallery-zoom {
            opacity: 1;
            transform: scale(1);
        }

        .gallery-item::after {
            opacity: .85;
        }

        .gallery-info {
            transform: none;
        }

        .videos-section {
            margin-top: 75px;
        }

        .gallery-cta {
            margin-top: 70px;
            padding: 34px 25px;
            border-radius: 23px;
        }

        .cta-button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .gallery-title {
            font-size: 45px;
        }

        .gallery-filter {
            padding: 9px 13px;
        }

        .gallery-content {
            padding-top: 55px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .gallery-page *,
        .gallery-page *::before,
        .gallery-page *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
            scroll-behavior: auto !important;
        }
    }
</style>


<div class="gallery-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="gallery-hero">

        <div class="gallery-grid-bg"></div>
        <div class="gallery-hero-glow"></div>

        <div class="container">

            <div class="gallery-hero-content">

                <div class="gallery-breadcrumb">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>Gallery</span>

                </div>

                <div class="gallery-badge">

                    <i class="bi bi-camera-fill"></i>

                    Real Food · Real Celebrations

                </div>

                <h1 class="gallery-title">
                    Moments worth
                    <br>
                    <span>remembering.</span>
                </h1>

                <p class="gallery-subtitle">
                    Explore the food, people, celebrations and beautiful
                    setups we've had the pleasure of creating for our clients.
                </p>

                <div class="hero-scroll">
                    <span class="hero-scroll-line"></span>
                    Explore our work
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <section class="gallery-content">

        <div class="container">

            <div class="section-heading">

                <div class="eyebrow">
                    Our Work
                </div>

                <h2>
                    A taste of what we create.
                </h2>

                <p>
                    From beautifully presented dishes to thoughtfully designed
                    event setups, here's a glimpse into the experiences we create.
                </p>

            </div>


            {{-- FILTER TOOLBAR --}}

            <div class="gallery-toolbar">

                <div class="gallery-filters">

                    <button
                        type="button"
                        class="gallery-filter active"
                        data-filter="all">
                        All
                    </button>

                    <button
                        type="button"
                        class="gallery-filter"
                        data-filter="image">
                        <i class="bi bi-images me-1"></i>
                        Photos
                    </button>

                    <button
                        type="button"
                        class="gallery-filter"
                        data-filter="video">
                        <i class="bi bi-play-circle me-1"></i>
                        Videos
                    </button>

                </div>

                <div class="gallery-count">
                    {{ $gallery->count() }} media items
                </div>

            </div>


            {{-- =================================================
                 GALLERY
            ================================================== --}}

            @if($gallery->count())

                <div class="gallery-grid" id="galleryGrid">

                    @foreach($gallery as $index => $g)

                        <div
                            class="gallery-entry"
                            data-type="{{ $g->type }}"
                        >

                            <div
                                class="gallery-item"
                                @if($g->type === 'image')
                                    data-lightbox="{{ asset('storage/'.$g->file_path) }}"
                                    data-title="{{ $g->title }}"
                                @endif
                            >

                                @if($g->type === 'image')

                                    <img
                                        src="{{ asset('storage/'.$g->file_path) }}"
                                        alt="{{ $g->title }}"
                                        loading="lazy"
                                    >

                                    <div class="gallery-zoom">
                                        <i class="bi bi-arrows-fullscreen"></i>
                                    </div>

                                @else

                                    <video
                                        src="{{ asset('storage/'.$g->file_path) }}"
                                        preload="metadata"
                                        muted
                                        playsinline
                                    ></video>

                                    <div class="video-play-badge">
                                        <i class="bi bi-play-fill"></i>
                                    </div>

                                @endif


                                <div class="gallery-overlay">

                                    <div class="gallery-info">

                                        <h5>
                                            {{ $g->title }}
                                        </h5>

                                        <span>
                                            {{ $g->type === 'image' ? 'Event Photo' : 'Event Video' }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-gallery">

                    <div class="empty-gallery-icon">
                        📸
                    </div>

                    <h3>
                        Our gallery is coming soon
                    </h3>

                    <p class="text-muted mb-0">
                        We're preparing some beautiful moments to share with you.
                    </p>

                </div>

            @endif


            {{-- =================================================
                 FEATURED VIDEOS
            ================================================== --}}

            @if($videos->count())

                <div class="videos-section">

                    <div class="section-heading">

                        <div class="eyebrow">
                            Watch & Experience
                        </div>

                        <h2>
                            See us in action.
                        </h2>

                        <p>
                            Get a feel for our food, service and the atmosphere
                            we create at every celebration.
                        </p>

                    </div>


                    <div class="row g-4">

                        @foreach($videos as $v)

                            <div class="col-md-6">

                                <article class="video-card">

                                    <div class="video-wrapper">

                                        @if($v->video_path)

                                            <video
                                                controls
                                                preload="metadata"
                                                @if($v->thumbnail)
                                                    poster="{{ asset('storage/'.$v->thumbnail) }}"
                                                @endif
                                            >

                                                <source
                                                    src="{{ asset('storage/'.$v->video_path) }}"
                                                    type="video/mp4"
                                                >

                                                Your browser does not support video playback.

                                            </video>

                                        @elseif($v->video_url)

                                            @php

                                                $videoUrl = $v->video_url;

                                                if (str_contains($videoUrl, 'youtube.com/watch?v=')) {

                                                    $videoId = explode('v=', $videoUrl)[1] ?? null;
                                                    $videoId = explode('&', $videoId)[0] ?? null;

                                                    $videoUrl = $videoId
                                                        ? 'https://www.youtube.com/embed/'.$videoId
                                                        : $v->video_url;

                                                } elseif (str_contains($videoUrl, 'youtu.be/')) {

                                                    $videoId = explode('youtu.be/', $videoUrl)[1] ?? null;
                                                    $videoId = explode('?', $videoId)[0] ?? null;

                                                    $videoUrl = $videoId
                                                        ? 'https://www.youtube.com/embed/'.$videoId
                                                        : $v->video_url;
                                                }

                                            @endphp

                                            <iframe
                                                src="{{ $videoUrl }}"
                                                title="{{ $v->title }}"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen
                                                loading="lazy">
                                            </iframe>

                                        @else

                                            <div
                                                class="w-100 h-100 d-grid place-items-center text-white"
                                                style="
                                                    display:grid;
                                                    place-items:center;
                                                    background:linear-gradient(135deg,#24150e,#875337);
                                                "
                                            >

                                                <i class="bi bi-camera-video fs-1"></i>

                                            </div>

                                        @endif

                                    </div>


                                    <div class="video-body">

                                        <h4>
                                            {{ $v->title }}
                                        </h4>

                                        @if($v->description)

                                            <p>
                                                {{ $v->description }}
                                            </p>

                                        @endif

                                    </div>

                                </article>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- =================================================
                 CTA
            ================================================== --}}

            <div class="gallery-cta">

                <div class="row align-items-center g-4">

                    <div class="col-lg-8">

                        <div class="eyebrow text-white opacity-75 mb-2">
                            Your event could be next
                        </div>

                        <h3>
                            Let's create something worth capturing.
                        </h3>

                        <p>
                            Tell us about your celebration and we'll help
                            turn it into an experience your guests will
                            remember long after the last plate.
                        </p>

                    </div>

                    <div class="col-lg-4 text-lg-end">

                        <a
                            href="{{ url('/contact') }}"
                            class="cta-button"
                        >
                            Plan My Event
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     LIGHTBOX
========================================================= --}}

<div
    class="gallery-lightbox"
    id="galleryLightbox"
    aria-hidden="true"
>

    <button
        type="button"
        class="lightbox-close"
        id="lightboxClose"
        aria-label="Close"
    >
        <i class="bi bi-x-lg"></i>
    </button>

    <div class="lightbox-content">

        <img
            id="lightboxImage"
            src=""
            alt="Gallery preview"
        >

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       GALLERY FILTER
    ====================================================== */

    const filterButtons = document.querySelectorAll('.gallery-filter');
    const galleryEntries = document.querySelectorAll('.gallery-entry');

    filterButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            filterButtons.forEach(function (btn) {
                btn.classList.remove('active');
            });

            this.classList.add('active');

            const filter = this.dataset.filter;

            galleryEntries.forEach(function (entry) {

                const type = entry.dataset.type;

                if (filter === 'all' || type === filter) {

                    entry.style.display = '';

                } else {

                    entry.style.display = 'none';

                }

            });

        });

    });


    /* =====================================================
       IMAGE LIGHTBOX
    ====================================================== */

    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxClose = document.getElementById('lightboxClose');

    document.querySelectorAll('[data-lightbox]').forEach(function (item) {

        item.addEventListener('click', function () {

            const imageUrl = this.dataset.lightbox;
            const title = this.dataset.title || 'Gallery image';

            lightboxImage.src = imageUrl;
            lightboxImage.alt = title;

            lightbox.classList.add('show');
            lightbox.setAttribute('aria-hidden', 'false');

            document.body.style.overflow = 'hidden';

        });

    });


    function closeLightbox() {

        lightbox.classList.remove('show');
        lightbox.setAttribute('aria-hidden', 'true');

        lightboxImage.src = '';

        document.body.style.overflow = '';

    }


    lightboxClose.addEventListener('click', closeLightbox);


    lightbox.addEventListener('click', function (event) {

        if (event.target === lightbox) {
            closeLightbox();
        }

    });


    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeLightbox();
        }

    });

});
</script>

@endsection