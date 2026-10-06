@extends('layouts.admin')

@section('content')

<style>
    .settings-page {
        --gold: #c9a227;
        --gold-dark: #a98518;
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
        max-width: 720px;
        line-height: 1.6;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        padding: 8px 13px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,.13);
        background: rgba(255,255,255,.06);
        font-size: 12px;
    }

    .settings-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(15,23,42,.05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .settings-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eef0f3;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #fff8df;
        color: var(--gold-dark);
        font-size: 18px;
        flex-shrink: 0;
    }

    .section-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
    }

    .section-description {
        color: var(--muted);
        font-size: 12px;
        margin: 3px 0 0;
    }

    .settings-card-body {
        padding: 22px;
    }

    .form-label-custom {
        font-size: 12px;
        font-weight: 750;
        color: #374151;
        margin-bottom: 7px;
    }

    .field-help {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 5px;
    }

    .form-control {
        min-height: 44px;
        border-radius: 11px;
        border-color: #dfe3e8;
        font-size: 14px;
        box-shadow: none !important;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,162,39,.08) !important;
    }

    .media-upload {
        border: 1px dashed #d7dce2;
        border-radius: 15px;
        padding: 15px;
        background: #fafafa;
        height: 100%;
    }

    .media-upload-label {
        font-size: 12px;
        font-weight: 750;
        color: #374151;
        margin-bottom: 8px;
    }

    .media-preview {
        margin-top: 12px;
        border-radius: 12px;
        overflow: hidden;
        background: #f1f3f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-preview {
        width: 76px;
        height: 76px;
    }

    .about-preview {
        width: 140px;
        height: 85px;
    }

    .media-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-placeholder {
        color: #9ca3af;
        font-size: 11px;
        text-align: center;
        padding: 20px;
    }

    .social-input {
        position: relative;
    }

    .social-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        z-index: 2;
        font-size: 16px;
    }

    .social-input .form-control {
        padding-left: 40px;
    }

    .save-bar {
        position: sticky;
        bottom: 15px;
        z-index: 20;
        background: rgba(255,255,255,.94);
        backdrop-filter: blur(12px);
        border: 1px solid var(--border);
        border-radius: 17px;
        padding: 12px 15px;
        box-shadow: 0 12px 35px rgba(15,23,42,.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .save-note {
        font-size: 12px;
        color: var(--muted);
    }

    .save-note i {
        color: var(--gold);
    }

    .btn-save {
        background: var(--dark);
        border: 1px solid var(--dark);
        color: #fff;
        border-radius: 11px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 750;
        transition: .2s ease;
        white-space: nowrap;
    }

    .btn-save:hover {
        background: #000;
        border-color: #000;
        color: #fff;
        transform: translateY(-1px);
    }

    .divider-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #9ca3af;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .1em;
        margin: 8px 0 20px;
    }

    .divider-label::after {
        content: "";
        height: 1px;
        background: #eef0f3;
        flex: 1;
    }

    @media (max-width: 767.98px) {

        .page-hero {
            padding: 24px 20px;
            border-radius: 17px;
        }

        .settings-card-header,
        .settings-card-body {
            padding: 17px;
        }

        .save-bar {
            align-items: stretch;
            flex-direction: column;
        }

        .btn-save {
            width: 100%;
        }

        .save-note {
            text-align: center;
        }
    }
</style>


<div class="settings-page">

    {{-- Page Header --}}
    <div class="page-hero">

        <div class="page-hero-content">

            <div class="page-kicker">
                <i class="bi bi-sliders2 me-1"></i>
                Global Website Controls
            </div>

            <h1>Website Settings</h1>

            <p>
                Manage your business branding, contact information, homepage
                fallback content, SEO text and social media links from one place.
            </p>

            <div class="hero-badge">
                <i class="bi bi-shield-check"></i>
                Centralized website configuration
            </div>

        </div>

    </div>


    <form
        method="post"
        enctype="multipart/form-data"
        id="websiteSettingsForm"
    >

        @csrf


        {{-- Brand & Contact --}}
        <div class="settings-card">

            <div class="settings-card-header">

                <div class="section-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>
                    <h5 class="section-title">
                        Brand & Contact
                    </h5>

                    <p class="section-description">
                        Basic business information shown throughout the website.
                    </p>
                </div>

            </div>


            <div class="settings-card-body">

                <div class="row g-3">

                    @foreach([
                        'business_name',
                        'tagline',
                        'phone',
                        'whatsapp',
                        'email',
                        'address',
                        'opening_hours'
                    ] as $key)

                        <div class="{{ $key === 'address' || $key === 'opening_hours' ? 'col-md-6' : 'col-md-6' }}">

                            <label class="form-label-custom">
                                {{ ucwords(str_replace('_', ' ', $key)) }}
                            </label>

                            @if($key === 'address')

                                <textarea
                                    class="form-control"
                                    name="{{ $key }}"
                                    rows="3"
                                    placeholder="Enter complete business address"
                                >{{ data_get($settings, $key) }}</textarea>

                            @elseif($key === 'opening_hours')

                                <textarea
                                    class="form-control"
                                    name="{{ $key }}"
                                    rows="3"
                                    placeholder="e.g. Mon - Sun: 10:00 AM - 10:00 PM"
                                >{{ data_get($settings, $key) }}</textarea>

                            @else

                                <input
                                    class="form-control"
                                    name="{{ $key }}"
                                    value="{{ data_get($settings, $key) }}"
                                    placeholder="Enter {{ strtolower(str_replace('_', ' ', $key)) }}"
                                    @if($key === 'email') type="email" @endif
                                >

                            @endif

                        </div>

                    @endforeach


                    {{-- Logo --}}
                    <div class="col-md-6">

                        <div class="media-upload">

                            <div class="media-upload-label">
                                <i class="bi bi-image me-1"></i>
                                Website Logo
                            </div>

                            <input
                                class="form-control"
                                type="file"
                                name="logo"
                                accept="image/*"
                            >

                            <div class="field-help">
                                Upload the main logo used by the website.
                            </div>


                            @if(data_get($settings, 'logo'))

                                <div class="media-preview logo-preview">

                                    <img
                                        src="{{ asset('storage/'.data_get($settings, 'logo')) }}"
                                        alt="Website Logo"
                                    >

                                </div>

                            @else

                                <div class="media-preview logo-preview">

                                    <div class="preview-placeholder">
                                        <i class="bi bi-image fs-4 d-block mb-1"></i>
                                        No logo uploaded
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- About Image --}}
                    <div class="col-md-6">

                        <div class="media-upload">

                            <div class="media-upload-label">
                                <i class="bi bi-card-image me-1"></i>
                                About Page Image
                            </div>

                            <input
                                class="form-control"
                                type="file"
                                name="about_image"
                                accept="image/*"
                            >

                            <div class="field-help">
                                Image displayed in the About section/page.
                            </div>


                            @if(data_get($settings, 'about_image'))

                                <div class="media-preview about-preview">

                                    <img
                                        src="{{ asset('storage/'.data_get($settings, 'about_image')) }}"
                                        alt="About Image"
                                    >

                                </div>

                            @else

                                <div class="media-preview about-preview">

                                    <div class="preview-placeholder">
                                        <i class="bi bi-image fs-4 d-block mb-1"></i>
                                        No image uploaded
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Homepage / SEO --}}
        <div class="settings-card">

            <div class="settings-card-header">

                <div class="section-icon">
                    <i class="bi bi-house-heart"></i>
                </div>

                <div>
                    <h5 class="section-title">
                        Homepage & SEO Content
                    </h5>

                    <p class="section-description">
                        Fallback homepage text and business introduction content.
                    </p>
                </div>

            </div>


            <div class="settings-card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label-custom">
                            Hero Badge
                        </label>

                        <input
                            class="form-control"
                            name="hero_badge"
                            value="{{ data_get($settings, 'hero_badge') }}"
                            placeholder="Premium Catering"
                        >

                    </div>


                    <div class="col-md-8">

                        <label class="form-label-custom">
                            Hero Title
                        </label>

                        <input
                            class="form-control"
                            name="hero_title"
                            value="{{ data_get($settings, 'hero_title') }}"
                            placeholder="Exceptional Food. Memorable Events."
                        >

                    </div>


                    <div class="col-12">

                        <label class="form-label-custom">
                            Hero Subtitle
                        </label>

                        <textarea
                            class="form-control"
                            name="hero_subtitle"
                            rows="3"
                            placeholder="Short introduction displayed below the main homepage heading."
                        >{{ data_get($settings, 'hero_subtitle') }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label-custom">
                            About Text
                        </label>

                        <textarea
                            class="form-control"
                            rows="6"
                            name="about"
                            placeholder="Write a short introduction about your catering business..."
                        >{{ data_get($settings, 'about') }}</textarea>

                        <div class="field-help">
                            Keep this clear and customer-friendly.
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label-custom">
                            Opening Hours / Extra Note
                        </label>

                        <textarea
                            class="form-control"
                            rows="6"
                            name="opening_hours"
                            placeholder="Business timings or an additional customer-facing note..."
                        >{{ data_get($settings, 'opening_hours') }}</textarea>

                        <div class="field-help">
                            This value can be used as a fallback on the frontend.
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Social Links --}}
        <div class="settings-card">

            <div class="settings-card-header">

                <div class="section-icon">
                    <i class="bi bi-share"></i>
                </div>

                <div>
                    <h5 class="section-title">
                        Social Links
                    </h5>

                    <p class="section-description">
                        Connect your website with your social media profiles.
                    </p>
                </div>

            </div>


            <div class="settings-card-body">

                <div class="row g-3">

                    @foreach([
                        'instagram',
                        'facebook',
                        'youtube'
                    ] as $key)

                        <div class="col-md-4">

                            <label class="form-label-custom">
                                {{ ucfirst($key) }} URL
                            </label>

                            <div class="social-input">

                                <i class="bi
                                    @if($key === 'instagram') bi-instagram
                                    @elseif($key === 'facebook') bi-facebook
                                    @else bi-youtube
                                    @endif
                                    social-icon">
                                </i>

                                <input
                                    class="form-control"
                                    type="url"
                                    name="{{ $key }}"
                                    value="{{ data_get($settings, $key) }}"
                                    placeholder="https://..."
                                >

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- Save Bar --}}
        <div class="save-bar">

            <div class="save-note">
                <i class="bi bi-info-circle me-1"></i>
                Changes will be reflected on the website after saving.
            </div>

            <button
                type="submit"
                class="btn btn-save"
                id="saveSettingsBtn"
            >
                <i class="bi bi-check2-circle me-1"></i>
                Save Website Settings
            </button>

        </div>

    </form>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('websiteSettingsForm');
    const button = document.getElementById('saveSettingsBtn');

    if (form && button) {

        form.addEventListener('submit', function () {

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

        });

    }

});
</script>

@endsection