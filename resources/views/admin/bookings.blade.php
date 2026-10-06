@extends('layouts.admin')

@section('content')

<style>
    .bookings-page {
        --gold: #c9a227;
        --dark: #111827;
        --muted: #6b7280;
        --border: #e5e7eb;
        --soft: #f8fafc;
    }

    .page-hero {
        background:
            radial-gradient(circle at 90% 10%, rgba(201,162,39,.18), transparent 30%),
            linear-gradient(135deg, #111827 0%, #1f2937 100%);
        border-radius: 22px;
        padding: 30px;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .page-hero::before,
    .page-hero::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 50%;
        pointer-events: none;
    }

    .page-hero::before {
        width: 280px;
        height: 280px;
        right: -100px;
        top: -140px;
    }

    .page-hero::after {
        width: 150px;
        height: 150px;
        right: 100px;
        bottom: -115px;
    }

    .page-hero-content {
        position: relative;
        z-index: 2;
    }

    .page-kicker {
        color: #d8bb5b;
        text-transform: uppercase;
        letter-spacing: .14em;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .page-hero h1 {
        font-size: clamp(26px, 3vw, 38px);
        font-weight: 800;
        margin: 0 0 8px;
    }

    .page-hero p {
        margin: 0;
        color: rgba(255,255,255,.7);
        max-width: 700px;
    }

    .hero-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        padding: 8px 13px;
        border: 1px solid rgba(255,255,255,.13);
        background: rgba(255,255,255,.06);
        border-radius: 999px;
        font-size: 13px;
    }

    .filter-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 8px 30px rgba(15,23,42,.05);
        margin-bottom: 20px;
    }

    .filter-title {
        font-size: 14px;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 14px;
    }

    .form-label-custom {
        font-size: 11px;
        font-weight: 750;
        color: #4b5563;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border-radius: 11px;
        border-color: #dfe3e8;
        font-size: 13px;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
    }

    .btn-filter {
        min-height: 44px;
        border-radius: 11px;
        background: var(--dark);
        border-color: var(--dark);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-filter:hover {
        background: #000;
        color: #fff;
    }

    .btn-reset {
        min-height: 44px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 650;
    }

    .booking-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(15,23,42,.05);
        overflow: hidden;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .booking-table {
        margin: 0;
        min-width: 920px;
    }

    .booking-table thead th {
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
        color: #6b7280;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .07em;
        font-weight: 800;
        padding: 15px 16px;
        white-space: nowrap;
    }

    .booking-table tbody td {
        padding: 17px 16px;
        border-bottom: 1px solid #eef0f3;
        vertical-align: middle;
    }

    .booking-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .booking-table tbody tr {
        transition: background .2s ease;
    }

    .booking-table tbody tr:hover {
        background: #fcfcfb;
    }

    .booking-number {
        font-size: 13px;
        font-weight: 800;
        color: var(--dark);
    }

    .booking-id {
        font-size: 10px;
        color: #9ca3af;
        margin-top: 3px;
    }

    .customer-cell {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 180px;
    }

    .customer-avatar {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: linear-gradient(135deg, #111827, #374151);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .customer-name {
        font-size: 13px;
        font-weight: 750;
        color: #1f2937;
    }

    .customer-phone {
        color: #9ca3af;
        font-size: 11px;
        margin-top: 2px;
    }

    .date-block {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .date-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #fff8df;
        color: var(--gold-dark, #a98518);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .date-value {
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        white-space: nowrap;
    }

    .guest-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 9px;
        background: var(--soft);
        color: #4b5563;
        font-size: 11px;
        font-weight: 700;
    }

    .guest-count i {
        color: var(--gold);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-contacted,
    .status-quotation_sent {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .status-confirmed {
        background: #ecfdf5;
        color: #047857;
    }

    .status-in_progress {
        background: #f5f3ff;
        color: #6d28d9;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-cancelled,
    .status-rejected {
        background: #fef2f2;
        color: #b91c1c;
    }

    .update-form {
        min-width: 220px;
    }

    .update-form .form-select {
        min-height: 36px;
        font-size: 11px;
        border-radius: 9px;
    }

    .save-status-btn {
        min-height: 36px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .pagination-wrap {
        padding: 18px 20px;
        border-top: 1px solid #eef0f3;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        border: 1px dashed #d7dce2;
        border-radius: 18px;
        background: #fafafa;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: #f3f4f6;
        color: #9ca3af;
        font-size: 25px;
        margin-bottom: 14px;
    }

    .mobile-booking {
        display: none;
    }

    @media (max-width: 767.98px) {

        .page-hero {
            padding: 24px 20px;
            border-radius: 17px;
        }

        .filter-card {
            padding: 17px;
            border-radius: 17px;
        }

        .desktop-bookings {
            display: none;
        }

        .mobile-booking {
            display: block;
        }

        .mobile-booking-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 6px 20px rgba(15,23,42,.04);
        }

        .mobile-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: flex-start;
            padding-bottom: 13px;
            border-bottom: 1px solid #eef0f3;
        }

        .mobile-customer {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 14px 0;
        }

        .info-box {
            padding: 10px;
            border-radius: 11px;
            background: var(--soft);
        }

        .info-label {
            font-size: 9px;
            text-transform: uppercase;
            color: #9ca3af;
            font-weight: 800;
            letter-spacing: .05em;
        }

        .info-value {
            font-size: 12px;
            color: #374151;
            font-weight: 700;
            margin-top: 3px;
        }

        .mobile-update {
            padding-top: 13px;
            border-top: 1px solid #eef0f3;
        }

        .mobile-update .form-select {
            margin-bottom: 8px;
        }

        .mobile-update .btn {
            width: 100%;
        }
    }
</style>


<div class="bookings-page">

    {{-- Header --}}
    <div class="page-hero">

        <div class="page-hero-content">

            <div class="page-kicker">
                <i class="bi bi-calendar2-check me-1"></i>
                Booking Management
            </div>

            <h1>Bookings</h1>

            <p>
                Review customer bookings, check event details and keep booking
                statuses updated from one place.
            </p>

            <div class="hero-count">
                <i class="bi bi-journal-check"></i>
                <span>{{ $bookings->total() }} Bookings</span>
            </div>

        </div>

    </div>


    {{-- Filters --}}
    <div class="filter-card">

        <div class="filter-title">
            <i class="bi bi-funnel me-1"></i>
            Find Bookings
        </div>

        <form method="get">

            <div class="row g-3 align-items-end">

                <div class="col-lg-4 col-md-6">

                    <label class="form-label-custom">
                        Search
                    </label>

                    <input
                        class="form-control"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Booking / customer / phone"
                    >

                </div>


                <div class="col-lg-3 col-md-6">

                    <label class="form-label-custom">
                        Event Date
                    </label>

                    <input
                        class="form-control"
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                    >

                </div>


                <div class="col-lg-3 col-md-6">

                    <label class="form-label-custom">
                        Booking Status
                    </label>

                    <select
                        class="form-select"
                        name="status"
                    >

                        <option value="">
                            All Status
                        </option>

                        @foreach([
                            'pending',
                            'contacted',
                            'quotation_sent',
                            'confirmed',
                            'in_progress',
                            'completed',
                            'cancelled',
                            'rejected'
                        ] as $s)

                            <option
                                value="{{ $s }}"
                                @selected(request('status') === $s)
                            >
                                {{ ucwords(str_replace('_', ' ', $s)) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-lg-2 col-md-6 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-filter flex-grow-1"
                    >
                        <i class="bi bi-search me-1"></i>
                        Filter
                    </button>

                    @if(request('search') || request('date') || request('status'))

                        <a
                            href="{{ url()->current() }}"
                            class="btn btn-outline-secondary btn-reset"
                            title="Clear filters"
                        >
                            <i class="bi bi-x-lg"></i>
                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    @if($bookings->count())

        {{-- Desktop Table --}}
        <div class="booking-card desktop-bookings">

            <div class="table-wrap">

                <table class="table align-middle booking-table">

                    <thead>

                        <tr>
                            <th>Booking</th>
                            <th>Customer</th>
                            <th>Event Date</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($bookings as $b)

                            @php
                                $customerName = $b->user->name ?? 'Guest';
                                $initials = collect(preg_split('/\s+/', trim($customerName)))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                    ->implode('');
                            @endphp

                            <tr>

                                {{-- Booking --}}
                                <td>

                                    <div class="booking-number">
                                        {{ $b->booking_no }}
                                    </div>

                                    <div class="booking-id">
                                        Booking #{{ $b->id }}
                                    </div>

                                </td>


                                {{-- Customer --}}
                                <td>

                                    <div class="customer-cell">

                                        <div class="customer-avatar">
                                            {{ $initials ?: 'C' }}
                                        </div>

                                        <div>

                                            <div class="customer-name">
                                                {{ $customerName }}
                                            </div>

                                            <div class="customer-phone">
                                                {{ $b->user->phone ?? 'No phone' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div class="date-block">

                                        <div class="date-icon">
                                            <i class="bi bi-calendar-event"></i>
                                        </div>

                                        <div class="date-value">
                                            {{ $b->event_date->format('d M Y') }}
                                        </div>

                                    </div>

                                </td>


                                {{-- Guests --}}
                                <td>

                                    <span class="guest-count">
                                        <i class="bi bi-people"></i>
                                        {{ $b->guest_count }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    <span class="status-badge status-{{ $b->status }}">

                                        @if($b->status === 'confirmed')
                                            <i class="bi bi-check-circle"></i>
                                        @elseif($b->status === 'completed')
                                            <i class="bi bi-patch-check"></i>
                                        @elseif($b->status === 'cancelled' || $b->status === 'rejected')
                                            <i class="bi bi-x-circle"></i>
                                        @elseif($b->status === 'in_progress')
                                            <i class="bi bi-arrow-repeat"></i>
                                        @else
                                            <i class="bi bi-clock"></i>
                                        @endif

                                        {{ ucwords(str_replace('_', ' ', $b->status)) }}

                                    </span>

                                </td>


                                {{-- Update --}}
                                <td>

                                    <form
                                        method="post"
                                        action="/admin/bookings/{{ $b->id }}"
                                        class="d-flex gap-2 update-form booking-update-form"
                                    >

                                        @csrf

                                        <select
                                            name="status"
                                            class="form-select form-select-sm"
                                        >

                                            @foreach([
                                                'pending',
                                                'contacted',
                                                'quotation_sent',
                                                'confirmed',
                                                'in_progress',
                                                'completed',
                                                'cancelled',
                                                'rejected'
                                            ] as $s)

                                                <option
                                                    value="{{ $s }}"
                                                    @selected($b->status === $s)
                                                >
                                                    {{ ucwords(str_replace('_', ' ', $s)) }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-dark save-status-btn"
                                        >
                                            <i class="bi bi-check2"></i>
                                            Save
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="pagination-wrap">
                {{ $bookings->links() }}
            </div>

        </div>


        {{-- Mobile Cards --}}
        <div class="mobile-booking">

            @foreach($bookings as $b)

                @php
                    $customerName = $b->user->name ?? 'Guest';
                    $initials = collect(preg_split('/\s+/', trim($customerName)))
                        ->filter()
                        ->take(2)
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->implode('');
                @endphp

                <div class="mobile-booking-card">

                    <div class="mobile-top">

                        <div class="mobile-customer">

                            <div class="customer-avatar">
                                {{ $initials ?: 'C' }}
                            </div>

                            <div>

                                <div class="customer-name">
                                    {{ $customerName }}
                                </div>

                                <div class="customer-phone">
                                    {{ $b->user->phone ?? 'No phone' }}
                                </div>

                            </div>

                        </div>


                        <span class="status-badge status-{{ $b->status }}">
                            {{ ucwords(str_replace('_', ' ', $b->status)) }}
                        </span>

                    </div>


                    <div class="mt-3">

                        <div class="booking-number">
                            {{ $b->booking_no }}
                        </div>

                        <div class="booking-id">
                            Booking #{{ $b->id }}
                        </div>

                    </div>


                    <div class="mobile-info">

                        <div class="info-box">

                            <div class="info-label">
                                Event Date
                            </div>

                            <div class="info-value">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $b->event_date->format('d M Y') }}
                            </div>

                        </div>


                        <div class="info-box">

                            <div class="info-label">
                                Guests
                            </div>

                            <div class="info-value">
                                <i class="bi bi-people me-1"></i>
                                {{ $b->guest_count }}
                            </div>

                        </div>

                    </div>


                    <div class="mobile-update">

                        <form
                            method="post"
                            action="/admin/bookings/{{ $b->id }}"
                            class="booking-update-form"
                        >

                            @csrf

                            <select
                                name="status"
                                class="form-select form-select-sm"
                            >

                                @foreach([
                                    'pending',
                                    'contacted',
                                    'quotation_sent',
                                    'confirmed',
                                    'in_progress',
                                    'completed',
                                    'cancelled',
                                    'rejected'
                                ] as $s)

                                    <option
                                        value="{{ $s }}"
                                        @selected($b->status === $s)
                                    >
                                        {{ ucwords(str_replace('_', ' ', $s)) }}
                                    </option>

                                @endforeach

                            </select>

                            <button
                                type="submit"
                                class="btn btn-dark btn-sm"
                            >
                                <i class="bi bi-check2-circle me-1"></i>
                                Update Booking Status
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach


            <div class="pagination-wrap px-0">
                {{ $bookings->links() }}
            </div>

        </div>

    @else

        {{-- Empty State --}}
        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-calendar-x"></i>
            </div>

            <h5 class="fw-bold mb-1">
                No bookings found
            </h5>

            <p class="text-muted small mb-0">
                Try changing your search or filter criteria.
            </p>

        </div>

    @endif

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.booking-update-form').forEach(function (form) {

        form.addEventListener('submit', function () {

            const button = form.querySelector('button[type="submit"]');

            if (!button) {
                return;
            }

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

        });

    });

});
</script>

@endsection