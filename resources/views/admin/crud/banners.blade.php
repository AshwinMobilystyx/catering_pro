@extends('layouts.admin')

@section('content')

<style>
    .banner-page {
        padding-bottom: 40px;
    }

    .banner-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .banner-eyebrow {
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

    .banner-eyebrow::before {
        content: "";
        width: 25px;
        height: 2px;
        background: #c2943e;
        border-radius: 5px;
    }

    .banner-header h1 {
        margin: 0;
        color: #181818;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .banner-header p {
        max-width: 700px;
        margin: 7px 0 0;
        color: #888;
        font-size: 14px;
        line-height: 1.6;
    }

    .banner-count {
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
        white-space: nowrap;
    }

    .banner-count i {
        color: #a97927;
    }

    /* Add Banner */
    .cms-card {
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.04);
    }

    .add-banner-card {
        margin-bottom: 28px;
        overflow: hidden;
    }

    .cms-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 23px;
        border-bottom: 1px solid #eeeae4;
    }

    .cms-header-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f8f2e7;
        color: #a97927;
        font-size: 17px;
    }

    .cms-card-header h3 {
        margin: 0;
        color: #242424;
        font-size: 16px;
        font-weight: 800;
    }

    .cms-card-header p {
        margin: 4px 0 0;
        color: #999;
        font-size: 11px;
    }

    .cms-card-body {
        padding: 25px;
    }

    .field-label {
        display: block;
        margin-bottom: 7px;
        color: #444;
        font-size: 12px;
        font-weight: 700;
    }

    .field-label .required {
        color: #bd4d4d;
    }

    .form-control {
        min-height: 46px;
        border: 1px solid #e2dfd9;
        border-radius: 11px;
        color: #333;
        font-size: 13px;
        box-shadow: none !important;
        transition: .2s ease;
    }

    .form-control:focus {
        border-color: #c2943e;
        box-shadow: 0 0 0 3px rgba(194,148,62,.08) !important;
    }

    .form-text {
        margin-top: 6px;
        color: #999;
        font-size: 10px;
    }

    .switch-box {
        height: 46px;
        display: flex;
        align-items: center;
        padding: 0 13px;
        border: 1px solid #e2dfd9;
        border-radius: 11px;
        background: #faf9f7;
    }

    .form-check-input {
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #a97927;
        border-color: #a97927;
    }

    .form-check-label {
        color: #555;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-add-banner {
        min-height: 45px;
        padding: 0 21px;
        border: 0;
        border-radius: 11px;
        background: #202020;
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
    }

    .btn-add-banner:hover {
        background: #a97927;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Banner Cards */
    .banner-item {
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.04);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .banner-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 45px rgba(0,0,0,.08);
    }

    .banner-preview {
        position: relative;
        height: 245px;
        overflow: hidden;
        background: #151515;
    }

    .banner-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .banner-item:hover .banner-preview img {
        transform: scale(1.035);
    }

    .banner-preview::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,0,0,.55),
            rgba(0,0,0,0) 55%
        );
        pointer-events: none;
    }

    .preview-label {
        position: absolute;
        left: 15px;
        bottom: 14px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 10px;
        border-radius: 8px;
        background: rgba(0,0,0,.55);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
    }

    .preview-label i {
        color: #e1bb71;
    }

    .banner-status {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 30px;
        backdrop-filter: blur(10px);
        font-size: 10px;
        font-weight: 800;
    }

    .status-pill::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-published {
        background: rgba(226,247,236,.94);
        color: #28764d;
    }

    .status-hidden {
        background: rgba(245,245,245,.94);
        color: #777;
    }

    .banner-content {
        padding: 21px;
    }

    .banner-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .banner-title {
        margin: 0;
        color: #222;
        font-size: 17px;
        line-height: 1.3;
        font-weight: 800;
    }

    .order-badge {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 8px;
        background: #f8f3e9;
        color: #9a6d26;
        font-size: 10px;
        font-weight: 800;
    }

    .banner-subtitle {
        min-height: 40px;
        margin: 8px 0 0;
        color: #888;
        font-size: 12px;
        line-height: 1.65;
    }

    .banner-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 15px;
    }

    .meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border: 1px solid #ebe8e2;
        border-radius: 8px;
        color: #777;
        background: #faf9f7;
        font-size: 10px;
        font-weight: 600;
    }

    .meta-chip i {
        color: #a97927;
    }

    /* Edit */
    .edit-details {
        margin-top: 18px;
        border-top: 1px solid #eeeae4;
        padding-top: 16px;
    }

    .edit-details summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        list-style: none;
        color: #333;
        font-size: 12px;
        font-weight: 800;
    }

    .edit-details summary::-webkit-details-marker {
        display: none;
    }

    .edit-details summary::after {
        content: "\F282";
        font-family: "bootstrap-icons";
        color: #999;
        font-size: 12px;
        transition: .2s ease;
    }

    .edit-details[open] summary::after {
        transform: rotate(180deg);
    }

    .edit-form {
        padding-top: 19px;
    }

    .edit-form .form-control {
        min-height: 42px;
        font-size: 12px;
    }

    .edit-form .field-label {
        font-size: 10px;
    }

    .btn-save {
        min-height: 40px;
        padding: 0 16px;
        border: 0;
        border-radius: 9px;
        background: #202020;
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        transition: .2s ease;
    }

    .btn-save:hover {
        background: #a97927;
        color: #fff;
    }

    .banner-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #eeeae4;
    }

    .order-text {
        color: #999;
        font-size: 10px;
    }

    .delete-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 34px;
        padding: 0 11px;
        border: 1px solid #efd5d5;
        border-radius: 8px;
        background: #fff;
        color: #b04b4b;
        font-size: 10px;
        font-weight: 700;
        transition: .2s ease;
    }

    .delete-btn:hover {
        background: #fff4f4;
        border-color: #e4bcbc;
    }

    /* Empty */
    .empty-banners {
        padding: 70px 20px;
        text-align: center;
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 18px;
        background: #f8f3e9;
        color: #a97927;
        font-size: 24px;
    }

    .empty-banners h4 {
        margin: 0 0 6px;
        color: #333;
        font-size: 17px;
        font-weight: 800;
    }

    .empty-banners p {
        margin: 0;
        color: #999;
        font-size: 12px;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 25px;
    }

    .pagination-wrapper .pagination {
        margin: 0;
        gap: 5px;
    }

    .pagination-wrapper .page-link {
        border: 1px solid #e5e1da;
        border-radius: 8px !important;
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

    @media (max-width: 767px) {
        .banner-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .banner-count {
            width: 100%;
            justify-content: center;
        }

        .cms-card-body {
            padding: 19px;
        }

        .banner-preview {
            height: 210px;
        }

        .banner-title-row {
            flex-direction: column;
        }

        .order-badge {
            align-self: flex-start;
        }
    }
</style>


<div class="banner-page">

    {{-- Page Header --}}
    <div class="banner-header">

        <div>
            <div class="banner-eyebrow">
                Homepage CMS
            </div>

            <h1>Hero Banners</h1>

            <p>
                Create and manage homepage banners, promotional messaging,
                call-to-action buttons, images and display order without touching code.
            </p>
        </div>

        <div class="banner-count">
            <i class="bi bi-images"></i>
            {{ $items->total() }} {{ $items->total() == 1 ? 'Banner' : 'Banners' }}
        </div>

    </div>


    {{-- Add Banner --}}
    <div class="cms-card add-banner-card">

        <div class="cms-card-header">

            <div class="cms-header-icon">
                <i class="bi bi-plus-lg"></i>
            </div>

            <div>
                <h3>Add New Banner</h3>
                <p>Create a new homepage hero section</p>
            </div>

        </div>

        <div class="cms-card-body">

            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <div class="col-lg-6">
                        <label class="field-label">
                            Headline <span class="required">*</span>
                        </label>

                        <input
                            class="form-control"
                            name="title"
                            required
                            value="{{ old('title') }}"
                            placeholder="Beautiful food. Memorable celebrations."
                        >
                    </div>

                    <div class="col-lg-6">
                        <label class="field-label">
                            Subtitle
                        </label>

                        <input
                            class="form-control"
                            name="subtitle"
                            value="{{ old('subtitle') }}"
                            placeholder="Fresh menus, warm service and beautiful presentation."
                        >
                    </div>


                    <div class="col-md-6 col-lg-3">
                        <label class="field-label">Primary Button</label>

                        <input
                            class="form-control"
                            name="button_text"
                            value="{{ old('button_text') }}"
                            placeholder="Plan My Event"
                        >
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="field-label">Primary URL</label>

                        <input
                            class="form-control"
                            name="button_url"
                            value="{{ old('button_url') }}"
                            placeholder="/contact"
                        >
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="field-label">Second Button</label>

                        <input
                            class="form-control"
                            name="secondary_button_text"
                            value="{{ old('secondary_button_text') }}"
                            placeholder="See Gallery"
                        >
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="field-label">Second URL</label>

                        <input
                            class="form-control"
                            name="secondary_button_url"
                            value="{{ old('secondary_button_url') }}"
                            placeholder="/gallery"
                        >
                    </div>


                    <div class="col-lg-7">
                        <label class="field-label">
                            Desktop Banner <span class="required">*</span>
                        </label>

                        <input
                            class="form-control"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <div class="form-text">
                            JPG, PNG or WebP · Recommended 1920 × 900
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <label class="field-label">
                            Mobile Banner
                        </label>

                        <input
                            class="form-control"
                            type="file"
                            name="mobile_image"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <div class="form-text">
                            Optional portrait/mobile crop
                        </div>
                    </div>


                    <div class="col-md-4">
                        <label class="field-label">
                            Display Order
                        </label>

                        <input
                            class="form-control"
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="field-label">
                            Publication
                        </label>

                        <div class="switch-box">
                            <div class="form-check form-switch mb-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="status"
                                    value="1"
                                    id="newBannerStatus"
                                    checked
                                >

                                <label class="form-check-label" for="newBannerStatus">
                                    Publish banner
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn-add-banner mt-4">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Banner
                </button>

            </form>

        </div>

    </div>


    {{-- Banner List --}}
    @if($items->count())

        <div class="row g-4">

            @foreach($items as $i)

                <div class="col-xl-6">

                    <div class="banner-item">

                        {{-- Preview --}}
                        <div class="banner-preview">

                            <img
                                src="{{ asset('storage/' . $i->image) }}"
                                alt="{{ $i->title }}"
                                loading="lazy"
                            >

                            <div class="banner-status">

                                @if($i->status)
                                    <span class="status-pill status-published">
                                        Published
                                    </span>
                                @else
                                    <span class="status-pill status-hidden">
                                        Hidden
                                    </span>
                                @endif

                            </div>

                            <div class="preview-label">
                                <i class="bi bi-display"></i>
                                Desktop Preview
                            </div>

                        </div>


                        {{-- Content --}}
                        <div class="banner-content">

                            <div class="banner-title-row">

                                <div>
                                    <h3 class="banner-title">
                                        {{ $i->title }}
                                    </h3>

                                    <p class="banner-subtitle">
                                        {{ $i->subtitle ?: 'No subtitle added.' }}
                                    </p>
                                </div>

                                <span class="order-badge">
                                    <i class="bi bi-sort-numeric-down"></i>
                                    #{{ $i->sort_order }}
                                </span>

                            </div>


                            {{-- Meta --}}
                            <div class="banner-meta">

                                @if($i->button_text)
                                    <span class="meta-chip">
                                        <i class="bi bi-cursor"></i>
                                        {{ $i->button_text }}
                                    </span>
                                @endif

                                @if($i->secondary_button_text)
                                    <span class="meta-chip">
                                        <i class="bi bi-link-45deg"></i>
                                        {{ $i->secondary_button_text }}
                                    </span>
                                @endif

                                @if($i->mobile_image)
                                    <span class="meta-chip">
                                        <i class="bi bi-phone"></i>
                                        Mobile image
                                    </span>
                                @endif

                            </div>


                            {{-- Edit --}}
                            <details class="edit-details">

                                <summary>
                                    <span>
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Edit Banner
                                    </span>
                                </summary>

                                <form
                                    method="POST"
                                    enctype="multipart/form-data"
                                    action="/admin/banners/{{ $i->id }}"
                                    class="edit-form"
                                >
                                    @csrf

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Headline
                                            </label>

                                            <input
                                                class="form-control"
                                                name="title"
                                                value="{{ $i->title }}"
                                                required
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Subtitle
                                            </label>

                                            <input
                                                class="form-control"
                                                name="subtitle"
                                                value="{{ $i->subtitle }}"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Primary Button
                                            </label>

                                            <input
                                                class="form-control"
                                                name="button_text"
                                                value="{{ $i->button_text }}"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Primary URL
                                            </label>

                                            <input
                                                class="form-control"
                                                name="button_url"
                                                value="{{ $i->button_url }}"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Second Button
                                            </label>

                                            <input
                                                class="form-control"
                                                name="secondary_button_text"
                                                value="{{ $i->secondary_button_text }}"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Second URL
                                            </label>

                                            <input
                                                class="form-control"
                                                name="secondary_button_url"
                                                value="{{ $i->secondary_button_url }}"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Replace Desktop Image
                                            </label>

                                            <input
                                                class="form-control"
                                                type="file"
                                                name="image"
                                                accept="image/jpeg,image/png,image/webp"
                                            >

                                        </div>

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Replace Mobile Image
                                            </label>

                                            <input
                                                class="form-control"
                                                type="file"
                                                name="mobile_image"
                                                accept="image/jpeg,image/png,image/webp"
                                            >

                                        </div>

                                        <div class="col-md-4">

                                            <label class="field-label">
                                                Display Order
                                            </label>

                                            <input
                                                class="form-control"
                                                type="number"
                                                name="sort_order"
                                                min="0"
                                                value="{{ $i->sort_order }}"
                                            >

                                        </div>

                                        <div class="col-md-4">

                                            <label class="field-label">
                                                Publication
                                            </label>

                                            <div class="switch-box">
                                                <div class="form-check form-switch mb-0">

                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="status"
                                                        value="1"
                                                        id="status{{ $i->id }}"
                                                        @checked($i->status)
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="status{{ $i->id }}"
                                                    >
                                                        Published
                                                    </label>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <button type="submit" class="btn-save mt-3">
                                        <i class="bi bi-check2 me-1"></i>
                                        Save Changes
                                    </button>

                                </form>

                            </details>


                            {{-- Actions --}}
                            <div class="banner-actions">

                                <span class="order-text">
                                    <i class="bi bi-layers me-1"></i>
                                    Display order: {{ $i->sort_order }}
                                </span>

                                <form
                                    method="POST"
                                    action="/admin/banners/{{ $i->id }}"
                                    class="delete-banner-form"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                    >
                                        <i class="bi bi-trash3"></i>
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-banners">

            <div class="empty-icon">
                <i class="bi bi-images"></i>
            </div>

            <h4>No hero banners yet</h4>

            <p>
                Add your first homepage banner using the form above.
            </p>

        </div>

    @endif


    {{-- Pagination --}}
    @if($items->hasPages())

        <div class="pagination-wrapper">
            {{ $items->links() }}
        </div>

    @endif

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-banner-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const confirmed = confirm(
                'Are you sure you want to delete this banner?\n\nThis action cannot be undone.'
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });

});
</script>

@endsection