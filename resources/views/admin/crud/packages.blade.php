@extends('layouts.admin')

@section('content')

<style>
    .packages-page {
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

    .page-hero::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 50%;
        right: -70px;
        top: -90px;
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
        max-width: 650px;
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

    .section-card {
        border: 1px solid var(--border);
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 30px rgba(15,23,42,.05);
    }

    .section-card-header {
        padding: 20px 22px 12px;
    }

    .section-title {
        font-size: 17px;
        font-weight: 750;
        color: var(--dark);
        margin: 0;
    }

    .section-subtitle {
        font-size: 13px;
        color: var(--muted);
        margin: 4px 0 0;
    }

    .add-form {
        padding: 0 22px 22px;
    }

    .form-label-custom {
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border-radius: 11px;
        border-color: #dfe3e8;
        font-size: 14px;
        box-shadow: none !important;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
    }

    .btn-gold {
        background: var(--gold);
        border-color: var(--gold);
        color: #fff;
        border-radius: 11px;
        padding: 10px 18px;
        font-weight: 700;
        font-size: 13px;
    }

    .btn-gold:hover {
        background: #ad8918;
        border-color: #ad8918;
        color: #fff;
        transform: translateY(-1px);
    }

    .package-card {
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        height: 100%;
        box-shadow: 0 8px 28px rgba(15,23,42,.05);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .package-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 38px rgba(15,23,42,.10);
    }

    .package-image-wrap {
        height: 205px;
        position: relative;
        background: linear-gradient(135deg, #e5e7eb, #f8fafc);
        overflow: hidden;
    }

    .package-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .package-card:hover .package-image {
        transform: scale(1.045);
    }

    .image-placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #9ca3af;
        gap: 7px;
    }

    .image-placeholder i {
        font-size: 32px;
    }

    .package-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.48), transparent 55%);
        pointer-events: none;
    }

    .status-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        backdrop-filter: blur(8px);
    }

    .status-live {
        color: #166534;
        background: rgba(220,252,231,.94);
    }

    .status-draft {
        color: #92400e;
        background: rgba(254,243,199,.94);
    }

    .package-body {
        padding: 20px;
    }

    .package-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .package-name {
        font-size: 19px;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
        line-height: 1.3;
    }

    .package-price {
        color: #9a7b19;
        font-weight: 800;
        white-space: nowrap;
        font-size: 14px;
    }

    .package-description {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.65;
        margin: 10px 0 15px;
        min-height: 42px;
    }

    .guest-range {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--soft);
        border: 1px solid #eef0f3;
        border-radius: 11px;
        padding: 10px 12px;
        color: #4b5563;
        font-size: 12px;
        margin-bottom: 16px;
    }

    .guest-range i {
        color: var(--gold);
        font-size: 15px;
    }

    .package-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-top: 14px;
        border-top: 1px solid #eef0f3;
    }

    .edit-toggle {
        border: 1px solid #dfe3e8;
        background: #fff;
        color: #374151;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .edit-toggle:hover {
        border-color: var(--gold);
        color: #8a6d12;
        background: #fffdf5;
    }

    .delete-btn {
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .edit-panel {
        border-top: 1px solid var(--border);
        background: #fafafa;
        padding: 20px;
    }

    .edit-panel-title {
        font-size: 13px;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 15px;
    }

    .current-image {
        width: 100%;
        height: 110px;
        object-fit: cover;
        border-radius: 11px;
        border: 1px solid #e5e7eb;
        margin-bottom: 8px;
    }

    .switch-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        padding: 10px 13px;
        min-height: 44px;
    }

    .switch-row .form-check {
        margin: 0;
    }

    .switch-row label {
        font-size: 13px;
        font-weight: 650;
        color: #374151;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        border: 1px dashed #d7dce2;
        border-radius: 18px;
        background: #fafafa;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #f3f4f6;
        color: #9ca3af;
        font-size: 25px;
        margin-bottom: 14px;
    }

    .pagination-wrap {
        margin-top: 24px;
    }

    @media (max-width: 767.98px) {
        .page-hero {
            padding: 24px 20px;
            border-radius: 17px;
        }

        .section-card-header,
        .add-form {
            padding-left: 17px;
            padding-right: 17px;
        }

        .package-body {
            padding: 17px;
        }

        .package-title-row {
            flex-direction: column;
            gap: 5px;
        }

        .package-price {
            white-space: normal;
        }

        .package-image-wrap {
            height: 185px;
        }
    }
</style>

<div class="packages-page">

    {{-- Header --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <div class="page-kicker">
                <i class="bi bi-box-seam me-1"></i> Menu Management
            </div>

            <h1>Packages</h1>

            <p>
                Create and manage catering packages, pricing, guest limits,
                descriptions and front-end images.
            </p>

            <div class="hero-count">
                <i class="bi bi-layers"></i>
                <span>{{ $items->total() }} Packages</span>
            </div>
        </div>
    </div>


    {{-- Add Package --}}
    <div class="section-card mb-4">

        <div class="section-card-header">
            <div class="d-flex align-items-center gap-2">
                <div class="text-warning">
                    <i class="bi bi-plus-circle fs-5"></i>
                </div>

                <div>
                    <h5 class="section-title">Add New Package</h5>
                    <p class="section-subtitle">
                        Add a new catering package to your website.
                    </p>
                </div>
            </div>
        </div>

        <form method="post"
              enctype="multipart/form-data"
              class="add-form">

            @csrf

            <div class="row g-3">

                <div class="col-lg-4 col-md-6">
                    <label class="form-label-custom">Package Name</label>
                    <input
                        class="form-control"
                        name="name"
                        placeholder="e.g. Premium Wedding Package"
                        required
                    >
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label-custom">Price / Person</label>
                    <input
                        class="form-control"
                        name="price_per_person"
                        type="number"
                        min="0"
                        step="0.01"
                        placeholder="₹ 0"
                    >
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label-custom">Minimum Guests</label>
                    <input
                        class="form-control"
                        name="min_guests"
                        type="number"
                        min="1"
                        placeholder="50"
                    >
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label-custom">Maximum Guests</label>
                    <input
                        class="form-control"
                        name="max_guests"
                        type="number"
                        min="1"
                        placeholder="500"
                    >
                </div>

                <div class="col-lg-2 col-md-6">
                    <label class="form-label-custom">Package Image</label>
                    <input
                        class="form-control"
                        type="file"
                        name="image"
                        accept="image/*"
                    >
                </div>

                <div class="col-12">
                    <label class="form-label-custom">Description</label>
                    <textarea
                        class="form-control"
                        name="description"
                        placeholder="Describe what's included in this package..."
                    ></textarea>
                </div>

                <div class="col-12">
                    <button class="btn btn-gold">
                        <i class="bi bi-plus-lg me-1"></i>
                        Add Package
                    </button>
                </div>

            </div>
        </form>
    </div>


    {{-- Package List --}}
    @if($items->count())

        <div class="row g-4">

            @foreach($items as $i)

                <div class="col-xl-6">

                    <div class="package-card">

                        {{-- Image --}}
                        <div class="package-image-wrap">

                            @if($i->image)

                                <img
                                    src="{{ asset('storage/'.$i->image) }}"
                                    class="package-image"
                                    alt="{{ $i->name }}"
                                    loading="lazy"
                                >

                                <div class="package-overlay"></div>

                            @else

                                <div class="image-placeholder">
                                    <i class="bi bi-image"></i>
                                    <span class="small">No image uploaded</span>
                                </div>

                            @endif

                            @if($i->status)
                                <span class="status-badge status-live">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Published
                                </span>
                            @else
                                <span class="status-badge status-draft">
                                    <i class="bi bi-eye-slash me-1"></i>
                                    Draft
                                </span>
                            @endif

                        </div>


                        {{-- Body --}}
                        <div class="package-body">

                            <div class="package-title-row">

                                <div>
                                    <h3 class="package-name">
                                        {{ $i->name }}
                                    </h3>
                                </div>

                                <div class="package-price">
                                    ₹{{ number_format((float) $i->price_per_person, 2) }}
                                    <span class="text-muted fw-normal">/ person</span>
                                </div>

                            </div>


                            @if($i->description)

                                <div class="package-description">
                                    {{ $i->description }}
                                </div>

                            @else

                                <div class="package-description text-muted">
                                    No package description added yet.
                                </div>

                            @endif


                            <div class="guest-range">
                                <i class="bi bi-people"></i>

                                <span>
                                    Guest capacity:
                                    <strong>
                                        {{ $i->min_guests ?: '—' }}
                                    </strong>
                                    -
                                    <strong>
                                        {{ $i->max_guests ?: '—' }}
                                    </strong>
                                    guests
                                </span>
                            </div>


                            <div class="package-actions">

                                <button
                                    type="button"
                                    class="edit-toggle"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#editPackage{{ $i->id }}"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Edit Package
                                </button>

                                <form
                                    method="post"
                                    action="/admin/packages/{{ $i->id }}"
                                    class="delete-package-form"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger delete-btn"
                                    >
                                        <i class="bi bi-trash3 me-1"></i>
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>


                        {{-- Edit Panel --}}
                        <div
                            class="collapse"
                            id="editPackage{{ $i->id }}"
                        >

                            <div class="edit-panel">

                                <div class="edit-panel-title">
                                    <i class="bi bi-sliders me-1"></i>
                                    Edit Package Details
                                </div>

                                <form
                                    method="post"
                                    enctype="multipart/form-data"
                                    action="/admin/packages/{{ $i->id }}"
                                >

                                    @csrf

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <label class="form-label-custom">
                                                Package Name
                                            </label>

                                            <input
                                                class="form-control"
                                                name="name"
                                                value="{{ $i->name }}"
                                                required
                                            >

                                        </div>


                                        <div class="col-md-6">

                                            <label class="form-label-custom">
                                                Price / Person
                                            </label>

                                            <input
                                                class="form-control"
                                                name="price_per_person"
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                value="{{ $i->price_per_person }}"
                                            >

                                        </div>


                                        <div class="col-md-6">

                                            <label class="form-label-custom">
                                                Minimum Guests
                                            </label>

                                            <input
                                                class="form-control"
                                                name="min_guests"
                                                type="number"
                                                min="1"
                                                value="{{ $i->min_guests }}"
                                            >

                                        </div>


                                        <div class="col-md-6">

                                            <label class="form-label-custom">
                                                Maximum Guests
                                            </label>

                                            <input
                                                class="form-control"
                                                name="max_guests"
                                                type="number"
                                                min="1"
                                                value="{{ $i->max_guests }}"
                                            >

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Replace Package Image
                                            </label>

                                            @if($i->image)

                                                <img
                                                    src="{{ asset('storage/'.$i->image) }}"
                                                    class="current-image"
                                                    alt="{{ $i->name }}"
                                                >

                                            @endif

                                            <input
                                                class="form-control"
                                                type="file"
                                                name="image"
                                                accept="image/*"
                                            >

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Description
                                            </label>

                                            <textarea
                                                class="form-control"
                                                name="description"
                                            >{{ $i->description }}</textarea>

                                        </div>


                                        <div class="col-12">

                                            <div class="switch-row">

                                                <label for="status{{ $i->id }}">
                                                    <i class="bi bi-globe2 me-1"></i>
                                                    Publish this package
                                                </label>

                                                <div class="form-check form-switch">

                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="status{{ $i->id }}"
                                                        name="status"
                                                        value="1"
                                                        @checked($i->status)
                                                    >

                                                </div>

                                            </div>

                                        </div>


                                        <div class="col-12">

                                            <button
                                                type="submit"
                                                class="btn btn-dark btn-sm px-3"
                                            >
                                                <i class="bi bi-check2-circle me-1"></i>
                                                Save Changes
                                            </button>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="pagination-wrap">
            {{ $items->links() }}
        </div>

    @else

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <h5 class="fw-bold mb-1">
                No packages found
            </h5>

            <p class="text-muted small mb-0">
                Create your first catering package using the form above.
            </p>

        </div>

    @endif

</div>


{{-- Delete Confirmation --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-package-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            const confirmed = window.confirm(
                'Are you sure you want to delete this package? This action cannot be undone.'
            );

            if (confirmed) {
                form.submit();
            }

        });

    });

});
</script>

@endsection