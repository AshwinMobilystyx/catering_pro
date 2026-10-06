@extends('layouts.app')

@section('content')

<style>
    .tasting-page {
        background:
            radial-gradient(circle at 10% 10%, rgba(194, 148, 62, .10), transparent 28%),
            radial-gradient(circle at 90% 30%, rgba(194, 148, 62, .07), transparent 25%),
            #f7f7f5;
        min-height: calc(100vh - 70px);
        padding: 55px 0 80px;
    }

    .tasting-wrapper {
        max-width: 1050px;
        margin: auto;
    }

    .tasting-hero {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 48px;
        margin-bottom: 28px;
        color: #fff;
        background:
            linear-gradient(120deg, rgba(15, 15, 15, .96), rgba(38, 31, 20, .94)),
            #111;
        box-shadow: 0 25px 70px rgba(0, 0, 0, .14);
    }

    .tasting-hero::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        right: -80px;
        top: -100px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.12);
        box-shadow:
            0 0 0 35px rgba(255,255,255,.025),
            0 0 0 70px rgba(255,255,255,.018);
    }

    .tasting-hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,.72);
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 28px;
        transition: .25s ease;
    }

    .back-link:hover {
        color: #fff;
        transform: translateX(-3px);
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #d7b46a;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .eyebrow::before {
        content: "";
        width: 28px;
        height: 1px;
        background: #d7b46a;
    }

    .tasting-hero h1 {
        margin: 0 0 15px;
        font-size: clamp(34px, 5vw, 58px);
        line-height: 1.05;
        font-weight: 800;
        letter-spacing: -1.8px;
    }

    .tasting-hero p {
        color: rgba(255,255,255,.70);
        font-size: 16px;
        line-height: 1.8;
        max-width: 620px;
        margin: 0;
    }

    .form-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 26px;
        padding: 35px;
        box-shadow: 0 20px 55px rgba(0,0,0,.07);
    }

    .form-section {
        padding-bottom: 30px;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
    }

    .form-section:last-of-type {
        border-bottom: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
    }

    .section-number {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f5efe3;
        color: #9b6f25;
        font-size: 13px;
        font-weight: 800;
    }

    .section-heading h2 {
        margin: 0 0 4px;
        font-size: 19px;
        font-weight: 800;
        color: #191919;
    }

    .section-heading p {
        margin: 0;
        color: #888;
        font-size: 13px;
    }

    .field-label {
        display: block;
        margin-bottom: 8px;
        color: #282828;
        font-size: 13px;
        font-weight: 700;
    }

    .field-label span {
        color: #b34a4a;
    }

    .form-control,
    .form-select {
        min-height: 52px;
        border: 1px solid #e2e2df;
        border-radius: 13px;
        padding: 13px 15px;
        color: #222;
        background: #fff;
        box-shadow: none !important;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #c2943e;
        box-shadow: 0 0 0 4px rgba(194,148,62,.10) !important;
    }

    .input-hint {
        color: #999;
        font-size: 11px;
        margin-top: 7px;
    }

    .food-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .food-option {
        position: relative;
    }

    .food-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .food-option label {
        min-height: 52px;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border: 1px solid #e1e1de;
        border-radius: 13px;
        cursor: pointer;
        color: #555;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .food-option input:checked + label {
        border-color: #b98632;
        background: #fbf6ec;
        color: #8a611e;
        box-shadow: 0 5px 18px rgba(185,134,50,.10);
    }

    .food-option label:hover {
        border-color: #c9a76c;
        transform: translateY(-2px);
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding-top: 30px;
        margin-top: 30px;
        border-top: 1px solid #eee;
    }

    .secure-note {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #888;
        font-size: 12px;
    }

    .secure-note i {
        color: #9a742f;
    }

    .btn-tasting {
        min-height: 54px;
        padding: 0 27px;
        border: 0;
        border-radius: 14px;
        background: linear-gradient(135deg, #b7832e, #d2a653);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        box-shadow: 0 12px 28px rgba(183,131,46,.22);
        transition: .25s ease;
    }

    .btn-tasting:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 16px 32px rgba(183,131,46,.30);
    }

    .btn-tasting.loading {
        pointer-events: none;
        opacity: .75;
    }

    .btn-tasting .spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    .btn-tasting.loading .spinner {
        display: inline-block;
    }

    .btn-tasting.loading .btn-text {
        display: none;
    }

    .alert-box {
        border-radius: 15px;
        padding: 15px 18px;
        margin-bottom: 25px;
        font-size: 13px;
    }

    .alert-box ul {
        margin: 7px 0 0;
        padding-left: 18px;
    }

    .field-error {
        color: #b44d4d;
        font-size: 11px;
        margin-top: 6px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 767px) {
        .tasting-page {
            padding: 25px 0 50px;
        }

        .tasting-hero {
            border-radius: 20px;
            padding: 32px 24px;
            margin-bottom: 18px;
        }

        .tasting-hero h1 {
            letter-spacing: -1px;
        }

        .form-card {
            padding: 23px 18px;
            border-radius: 20px;
        }

        .food-options {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .secure-note {
            justify-content: center;
        }

        .btn-tasting {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            scroll-behavior: auto !important;
            transition: none !important;
            animation: none !important;
        }
    }
</style>

<div class="tasting-page">
    <div class="container">
        <div class="tasting-wrapper">

            {{-- Hero --}}
            <div class="tasting-hero">
                <div class="tasting-hero-content">

                    <a href="{{ url()->previous() }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Back
                    </a>

                    <div class="eyebrow">Private Tasting Experience</div>

                    <h1>Let's Taste Something Special.</h1>

                    <p>
                        Tell us a little about your event and preferred tasting schedule.
                        Our team will prepare a personalised tasting experience for you.
                    </p>

                </div>
            </div>

            {{-- Form --}}
            <div class="form-card">

                @if ($errors->any())
                    <div class="alert alert-danger alert-box">
                        <strong>Please check the following:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-box">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ url()->current() }}" id="tastingForm">
                    @csrf

                    {{-- Event Details --}}
                    <div class="form-section">

                        <div class="section-heading">
                            <div class="section-number">01</div>

                            <div>
                                <h2>Event Details</h2>
                                <p>Help us understand what you're planning.</p>
                            </div>
                        </div>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label class="field-label">Event Type</label>

                                <input
                                    type="text"
                                    name="event_type"
                                    class="form-control"
                                    value="{{ old('event_type') }}"
                                    placeholder="e.g. Wedding, Birthday, Corporate"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="field-label">Event Date</label>

                                <input
                                    type="date"
                                    name="event_date"
                                    class="form-control"
                                    value="{{ old('event_date') }}"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="field-label">Expected Guests</label>

                                <input
                                    type="number"
                                    name="guest_count"
                                    class="form-control"
                                    value="{{ old('guest_count') }}"
                                    min="1"
                                    placeholder="Approx. number of guests"
                                >

                                <div class="input-hint">
                                    An approximate count is perfectly fine.
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Tasting Schedule --}}
                    <div class="form-section">

                        <div class="section-heading">
                            <div class="section-number">02</div>

                            <div>
                                <h2>Tasting Schedule</h2>
                                <p>Choose when you'd like to experience our food.</p>
                            </div>
                        </div>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label class="field-label">
                                    Preferred Date <span>*</span>
                                </label>

                                <input
                                    type="date"
                                    name="preferred_date"
                                    class="form-control"
                                    value="{{ old('preferred_date') }}"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                >

                                @error('preferred_date')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="field-label">Preferred Time</label>

                                <input
                                    type="time"
                                    name="preferred_time"
                                    class="form-control"
                                    value="{{ old('preferred_time') }}"
                                >
                            </div>

                        </div>
                    </div>

                    {{-- Food Preference --}}
                    <div class="form-section">

                        <div class="section-heading">
                            <div class="section-number">03</div>

                            <div>
                                <h2>Food Preference</h2>
                                <p>Tell our chefs what kind of menu you'd like to explore.</p>
                            </div>
                        </div>

                        <div class="food-options">

                            @php
                                $foodPreference = old('food_preference', 'Vegetarian');
                            @endphp

                            <div class="food-option">
                                <input
                                    type="radio"
                                    id="veg"
                                    name="food_preference"
                                    value="Vegetarian"
                                    {{ $foodPreference === 'Vegetarian' ? 'checked' : '' }}
                                >
                                <label for="veg">
                                    <i class="bi bi-leaf me-2"></i>
                                    Vegetarian
                                </label>
                            </div>

                            <div class="food-option">
                                <input
                                    type="radio"
                                    id="nonveg"
                                    name="food_preference"
                                    value="Non-Vegetarian"
                                    {{ $foodPreference === 'Non-Vegetarian' ? 'checked' : '' }}
                                >
                                <label for="nonveg">
                                    <i class="bi bi-egg-fried me-2"></i>
                                    Non-Vegetarian
                                </label>
                            </div>

                            <div class="food-option">
                                <input
                                    type="radio"
                                    id="jain"
                                    name="food_preference"
                                    value="Jain"
                                    {{ $foodPreference === 'Jain' ? 'checked' : '' }}
                                >
                                <label for="jain">
                                    <i class="bi bi-flower1 me-2"></i>
                                    Jain
                                </label>
                            </div>

                            <div class="food-option">
                                <input
                                    type="radio"
                                    id="mixed"
                                    name="food_preference"
                                    value="Mixed"
                                    {{ $foodPreference === 'Mixed' ? 'checked' : '' }}
                                >
                                <label for="mixed">
                                    <i class="bi bi-grid me-2"></i>
                                    Mixed
                                </label>
                            </div>

                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="form-section">

                        <div class="section-heading">
                            <div class="section-number">04</div>

                            <div>
                                <h2>Tasting Location</h2>
                                <p>Where would you prefer the tasting to take place?</p>
                            </div>
                        </div>

                        <label class="field-label">Preferred Location</label>

                        <textarea
                            name="location"
                            class="form-control"
                            placeholder="Enter your preferred tasting location..."
                        >{{ old('location') }}</textarea>

                    </div>

                    {{-- Additional Message --}}
                    <div class="form-section">

                        <div class="section-heading">
                            <div class="section-number">05</div>

                            <div>
                                <h2>Anything Else?</h2>
                                <p>Share special requests, cuisine preferences or questions.</p>
                            </div>
                        </div>

                        <label class="field-label">Your Message</label>

                        <textarea
                            name="message"
                            class="form-control"
                            rows="5"
                            maxlength="2000"
                            placeholder="Tell us about your preferred cuisine, dishes you'd like to taste, dietary requirements, or anything else..."
                        >{{ old('message') }}</textarea>

                        <div class="input-hint">
                            Maximum 2000 characters.
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="form-actions">

                        <div class="secure-note">
                            <i class="bi bi-shield-check"></i>
                            Your request is handled securely by our team.
                        </div>

                        <button type="submit" class="btn-tasting" id="submitBtn">
                            <span class="btn-text">
                                Request Tasting
                                <i class="bi bi-arrow-right ms-2"></i>
                            </span>

                            <span class="spinner"></span>
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('tastingForm');
    const button = document.getElementById('submitBtn');

    if (!form || !button) {
        return;
    }

    form.addEventListener('submit', function () {

        if (!form.checkValidity()) {
            return;
        }

        button.classList.add('loading');
        button.disabled = true;

    });

    // Prevent selecting a tasting date in the past.
    const preferredDate = form.querySelector('[name="preferred_date"]');

    if (preferredDate) {
        const today = new Date().toISOString().split('T')[0];

        preferredDate.setAttribute('min', today);
    }

});
</script>

@endsection