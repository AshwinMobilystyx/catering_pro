@extends('layouts.app')

@section('content')

<style>
    .booking-page {
        min-height: 100vh;
        background:
            radial-gradient(circle at 5% 5%, rgba(255,193,7,.10), transparent 25%),
            radial-gradient(circle at 95% 35%, rgba(255,152,0,.07), transparent 25%),
            #f7f7f5;
        padding: 45px 0 80px;
    }

    /* =========================
       PAGE HEADER
    ========================== */

    .booking-header {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 42px;
        margin-bottom: 25px;
        color: #fff;
        background:
            linear-gradient(120deg, rgba(24,20,15,.97), rgba(61,42,20,.93));
        box-shadow: 0 22px 55px rgba(0,0,0,.10);
    }

    .booking-header::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border: 1px solid rgba(255,193,7,.12);
        border-radius: 50%;
        right: -120px;
        top: -190px;
    }

    .booking-header::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        background: rgba(255,193,7,.08);
        filter: blur(65px);
        border-radius: 50%;
        right: 100px;
        bottom: -150px;
    }

    .header-grid {
        position: absolute;
        inset: 0;
        opacity: .16;
        background-image:
            linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
        background-size: 45px 45px;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: rgba(255,255,255,.65);
        text-decoration: none;
        font-size: .78rem;
        font-weight: 700;
        margin-bottom: 23px;
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
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .header-label i {
        font-size: .7rem;
    }

    .booking-header h1 {
        font-size: clamp(2rem, 5vw, 3.6rem);
        line-height: 1.05;
        letter-spacing: -1.5px;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .booking-header h1 span {
        color: #ffc107;
    }

    .booking-header p {
        color: rgba(255,255,255,.67);
        max-width: 650px;
        margin: 0;
        line-height: 1.75;
        font-size: .93rem;
    }

    /* =========================
       MAIN FORM
    ========================== */

    .booking-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 22px;
        align-items: start;
    }

    .booking-form {
        background: #fff;
        border: 1px solid #e8e8e6;
        border-radius: 26px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.045);
    }

    .form-section {
        padding: 30px;
        border-bottom: 1px solid #eeeeec;
    }

    .form-section:last-child {
        border-bottom: 0;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 25px;
    }

    .section-number {
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #fff3cf;
        color: #9a6900;
        font-size: .78rem;
        font-weight: 900;
    }

    .section-heading h3 {
        margin: 0 0 4px;
        color: #1c1c1c;
        font-size: 1.05rem;
        font-weight: 900;
    }

    .section-heading p {
        margin: 0;
        color: #999;
        font-size: .76rem;
    }

    /* =========================
       FORM ELEMENTS
    ========================== */

    .field {
        margin-bottom: 18px;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        color: #3b3b3b;
        font-size: .76rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .required {
        color: #dc3545;
    }

    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a3a3a3;
        pointer-events: none;
        z-index: 2;
    }

    .custom-input,
    .custom-select,
    .custom-textarea {
        width: 100%;
        border: 1px solid #e2e2df;
        border-radius: 13px;
        background: #fafafa;
        color: #222;
        outline: none;
        transition: .25s ease;
        font-size: .84rem;
    }

    .custom-input,
    .custom-select {
        height: 51px;
        padding: 0 15px;
    }

    .has-icon .custom-input,
    .has-icon .custom-select {
        padding-left: 43px;
    }

    .custom-textarea {
        min-height: 120px;
        padding: 14px 15px;
        resize: vertical;
    }

    .custom-input:focus,
    .custom-select:focus,
    .custom-textarea:focus {
        background: #fff;
        border-color: #ffc107;
        box-shadow: 0 0 0 4px rgba(255,193,7,.09);
    }

    .field-help {
        color: #a0a0a0;
        font-size: .68rem;
        margin-top: 6px;
    }

    /* =========================
       CHOICE CARDS
    ========================== */

    .choice-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .choice-input {
        display: none;
    }

    .choice-label {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px;
        border: 1px solid #e4e4e1;
        border-radius: 14px;
        cursor: pointer;
        background: #fafafa;
        transition: .25s ease;
    }

    .choice-label:hover {
        border-color: #ffc107;
        background: #fffdf5;
    }

    .choice-input:checked + .choice-label {
        border-color: #e3a900;
        background: #fff8df;
        box-shadow: 0 0 0 2px rgba(255,193,7,.08);
    }

    .choice-icon {
        flex: 0 0 37px;
        width: 37px;
        height: 37px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #fff;
        color: #9b6900;
    }

    .choice-label strong {
        display: block;
        font-size: .78rem;
        color: #333;
    }

    .choice-label small {
        display: block;
        color: #999;
        font-size: .66rem;
        margin-top: 2px;
    }

    /* =========================
       FOOD / SERVICE SELECTION
    ========================== */

    .selection-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 9px;
        max-height: 310px;
        overflow-y: auto;
        padding-right: 3px;
    }

    .selection-grid::-webkit-scrollbar {
        width: 5px;
    }

    .selection-grid::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 20px;
    }

    .selection-item {
        position: relative;
    }

    .selection-checkbox {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .selection-label {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 48px;
        padding: 10px 12px;
        border: 1px solid #e5e5e2;
        border-radius: 12px;
        background: #fafafa;
        cursor: pointer;
        transition: .25s ease;
    }

    .selection-label:hover {
        border-color: #ffc107;
    }

    .selection-check {
        flex: 0 0 19px;
        width: 19px;
        height: 19px;
        border: 1.5px solid #ccc;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: transparent;
        font-size: .65rem;
        transition: .2s ease;
    }

    .selection-checkbox:checked + .selection-label {
        background: #fff8e3;
        border-color: #e3a900;
    }

    .selection-checkbox:checked + .selection-label .selection-check {
        background: #ffc107;
        border-color: #ffc107;
        color: #1c1608;
    }

    .selection-name {
        color: #444;
        font-size: .76rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .selection-count {
        color: #999;
        font-size: .68rem;
        margin-bottom: 10px;
    }

    /* =========================
       SIDE SUMMARY
    ========================== */

    .booking-sidebar {
        position: sticky;
        top: 20px;
    }

    .summary-card {
        background: #1d1d1d;
        color: #fff;
        border-radius: 23px;
        padding: 25px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 18px 40px rgba(0,0,0,.13);
    }

    .summary-card::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,193,7,.09);
        right: -90px;
        top: -90px;
    }

    .summary-content {
        position: relative;
        z-index: 1;
    }

    .summary-label {
        color: #ffc107;
        font-size: .68rem;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .summary-card h3 {
        font-size: 1.25rem;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .summary-card > .summary-content > p {
        color: #999;
        font-size: .75rem;
        line-height: 1.65;
        margin-bottom: 25px;
    }

    .summary-list {
        border-top: 1px solid rgba(255,255,255,.09);
        padding-top: 17px;
    }

    .summary-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 14px;
    }

    .summary-row i {
        color: #ffc107;
        margin-top: 2px;
    }

    .summary-row span {
        color: #a5a5a5;
        font-size: .73rem;
        line-height: 1.5;
    }

    .submit-booking {
        width: 100%;
        margin-top: 15px;
        border: 0;
        border-radius: 12px;
        padding: 13px 18px;
        background: #ffc107;
        color: #211906;
        font-size: .82rem;
        font-weight: 900;
        transition: .3s ease;
    }

    .submit-booking:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(255,193,7,.18);
    }

    .submit-booking:disabled {
        opacity: .75;
        cursor: not-allowed;
        transform: none;
    }

    .secure-note {
        text-align: center;
        color: #777;
        font-size: .64rem;
        margin-top: 13px;
    }

    /* =========================
       FORM FOOTER
    ========================== */

    .form-footer {
        padding: 22px 30px;
        background: #fcfcfb;
        border-top: 1px solid #eeeeec;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .form-footer-note {
        color: #999;
        font-size: .7rem;
        line-height: 1.5;
    }

    .form-footer-note i {
        color: #b47a00;
    }

    .mobile-submit {
        display: none;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 991px) {

        .booking-layout {
            grid-template-columns: 1fr;
        }

        .booking-sidebar {
            display: none;
        }

        .mobile-submit {
            display: block;
        }
    }

    @media (max-width: 767px) {

        .booking-page {
            padding: 25px 0 55px;
        }

        .booking-header {
            padding: 30px 23px;
            border-radius: 23px;
        }

        .form-section {
            padding: 23px 20px;
        }

        .choice-grid,
        .selection-grid {
            grid-template-columns: 1fr;
        }

        .form-footer {
            padding: 20px;
            align-items: stretch;
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {

        .booking-header h1 {
            font-size: 2rem;
        }

        .section-heading {
            margin-bottom: 20px;
        }

        .form-section {
            padding: 21px 16px;
        }

        .booking-form {
            border-radius: 20px;
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


<div class="booking-page">

    <div class="container">

        {{-- =========================
             HEADER
        ========================== --}}
        <section class="booking-header">

            <div class="header-grid"></div>

            <div class="header-content">

                <a
                    href="{{ url('/customer/dashboard') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left"></i>
                    Back to Dashboard
                </a>

                <div class="header-label">
                    <i class="bi bi-calendar2-heart"></i>
                    Event Planner
                </div>

                <h1>
                    Let's plan your
                    <span>perfect event.</span>
                </h1>

                <p>
                    Tell us about your event and we'll create a catering
                    experience tailored to your guests, menu preferences
                    and special requirements.
                </p>

            </div>

        </section>


        {{-- =========================
             FORM + SIDEBAR
        ========================== --}}
        <div class="booking-layout">

            <form
                method="POST"
                action="{{ url('/customer/bookings') }}"
                class="booking-form"
                id="bookingForm"
            >

                @csrf


                {{-- =========================
                     EVENT DETAILS
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">01</div>

                        <div>
                            <h3>Tell us about your event</h3>
                            <p>Basic information about the occasion.</p>
                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    Event Type
                                    <span class="required">*</span>
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-stars input-icon"></i>

                                    <input
                                        type="text"
                                        name="event_type"
                                        class="custom-input"
                                        placeholder="Wedding / Birthday / Corporate"
                                        value="{{ old('event_type') }}"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    Event Date
                                    <span class="required">*</span>
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-calendar3 input-icon"></i>

                                    <input
                                        type="date"
                                        name="event_date"
                                        class="custom-input"
                                        value="{{ old('event_date') }}"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    Start Time
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-clock input-icon"></i>

                                    <input
                                        type="time"
                                        name="start_time"
                                        class="custom-input"
                                        value="{{ old('start_time') }}"
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    End Time
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-clock-history input-icon"></i>

                                    <input
                                        type="time"
                                        name="end_time"
                                        class="custom-input"
                                        value="{{ old('end_time') }}"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =========================
                     GUESTS & BUDGET
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">02</div>

                        <div>
                            <h3>Guests & budget</h3>
                            <p>Help us understand the size of your event.</p>
                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    Number of Guests
                                    <span class="required">*</span>
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-people input-icon"></i>

                                    <input
                                        type="number"
                                        name="guest_count"
                                        class="custom-input"
                                        min="1"
                                        placeholder="e.g. 150"
                                        value="{{ old('guest_count') }}"
                                        required
                                    >

                                </div>

                                <div class="field-help">
                                    Approximate guest count is fine.
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="field">

                                <label class="field-label">
                                    Estimated Budget
                                </label>

                                <div class="input-wrap has-icon">

                                    <i class="bi bi-currency-rupee input-icon"></i>

                                    <input
                                        type="number"
                                        name="budget"
                                        class="custom-input"
                                        min="0"
                                        placeholder="e.g. 100000"
                                        value="{{ old('budget') }}"
                                    >

                                </div>

                                <div class="field-help">
                                    Optional — helps us recommend suitable options.
                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =========================
                     VENUE
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">03</div>

                        <div>
                            <h3>Where is your event?</h3>
                            <p>Share the venue or event address.</p>
                        </div>

                    </div>


                    <div class="field">

                        <label class="field-label">
                            Venue / Address
                            <span class="required">*</span>
                        </label>

                        <textarea
                            name="venue"
                            class="custom-textarea"
                            placeholder="Enter complete venue address..."
                            required
                        >{{ old('venue') }}</textarea>

                    </div>

                </section>


                {{-- =========================
                     PACKAGE
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">04</div>

                        <div>
                            <h3>Choose your package</h3>
                            <p>Select a package or let us create a custom requirement.</p>
                        </div>

                    </div>


                    <div class="field">

                        <label class="field-label">
                            Catering Package
                        </label>

                        <select
                            name="package_id"
                            class="custom-select"
                            id="packageSelect"
                        >

                            <option value="">
                                Custom requirement
                            </option>

                            @foreach($packages as $p)

                                <option
                                    value="{{ $p->id }}"
                                    {{ old('package_id') == $p->id ? 'selected' : '' }}
                                >
                                    {{ $p->name }} — ₹{{ number_format($p->price_per_person, 2) }}/person
                                </option>

                            @endforeach

                        </select>

                    </div>

                </section>


                {{-- =========================
                     FOOD
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">05</div>

                        <div>
                            <h3>Build your menu</h3>
                            <p>Select food items you'd like to discuss with our team.</p>
                        </div>

                    </div>


                    <div class="selection-count">
                        Select one or more food items
                    </div>


                    <div class="selection-grid">

                        @foreach($foods as $f)

                            <div class="selection-item">

                                <input
                                    type="checkbox"
                                    class="selection-checkbox"
                                    id="food_{{ $f->id }}"
                                    name="food_ids[]"
                                    value="{{ $f->id }}"
                                    {{ in_array($f->id, old('food_ids', [])) ? 'checked' : '' }}
                                >

                                <label
                                    class="selection-label"
                                    for="food_{{ $f->id }}"
                                >

                                    <span class="selection-check">
                                        <i class="bi bi-check-lg"></i>
                                    </span>

                                    <span class="selection-name">
                                        {{ $f->name }}
                                    </span>

                                </label>

                            </div>

                        @endforeach

                    </div>

                </section>


                {{-- =========================
                     ADDITIONAL SERVICES
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">06</div>

                        <div>
                            <h3>Add-on services</h3>
                            <p>Choose any additional services you may need.</p>
                        </div>

                    </div>


                    <div class="selection-grid">

                        @foreach($extras as $e)

                            <div class="selection-item">

                                <input
                                    type="checkbox"
                                    class="selection-checkbox"
                                    id="extra_{{ $e->id }}"
                                    name="additional_service_ids[]"
                                    value="{{ $e->id }}"
                                    {{ in_array($e->id, old('additional_service_ids', [])) ? 'checked' : '' }}
                                >

                                <label
                                    class="selection-label"
                                    for="extra_{{ $e->id }}"
                                >

                                    <span class="selection-check">
                                        <i class="bi bi-check-lg"></i>
                                    </span>

                                    <span class="selection-name">
                                        {{ $e->name }}
                                    </span>

                                </label>

                            </div>

                        @endforeach

                    </div>

                </section>


                {{-- =========================
                     SPECIAL REQUIREMENTS
                ========================== --}}
                <section class="form-section">

                    <div class="section-heading">

                        <div class="section-number">07</div>

                        <div>
                            <h3>Anything else?</h3>
                            <p>Tell us about dietary preferences or special requirements.</p>
                        </div>

                    </div>


                    <div class="field">

                        <textarea
                            name="special_requirements"
                            class="custom-textarea"
                            rows="5"
                            placeholder="Example: Jain food, live counters, children's menu, decoration coordination, special dietary requirements..."
                        >{{ old('special_requirements') }}</textarea>

                    </div>

                </section>


                {{-- =========================
                     MOBILE SUBMIT
                ========================== --}}
                <div class="form-footer mobile-submit">

                    <div class="form-footer-note">
                        <i class="bi bi-shield-check me-1"></i>
                        Your request will be reviewed by our catering team.
                    </div>

                    <button
                        type="submit"
                        class="submit-booking"
                        id="mobileSubmit"
                    >
                        <i class="bi bi-send me-1"></i>
                        Submit Booking Request
                    </button>

                </div>

            </form>


            {{-- =========================
                 DESKTOP SIDEBAR
            ========================== --}}
            <aside class="booking-sidebar">

                <div class="summary-card">

                    <div class="summary-content">

                        <div class="summary-label">
                            Almost there
                        </div>

                        <h3>Plan it your way.</h3>

                        <p>
                            Give us as much information as possible.
                            Our team will review your request and contact
                            you to finalize the details.
                        </p>


                        <div class="summary-list">

                            <div class="summary-row">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Flexible menu and package options
                                </span>
                            </div>

                            <div class="summary-row">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Catering tailored to your guest count
                                </span>
                            </div>

                            <div class="summary-row">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Additional services available
                                </span>
                            </div>

                            <div class="summary-row">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>
                                    Our team will contact you after review
                                </span>
                            </div>

                        </div>


                        <button
                            type="submit"
                            form="bookingForm"
                            class="submit-booking"
                            id="desktopSubmit"
                        >
                            <i class="bi bi-send me-1"></i>
                            Submit Booking Request
                        </button>

                        <div class="secure-note">
                            <i class="bi bi-lock-fill me-1"></i>
                            No online payment required
                        </div>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('bookingForm');
        const desktopButton = document.getElementById('desktopSubmit');
        const mobileButton = document.getElementById('mobileSubmit');

        if (!form) return;

        form.addEventListener('submit', function () {

            [desktopButton, mobileButton].forEach(function (button) {

                if (!button) return;

                button.disabled = true;

                button.innerHTML = `
                    <span>
                        <span class="spinner-border spinner-border-sm me-2"
                              role="status"
                              aria-hidden="true"></span>
                        Submitting...
                    </span>
                `;

            });

        });

    });
</script>

@endsection