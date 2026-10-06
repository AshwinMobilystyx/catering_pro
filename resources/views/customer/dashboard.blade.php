@extends('layouts.app')

@section('content')

<style>
    .customer-dashboard {
        min-height: 100vh;
        background:
            radial-gradient(circle at 8% 8%, rgba(255,193,7,.10), transparent 25%),
            radial-gradient(circle at 92% 30%, rgba(255,152,0,.07), transparent 25%),
            #f6f6f4;
        padding: 45px 0 80px;
    }

    /* =========================
       TOP HEADER
    ========================= */

    .dashboard-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 25px;
        margin-bottom: 28px;
    }

    .welcome-area {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .user-avatar {
        width: 62px;
        height: 62px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #201706;
        font-size: 1.35rem;
        font-weight: 900;
        box-shadow: 0 12px 28px rgba(255,152,0,.22);
    }

    .welcome-area small {
        display: block;
        color: #9a9a9a;
        font-size: .74rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .welcome-area h1 {
        margin: 0;
        color: #191919;
        font-size: clamp(1.7rem, 3vw, 2.35rem);
        font-weight: 900;
        letter-spacing: -1px;
    }

    .welcome-area p {
        margin: 5px 0 0;
        color: #888;
        font-size: .9rem;
    }

    .logout-btn {
        border: 1px solid #ddd;
        background: #fff;
        color: #333;
        padding: 10px 17px;
        border-radius: 12px;
        font-size: .82rem;
        font-weight: 700;
        transition: .25s ease;
    }

    .logout-btn:hover {
        background: #191919;
        color: #fff;
        border-color: #191919;
        transform: translateY(-2px);
    }

    /* =========================
       HERO DASHBOARD CARD
    ========================= */

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        min-height: 255px;
        border-radius: 30px;
        padding: 42px;
        margin-bottom: 22px;
        color: #fff;
        background:
            linear-gradient(120deg, rgba(25,21,16,.97), rgba(58,40,20,.93));
        box-shadow: 0 25px 55px rgba(0,0,0,.12);
    }

    .dashboard-hero::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        border: 1px solid rgba(255,193,7,.13);
        right: -120px;
        top: -160px;
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,193,7,.08);
        filter: blur(55px);
        right: 80px;
        bottom: -130px;
    }

    .hero-grid {
        position: absolute;
        inset: 0;
        opacity: .18;
        background-image:
            linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
        background-size: 45px 45px;
    }

    .dashboard-hero-content {
        position: relative;
        z-index: 2;
        max-width: 670px;
    }

    .hero-mini-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 13px;
        border-radius: 50px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.13);
        color: #ffc107;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .hero-mini-label i {
        font-size: .7rem;
    }

    .dashboard-hero h2 {
        font-size: clamp(1.9rem, 4vw, 3rem);
        line-height: 1.08;
        font-weight: 900;
        letter-spacing: -1.5px;
        margin-bottom: 13px;
    }

    .dashboard-hero h2 span {
        color: #ffc107;
    }

    .dashboard-hero p {
        color: rgba(255,255,255,.67);
        max-width: 570px;
        line-height: 1.7;
        margin-bottom: 25px;
        font-size: .92rem;
    }

    .hero-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 11px;
        text-decoration: none;
        font-size: .82rem;
        font-weight: 800;
        transition: .3s ease;
    }

    .hero-btn-primary {
        background: #ffc107;
        color: #211906;
    }

    .hero-btn-primary:hover {
        color: #211906;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255,193,7,.22);
    }

    .hero-btn-outline {
        color: #fff;
        border: 1px solid rgba(255,255,255,.18);
        background: rgba(255,255,255,.05);
    }

    .hero-btn-outline:hover {
        color: #fff;
        background: rgba(255,255,255,.11);
    }

    /* =========================
       STATS
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 32px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        padding: 24px;
        min-height: 145px;
        border-radius: 21px;
        background: #fff;
        border: 1px solid #e9e9e7;
        transition: .3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 17px 35px rgba(0,0,0,.07);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        right: -30px;
        bottom: -40px;
        background: rgba(255,193,7,.09);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff5d8;
        color: #b27700;
    }

    .stat-card:nth-child(2) .stat-icon {
        background: #eaf7ef;
        color: #27844a;
    }

    .stat-card:nth-child(3) .stat-icon {
        background: #eeeafa;
        color: #6653a8;
    }

    .stat-label {
        color: #999;
        font-size: .73rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-number {
        color: #191919;
        font-size: 2rem;
        font-weight: 900;
        line-height: 1;
    }

    /* =========================
       CONTENT HEADER
    ========================= */

    .content-heading {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 18px;
    }

    .content-heading small {
        display: block;
        color: #b27a00;
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .content-heading h3 {
        margin: 0;
        font-size: 1.45rem;
        font-weight: 900;
        color: #191919;
    }

    .view-all {
        color: #a36b00;
        text-decoration: none;
        font-size: .78rem;
        font-weight: 800;
    }

    .view-all:hover {
        color: #191919;
    }

    /* =========================
       BOOKING PANEL
    ========================= */

    .booking-panel {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.04);
    }

    .booking-item {
        position: relative;
        display: grid;
        grid-template-columns: 72px 1fr auto;
        gap: 18px;
        align-items: center;
        padding: 21px 24px;
        border-bottom: 1px solid #eeeeec;
        transition: .3s ease;
    }

    .booking-item:last-child {
        border-bottom: 0;
    }

    .booking-item:hover {
        background: #fffdf6;
    }

    .booking-date {
        width: 58px;
        height: 58px;
        border-radius: 17px;
        background: #f8f2e4;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #805900;
    }

    .booking-date strong {
        font-size: 1.15rem;
        line-height: 1;
        font-weight: 900;
    }

    .booking-date span {
        margin-top: 4px;
        font-size: .61rem;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: .7px;
    }

    .booking-main {
        min-width: 0;
    }

    .booking-number {
        display: inline-block;
        color: #a56e00;
        font-size: .72rem;
        font-weight: 800;
        margin-bottom: 5px;
        text-decoration: none;
    }

    .booking-number:hover {
        color: #191919;
    }

    .booking-main h5 {
        margin: 0 0 5px;
        color: #222;
        font-size: .98rem;
        font-weight: 800;
        text-transform: capitalize;
    }

    .booking-main p {
        margin: 0;
        color: #999;
        font-size: .76rem;
    }

    .booking-status {
        text-align: right;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 50px;
        font-size: .68rem;
        font-weight: 800;
        text-transform: capitalize;
    }

    .status-pill::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending,
    .status-contacted,
    .status-quotation_sent {
        background: #fff5d9;
        color: #9a6a00;
    }

    .status-confirmed {
        background: #eaf8ef;
        color: #258149;
    }

    .status-completed {
        background: #e8f4ff;
        color: #2672a9;
    }

    .status-cancelled,
    .status-rejected {
        background: #fff0f0;
        color: #bd4040;
    }

    .status-in_progress {
        background: #eeeafa;
        color: #6653a8;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-bookings {
        text-align: center;
        padding: 65px 25px;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        border-radius: 22px;
        background: #fff5d8;
        color: #b27800;
        font-size: 1.7rem;
    }

    .empty-bookings h4 {
        font-weight: 900;
        margin-bottom: 7px;
    }

    .empty-bookings p {
        color: #999;
        font-size: .85rem;
        max-width: 420px;
        margin: 0 auto 22px;
    }

    /* =========================
       QUICK ACTIONS
    ========================= */

    .quick-actions {
        margin-top: 32px;
    }

    .quick-action-card {
        position: relative;
        height: 100%;
        padding: 25px;
        border-radius: 21px;
        text-decoration: none;
        display: block;
        overflow: hidden;
        transition: .35s ease;
    }

    .quick-action-card:hover {
        transform: translateY(-6px);
    }

    .quick-action-booking {
        background: linear-gradient(135deg, #ffc107, #ff9f00);
        color: #241a06;
    }

    .quick-action-tasting {
        background: #1e1e1e;
        color: #fff;
    }

    .quick-action-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: rgba(255,255,255,.2);
        font-size: 1.2rem;
        margin-bottom: 28px;
    }

    .quick-action-card h4 {
        font-size: 1.1rem;
        font-weight: 900;
        margin-bottom: 7px;
    }

    .quick-action-card p {
        font-size: .78rem;
        line-height: 1.6;
        opacity: .7;
        margin-bottom: 18px;
    }

    .quick-arrow {
        font-size: .78rem;
        font-weight: 800;
    }

    .quick-action-decoration {
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        right: -45px;
        bottom: -50px;
        background: rgba(255,255,255,.12);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767px) {

        .customer-dashboard {
            padding: 30px 0 60px;
        }

        .dashboard-top {
            align-items: flex-start;
        }

        .welcome-area {
            align-items: flex-start;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 15px;
        }

        .logout-btn {
            padding: 8px 12px;
        }

        .dashboard-hero {
            padding: 30px 24px;
            border-radius: 23px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .stat-card {
            min-height: auto;
        }

        .booking-item {
            grid-template-columns: 58px 1fr;
            gap: 13px;
            padding: 18px;
        }

        .booking-status {
            grid-column: 2;
            text-align: left;
        }

        .booking-date {
            width: 50px;
            height: 50px;
        }

        .content-heading {
            align-items: center;
        }
    }

    @media (max-width: 480px) {

        .dashboard-top {
            flex-direction: column;
        }

        .logout-btn {
            align-self: flex-end;
        }

        .welcome-area h1 {
            font-size: 1.5rem;
        }

        .hero-actions {
            flex-direction: column;
        }

        .hero-btn {
            justify-content: center;
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


<div class="customer-dashboard">

    <div class="container">

        {{-- =========================
             TOP HEADER
        ========================== --}}
        <div class="dashboard-top">

            <div class="welcome-area">

                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <small>Customer Portal</small>

                    <h1>
                        Hello, {{ $user->name }}
                    </h1>

                    <p>
                        Your events, bookings and tasting requests — all in one place.
                    </p>
                </div>

            </div>


            <form method="POST" action="{{ url('/logout') }}">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </form>

        </div>


        {{-- =========================
             HERO
        ========================== --}}
        <section class="dashboard-hero">

            <div class="hero-grid"></div>

            <div class="dashboard-hero-content">

                <div class="hero-mini-label">
                    <i class="bi bi-stars"></i>
                    Your Catering Dashboard
                </div>

                <h2>
                    Let's make your next event
                    <span>unforgettable.</span>
                </h2>

                <p>
                    Plan your catering, request a food tasting and keep track
                    of every booking from your personal dashboard.
                </p>

                <div class="hero-actions">

                    <a
                        href="{{ url('/customer/bookings/create') }}"
                        class="hero-btn hero-btn-primary"
                    >
                        <i class="bi bi-calendar2-plus"></i>
                        Book Catering
                    </a>

                    <a
                        href="{{ url('/customer/food-tasting') }}"
                        class="hero-btn hero-btn-outline"
                    >
                        <i class="bi bi-cup-hot"></i>
                        Request Tasting
                    </a>

                </div>

            </div>

        </section>


        {{-- =========================
             STATS
        ========================== --}}
        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Bookings
                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>

                </div>

                <div class="stat-number">
                    {{ $user->bookings()->count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Confirmed
                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                </div>

                <div class="stat-number">
                    {{ $user->bookings()->where('status', 'confirmed')->count() }}
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Food Tastings
                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-cup-hot"></i>
                    </div>

                </div>

                <div class="stat-number">
                    {{ $user->foodTastingRequests()->count() }}
                </div>

            </div>

        </div>


        {{-- =========================
             RECENT BOOKINGS
        ========================== --}}
        <div class="content-heading">

            <div>
                <small>Your Activity</small>
                <h3>Recent Bookings</h3>
            </div>

        </div>


        <div class="booking-panel">

            @forelse($bookings as $b)

                @php
                    $statusClass = 'status-' . str_replace(' ', '_', strtolower($b->status));
                @endphp

                <div class="booking-item">

                    {{-- DATE --}}
                    <div class="booking-date">

                        <strong>
                            {{ $b->event_date->format('d') }}
                        </strong>

                        <span>
                            {{ $b->event_date->format('M') }}
                        </span>

                    </div>


                    {{-- DETAILS --}}
                    <div class="booking-main">

                        <a
                            href="{{ url('/customer/bookings/' . $b->id) }}"
                            class="booking-number"
                        >
                            {{ $b->booking_no }}
                        </a>

                        <h5>
                            {{ $b->event_type }}
                        </h5>

                        <p>
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $b->event_date->format('d M Y') }}

                            @if($b->guest_count)
                                <span class="mx-1">•</span>
                                <i class="bi bi-people me-1"></i>
                                {{ $b->guest_count }} Guests
                            @endif
                        </p>

                    </div>


                    {{-- STATUS --}}
                    <div class="booking-status">

                        <span class="status-pill {{ $statusClass }}">
                            {{ str_replace('_', ' ', $b->status) }}
                        </span>

                    </div>

                </div>

            @empty

                <div class="empty-bookings">

                    <div class="empty-icon">
                        <i class="bi bi-calendar2-heart"></i>
                    </div>

                    <h4>No bookings yet</h4>

                    <p>
                        Your upcoming events will appear here.
                        Start planning your first memorable catering experience.
                    </p>

                    <a
                        href="{{ url('/customer/bookings/create') }}"
                        class="hero-btn hero-btn-primary"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Create Your First Booking
                    </a>

                </div>

            @endforelse

        </div>


        {{-- =========================
             QUICK ACTIONS
        ========================== --}}
        <section class="quick-actions">

            <div class="content-heading">

                <div>
                    <small>Need Something?</small>
                    <h3>Quick Actions</h3>
                </div>

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <a
                        href="{{ url('/customer/bookings/create') }}"
                        class="quick-action-card quick-action-booking"
                    >

                        <div class="quick-action-icon">
                            <i class="bi bi-calendar2-plus"></i>
                        </div>

                        <h4>Plan a New Event</h4>

                        <p>
                            Tell us about your event, guest count,
                            venue and catering requirements.
                        </p>

                        <div class="quick-arrow">
                            Start Booking
                            <i class="bi bi-arrow-right ms-1"></i>
                        </div>

                        <div class="quick-action-decoration"></div>

                    </a>

                </div>


                <div class="col-md-6">

                    <a
                        href="{{ url('/customer/food-tasting') }}"
                        class="quick-action-card quick-action-tasting"
                    >

                        <div class="quick-action-icon">
                            <i class="bi bi-cup-hot"></i>
                        </div>

                        <h4>Book a Food Tasting</h4>

                        <p>
                            Taste your preferred menu before the big day
                            and make your selection with confidence.
                        </p>

                        <div class="quick-arrow">
                            Request Tasting
                            <i class="bi bi-arrow-right ms-1"></i>
                        </div>

                        <div class="quick-action-decoration"></div>

                    </a>

                </div>

            </div>

        </section>

    </div>

</div>

@endsection