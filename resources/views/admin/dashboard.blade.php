@extends('layouts.admin')

@section('content')

<style>
    .dashboard-page {
        padding-bottom: 40px;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .dashboard-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a97927;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .dashboard-eyebrow::before {
        content: "";
        width: 25px;
        height: 2px;
        background: #c2943e;
        border-radius: 5px;
    }

    .dashboard-header h1 {
        margin: 0;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
        color: #181818;
    }

    .dashboard-header p {
        margin: 7px 0 0;
        color: #858585;
        font-size: 14px;
    }

    .dashboard-date {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 15px;
        border: 1px solid #e9e5dd;
        border-radius: 12px;
        background: #fff;
        color: #666;
        font-size: 13px;
        white-space: nowrap;
    }

    .dashboard-date i {
        color: #b58330;
    }

    /* Stats */
    .stat-card {
        position: relative;
        overflow: hidden;
        height: 100%;
        padding: 22px;
        background: #fff;
        border: 1px solid #ece9e3;
        border-radius: 18px;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -45px;
        bottom: -50px;
        border-radius: 50%;
        background: rgba(194,148,62,.06);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: #ded5c5;
        box-shadow: 0 16px 35px rgba(0,0,0,.07);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .stat-label {
        color: #8b8b8b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #f8f2e7;
        color: #a97927;
        font-size: 18px;
    }

    .stat-value {
        margin: 14px 0 0;
        color: #191919;
        font-size: 31px;
        line-height: 1;
        font-weight: 800;
    }

    /* Main Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 20px;
        margin-top: 22px;
    }

    .dashboard-card {
        background: #fff;
        border: 1px solid #ece9e3;
        border-radius: 20px;
        overflow: hidden;
    }

    .card-header-custom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 21px 23px;
        border-bottom: 1px solid #efede9;
    }

    .card-title-wrap h3 {
        margin: 0;
        color: #202020;
        font-size: 17px;
        font-weight: 800;
    }

    .card-title-wrap p {
        margin: 5px 0 0;
        color: #929292;
        font-size: 12px;
    }

    .view-all {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #a47428;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .view-all:hover {
        color: #815b20;
    }

    /* Table */
    .booking-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .booking-table th {
        padding: 13px 18px;
        background: #faf9f7;
        color: #8c8c8c;
        border-bottom: 1px solid #eceae6;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .booking-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f0efec;
        color: #555;
        font-size: 13px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .booking-table tbody tr {
        transition: background .2s ease;
    }

    .booking-table tbody tr:hover {
        background: #fcfaf6;
    }

    .booking-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .booking-no {
        color: #9b6f25;
        font-weight: 800;
        font-size: 12px;
    }

    .customer-name {
        color: #292929;
        font-weight: 700;
    }

    .event-name {
        color: #555;
        text-transform: capitalize;
    }

    .booking-date {
        color: #666;
    }

    /* Status */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .status-badge::before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        color: #a66a00;
        background: #fff5dd;
    }

    .status-contacted,
    .status-quotation_sent {
        color: #326a9b;
        background: #eaf4fc;
    }

    .status-confirmed {
        color: #2c8053;
        background: #e9f7ef;
    }

    .status-in_progress {
        color: #7554a8;
        background: #f1ebfa;
    }

    .status-completed {
        color: #26745a;
        background: #e5f6ef;
    }

    .status-cancelled,
    .status-rejected {
        color: #b34b4b;
        background: #fceaea;
    }

    /* Empty State */
    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        border-radius: 17px;
        background: #f8f3e9;
        color: #ad7d2e;
        font-size: 22px;
    }

    .empty-state h4 {
        margin: 0 0 6px;
        color: #333;
        font-size: 16px;
        font-weight: 800;
    }

    .empty-state p {
        margin: 0;
        color: #999;
        font-size: 13px;
    }

    /* Quick Actions */
    .quick-actions {
        padding: 20px;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px 0;
        color: #333;
        text-decoration: none;
        border-bottom: 1px solid #f0eeea;
        transition: .2s ease;
    }

    .quick-action:last-child {
        border-bottom: 0;
    }

    .quick-action:hover {
        color: #a47428;
        transform: translateX(3px);
    }

    .quick-action-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #f8f3e9;
        color: #a47428;
    }

    .quick-action-text {
        flex: 1;
    }

    .quick-action-text strong {
        display: block;
        font-size: 13px;
        font-weight: 700;
    }

    .quick-action-text small {
        display: block;
        margin-top: 2px;
        color: #999;
        font-size: 10px;
    }

    .quick-action > i {
        color: #aaa;
        font-size: 12px;
    }

    /* Status overview */
    .status-overview {
        padding: 20px;
    }

    .status-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 0;
        border-bottom: 1px solid #f0eeea;
    }

    .status-row:last-child {
        border-bottom: 0;
    }

    .status-row-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 12px;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .dot-pending {
        background: #d99a25;
    }

    .dot-confirmed {
        background: #3d9b68;
    }

    .dot-progress {
        background: #8061ad;
    }

    .dot-completed {
        background: #2f8665;
    }

    .dot-cancelled {
        background: #c45a5a;
    }

    .status-row strong {
        color: #292929;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .dashboard-header {
            align-items: flex-start;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .dashboard-date {
            width: 100%;
            justify-content: center;
        }

        .stat-value {
            font-size: 27px;
        }

        .card-header-custom {
            padding: 18px;
        }

        .booking-table th,
        .booking-table td {
            padding: 13px 14px;
        }
    }
</style>

<div class="dashboard-page">

    {{-- Header --}}
    <div class="dashboard-header">

        <div>
            <div class="dashboard-eyebrow">
                Admin Overview
            </div>

            <h1>Dashboard</h1>

            <p>
                Monitor your catering business, bookings and customer activity.
            </p>
        </div>

        <div class="dashboard-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('d M Y') }}
        </div>

    </div>


    {{-- Statistics --}}
    <div class="row g-3">

        @php
            $statIcons = [
                'users' => 'bi-people',
                'customers' => 'bi-people',
                'bookings' => 'bi-calendar-check',
                'services' => 'bi-grid',
                'foods' => 'bi-egg-fried',
                'packages' => 'bi-box-seam',
                'enquiries' => 'bi-chat-left-text',
                'tastings' => 'bi-cup-hot',
                'gallery' => 'bi-images',
                'videos' => 'bi-play-btn',
            ];
        @endphp

        @foreach($stats as $k => $v)

            @php
                $statKey = strtolower(str_replace([' ', '-'], '_', $k));

                $icon = $statIcons[$statKey] ?? 'bi-bar-chart';
            @endphp

            <div class="col-6 col-md-4 col-lg-3">

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            {{ str_replace('_', ' ', $k) }}
                        </span>

                        <div class="stat-icon">
                            <i class="bi {{ $icon }}"></i>
                        </div>

                    </div>

                    <div class="stat-value">
                        {{ $v }}
                    </div>

                </div>

            </div>

        @endforeach

    </div>


    {{-- Main Dashboard --}}
    <div class="dashboard-grid">

        {{-- Recent Bookings --}}
        <div class="dashboard-card">

            <div class="card-header-custom">

                <div class="card-title-wrap">
                    <h3>Recent Bookings</h3>
                    <p>Latest catering booking activity</p>
                </div>

                <a href="{{ url('/admin/bookings') }}" class="view-all">
                    View all
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>


            @if($bookings->count())

                <div class="table-responsive">

                    <table class="booking-table">

                        <thead>
                            <tr>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Event</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($bookings as $b)

                                @php
                                    $status = strtolower($b->status ?? 'pending');

                                    $statusClass = match ($status) {
                                        'pending' => 'status-pending',
                                        'contacted' => 'status-contacted',
                                        'quotation_sent' => 'status-quotation_sent',
                                        'confirmed' => 'status-confirmed',
                                        'in_progress' => 'status-in_progress',
                                        'completed' => 'status-completed',
                                        'cancelled' => 'status-cancelled',
                                        'rejected' => 'status-rejected',
                                        default => 'status-pending',
                                    };
                                @endphp

                                <tr>

                                    <td>
                                        <span class="booking-no">
                                            {{ $b->booking_no }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="customer-name">
                                            {{ $b->user->name ?? 'Guest' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="booking-date">
                                            {{ $b->event_date ? $b->event_date->format('d M Y') : '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="event-name">
                                            {{ $b->event_type }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ str_replace('_', ' ', $status) }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>

                    <h4>No bookings yet</h4>

                    <p>
                        New catering bookings will appear here.
                    </p>

                </div>

            @endif

        </div>


        {{-- Sidebar --}}
        <div>

            {{-- Quick Actions --}}
            <div class="dashboard-card mb-3">

                <div class="card-header-custom">

                    <div class="card-title-wrap">
                        <h3>Quick Actions</h3>
                        <p>Manage your website</p>
                    </div>

                </div>

                <div class="quick-actions">

                    <a href="{{ url('/admin/bookings') }}" class="quick-action">

                        <div class="quick-action-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                        <div class="quick-action-text">
                            <strong>Bookings</strong>
                            <small>Manage event bookings</small>
                        </div>

                        <i class="bi bi-chevron-right"></i>

                    </a>

                    <a href="{{ url('/admin/foods') }}" class="quick-action">

                        <div class="quick-action-icon">
                            <i class="bi bi-egg-fried"></i>
                        </div>

                        <div class="quick-action-text">
                            <strong>Food Menu</strong>
                            <small>Manage food items</small>
                        </div>

                        <i class="bi bi-chevron-right"></i>

                    </a>

                    <a href="{{ url('/admin/packages') }}" class="quick-action">

                        <div class="quick-action-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <div class="quick-action-text">
                            <strong>Packages</strong>
                            <small>Manage catering packages</small>
                        </div>

                        <i class="bi bi-chevron-right"></i>

                    </a>

                    <a href="{{ url('/admin/services') }}" class="quick-action">

                        <div class="quick-action-icon">
                            <i class="bi bi-grid"></i>
                        </div>

                        <div class="quick-action-text">
                            <strong>Services</strong>
                            <small>Manage catering services</small>
                        </div>

                        <i class="bi bi-chevron-right"></i>

                    </a>

                </div>

            </div>


            {{-- Booking Status --}}
            <div class="dashboard-card">

                <div class="card-header-custom">

                    <div class="card-title-wrap">
                        <h3>Booking Status</h3>
                        <p>Current booking stages</p>
                    </div>

                </div>

                @php
                    $statusCounts = [
                        'pending' => 0,
                        'confirmed' => 0,
                        'in_progress' => 0,
                        'completed' => 0,
                        'cancelled' => 0,
                    ];

                    foreach ($bookings as $booking) {
                        if (isset($statusCounts[$booking->status])) {
                            $statusCounts[$booking->status]++;
                        }
                    }
                @endphp

                <div class="status-overview">

                    <div class="status-row">
                        <span class="status-row-label">
                            <span class="status-dot dot-pending"></span>
                            Pending
                        </span>
                        <strong>{{ $statusCounts['pending'] }}</strong>
                    </div>

                    <div class="status-row">
                        <span class="status-row-label">
                            <span class="status-dot dot-confirmed"></span>
                            Confirmed
                        </span>
                        <strong>{{ $statusCounts['confirmed'] }}</strong>
                    </div>

                    <div class="status-row">
                        <span class="status-row-label">
                            <span class="status-dot dot-progress"></span>
                            In Progress
                        </span>
                        <strong>{{ $statusCounts['in_progress'] }}</strong>
                    </div>

                    <div class="status-row">
                        <span class="status-row-label">
                            <span class="status-dot dot-completed"></span>
                            Completed
                        </span>
                        <strong>{{ $statusCounts['completed'] }}</strong>
                    </div>

                    <div class="status-row">
                        <span class="status-row-label">
                            <span class="status-dot dot-cancelled"></span>
                            Cancelled
                        </span>
                        <strong>{{ $statusCounts['cancelled'] }}</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection