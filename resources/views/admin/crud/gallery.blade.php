@extends('layouts.admin')

@section('content')

<style>
    .gallery-page {
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
        right: -110px;
        top: -130px;
    }

    .page-hero::after {
        width: 150px;
        height: 150px;
        right: 80px;
        bottom: -110px;
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
        max-width: 680px;
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

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .btn-gold {
        background: var(--gold);
        border-color: var(--gold);
        color: #fff;
        border-radius: 11px;
        padding: 10px 18px;
        font-weight: 700;
        font-size: 13px;
        transition: .2s ease;
    }

    .btn-gold:hover {
        background: #ad8918;
        border-color: #ad8918;
        color: #fff;
        transform: translateY(-1px);
    }

    .media-card {
        border: 1px solid var(--border);
        border-radius: 20px;
        background: #fff;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 8px 28px rgba(15,23,42,.05);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .media-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 38px rgba(15,23,42,.10);
    }

    .media-preview {
        height: 220px;
        background: #111827;
        position: relative;
        overflow: hidden;
    }

    .media-preview img,
    .media-preview video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .media-preview img {
        transition: transform .5s ease;
    }

    .media-card:hover .media-preview img {
        transform: scale(1.045);
    }

    .media-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,0,0,.58),
            rgba(0,0,0,.04) 65%
        );
        pointer-events: none;
    }

    .media-type {
        position: absolute;
        top: 13px;
        left: 13px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(17,24,39,.78);
        color: #fff;
        backdrop-filter: blur(8px);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .category-badge {
        position: absolute;
        bottom: 13px;
        left: 13px;
        z-index: 2;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,.92);
        color: #374151;
        font-size: 11px;
        font-weight: 700;
        max-width: calc(100% - 26px);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .no-media {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: #9ca3af;
    }

    .no-media i {
        font-size: 35px;
    }

    .media-body {
        padding: 18px;
    }

    .media-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--dark);
        line-height: 1.35;
        margin: 0;
    }

    .media-description {
        font-size: 12px;
        line-height: 1.6;
        color: var(--muted);
        margin: 8px 0 15px;
        min-height: 38px;
    }

    .media-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid #eef0f3;
    }

    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #6b7280;
        font-size: 11px;
    }

    .meta-item i {
        color: var(--gold);
    }

    .media-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 14px;
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
        padding: 18px;
    }

    .edit-panel-title {
        font-size: 13px;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 14px;
    }

    .current-media {
        border-radius: 11px;
        overflow: hidden;
        height: 130px;
        background: #111827;
        margin-bottom: 10px;
    }

    .current-media img,
    .current-media video {
        width: 100%;
        height: 100%;
        object-fit: cover;
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

        .media-body {
            padding: 16px;
        }

        .media-preview {
            height: 205px;
        }

        .media-actions {
            flex-wrap: wrap;
        }
    }
</style>


<div class="gallery-page">

    {{-- Header --}}
    <div class="page-hero">

        <div class="page-hero-content">

            <div class="page-kicker">
                <i class="bi bi-images me-1"></i>
                Media Management
            </div>

            <h1>Gallery</h1>

            <p>
                Upload and manage event photos and videos displayed across
                your catering website.
            </p>

            <div class="hero-count">
                <i class="bi bi-collection-play"></i>
                <span>{{ $items->total() }} Media Items</span>
            </div>

        </div>

    </div>


    {{-- Add Media --}}
    <div class="section-card mb-4">

        <div class="section-card-header">

            <div class="d-flex align-items-center gap-2">

                <div class="text-warning">
                    <i class="bi bi-cloud-arrow-up fs-5"></i>
                </div>

                <div>

                    <h5 class="section-title">
                        Upload New Media
                    </h5>

                    <p class="section-subtitle">
                        Add event photos or videos to your website gallery.
                    </p>

                </div>

            </div>

        </div>


        <form
            method="post"
            enctype="multipart/form-data"
            class="add-form"
            id="galleryUploadForm"
        >

            @csrf

            <div class="row g-3">

                <div class="col-lg-4 col-md-6">

                    <label class="form-label-custom">
                        Media Title
                    </label>

                    <input
                        class="form-control"
                        name="title"
                        placeholder="e.g. Royal Wedding Setup"
                        required
                    >

                </div>


                <div class="col-lg-3 col-md-6">

                    <label class="form-label-custom">
                        Category
                    </label>

                    <input
                        class="form-control"
                        name="category"
                        placeholder="Wedding / Corporate / Food"
                    >

                </div>


                <div class="col-lg-5">

                    <label class="form-label-custom">
                        Photo / Video
                    </label>

                    <input
                        class="form-control"
                        type="file"
                        name="file"
                        accept="image/*,video/*"
                        required
                    >

                    <div class="form-text small">
                        <i class="bi bi-info-circle me-1"></i>
                        Images and videos are supported.
                    </div>

                </div>


                <div class="col-12">

                    <label class="form-label-custom">
                        Description
                    </label>

                    <textarea
                        class="form-control"
                        name="description"
                        placeholder="Add a short description for this gallery item..."
                    ></textarea>

                </div>


                <div class="col-12">

                    <button
                        type="submit"
                        class="btn btn-gold"
                        id="uploadButton"
                    >
                        <i class="bi bi-cloud-arrow-up me-1"></i>
                        Upload Media
                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Gallery Items --}}
    @if($items->count())

        <div class="row g-4">

            @foreach($items as $i)

                <div class="col-md-6 col-xl-4">

                    <div class="media-card">

                        {{-- Media Preview --}}
                        <div class="media-preview">

                            @if($i->type === 'image' && $i->file_path)

                                <img
                                    src="{{ asset('storage/'.$i->file_path) }}"
                                    alt="{{ $i->title }}"
                                    loading="lazy"
                                >

                                <div class="media-overlay"></div>

                            @elseif($i->file_path)

                                <video
                                    src="{{ asset('storage/'.$i->file_path) }}"
                                    controls
                                    preload="metadata"
                                ></video>

                            @else

                                <div class="no-media">
                                    <i class="bi bi-image"></i>
                                    <span class="small">
                                        No media available
                                    </span>
                                </div>

                            @endif


                            <span class="media-type">

                                @if($i->type === 'image')

                                    <i class="bi bi-image"></i>
                                    Photo

                                @else

                                    <i class="bi bi-play-circle"></i>
                                    Video

                                @endif

                            </span>


                            @if($i->category)

                                <span class="category-badge">
                                    <i class="bi bi-tag me-1"></i>
                                    {{ $i->category }}
                                </span>

                            @endif

                        </div>


                        {{-- Media Details --}}
                        <div class="media-body">

                            <h3 class="media-title">
                                {{ $i->title }}
                            </h3>


                            @if($i->description)

                                <div class="media-description">
                                    {{ $i->description }}
                                </div>

                            @else

                                <div class="media-description">
                                    No description added for this media item.
                                </div>

                            @endif


                            <div class="media-meta">

                                <span class="meta-item">

                                    @if($i->type === 'image')
                                        <i class="bi bi-image"></i>
                                        Image
                                    @else
                                        <i class="bi bi-camera-video"></i>
                                        Video
                                    @endif

                                </span>


                                <span class="meta-item">
                                    <i class="bi bi-hash"></i>
                                    ID {{ $i->id }}
                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="media-actions">

                                <button
                                    type="button"
                                    class="edit-toggle"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#editMedia{{ $i->id }}"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Edit Media
                                </button>


                                <form
                                    method="post"
                                    action="/admin/gallery/{{ $i->id }}"
                                    class="delete-gallery-form"
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
                            id="editMedia{{ $i->id }}"
                        >

                            <div class="edit-panel">

                                <div class="edit-panel-title">
                                    <i class="bi bi-sliders me-1"></i>
                                    Edit / Replace Media
                                </div>


                                <form
                                    method="post"
                                    enctype="multipart/form-data"
                                    action="/admin/gallery/{{ $i->id }}"
                                >

                                    @csrf

                                    <div class="row g-3">

                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Current Media
                                            </label>

                                            @if($i->file_path)

                                                <div class="current-media">

                                                    @if($i->type === 'image')

                                                        <img
                                                            src="{{ asset('storage/'.$i->file_path) }}"
                                                            alt="{{ $i->title }}"
                                                        >

                                                    @else

                                                        <video
                                                            src="{{ asset('storage/'.$i->file_path) }}"
                                                            controls
                                                            preload="metadata"
                                                        ></video>

                                                    @endif

                                                </div>

                                            @endif

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Title
                                            </label>

                                            <input
                                                class="form-control"
                                                name="title"
                                                value="{{ $i->title }}"
                                                required
                                            >

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Category
                                            </label>

                                            <input
                                                class="form-control"
                                                name="category"
                                                value="{{ $i->category }}"
                                                placeholder="Wedding / Corporate / Food"
                                            >

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Replace Media
                                            </label>

                                            <input
                                                class="form-control"
                                                type="file"
                                                name="file"
                                                accept="image/*,video/*"
                                            >

                                            <div class="form-text small">
                                                Leave empty to keep the current media.
                                            </div>

                                        </div>


                                        <div class="col-12">

                                            <label class="form-label-custom">
                                                Description
                                            </label>

                                            <textarea
                                                class="form-control"
                                                name="description"
                                                placeholder="Media description..."
                                            >{{ $i->description }}</textarea>

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


        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $items->links() }}
        </div>

    @else

        {{-- Empty State --}}
        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-images"></i>
            </div>

            <h5 class="fw-bold mb-1">
                Gallery is empty
            </h5>

            <p class="text-muted small mb-0">
                Upload your first event photo or video using the form above.
            </p>

        </div>

    @endif

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
     * Delete confirmation
     */
    document.querySelectorAll('.delete-gallery-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            const confirmed = window.confirm(
                'Are you sure you want to delete this gallery item? This action cannot be undone.'
            );

            if (confirmed) {
                form.submit();
            }

        });

    });


    /*
     * Upload loading state
     */
    const uploadForm = document.getElementById('galleryUploadForm');
    const uploadButton = document.getElementById('uploadButton');

    if (uploadForm && uploadButton) {

        uploadForm.addEventListener('submit', function () {

            uploadButton.disabled = true;

            uploadButton.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span> Uploading...';

        });

    }

});
</script>

@endsection