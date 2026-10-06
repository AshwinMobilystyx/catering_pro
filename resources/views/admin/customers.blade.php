@extends('layouts.admin')

@section('content')

<style>
    .customers-page {
        padding-bottom: 40px;
    }

    .customers-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .customers-eyebrow {
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

    .customers-eyebrow::before {
        content: "";
        width: 25px;
        height: 2px;
        background: #c2943e;
        border-radius: 5px;
    }

    .customers-header h1 {
        margin: 0;
        color: #181818;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .customers-header p {
        margin: 7px 0 0;
        color: #888;
        font-size: 14px;
    }

    .customer-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border: 1px solid #e9e4da;
        border-radius: 12px;
        background: #fff;
        color: #777;
        font-size: 12px;
        font-weight: 700;
    }

    .customer-count i {
        color: #a97927;
    }

    /* Main Card */
    .customers-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.04);
    }

    .customers-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 19px 22px;
        border-bottom: 1px solid #eeeae4;
    }

    .toolbar-title h3 {
        margin: 0;
        color: #252525;
        font-size: 16px;
        font-weight: 800;
    }

    .toolbar-title span {
        display: block;
        margin-top: 4px;
        color: #999;
        font-size: 11px;
    }

    .customer-search {
        position: relative;
        width: 270px;
    }

    .customer-search i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 13px;
    }

    .customer-search input {
        width: 100%;
        height: 40px;
        padding: 0 13px 0 36px;
        border: 1px solid #e4e1dc;
        border-radius: 11px;
        outline: none;
        color: #333;
        font-size: 12px;
        background: #faf9f7;
        transition: .2s ease;
    }

    .customer-search input:focus {
        border-color: #c2943e;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(194,148,62,.08);
    }

    /* Table */
    .customers-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .customers-table th {
        padding: 13px 20px;
        background: #faf9f7;
        border-bottom: 1px solid #ebe8e2;
        color: #888;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .customers-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0eeea;
        color: #555;
        font-size: 13px;
        vertical-align: middle;
    }

    .customers-table tbody tr {
        transition: background .2s ease;
    }

    .customers-table tbody tr:hover {
        background: #fcfaf6;
    }

    .customers-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* Customer */
    .customer-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 190px;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, #f5ead5, #fbf7ef);
        color: #9b6f25;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .customer-name {
        color: #292929;
        font-size: 13px;
        font-weight: 800;
    }

    .customer-id {
        margin-top: 3px;
        color: #aaa;
        font-size: 10px;
    }

    .customer-email {
        color: #666;
        font-size: 12px;
    }

    .customer-phone {
        color: #666;
        font-size: 12px;
    }

    .booking-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 11px;
        border-radius: 10px;
        background: #f7f2e9;
        color: #9a6d26;
        font-size: 11px;
        font-weight: 800;
    }

    .booking-badge i {
        font-size: 12px;
    }

    /* Empty State */
    .empty-state {
        padding: 65px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 18px;
        background: #f8f3e9;
        color: #aa792b;
        font-size: 23px;
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

    /* Pagination */
    .pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid #eeeae4;
        background: #fff;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: flex-end;
    }

    .pagination-wrapper .pagination {
        margin: 0;
        gap: 5px;
    }

    .pagination-wrapper .page-link {
        border: 1px solid #e7e3dc;
        border-radius: 9px !important;
        color: #666;
        font-size: 12px;
        min-width: 34px;
        text-align: center;
    }

    .pagination-wrapper .page-item.active .page-link {
        border-color: #b58330;
        background: #b58330;
        color: #fff;
    }

    /* Mobile Cards */
    .mobile-customer-list {
        display: none;
    }

    .mobile-customer {
        padding: 18px;
        border-bottom: 1px solid #eeeae4;
    }

    .mobile-customer:last-child {
        border-bottom: 0;
    }

    .mobile-customer-top {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mobile-customer-info {
        flex: 1;
        min-width: 0;
    }

    .mobile-customer-name {
        color: #292929;
        font-size: 13px;
        font-weight: 800;
    }

    .mobile-customer-email {
        margin-top: 3px;
        color: #999;
        font-size: 11px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .mobile-customer-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 15px;
    }

    .mobile-detail {
        padding: 10px;
        border-radius: 10px;
        background: #faf9f7;
    }

    .mobile-detail small {
        display: block;
        margin-bottom: 4px;
        color: #999;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .mobile-detail span {
        color: #555;
        font-size: 11px;
    }

    @media (max-width: 767px) {

        .customers-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .customer-count {
            width: 100%;
            justify-content: center;
        }

        .customers-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .customer-search {
            width: 100%;
        }

        .desktop-customer-table {
            display: none;
        }

        .mobile-customer-list {
            display: block;
        }

        .pagination-wrapper nav {
            justify-content: center;
        }
    }
</style>


<div class="customers-page">

    {{-- Header --}}
    <div class="customers-header">

        <div>
            <div class="customers-eyebrow">
                Customer Management
            </div>

            <h1>Customers</h1>

            <p>
                View and manage customers who interact with your catering business.
            </p>
        </div>

        <div class="customer-count">
            <i class="bi bi-people"></i>
            {{ $customers->total() }} Total Customers
        </div>

    </div>


    {{-- Customers Card --}}
    <div class="customers-card">

        {{-- Toolbar --}}
        <div class="customers-toolbar">

            <div class="toolbar-title">
                <h3>Customer Directory</h3>
                <span>Registered customer accounts and booking activity</span>
            </div>

            <div class="customer-search">
                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="customerSearch"
                    placeholder="Search customers..."
                    autocomplete="off"
                >
            </div>

        </div>


        @if($customers->count())

            {{-- Desktop Table --}}
            <div class="table-responsive desktop-customer-table">

                <table class="customers-table">

                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Bookings</th>
                        </tr>
                    </thead>

                    <tbody id="customerTableBody">

                        @foreach($customers as $c)

                            @php
                                $name = trim($c->name ?? 'Customer');
                                $nameParts = preg_split('/\s+/', $name);

                                $initials = strtoupper(
                                    substr($nameParts[0] ?? 'C', 0, 1) .
                                    (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')
                                );
                            @endphp

                            <tr class="customer-row">

                                <td>
                                    <div class="customer-info">

                                        <div class="customer-avatar">
                                            {{ $initials }}
                                        </div>

                                        <div>
                                            <div class="customer-name">
                                                {{ $name }}
                                            </div>

                                            <div class="customer-id">
                                                Customer #{{ $c->id }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <span class="customer-email">
                                        {{ $c->email ?: '—' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="customer-phone">
                                        {{ $c->phone ?: '—' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="booking-badge">
                                        <i class="bi bi-calendar-check"></i>
                                        {{ $c->bookings()->count() }}
                                        {{ $c->bookings()->count() == 1 ? 'Booking' : 'Bookings' }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Mobile List --}}
            <div class="mobile-customer-list" id="mobileCustomerList">

                @foreach($customers as $c)

                    @php
                        $name = trim($c->name ?? 'Customer');
                        $nameParts = preg_split('/\s+/', $name);

                        $initials = strtoupper(
                            substr($nameParts[0] ?? 'C', 0, 1) .
                            (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')
                        );

                        $bookingCount = $c->bookings()->count();
                    @endphp

                    <div class="mobile-customer customer-mobile-row">

                        <div class="mobile-customer-top">

                            <div class="customer-avatar">
                                {{ $initials }}
                            </div>

                            <div class="mobile-customer-info">

                                <div class="mobile-customer-name">
                                    {{ $name }}
                                </div>

                                <div class="mobile-customer-email">
                                    {{ $c->email ?: 'No email available' }}
                                </div>

                            </div>

                        </div>

                        <div class="mobile-customer-details">

                            <div class="mobile-detail">

                                <small>Phone</small>

                                <span>
                                    {{ $c->phone ?: '—' }}
                                </span>

                            </div>

                            <div class="mobile-detail">

                                <small>Bookings</small>

                                <span>
                                    {{ $bookingCount }}
                                    {{ $bookingCount == 1 ? 'Booking' : 'Bookings' }}
                                </span>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if($customers->hasPages())

                <div class="pagination-wrapper">
                    {{ $customers->links() }}
                </div>

            @endif

        @else

            {{-- Empty --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-people"></i>
                </div>

                <h4>No customers found</h4>

                <p>
                    Registered customers will appear here once they create an account.
                </p>

            </div>

        @endif

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('customerSearch');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const query = this.value.toLowerCase().trim();

        document.querySelectorAll('.customer-row').forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(query) ? '' : 'none';

        });

        document.querySelectorAll('.customer-mobile-row').forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(query) ? '' : 'none';

        });

    });

});
</script>

@endsection