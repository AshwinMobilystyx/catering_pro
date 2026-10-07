<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? \App\Models\WebsiteSetting::get('business_name','Catering Pro') }}</title>
    <meta name="description"
        content="{{ \App\Models\WebsiteSetting::get('tagline','Delicious food. Memorable celebrations.') }}">
    <meta name="theme-color" content="#1f4d3a">

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Young+Serif&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    /* =========================================================
       THEME TOKENS — brand yahin se change hota hai
       ========================================================= */
    :root {
        --brand: #1f4d3a;
        /* mehendi green */
        --brand-dark: #153828;
        --brand-soft: #dfe9e1;
        --accent: #e3a018;
        /* marigold */
        --accent-soft: #f6e3b4;
        --ink: #1b2420;
        --muted: #5d6a63;
        --cream: #f7f8f4;
        /* page paper (var name purana rakha hai, other views break na ho) */
        --white: #fff;
        --line: #d6ddd3;
        --shadow: 0 1px 2px rgba(31, 77, 58, .08), 0 10px 30px rgba(31, 77, 58, .09);

        --font-display: 'Young Serif', Georgia, serif;
        --font-body: 'Hanken Grotesk', system-ui, -apple-system, "Segoe UI", sans-serif;

        --r-btn: 999px;
        --r-card: 10px;
        --r-media: 4px;
    }

    * {
        box-sizing: border-box
    }

    html {
        scroll-behavior: smooth
    }

    body {
        font-family: var(--font-body);
        background: var(--cream);
        color: var(--ink);
        line-height: 1.65;
        overflow-x: hidden
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .display-5,
    .display-6 {
        font-family: var(--font-display);
        font-weight: 400;
        letter-spacing: -.01em;
        line-height: 1.15;
        color: inherit
    }

    h6 {
        font-family: var(--font-body);
        font-weight: 700
    }

    .text-muted,
    .lead {
        color: var(--muted) !important
    }

    .text-white-50 {
        color: rgba(255, 255, 255, .68) !important
    }

    a {
        color: var(--brand)
    }

    a:focus-visible,
    .btn:focus-visible,
    button:focus-visible {
        outline: 3px solid var(--accent);
        outline-offset: 2px
    }

    /* ---------- Navbar ---------- */
    .navbar {
        background: rgba(247, 248, 244, .96) !important;
        backdrop-filter: blur(14px);
        border-bottom: 1px solid var(--line) !important;
        box-shadow: none
    }

    .navbar-brand {
        font-family: var(--font-display);
        font-weight: 400 !important;
        letter-spacing: 0;
        color: var(--brand) !important
    }

    .nav-link {
        font-weight: 600;
        color: var(--ink) !important;
        padding: .7rem .8rem !important;
        position: relative
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: .8rem;
        right: .8rem;
        bottom: .35rem;
        height: 2px;
        background: var(--accent);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .2s
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--brand) !important
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        transform: scaleX(1)
    }

    /* ---------- Buttons ---------- */
    .btn {
        font-weight: 600;
        border-radius: var(--r-btn);
        transition: background-color .2s, color .2s, border-color .2s
    }

    .btn-brand {
        background: var(--brand);
        border: 2px solid var(--brand);
        color: #fff
    }

    .btn-brand:hover,
    .btn-brand:focus-visible {
        background: var(--brand-dark);
        border-color: var(--brand-dark);
        color: #fff
    }

    .btn-outline-brand {
        border: 2px solid var(--brand);
        color: var(--brand);
        background: transparent
    }

    .btn-outline-brand:hover {
        background: var(--brand);
        color: #fff
    }

    .btn-light {
        background: var(--accent);
        border-color: var(--accent);
        color: #1b1405
    }

    .btn-light:hover {
        background: #f0b232;
        border-color: #f0b232;
        color: #1b1405
    }

    .btn-outline-light:hover {
        background: #fff;
        color: var(--brand-dark)
    }

    /* ---------- Sections ---------- */
    .section {
        padding: 88px 0
    }

    .section.pt-0 {
        padding-top: 0
    }

    .soft {
        background: var(--brand-soft)
    }

    .section-title {
        max-width: 760px
    }

    .section p {
        max-width: 68ch
    }

    .text-center p,
    .section-title p {
        margin-inline: auto
    }

    /* eyebrow: sentence case + marigold bar (no all-caps) */
    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: .6rem;
        font-size: .95rem;
        font-weight: 600;
        color: var(--brand);
        text-transform: none;
        letter-spacing: 0
    }

    .eyebrow::before {
        content: "";
        width: 28px;
        height: 3px;
        background: var(--accent);
        border-radius: 2px
    }

    .eyebrow.text-warning {
        color: var(--accent) !important
    }

    /* ---------- Cards & media ---------- */
    .card {
        border: 1px solid var(--line);
        border-radius: var(--r-card);
        box-shadow: none;
        overflow: hidden;
        background: #fff
    }

    .image-card {
        position: relative;
        overflow: hidden;
        transition: box-shadow .25s, border-color .25s
    }

    .image-card:hover {
        box-shadow: var(--shadow);
        border-color: transparent
    }

    .image-card img {
        transition: transform .5s cubic-bezier(.2, .7, .2, 1)
    }

    .image-card:hover img {
        transform: scale(1.04)
    }

    .rounded-4 {
        border-radius: var(--r-media) !important
    }

    .shadow {
        box-shadow: var(--shadow) !important
    }

    .service-img,
    .package-img {
        height: 230px;
        object-fit: cover;
        width: 100%
    }

    .package-card {
        position: relative
    }

    .package-card .package-img {
        height: 250px
    }

    .gallery-img {
        height: 275px;
        object-fit: cover;
        width: 100%;
        display: block
    }

    .avatar {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 50%
    }

    .text-warning {
        color: var(--accent) !important
    }

    .package-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        background: var(--accent);
        color: #1b1405;
        border-radius: var(--r-btn);
        padding: 6px 12px;
        font-size: .82rem;
        font-weight: 700
    }

    .feature-pill {
        background: #fff;
        border: 1px solid var(--line);
        color: var(--brand);
        border-radius: var(--r-btn);
        padding: 8px 14px;
        font-weight: 600;
        font-size: .95rem
    }

    .stats-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--r-card);
        padding: 24px;
        text-align: center;
        height: 100%
    }

    .stats-card strong {
        font-family: var(--font-display);
        font-weight: 400;
        font-size: 2.2rem;
        display: block;
        color: var(--brand)
    }

    /* steps = real sequence, isliye number rakha hai */
    .step-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--line);
        border-left: 3px solid var(--accent);
        border-radius: 0 var(--r-card) var(--r-card) 0;
        padding: 28px;
        height: 100%
    }

    .step-no {
        font-family: var(--font-display);
        font-size: 2.2rem;
        line-height: 1;
        color: var(--brand);
        margin-bottom: 14px
    }

    .step-card p {
        color: var(--muted);
        margin-bottom: 0
    }

    .menu-mini {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--r-card);
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 14px;
        height: 100%
    }

    .menu-mini img {
        width: 76px;
        height: 76px;
        border-radius: var(--r-media);
        object-fit: cover
    }

    .menu-mini .price {
        color: var(--brand);
        font-weight: 700
    }

    /* ---------- Hero (page ka ek memorable moment) ---------- */
    .hero-wrap {
        position: relative;
        background: var(--brand-dark)
    }

    .hero-slide {
        min-height: min(82vh, 740px);
        position: relative;
        display: flex;
        align-items: flex-end;
        color: #fff;
        overflow: hidden
    }

    .hero-media {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(21, 56, 40, .92) 0%, rgba(21, 56, 40, .65) 45%, rgba(21, 56, 40, .08) 100%)
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
        padding: 100px 0 90px
    }

    .hero-content h1 {
        font-size: clamp(2.5rem, 5.6vw, 4.6rem);
        line-height: 1.05;
        color: #fff;
        text-wrap: balance
    }

    .hero-content p {
        font-size: 1.15rem;
        line-height: 1.7;
        max-width: 620px;
        color: rgba(255, 255, 255, .86)
    }

    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 255, 255, .32);
        background: rgba(255, 255, 255, .08);
        border-radius: var(--r-btn);
        padding: 7px 15px;
        font-size: .9rem;
        font-weight: 500
    }

    .hero-kicker i {
        color: var(--accent)
    }

    .hero-fallback {
        background: var(--brand-dark)
    }

    .hero-dots {
        bottom: 30px
    }

    .hero-dots button {
        width: 28px !important;
        height: 3px !important;
        border: 0 !important;
        background: #fff !important;
        opacity: .45
    }

    .hero-dots button.active {
        background: var(--accent) !important;
        opacity: 1
    }

    .hero-arrow {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .14);
        top: auto;
        bottom: 34px;
        opacity: 1;
        margin: 0 18px
    }

    .hero-arrow.carousel-control-prev {
        left: auto;
        right: 74px
    }

    .hero-arrow.carousel-control-next {
        right: 0
    }

    /* sirf hero text par entrance animation */
    .reveal {
        animation: fadeUp .7s ease-out both
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    /* ---------- Trust strip ---------- */
    .trust-strip {
        background: var(--brand);
        color: #fff
    }

    .trust-item {
        display: flex;
        gap: 14px;
        align-items: center;
        padding: 22px 16px;
        height: 100%;
        border-right: 1px solid rgba(255, 255, 255, .14)
    }

    .trust-icon {
        color: var(--accent);
        font-size: 1.5rem;
        flex: none;
        display: grid;
        place-items: center
    }

    .trust-item strong {
        display: block;
        font-weight: 600
    }

    .trust-item span {
        font-size: .88rem;
        color: rgba(255, 255, 255, .72)
    }

    /* ---------- CTA band ---------- */
    .cta-band {
        background: var(--brand-dark);
        color: #fff;
        border-radius: var(--r-card);
        padding: 58px;
        position: relative;
        overflow: hidden
    }

    .cta-band:after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border: 36px solid rgba(227, 160, 24, .18);
        border-radius: 50%;
        right: -80px;
        top: -80px
    }

    /* ---------- Footer ---------- */
    .footer {
        background: var(--brand-dark);
        color: #e8efe9
    }

    .footer h6,
    .footer .h4 {
        color: #fff
    }

    .footer .h4 {
        font-family: var(--font-display);
        font-weight: 400
    }

    .footer a {
        color: #dbe6de;
        text-decoration: none
    }

    .footer a:hover {
        color: #fff
    }

    .footer .btn-outline-light:hover {
        color: var(--brand-dark)
    }

    .footer .btn-light {
        color: #1b1405
    }

    /* ---------- Floating / mobile ---------- */
    .whatsapp-float {
        position: fixed;
        right: 22px;
        bottom: 22px;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        z-index: 1000;
        display: grid;
        place-items: center;
        font-size: 1.5rem;
        box-shadow: 0 12px 30px #0004
    }

    .mobile-actions {
        display: none
    }

    @media(max-width:768px) {
        .section {
            padding: 60px 0
        }

        .hero-slide {
            min-height: 640px
        }

        .hero-overlay {
            background: linear-gradient(0deg, rgba(21, 56, 40, .94) 22%, rgba(21, 56, 40, .25) 100%)
        }

        .hero-content {
            padding: 80px 0 115px
        }

        .hero-content h1 {
            font-size: clamp(2.3rem, 11vw, 3.4rem)
        }

        .hero-content p {
            font-size: 1rem
        }

        .hero-arrow {
            display: none
        }

        .trust-item {
            border-right: 0;
            border-bottom: 1px solid rgba(255, 255, 255, .14);
            padding: 16px 10px
        }

        .cta-band {
            padding: 35px 25px
        }

        .gallery-img {
            height: 190px
        }

        .mobile-actions {
            position: fixed;
            display: flex;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff;
            z-index: 9999;
            padding: 8px;
            gap: 8px;
            box-shadow: 0 -8px 30px #0002
        }

        .mobile-actions a {
            flex: 1
        }

        .whatsapp-float {
            bottom: 75px;
            right: 16px
        }
    }

    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation: none !important;
            transition: none !important;
            scroll-behavior: auto !important
        }
    }
    
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container py-2">
            <a class="navbar-brand fs-4 d-flex align-items-center gap-2" href="/">
                @if(\App\Models\WebsiteSetting::get('logo'))
                    <img src="{{ asset('storage/'.\App\Models\WebsiteSetting::get('logo')) }}"
                        alt="{{ \App\Models\WebsiteSetting::get('business_name','Catering Pro') }} logo"
                        style="height:40px;width:40px;object-fit:cover;border-radius:8px">
                @endif
                {{ \App\Models\WebsiteSetting::get('business_name','Catering Pro') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link @if(request()->is('/')) active @endif" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('services*')) active @endif" href="/services">Services</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('menu*')) active @endif" href="/menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('packages*')) active @endif" href="/packages">Packages</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('gallery*')) active @endif" href="/gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('about*')) active @endif" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->is('contact*')) active @endif" href="/contact">Contact</a></li>
                    @if(session('customer_id'))
                        <li class="nav-item"><a class="btn btn-sm btn-brand px-3 ms-lg-2" href="/customer/dashboard">My Account</a></li>
                    @else
                        <li class="nav-item"><a class="btn btn-sm btn-brand px-3 ms-lg-2" href="/login">Book Your Event</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))<div class="alert alert-success m-0 rounded-0 text-center">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger m-0 rounded-0 text-center">{{ session('error') }}</div>@endif

    <main>@yield('content')</main>

    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="h4 mb-3">{{ \App\Models\WebsiteSetting::get('business_name','Catering Pro') }}</div>
                    <p class="text-white-50">
                        {{ \App\Models\WebsiteSetting::get('tagline','Delicious food. Memorable celebrations.') }}</p>
                    <div class="d-flex gap-2 mt-4">
                        <a class="btn btn-outline-light rounded-circle" aria-label="Instagram"
                            href="{{ \App\Models\WebsiteSetting::get('instagram','#') }}"><i class="bi bi-instagram"></i></a>
                        <a class="btn btn-outline-light rounded-circle" aria-label="Facebook"
                            href="{{ \App\Models\WebsiteSetting::get('facebook','#') }}"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-light rounded-circle" aria-label="YouTube"
                            href="{{ \App\Models\WebsiteSetting::get('youtube','#') }}"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <h6>Contact</h6>
                    <p class="text-white-50 mb-2"><i class="bi bi-telephone me-2"></i>{{ \App\Models\WebsiteSetting::get('phone') }}</p>
                    <p class="text-white-50 mb-2"><i class="bi bi-envelope me-2"></i>{{ \App\Models\WebsiteSetting::get('email') }}</p>
                    <p class="text-white-50">{{ \App\Models\WebsiteSetting::get('address') }}</p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <h6>Ready to plan your event?</h6>
                    <p class="text-white-50">Share your date, guest count and occasion. We’ll help shape the menu.</p>
                    <a class="btn btn-light px-4" href="/contact">Get a free quote <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="small text-white-50">© {{ date('Y') }}
                {{ \App\Models\WebsiteSetting::get('business_name','Catering Pro') }}. All rights reserved.</div>
        </div>
    </footer>

    @if(\App\Models\WebsiteSetting::get('whatsapp'))
        <a class="whatsapp-float btn btn-success" target="_blank" rel="noopener"
            href="https://wa.me/{{ \App\Models\WebsiteSetting::get('whatsapp') }}" aria-label="Chat on WhatsApp"><i
                class="bi bi-whatsapp"></i></a>
    @endif

    <div class="mobile-actions">
        <a class="btn btn-outline-brand" href="/menu"><i class="bi bi-egg-fried me-1"></i> Menu</a>
        <a class="btn btn-brand" href="/contact"><i class="bi bi-calendar2-check me-1"></i> Get Quote</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>