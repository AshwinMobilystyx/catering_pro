@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       PREMIUM MENU PAGE
       ========================================================= */

    .menu-page {
        --ink: #171411;
        --ink-soft: #2b211a;
        --cream: #f7f3ec;
        --paper: #fffdf9;
        --gold: #c69a61;
        --gold-light: #e4c28e;
        --brown: #71472d;
        --muted: #756d65;
        --line: #e8ded2;
        --green: #3e7040;
        --red: #a43d35;

        min-height: 100vh;
        overflow: hidden;
        background: var(--paper);
        color: var(--ink);
    }

    /* =========================================================
       HERO
       ========================================================= */

    .menu-hero {
        position: relative;
        min-height: 610px;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        background:
            radial-gradient(
                circle at 82% 18%,
                rgba(198,154,97,.24),
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

    .menu-hero::before {
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
        animation: rotateSlow 26s linear infinite;
    }

    .menu-hero::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        left: -175px;
        bottom: -185px;
        border: 1px solid rgba(198,154,97,.2);
        border-radius: 50%;
    }

    .menu-grid {
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

    .menu-hero-line {
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

    .menu-hero-line.one {
        left: 17%;
    }

    .menu-hero-line.two {
        left: 80%;
    }

    .menu-hero-content {
        position: relative;
        z-index: 3;
        padding: 105px 0 100px;
    }

    .menu-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 28px;
        color: rgba(255,255,255,.52);
        font-size: 13px;
    }

    .menu-breadcrumb a {
        color: rgba(255,255,255,.86);
        text-decoration: none;
        transition: color .25s ease;
    }

    .menu-breadcrumb a:hover {
        color: var(--gold-light);
    }

    .menu-kicker {
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

    .menu-kicker::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--gold);
    }

    .menu-title {
        max-width: 900px;
        margin: 0 0 25px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(55px, 8vw, 100px);
        line-height: .94;
        font-weight: 400;
        letter-spacing: -3px;
    }

    .menu-title em {
        color: var(--gold-light);
        font-style: italic;
    }

    .menu-subtitle {
        max-width: 670px;
        margin: 0;
        color: rgba(255,255,255,.66);
        font-size: 17px;
        line-height: 1.9;
    }

    .hero-food-note {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-top: 38px;
        color: rgba(255,255,255,.45);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .hero-food-note i {
        color: var(--gold);
        font-size: 17px;
    }

    /* =========================================================
       CONTENT
       ========================================================= */

    .menu-content {
        padding: 90px 0 115px;
        background: var(--paper);
    }

    /* =========================================================
       TOOLBAR
       ========================================================= */

    .menu-toolbar {
        position: sticky;
        top: 15px;
        z-index: 50;
        padding: 13px;
        margin-bottom: 65px;
        border: 1px solid var(--line);
        border-radius: 5px;
        background: rgba(255,253,249,.94);
        backdrop-filter: blur(18px);
        box-shadow: 0 18px 45px rgba(40,25,15,.07);
    }

    .menu-search {
        position: relative;
    }

    .menu-search i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #988d82;
        font-size: 15px;
    }

    .menu-search input {
        width: 100%;
        height: 50px;
        padding: 0 18px 0 46px;
        border: 1px solid #e3d9ce;
        border-radius: 3px;
        outline: none;
        background: #fff;
        color: var(--ink);
        font-size: 14px;
        transition: all .25s ease;
    }

    .menu-search input::placeholder {
        color: #a39a92;
    }

    .menu-search input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 4px rgba(198,154,97,.09);
    }

    .menu-filters {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 7px;
    }

    .menu-filter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 40px;
        border: 1px solid #e2d8cd;
        border-radius: 3px;
        padding: 9px 15px;
        background: #fff;
        color: #594d44;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        cursor: pointer;
        transition: all .25s ease;
    }

    .menu-filter:hover {
        border-color: var(--ink);
        color: var(--ink);
        transform: translateY(-1px);
    }

    .menu-filter.active {
        border-color: var(--ink);
        background: var(--ink);
        color: #fff;
    }

    /* =========================================================
       CATEGORY
       ========================================================= */

    .menu-category {
        margin-bottom: 85px;
        scroll-margin-top: 110px;
    }

    .category-header {
        display: flex;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 28px;
    }

    .category-heading {
        min-width: max-content;
    }

    .category-number {
        margin-bottom: 6px;
        color: var(--brown);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .category-header h2 {
        margin: 0;
        color: var(--ink);
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(33px, 4vw, 48px);
        font-weight: 400;
        line-height: 1;
        letter-spacing: -1px;
    }

    .category-line {
        flex: 1;
        height: 1px;
        margin-bottom: 7px;
        background: linear-gradient(
            90deg,
            #d2b18e,
            transparent
        );
    }

    .category-count {
        min-width: max-content;
        margin-bottom: 4px;
        color: #9a9087;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* =========================================================
       FOOD CARD
       ========================================================= */

    .food-item {
        transition: opacity .25s ease, transform .25s ease;
    }

    .food-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 12px 35px rgba(40,25,15,.05);
        transition:
            transform .45s cubic-bezier(.2,.8,.2,1),
            box-shadow .45s ease,
            border-color .3s ease;
    }

    .food-card:hover {
        transform: translateY(-8px);
        border-color: rgba(198,154,97,.45);
        box-shadow: 0 28px 60px rgba(40,25,15,.12);
    }

    .food-image {
        position: relative;
        height: 225px;
        overflow: hidden;
        background:
            linear-gradient(
                135deg,
                #2d1a0f,
                #9d6540
            );
    }

    .food-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition:
            transform .75s cubic-bezier(.2,.8,.2,1),
            filter .5s ease;
    }

    .food-card:hover .food-image img {
        transform: scale(1.08);
        filter: saturate(1.08);
    }

    .food-image::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(
            to top,
            rgba(15,9,5,.48),
            transparent 55%
        );
    }

    .food-image::before {
        content: "";
        position: absolute;
        z-index: 2;
        top: -20%;
        left: -130%;
        width: 70px;
        height: 150%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.22),
            transparent
        );
        transform: rotate(20deg);
        transition: left .85s ease;
    }

    .food-card:hover .food-image::before {
        left: 125%;
    }

    /* =========================================================
       DIET BADGE
       ========================================================= */

    .diet-badge {
        position: absolute;
        z-index: 4;
        top: 14px;
        right: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border: 1px solid rgba(255,255,255,.45);
        border-radius: 3px;
        background: rgba(255,255,255,.91);
        color: var(--green);
        box-shadow: 0 6px 20px rgba(0,0,0,.10);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .diet-dot {
        width: 7px;
        height: 7px;
        border: 1px solid currentColor;
        border-radius: 2px;
        position: relative;
    }

    .diet-dot::after {
        content: "";
        position: absolute;
        width: 3px;
        height: 3px;
        top: 1px;
        left: 1px;
        border-radius: 50%;
        background: currentColor;
    }

    .diet-badge.non-veg {
        color: var(--red);
    }

    /* =========================================================
       FOOD BODY
       ========================================================= */

    .food-body {
        min-height: 190px;
        display: flex;
        flex-direction: column;
        padding: 23px;
    }

    .food-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .food-title {
        margin: 0;
        color: var(--ink);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 22px;
        font-weight: 400;
        line-height: 1.2;
    }

    .food-price {
        color: var(--brown);
        font-size: 15px;
        font-weight: 800;
        white-space: nowrap;
    }

    .food-description {
        flex: 1;
        margin: 11px 0 17px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.75;
    }

    .food-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-top: 14px;
        border-top: 1px solid #eee7df;
    }

    .jain-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border: 1px solid #d9e8d8;
        border-radius: 3px;
        background: #f3f8f1;
        color: #477248;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .jain-badge i {
        font-size: 11px;
    }

    .dish-mark {
        color: #b5aaa0;
        font-size: 13px;
    }

    .food-card-hidden {
        display: none !important;
    }

    /* =========================================================
       EMPTY
       ========================================================= */

    .empty-menu {
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

    .empty-menu h3 {
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 28px;
        font-weight: 400;
    }

    .empty-menu p {
        margin: 0;
        color: var(--muted);
    }

    /* =========================================================
       CTA
       ========================================================= */

    .menu-cta {
        position: relative;
        overflow: hidden;
        margin-top: 25px;
        padding: 65px;
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

    .menu-cta::before {
        content: "";
        position: absolute;
        width: 370px;
        height: 370px;
        right: -190px;
        bottom: -210px;
        border: 1px solid rgba(228,194,142,.18);
        border-radius: 50%;
    }

    .menu-cta-content {
        position: relative;
        z-index: 2;
    }

    .cta-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
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

    .menu-cta h3 {
        max-width: 650px;
        margin: 0 0 13px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(34px, 4.5vw, 53px);
        font-weight: 400;
        line-height: 1.05;
    }

    .menu-cta p {
        max-width: 630px;
        margin: 0;
        color: rgba(255,255,255,.62);
        line-height: 1.85;
    }

    .menu-cta-btn {
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

    .menu-cta-btn:hover {
        background: var(--gold-light);
        color: #211710;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,.25);
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

    @keyframes rotateSlowReverse {
        from {
            transform: rotate(360deg);
        }

        to {
            transform: rotate(0);
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

        .menu-filters {
            justify-content: flex-start;
            margin-top: 10px;
        }

        .category-line {
            display: none;
        }

        .category-header {
            align-items: flex-start;
        }

        .category-count {
            margin-left: auto;
        }
    }

    @media (max-width: 767px) {

        .menu-hero {
            min-height: 550px;
        }

        .menu-hero-content {
            padding: 80px 0;
        }

        .menu-title {
            font-size: 55px;
            letter-spacing: -2px;
        }

        .menu-subtitle {
            font-size: 15px;
            line-height: 1.8;
        }

        .menu-content {
            padding: 65px 0 80px;
        }

        .menu-toolbar {
            position: static;
            margin-bottom: 50px;
        }

        .menu-category {
            margin-bottom: 60px;
        }

        .food-image {
            height: 215px;
        }

        .menu-cta {
            padding: 42px 27px;
        }
    }

    @media (max-width: 575px) {

        .menu-hero {
            min-height: 500px;
        }

        .menu-hero-content {
            padding: 65px 0;
        }

        .menu-title {
            font-size: 46px;
            letter-spacing: -1.5px;
        }

        .hero-food-note {
            margin-top: 28px;
        }

        .menu-filters {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .menu-filter {
            width: 100%;
            justify-content: center;
        }

        .category-header {
            display: block;
        }

        .category-count {
            margin-top: 9px;
        }

        .food-image {
            height: 205px;
        }

        .food-body {
            min-height: 0;
        }

        .menu-cta {
            padding: 35px 23px;
        }
    }
</style>


<div class="menu-page">

    {{-- =====================================================
         HERO
         ===================================================== --}}
    <section class="menu-hero">

        <div class="menu-grid"></div>
        <div class="menu-hero-line one"></div>
        <div class="menu-hero-line two"></div>

        <div class="container">

            <div class="menu-hero-content">

                <div class="menu-breadcrumb">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>
                        Our Menu
                    </span>

                </div>

                <div class="menu-kicker">
                    Crafted for memorable celebrations
                </div>

                <h1 class="menu-title">
                    Good food.
                    <br>
                    <em>Great memories.</em>
                </h1>

                <p class="menu-subtitle">
                    Explore our chef-curated catering menu, from elegant
                    starters and rich main courses to indulgent desserts
                    and refreshing beverages.
                </p>

                <div class="hero-food-note">
                    <i class="bi bi-stars"></i>
                    Fresh ingredients · Thoughtful menus · Beautiful presentation
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         MENU CONTENT
         ===================================================== --}}
    <section class="menu-content">

        <div class="container">

            {{-- =================================================
                 SEARCH + FILTER
                 ================================================= --}}
            <div class="menu-toolbar">

                <div class="row align-items-center g-2">

                    <div class="col-lg-5">

                        <div class="menu-search">

                            <i class="bi bi-search"></i>

                            <input
                                type="search"
                                id="foodSearch"
                                autocomplete="off"
                                placeholder="Search dishes, ingredients..."
                            >

                        </div>

                    </div>


                    <div class="col-lg-7">

                        <div class="menu-filters">

                            <button
                                type="button"
                                class="menu-filter active"
                                data-filter="all"
                            >
                                <i class="bi bi-grid"></i>
                                All
                            </button>

                            <button
                                type="button"
                                class="menu-filter"
                                data-filter="veg"
                            >
                                <span class="diet-dot"></span>
                                Veg
                            </button>

                            <button
                                type="button"
                                class="menu-filter"
                                data-filter="non_veg"
                            >
                                <span class="diet-dot"></span>
                                Non-Veg
                            </button>

                            <button
                                type="button"
                                class="menu-filter"
                                data-filter="jain"
                            >
                                <i class="bi bi-leaf"></i>
                                Jain
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 CATEGORIES
                 ================================================= --}}
            @forelse($categories as $categoryIndex => $c)

                @if($c->foods->count())

                    <div
                        class="menu-category"
                        id="category-{{ $c->slug }}"
                    >

                        <div class="category-header">

                            <div class="category-heading">

                                <div class="category-number">
                                    Category
                                    {{ str_pad($categoryIndex + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                <h2>
                                    {{ $c->name }}
                                </h2>

                            </div>

                            <div class="category-line"></div>

                            <span class="category-count">
                                {{ $c->foods->count() }}
                                {{ $c->foods->count() === 1 ? 'Dish' : 'Dishes' }}
                            </span>

                        </div>


                        <div class="row g-4">

                            @foreach($c->foods as $food)

                                <div
                                    class="col-md-6 col-lg-4 food-item"
                                    data-name="{{ strtolower($food->name) }}"
                                    data-description="{{ strtolower($food->description ?? '') }}"
                                    data-diet="{{ $food->diet_type }}"
                                    data-jain="{{ $food->is_jain ? 'jain' : 'normal' }}"
                                >

                                    <article class="food-card">

                                        {{-- IMAGE --}}
                                        <div class="food-image">

                                            @if($food->image)

                                                <img
                                                    src="{{ asset('storage/' . $food->image) }}"
                                                    alt="{{ $food->name }}"
                                                    loading="lazy"
                                                >

                                            @else

                                                <div
                                                    class="w-100 h-100"
                                                    style="
                                                        display:grid;
                                                        place-items:center;
                                                        color:#fff;
                                                        font-size:60px;
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
                                                    <i class="bi bi-egg-fried"></i>
                                                </div>

                                            @endif


                                            {{-- DIET --}}
                                            <span
                                                class="diet-badge {{ $food->diet_type === 'non_veg' ? 'non-veg' : '' }}"
                                            >

                                                <span class="diet-dot"></span>

                                                {{ $food->diet_type === 'veg'
                                                    ? 'Vegetarian'
                                                    : 'Non-Veg' }}

                                            </span>

                                        </div>


                                        {{-- BODY --}}
                                        <div class="food-body">

                                            <div class="food-title-row">

                                                <h3 class="food-title">
                                                    {{ $food->name }}
                                                </h3>

                                                @if($food->price)

                                                    <div class="food-price">
                                                        ₹{{ number_format($food->price) }}
                                                    </div>

                                                @endif

                                            </div>


                                            @if($food->description)

                                                <p class="food-description">
                                                    {{ $food->description }}
                                                </p>

                                            @else

                                                <p class="food-description">
                                                    Carefully prepared by our kitchen
                                                    team using fresh ingredients.
                                                </p>

                                            @endif


                                            <div class="food-footer">

                                                @if($food->is_jain)

                                                    <span class="jain-badge">
                                                        <i class="bi bi-leaf-fill"></i>
                                                        Jain Available
                                                    </span>

                                                @else

                                                    <span class="dish-mark">
                                                        <i class="bi bi-stars"></i>
                                                        Chef selected
                                                    </span>

                                                @endif

                                                <span class="dish-mark">
                                                    <i class="bi bi-check2-circle"></i>
                                                    Fresh
                                                </span>

                                            </div>

                                        </div>

                                    </article>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            @empty

                <div class="empty-menu">

                    <div class="empty-icon">
                        <i class="bi bi-egg-fried"></i>
                    </div>

                    <h3>
                        Menu coming soon
                    </h3>

                    <p>
                        We're preparing something delicious for you.
                    </p>

                </div>

            @endforelse


            {{-- =================================================
                 CTA
                 ================================================= --}}
            <div class="menu-cta">

                <div class="menu-cta-content">

                    <div class="row align-items-center g-5">

                        <div class="col-lg-8">

                            <div class="cta-label">
                                Planning an event?
                            </div>

                            <h3>
                                Don't see exactly what you're looking for?
                            </h3>

                            <p>
                                We can customise the menu around your event,
                                guest preferences, dietary requirements and budget.
                                Tell us what you're planning and we'll create
                                something special.
                            </p>

                        </div>

                        <div class="col-lg-4 text-lg-end">

                            <a
                                href="{{ url('/contact') }}"
                                class="menu-cta-btn"
                            >
                                Build My Menu
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('foodSearch');
    const filterButtons = document.querySelectorAll('.menu-filter');
    const foodItems = document.querySelectorAll('.food-item');

    let activeFilter = 'all';


    function filterMenu() {

        const searchValue =
            searchInput
                ? searchInput.value.trim().toLowerCase()
                : '';


        foodItems.forEach(function (item) {

            const name =
                item.dataset.name || '';

            const description =
                item.dataset.description || '';

            const diet =
                item.dataset.diet || '';

            const jain =
                item.dataset.jain || '';


            const matchesSearch =
                !searchValue ||
                name.includes(searchValue) ||
                description.includes(searchValue);


            let matchesFilter = true;


            if (activeFilter === 'veg') {
                matchesFilter = diet === 'veg';
            }


            if (activeFilter === 'non_veg') {
                matchesFilter = diet === 'non_veg';
            }


            if (activeFilter === 'jain') {
                matchesFilter = jain === 'jain';
            }


            if (matchesSearch && matchesFilter) {

                item.classList.remove(
                    'food-card-hidden'
                );

            } else {

                item.classList.add(
                    'food-card-hidden'
                );

            }

        });


        document
            .querySelectorAll('.menu-category')
            .forEach(function (category) {

                const visibleItems =
                    category.querySelectorAll(
                        '.food-item:not(.food-card-hidden)'
                    );

                category.style.display =
                    visibleItems.length
                        ? ''
                        : 'none';

            });

    }


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            filterMenu
        );

    }


    filterButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                filterButtons.forEach(
                    function (btn) {
                        btn.classList.remove('active');
                    }
                );


                this.classList.add('active');

                activeFilter =
                    this.dataset.filter || 'all';

                filterMenu();

            }
        );

    });

});
</script>

@endsection