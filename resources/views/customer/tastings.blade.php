@extends('layouts.app')

@section('content')

<style>
    .tasting-page {
        min-height: 100vh;
        padding: 45px 0 80px;
        background:
            radial-gradient(circle at 5% 5%, rgba(255,193,7,.10), transparent 25%),
            radial-gradient(circle at 95% 30%, rgba(255,152,0,.07), transparent 25%),
            #f7f7f5;
    }

    /* =========================
       HERO
    ========================== */

    .tasting-hero {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 42px;
        margin-bottom: 25px;
        color: #fff;
        background:
            linear-gradient(120deg, rgba(25,21,16,.97), rgba(61,42,20,.94));
        box-shadow: 0 22px 55px rgba(0,0,0,.11);
    }

    .tasting-hero::before {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        border: 1px solid rgba(255,193,7,.12);
        right: -130px;
        top: -190px;
    }

    .tasting-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255,193,7,.08);
        filter: blur(65px);
        right: 100px;
        bottom: -150px;
    }

    .hero-grid {
        position: absolute;
        inset: 0;
        opacity: .15;
        background-image:
            linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
        background-size: 45px 45px;
    }

    .tasting-hero-content {
        position: relative;
        z-index: 2;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: rgba(255,255,255,.65);
        text-decoration: none;
        font-size: .76rem;
        font-weight: 700;
        margin-bottom: 22px;
        transition: .25s ease;
    }

    .back-link:hover {
        color: #ffc107;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 13px;
        border-radius: 50px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.13);
        color: #ffc107;
        font-size: .69rem;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .tasting-hero h1 {
        margin: 0 0 11px;
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1.05;
        font-weight: 900;
        letter-spacing: -1.5px;
    }

    .tasting-hero h1 span {
        color: #ffc107;
    }

    .tasting-hero p {
        max-width: 650px;
        margin: 0;
        color: rgba(255,255,255,.65);
        font-size: .9rem;
        line-height: 1.75;
    }

    /* =========================
       TOOLBAR
    ========================== */

    .tasting-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 18px;
    }

    .request-count {
        color: #888;
        font-size: .76rem;
    }

    .request-count strong {
        color: #222;
        font-weight: 900;
    }

    .new-tasting-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 12px;
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: #211906;
        text-decoration: none;
        font-size: .78rem;
        font-weight: 900;
        box-shadow: 0 9px 20px rgba(255,152,0,.15);
        transition: .3s ease;
    }

    .new-tasting-btn:hover {
        color: #211906;
        transform: translateY(-3px);
        box-shadow: 0 13px 28px rgba(255,152,0,.23);
    }

    /* =========================
       REQUEST LIST
    ========================== */

    .tasting-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .tasting-card {
        position: relative;
        display: grid;
        grid-template-columns: 90px minmax(0, 1fr) auto;
        align-items: center;
        gap: 20px;
        padding: 21px;
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 22px;
        overflow: hidden;
        transition: .3s ease;
    }

    .tasting-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 17px;
        bottom: 17px;
        width: 3px;
        border-radius: 10px;
        background: #ffc107;
    }

    .tasting-card:hover {
        transform: translateY(-4px);
        border-color: rgba(255,193,7,.35);
        box-shadow: 0 17px 38px rgba(0,0,0,.07);
    }

    /* =========================
       DATE
    ========================== */

    .tasting-date {
        width: 76px;
        height: 82px;
        border-radius: 19px;
        background: #fff6dc;
        color: #875d00;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .tasting-date .day {
        font-size: 1.65rem;
        line-height: 1;
        font-weight: 900;
    }

    .tasting-date .month {
        margin-top: 5px;
        font-size: .65rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .tasting-date .year {
        margin-top: 3px;
        color: #b08b43;
        font-size: .58rem;
    }

    /* =========================
       DETAILS
    ========================== */

    .tasting-details {
        min-width: 0;
    }

    .tasting-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #a36d00;
        font-size: .69rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 5px;
    }

    .tasting-details h3 {
        margin: 0 0 9px;
        color: #202020;
        font-size: 1rem;
        font-weight: 900;
    }

    .tasting-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        color: #929292;
        font-size: .72rem;
    }

    .tasting-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .tasting-meta i {
        color: #b57a00;
    }

    /* =========================
       STATUS
    ========================== */

    .tasting-status {
        min-width: 135px;
        text-align: right;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 50px;
        font-size: .66rem;
        font-weight: 900;
        text-transform: capitalize;
    }

    .status-pill::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        background: #fff5d9;
        color: #9a6a00;
    }

    .status-confirmed {
        background: #eaf8ef;
        color: #258149;
    }

    .status-rescheduled {
        background: #eaf3ff;
        color: #3272a8;
    }

    .status-completed {
        background: #eeeafa;
        color: #6653a8;
    }

    .status-cancelled {
        background: #fff0f0;
        color: #bd4040;
    }

    .status-date {
        display: block;
        margin-top: 8px;
        color: #aaa;
        font-size: .64rem;
    }

    /* =========================
       EMPTY
    ========================== */

    .empty-state {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 25px;
        padding: 75px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 78px;
        height: 78px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        background: #fff5d8;
        color: #aa7300;
        font-size: 1.8rem;
    }

    .empty-state h3 {
        margin-bottom: 8px;
        color: #222;
        font-weight: 900;
    }

    .empty-state p {
        max-width: 450px;
        margin: 0 auto 24px;
        color: #999;
        font-size: .82rem;
        line-height: 1.7;
    }

    /* =========================
       PAGINATION
    ========================== */

    .pagination-wrap {
        display: flex;
        justify-content: center;
        margin-top: 25px;
    }

    .pagination-wrap .pagination {
        margin: 0;
    }

    .pagination-wrap .page-link {
        border: 0;
        margin: 0 3px;
        border-radius: 10px !important;
        color: #555;
        font-size: .75rem;
        font-weight: 700;
    }

    .pagination-wrap .page-item.active .page-link {
        background: #ffc107;
        color: #211906;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 767px) {

        .tasting-page {
            padding: 28px 0 60px;
        }

        .tasting-hero {
            padding: 30px 22px;
            border-radius: 22px;
        }

        .tasting-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .new-tasting-btn {
            justify-content: center;
        }

        .tasting-card {
            grid-template-columns: 64px minmax(0, 1fr);
            gap: 15px;
            padding: 17px;
        }

        .tasting-date {
            width: 58px;
            height: 68px;
            border-radius: 15px;
        }

        .tasting-date .day {
            font-size: 1.4rem;
        }

        .tasting-status {
            grid-column: 2;
            min-width: auto;
            text-align: left;
        }
    }

    @media (max-width: 480px) {

        .tasting-hero h1 {
            font-size: 2rem;
        }

        .tasting-card {
            grid-template-columns: 54px minmax(0, 1fr);
            gap: 12px;
        }

        .tasting-date {
            width: 52px;
            height: 62px;
        }

        .tasting-date .day {
            font-size: 1.25rem;
        }

        .tasting-details h3 {
            font-size: .9rem;
        }

        .tasting-meta {
            gap: 7px;
        }

        .tasting-meta span {
            width: 100%;
        }

        .tasting-status {
            grid-column: 1 / -1;
            padding-left: 66px;
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


<div class="tasting-page">

    <div class="container">

        {{-- =========================
             HERO
        ========================== --}}
        <section class="tasting-hero">

            <div class="hero-grid"></div>

            <div class="tasting-hero-content">

                <a
                    href="{{ url('/customer/dashboard') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left"></i>
                    Back to Dashboard
                </a>

                <div class="hero-label">
                    <i class="bi bi-cup-hot"></i>
                    Tasting Experience
                </div>

                <h1>
                    My Food <span>Tastings</span>
                </h1>

                <p>
                    Review your food tasting requests, preferred dates
                    and current status. Taste before you decide and make
                    your event menu exactly the way you want it.
                </p>

            </div>

        </section>


        {{-- =========================
             TOOLBAR
        ========================== --}}
        <div class="tasting-toolbar">

            <div class="request-count">

                <strong>{{ $tastings->total() }}</strong>

                tasting request{{ $tastings->total() == 1 ? '' : 's' }}

            </div>


            <a
                href="{{ url('/customer/food-tasting') }}"
                class="new-tasting-btn"
            >
                <i class="bi bi-plus-lg"></i>
                New Tasting Request
            </a>

        </div>


        {{-- =========================
             REQUEST LIST
        ========================== --}}
        @if($tastings->count())

            <div class="tasting-list">

                @foreach($tastings as $t)

                    @php
                        $statusClass = 'status-' . str_replace(
                            ' ',
                            '_',
                            strtolower($t->status)
                        );
                    @endphp

                    <article class="tasting-card">

                        {{-- DATE --}}
                        <div class="tasting-date">

                            <div class="day">
                                {{ $t->preferred_date->format('d') }}
                            </div>

                            <div class="month">
                                {{ $t->preferred_date->format('M') }}
                            </div>

                            <div class="year">
                                {{ $t->preferred_date->format('Y') }}
                            </div>

                        </div>


                        {{-- DETAILS --}}
                        <div class="tasting-details">

                            <div class="tasting-label">
                                <i class="bi bi-cup-hot"></i>
                                Food Tasting
                            </div>

                            <h3>
                                Preferred tasting appointment
                            </h3>

                            <div class="tasting-meta">

                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $t->preferred_date->format('d M Y') }}
                                </span>

                                <span>
                                    <i class="bi bi-clock"></i>
                                    {{ $t->preferred_time ?: 'Time to be confirmed' }}
                                </span>

                                @if($t->event_type)

                                    <span>
                                        <i class="bi bi-stars"></i>
                                        {{ $t->event_type }}
                                    </span>

                                @endif

                                @if($t->guest_count)

                                    <span>
                                        <i class="bi bi-people"></i>
                                        {{ $t->guest_count }} Guests
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="tasting-status">

                            <span class="status-pill {{ $statusClass }}">
                                {{ str_replace('_', ' ', $t->status) }}
                            </span>

                            <span class="status-date">
                                Requested
                                {{ $t->created_at->format('d M Y') }}
                            </span>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            <div class="pagination-wrap">
                {{ $tastings->links() }}
            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-cup-hot"></i>
                </div>

                <h3>
                    No tasting requests yet
                </h3>

                <p>
                    You haven't requested a food tasting yet.
                    Choose your preferred date and time and let us
                    prepare a tasting experience for you.
                </p>

                <a
                    href="{{ url('/customer/food-tasting') }}"
                    class="new-tasting-btn"
                >
                    <i class="bi bi-cup-hot"></i>
                    Request Food Tasting
                </a>

            </div>

        @endif

    </div>

</div>

@endsection