@extends('layouts.admin')

@section('content')

<style>
    .foods-page {
        padding-bottom: 40px;
    }

    .foods-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .foods-eyebrow {
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

    .foods-eyebrow::before {
        content: "";
        width: 25px;
        height: 2px;
        background: #c2943e;
        border-radius: 5px;
    }

    .foods-header h1 {
        margin: 0;
        color: #181818;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .foods-header p {
        margin: 7px 0 0;
        color: #888;
        font-size: 14px;
    }

    .food-count {
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

    .food-count i {
        color: #a97927;
    }

    /* Common */
    .cms-card,
    .food-card {
        background: #fff;
        border: 1px solid #ebe8e2;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.04);
    }

    /* Add Food */
    .add-food-card {
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

    .form-control,
    .form-select {
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

    .form-control:focus,
    .form-select:focus {
        border-color: #c2943e;
        box-shadow: 0 0 0 3px rgba(194,148,62,.08) !important;
    }

    .form-text {
        color: #999;
        font-size: 10px;
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

    /* Food Card */
    .food-card {
        height: 100%;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .food-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 45px rgba(0,0,0,.08);
    }

    .food-top {
        display: flex;
        gap: 16px;
        padding: 20px;
    }

    .food-image {
        position: relative;
        width: 120px;
        height: 115px;
        flex: 0 0 120px;
        overflow: hidden;
        border-radius: 15px;
        background: #f3f0eb;
    }

    .food-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .food-card:hover .food-image img {
        transform: scale(1.07);
    }

    .food-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background:
            radial-gradient(circle at 30% 20%, #fff, transparent 45%),
            #f2eee6;
        color: #b08338;
        font-size: 28px;
    }

    .food-info {
        flex: 1;
        min-width: 0;
    }

    .food-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .food-name {
        margin: 0;
        color: #222;
        font-size: 17px;
        font-weight: 800;
        line-height: 1.3;
    }

    .status-pill {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 30px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .status-pill::before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-published {
        color: #28764d;
        background: #e7f6ed;
    }

    .status-hidden {
        color: #777;
        background: #f1f1f1;
    }

    .food-category {
        margin-top: 6px;
        color: #8a8a8a;
        font-size: 11px;
    }

    .food-category i {
        color: #b18339;
    }

    .food-description {
        margin: 8px 0 10px;
        color: #888;
        font-size: 11px;
        line-height: 1.55;
    }

    .food-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .food-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 7px;
        background: #faf8f4;
        color: #777;
        font-size: 9px;
        font-weight: 700;
    }

    .food-chip i {
        color: #a97927;
    }

    .food-chip.veg {
        color: #27794b;
        background: #edf8f1;
    }

    .food-chip.veg i {
        color: #2d8b57;
    }

    .food-chip.nonveg {
        color: #a44747;
        background: #fceded;
    }

    .food-chip.nonveg i {
        color: #b44c4c;
    }

    .food-chip.jain {
        color: #806124;
        background: #faf3dd;
    }

    /* Body */
    .food-body {
        padding: 0 20px 20px;
    }

    .edit-details {
        border-top: 1px solid #eeeae4;
        padding-top: 15px;
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
        padding-top: 18px;
    }

    .edit-form .form-control,
    .edit-form .form-select {
        min-height: 42px;
        font-size: 12px;
    }

    .edit-form textarea.form-control {
        min-height: 90px;
    }

    .edit-form .field-label {
        font-size: 10px;
    }

    .switch-box {
        min-height: 42px;
        display: flex;
        align-items: center;
        padding: 0 11px;
        border: 1px solid #e2dfd9;
        border-radius: 10px;
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
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save {
        min-height: 39px;
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

    /* Actions */
    .food-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 17px;
        padding-top: 15px;
        border-top: 1px solid #eeeae4;
    }

    .sort-info {
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
    .empty-foods {
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

    .empty-foods h4 {
        margin: 0 0 6px;
        color: #333;
        font-size: 17px;
        font-weight: 800;
    }

    .empty-foods p {
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

        .foods-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .food-count {
            width: 100%;
            justify-content: center;
        }

        .cms-body {
            padding: 19px;
        }

        .food-top {
            padding: 17px;
            gap: 12px;
        }

        .food-image {
            width: 95px;
            height: 90px;
            flex-basis: 95px;
        }

        .food-title-row {
            flex-direction: column;
            gap: 7px;
        }

        .food-body {
            padding: 0 17px 17px;
        }
    }
</style>


<div class="foods-page">

    {{-- Page Header --}}
    <div class="foods-header">

        <div>
            <div class="foods-eyebrow">
                Menu Management
            </div>

            <h1>Foods / Menu</h1>

            <p>
                Manage dishes, categories, dietary preferences, pricing and menu photos.
            </p>
        </div>

        <div class="food-count">
            <i class="bi bi-egg-fried"></i>
            {{ $items->total() }} {{ $items->total() == 1 ? 'Dish' : 'Dishes' }}
        </div>

    </div>


    {{-- Add Food --}}
    <div class="cms-card add-food-card">

        <div class="cms-header">

            <div class="cms-icon">
                <i class="bi bi-plus-lg"></i>
            </div>

            <div>
                <h3>Add New Food</h3>
                <p>Add a dish to your catering menu</p>
            </div>

        </div>

        <div class="cms-body">

            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <div class="col-lg-4">

                        <label class="field-label">
                            Food Name <span class="required">*</span>
                        </label>

                        <input
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Paneer Tikka"
                            required
                        >

                    </div>

                    <div class="col-lg-3">

                        <label class="field-label">
                            Category <span class="required">*</span>
                        </label>

                        <select
                            class="form-select"
                            name="category_id"
                            required
                        >

                            <option value="">Select category</option>

                            @foreach($categories as $c)

                                <option
                                    value="{{ $c->id }}"
                                    @selected(old('category_id') == $c->id)
                                >
                                    {{ $c->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="field-label">
                            Diet Type
                        </label>

                        <select class="form-select" name="diet_type">

                            <option value="veg" @selected(old('diet_type', 'veg') === 'veg')>
                                Veg
                            </option>

                            <option value="non_veg" @selected(old('diet_type') === 'non_veg')>
                                Non-Veg
                            </option>

                            <option value="mixed" @selected(old('diet_type') === 'mixed')>
                                Mixed
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="field-label">
                            Price
                        </label>

                        <input
                            class="form-control"
                            name="price"
                            value="{{ old('price') }}"
                            placeholder="₹299"
                        >

                    </div>

                    <div class="col-lg-1">

                        <label class="field-label">
                            Jain
                        </label>

                        <div class="switch-box justify-content-center">

                            <div class="form-check form-switch mb-0">

                                <input
                                    type="checkbox"
                                    name="is_jain"
                                    value="1"
                                    class="form-check-input"
                                    id="newFoodJain"
                                    @checked(old('is_jain'))
                                >

                                <label
                                    class="form-check-label visually-hidden"
                                    for="newFoodJain"
                                >
                                    Jain
                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="col-12">

                        <label class="field-label">
                            Description
                        </label>

                        <textarea
                            class="form-control"
                            name="description"
                            rows="3"
                            placeholder="Describe the dish, ingredients or serving style..."
                        >{{ old('description') }}</textarea>

                    </div>

                    <div class="col-lg-5">

                        <label class="field-label">
                            Food Image
                        </label>

                        <input
                            class="form-control"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <div class="form-text">
                            JPG, PNG or WebP recommended.
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn-add mt-4">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Food
                </button>

            </form>

        </div>

    </div>


    {{-- Food List --}}
    @if($items->count())

        <div class="row g-4">

            @foreach($items as $i)

                <div class="col-lg-6">

                    <div class="food-card">

                        {{-- Food Header --}}
                        <div class="food-top">

                            <div class="food-image">

                                @if($i->image)

                                    <img
                                        src="{{ asset('storage/' . $i->image) }}"
                                        alt="{{ $i->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="food-placeholder">
                                        <i class="bi bi-egg-fried"></i>
                                    </div>

                                @endif

                            </div>


                            <div class="food-info">

                                <div class="food-title-row">

                                    <h3 class="food-name">
                                        {{ $i->name }}
                                    </h3>

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


                                <div class="food-category">
                                    <i class="bi bi-collection me-1"></i>
                                    {{ $i->category->name ?? 'Uncategorized' }}
                                </div>


                                @if($i->description)

                                    <p class="food-description">
                                        {{ \Illuminate\Support\Str::limit($i->description, 90) }}
                                    </p>

                                @endif


                                <div class="food-meta">

                                    @if($i->diet_type === 'veg')

                                        <span class="food-chip veg">
                                            <i class="bi bi-circle-fill"></i>
                                            Veg
                                        </span>

                                    @elseif($i->diet_type === 'non_veg')

                                        <span class="food-chip nonveg">
                                            <i class="bi bi-circle-fill"></i>
                                            Non-Veg
                                        </span>

                                    @else

                                        <span class="food-chip">
                                            <i class="bi bi-circle-half"></i>
                                            Mixed
                                        </span>

                                    @endif


                                    @if($i->is_jain)

                                        <span class="food-chip jain">
                                            <i class="bi bi-flower1"></i>
                                            Jain
                                        </span>

                                    @endif


                                    @if($i->price !== null && $i->price !== '')

                                        <span class="food-chip">
                                            <i class="bi bi-tag"></i>
                                            {{ $i->price }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Food Body --}}
                        <div class="food-body">

                            <details class="edit-details">

                                <summary>
                                    <span>
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Edit Food / Replace Image
                                    </span>
                                </summary>


                                <form
                                    method="POST"
                                    enctype="multipart/form-data"
                                    action="/admin/foods/{{ $i->id }}"
                                    class="edit-form"
                                >
                                    @csrf

                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Food Name
                                            </label>

                                            <input
                                                class="form-control"
                                                name="name"
                                                value="{{ $i->name }}"
                                                required
                                            >

                                        </div>


                                        <div class="col-md-6">

                                            <label class="field-label">
                                                Category
                                            </label>

                                            <select
                                                class="form-select"
                                                name="category_id"
                                                required
                                            >

                                                @foreach($categories as $c)

                                                    <option
                                                        value="{{ $c->id }}"
                                                        @selected($i->category_id == $c->id)
                                                    >
                                                        {{ $c->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        <div class="col-md-4">

                                            <label class="field-label">
                                                Diet Type
                                            </label>

                                            <select
                                                class="form-select"
                                                name="diet_type"
                                            >

                                                <option
                                                    value="veg"
                                                    @selected($i->diet_type === 'veg')
                                                >
                                                    Veg
                                                </option>

                                                <option
                                                    value="non_veg"
                                                    @selected($i->diet_type === 'non_veg')
                                                >
                                                    Non-Veg
                                                </option>

                                                <option
                                                    value="mixed"
                                                    @selected($i->diet_type === 'mixed')
                                                >
                                                    Mixed
                                                </option>

                                            </select>

                                        </div>


                                        <div class="col-md-4">

                                            <label class="field-label">
                                                Price
                                            </label>

                                            <input
                                                class="form-control"
                                                name="price"
                                                value="{{ $i->price }}"
                                            >

                                        </div>


                                        <div class="col-md-4">

                                            <label class="field-label">
                                                Replace Image
                                            </label>

                                            <input
                                                class="form-control"
                                                type="file"
                                                name="image"
                                                accept="image/jpeg,image/png,image/webp"
                                            >

                                        </div>


                                        <div class="col-12">

                                            <label class="field-label">
                                                Description
                                            </label>

                                            <textarea
                                                class="form-control"
                                                name="description"
                                                rows="3"
                                            >{{ $i->description }}</textarea>

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
                                                Dietary Tag
                                            </label>

                                            <div class="switch-box">

                                                <div class="form-check form-switch mb-0">

                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="is_jain"
                                                        value="1"
                                                        id="jain{{ $i->id }}"
                                                        @checked($i->is_jain)
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="jain{{ $i->id }}"
                                                    >
                                                        Jain
                                                    </label>

                                                </div>

                                            </div>

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
                                                        id="foodStatus{{ $i->id }}"
                                                        @checked($i->status)
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="foodStatus{{ $i->id }}"
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
                            <div class="food-actions">

                                <span class="sort-info">
                                    <i class="bi bi-layers me-1"></i>
                                    Display order: {{ $i->sort_order }}
                                </span>


                                <form
                                    method="POST"
                                    action="/admin/foods/{{ $i->id }}"
                                    class="delete-food-form"
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

        <div class="empty-foods">

            <div class="empty-icon">
                <i class="bi bi-egg-fried"></i>
            </div>

            <h4>No food items yet</h4>

            <p>
                Add your first dish using the form above.
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

    document.querySelectorAll('.delete-food-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const confirmed = confirm(
                'Are you sure you want to delete this food item?\n\nThis action cannot be undone.'
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });

});
</script>

@endsection