@extends('layouts.admin')

@section('content')

<style>
    .categories-page {
        padding-bottom: 40px;
    }

    .categories-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .categories-eyebrow {
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

    .categories-eyebrow::before {
        content: "";
        width: 25px;
        height: 2px;
        background: #c2943e;
        border-radius: 5px;
    }

    .categories-header h1 {
        margin: 0;
        color: #181818;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .categories-header p {
        margin: 7px 0 0;
        color: #888;
        font-size: 14px;
    }

    .category-count {
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

    .category-count i {
        color: #a97927;
    }

    /* Common Card */
    .cms-card {
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.04);
    }

    /* Add Category */
    .add-category-card {
        overflow: hidden;
        margin-bottom: 28px;
    }

    .cms-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 23px;
        border-bottom: 1px solid #eeeae4;
    }

    .cms-icon {
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

    .cms-header h3 {
        margin: 0;
        color: #242424;
        font-size: 16px;
        font-weight: 800;
    }

    .cms-header p {
        margin: 4px 0 0;
        color: #999;
        font-size: 11px;
    }

    .cms-body {
        padding: 25px;
    }

    .field-label {
        display: block;
        margin-bottom: 7px;
        color: #444;
        font-size: 12px;
        font-weight: 700;
    }

    .required {
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

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #c2943e;
        box-shadow: 0 0 0 3px rgba(194,148,62,.08) !important;
    }

    .btn-add {
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

    .btn-add:hover {
        background: #a97927;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Category List */
    .categories-card {
        overflow: hidden;
    }

    .list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 23px;
        border-bottom: 1px solid #eeeae4;
    }

    .list-title h3 {
        margin: 0;
        color: #242424;
        font-size: 16px;
        font-weight: 800;
    }

    .list-title p {
        margin: 4px 0 0;
        color: #999;
        font-size: 11px;
    }

    .category-list {
        padding: 7px 0;
    }

    .category-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 23px;
        border-bottom: 1px solid #f0eeea;
        transition: background .2s ease;
    }

    .category-row:last-child {
        border-bottom: 0;
    }

    .category-row:hover {
        background: #fcfaf6;
    }

    .category-main {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .category-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f8f2e7;
        color: #a97927;
        font-size: 17px;
    }

    .category-info {
        min-width: 0;
    }

    .category-name {
        color: #292929;
        font-size: 13px;
        font-weight: 800;
    }

    .category-description {
        max-width: 650px;
        margin-top: 3px;
        color: #999;
        font-size: 11px;
        line-height: 1.5;
    }

    .category-id {
        color: #aaa;
        font-size: 9px;
        margin-top: 3px;
    }

    .category-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 0 0 auto;
    }

    .delete-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 35px;
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
    .empty-categories {
        padding: 70px 20px;
        text-align: center;
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

    .empty-categories h4 {
        margin: 0 0 6px;
        color: #333;
        font-size: 17px;
        font-weight: 800;
    }

    .empty-categories p {
        margin: 0;
        color: #999;
        font-size: 12px;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 18px 23px;
        border-top: 1px solid #eeeae4;
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

        .categories-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .category-count {
            width: 100%;
            justify-content: center;
        }

        .cms-body {
            padding: 19px;
        }

        .category-row {
            align-items: flex-start;
            padding: 15px 17px;
        }

        .category-main {
            align-items: flex-start;
        }

        .category-actions {
            margin-top: 3px;
        }

        .delete-btn span {
            display: none;
        }

        .list-header {
            padding: 18px;
        }

        .pagination-wrapper {
            padding: 17px;
        }
    }
</style>


<div class="categories-page">

    {{-- Header --}}
    <div class="categories-header">

        <div>
            <div class="categories-eyebrow">
                Menu Management
            </div>

            <h1>Food Categories</h1>

            <p>
                Organise your menu into clear food categories for easier browsing and management.
            </p>
        </div>

        <div class="category-count">
            <i class="bi bi-collection"></i>
            {{ $items->total() }}
            {{ $items->total() == 1 ? 'Category' : 'Categories' }}
        </div>

    </div>


    {{-- Add Category --}}
    <div class="cms-card add-category-card">

        <div class="cms-header">

            <div class="cms-icon">
                <i class="bi bi-plus-lg"></i>
            </div>

            <div>
                <h3>Add New Category</h3>
                <p>Create a category for organising your food menu</p>
            </div>

        </div>

        <div class="cms-body">

            <form method="POST">
                @csrf

                <div class="row g-4">

                    <div class="col-lg-5">

                        <label class="field-label">
                            Category Name <span class="required">*</span>
                        </label>

                        <input
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Starters, Main Course, Desserts..."
                            required
                        >

                    </div>

                    <div class="col-lg-7">

                        <label class="field-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            name="description"
                            rows="2"
                            placeholder="Briefly describe this food category..."
                        >{{ old('description') }}</textarea>

                    </div>

                </div>

                <button type="submit" class="btn-add mt-4">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Category
                </button>

            </form>

        </div>

    </div>


    {{-- Category List --}}
    <div class="cms-card categories-card">

        <div class="list-header">

            <div class="list-title">

                <h3>Category Directory</h3>

                <p>
                    Manage categories used across your food menu.
                </p>

            </div>

        </div>


        @if($items->count())

            <div class="category-list">

                @foreach($items as $i)

                    <div class="category-row">

                        <div class="category-main">

                            <div class="category-icon">
                                <i class="bi bi-collection"></i>
                            </div>

                            <div class="category-info">

                                <div class="category-name">
                                    {{ $i->name }}
                                </div>

                                @if($i->description)

                                    <div class="category-description">
                                        {{ $i->description }}
                                    </div>

                                @else

                                    <div class="category-description">
                                        No description added.
                                    </div>

                                @endif

                                <div class="category-id">
                                    Category #{{ $i->id }}
                                </div>

                            </div>

                        </div>


                        <div class="category-actions">

                            <form
                                method="POST"
                                action="/admin/categories/{{ $i->id }}"
                                class="delete-category-form"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-btn"
                                >
                                    <i class="bi bi-trash3"></i>
                                    <span>Delete</span>
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if($items->hasPages())

                <div class="pagination-wrapper">
                    {{ $items->links() }}
                </div>

            @endif

        @else

            <div class="empty-categories">

                <div class="empty-icon">
                    <i class="bi bi-collection"></i>
                </div>

                <h4>No categories yet</h4>

                <p>
                    Add your first food category using the form above.
                </p>

            </div>

        @endif

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-category-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const confirmed = confirm(
                'Are you sure you want to delete this category?\n\nMake sure no food items depend on this category.'
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });

});
</script>

@endsection