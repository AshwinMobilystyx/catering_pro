@extends('layouts.app')

@section('content')

<style>
    .my-bookings-page {
        min-height: 100vh;
        padding: 45px 0 80px;
        background:
            radial-gradient(circle at 5% 5%, rgba(255,193,7,.10), transparent 25%),
            radial-gradient(circle at 95% 30%, rgba(255,152,0,.07), transparent 25%),
            #f7f7f5;
    }

    /* =========================
       HEADER
    ========================== */

    .bookings-header {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 40px;
        margin-bottom: 25px;
        color: #fff;
        background: linear-gradient(120deg, #1b1814, #45301a);
        box-shadow: 0 22px 55px rgba(0,0,0,.11);
    }

    .bookings-header::before {
        content: "";
        position: absolute;
        width: 360px;
        height: 360px;
        border: 1px solid rgba(255,193,7,.12);
        border-radius: 50%;
        right: -130px;
        top: -190px;
    }

    .bookings-header::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,193,7,.08);
        filter: blur(65px);
        right: 80px;
        bottom: -140px;
    }

    .header-grid {
        position: absolute;
        inset: 0;
        opacity: .15;
        background-image:
            linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
        background-size: 45px 45px;
    }

    .bookings-header-content {
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
        margin-bottom: 20px;
        transition: .25s ease;
    }

    .back-link:hover {
        color: #ffc107;
    }

    .header-label {
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
        margin-bottom: 15px;
    }

    .bookings-header h1 {
        margin: 0 0 10px;
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        letter-spacing: -1.5px;
    }

    .bookings-header h1 span {
        color: #ffc107;
    }

    .bookings-header p {
        margin: 0;
        max-width: 620px;
        color: rgba(255,255,255,.65);
        font-size: .9rem;
        line-height: 1.7;
    }

    /* =========================
       TOP ACTION BAR
    ========================== */

    .booking-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 18px;
    }

    .booking-count-label {
        color: #888;
        font-size: .76rem;
    }

    .booking-count-label strong {
        color: #222;
        font-weight: 900;
    }

    .new-booking-btn {
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

    .new-booking-btn:hover {
        color: #211906;
        transform: translateY(-3px);
        box-shadow: 0 13px 28px rgba(255,152,0,.23);
    }

    /* =========================
       BOOKING LIST
    ========================== */

    .booking-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .booking-card {
        position: relative;
        display: grid;
        grid-template-columns: 82px minmax(0, 1fr) auto;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 22px;
        transition: .3s ease;
        overflow: hidden;
    }

    .booking-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 16px;
        bottom: 16px;
        width: 3px;
        border-radius: 10px;
        background: #ffc107;
        opacity: .7;
    }

    .booking-card:hover {
        transform: translateY(-4px);
        border-color: rgba(255,193,7,.35);
        box-shadow: 0 17px 38px rgba(0,0,0,.07);
    }

    /* DATE BLOCK */
    .date-block {
        width: 68px;
        height: 76px;
        border-radius: 18px;
        background: #fff6db;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #855c00;
    }

    .date-block .day {
        font-size: 1.65rem;
        font-weight: 900;
        line-height: 1;
    }

    .date-block .month {
        margin-top: 5px;
        font-size: .64rem;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .date-block .year {
        font-size: .57rem;
        color: #b08a3c;
        margin-top: 3px;
    }

    /* DETAILS */
    .booking-details {
        min-width: 0;
    }

    .booking-number {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #a36d00;
        font-size: .7rem;
        font-weight: 900;
        text-decoration: none;
        margin-bottom: 5px;
    }

    .booking-number:hover {
        color: #222;
    }

    .booking-details h3 {
        margin: 0 0 7px;
        color: #202020;
        font-size: 1rem;
        font-weight: 900;
        text-transform: capitalize;
    }

    .booking-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        color: #929292;
        font-size: .72rem;
    }

    .booking-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .booking-meta i {
        color: #b57a00;
    }

    /* STATUS */
    .booking-right {
        text-align: right;
        min-width: 125px;
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
        margin-bottom: 12px;
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

    .view-booking {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #444;
        text-decoration: none;
        font-size: .71rem;
        font-weight: 800;
        transition: .25s ease;
    }

    .view-booking:hover {
        color: #a36d00;
    }

    /* =========================
       EMPTY STATE
    ========================== */

    .empty-state {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 25px;
        padding: 75px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 23px;
        background: #fff5d8;
        color: #aa7300;
        font-size: 1.8rem;
    }

    .empty-state h3 {
        margin-bottom: 8px;
        font-weight: 900;
        color: #222;
    }

    .empty-state p {
        max-width: 430px;
        margin: 0 auto 24px;
        color: #999;
        font-size: .82rem;
        line-height: 1.7;
    }

    /* =========================
       PAGINATION
    ========================== */

    .pagination-wrap {
        margin-top: 25px;
        display: flex;
        justify-content: center;
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

        .my-bookings-page {
            padding: 28px 0 60px;
        }

        .bookings-header {
            padding: 30px 22px;
            border-radius: 22px;
        }

        .booking-toolbar {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }

        .new-booking-btn {
            justify-content: center;
        }

        .booking-card {
            grid-template-columns: 64px minmax(0, 1fr);
            gap: 15px;
            padding: 17px;
        }

        .date-block {
            width: 58px;
            height: 68px;
            border-radius: 15px;
        }

        .date-block .day {
            font-size: 1.4rem;
        }

        .booking-right {
            grid-column: 2;
            text-align: left;
            min-width: auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .status-pill {
            margin-bottom: 0;
        }
    }

    @media (max-width: 480px) {

        .bookings-header h1 {
            font-size: 2rem;
        }

        .booking-card {
            grid-template-columns: 55px minmax(0, 1fr);
            gap: 12px;
        }

        .date-block {
            width: 52px;
            height: 62px;
        }

        .date-block .day {
            font-size: 1.25rem;
        }

        .booking-details h3 {
            font-size: .9rem;
        }

        .booking-meta {
            gap: 7px;
        }

        .booking-meta span {
            width: 100%;
        }

        .booking-right {
            grid-column: 1 / -1;
            padding-left: 67px;
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


<div class="my-bookings-page">

    <div class="container">

        {{-- =========================
             HEADER
        ========================== --}}
        <section class="bookings-header">

            <div class="header-grid"></div>

            <div class="bookings-header-content">

                <a
                    href="{{ url('/customer/dashboard') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left"></i>
                    Back to Dashboard
                </a>

                <div class="header-label">
                    <i class="bi bi-calendar2-check"></i>
                    Event Planner
                </div>

                <h1>
                    My <span>Bookings</span>
                </h1>

                <p>
                    Keep track of your catering requests, event dates,
                    guest details and booking status from one place.
                </p>

            </div>

        </section>


        {{-- =========================
             TOOLBAR
        ========================== --}}
        <div class="booking-toolbar">

            <div class="booking-count-label">

                <strong>{{ $bookings->total() }}</strong>
                booking{{ $bookings->total() == 1 ? '' : 's' }}
                in your account

            </div>


            <a
                href="{{ url('/customer/bookings/create') }}"
                class="new-booking-btn"
            >
                <i class="bi bi-plus-lg"></i>
                New Booking
            </a>

        </div>


        {{-- =========================
             BOOKINGS
        ========================== --}}
        @if($bookings->count())

            <div class="booking-list">

                @foreach($bookings as $b)

                    @php
                        $statusClass = 'status-' . str_replace(
                            ' ',
                            '_',
                            strtolower($b->status)
                        );
                    @endphp

                    <article class="booking-card">

                        {{-- DATE --}}
                        <div class="date-block">

                            <div class="day">
                                {{ $b->event_date->format('d') }}
                            </div>

                            <div class="month">
                                {{ $b->event_date->format('M') }}
                            </div>

                            <div class="year">
                                {{ $b->event_date->format('Y') }}
                            </div>

                        </div>


                        {{-- DETAILS --}}
                        <div class="booking-details">

                            <a
                                href="{{ url('/customer/bookings/' . $b->id) }}"
                                class="booking-number"
                            >
                                <i class="bi bi-hash"></i>
                                {{ $b->booking_no }}
                            </a>

                            <h3>
                                {{ $b->event_type }}
                            </h3>

                            <div class="booking-meta">

                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $b->event_date->format('d M Y') }}
                                </span>

                                <span>
                                    <i class="bi bi-people"></i>
                                    {{ $b->guest_count }} Guests
                                </span>

                                @if($b->start_time)

                                    <span>
                                        <i class="bi bi-clock"></i>
                                        {{ \Carbon\Carbon::parse($b->start_time)->format('h:i A') }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- STATUS + VIEW --}}
                        <div class="booking-right">

                            <span class="status-pill {{ $statusClass }}">
                                {{ str_replace('_', ' ', $b->status) }}
                            </span>

                            <a
                                href="{{ url('/customer/bookings/' . $b->id) }}"
                                class="view-booking"
                            >
                                View Details
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            <div class="pagination-wrap">
                {{ $bookings->links() }}
            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-calendar2-heart"></i>
                </div>

                <h3>
                    No bookings yet
                </h3>

                <p>
                    You haven't created any catering bookings yet.
                    Start planning your next celebration and let our
                    team take care of the food experience.
                </p>

                <a
                    href="{{ url('/customer/bookings/create') }}"
                    class="new-booking-btn"
                >
                    <i class="bi bi-calendar2-plus"></i>
                    Plan My Event
                </a>

            </div>

        @endif

    </div>

</div>

@endsection