<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin-last-page" content="{{ request()->cookie('admin_last_page', route('admin.dashboard')) }}">
    <title>{{ $pageTitle ?? 'Admin' }} · {{ \App\Models\WebsiteSetting::get('business_name', 'Catering Pro') }}</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
    :root {
        --admin-bg: #f6f4f1;
        --admin-surface: #fff;
        --admin-dark: #211813;
        --admin-dark-2: #2e211b;
        --admin-brand: #8b4b2a;
        --admin-brand-soft: #f3e4d8;
        --admin-text: #2b211c;
        --admin-muted: #786c63;
        --admin-line: #e9e0d9;
        --admin-shadow: 0 12px 35px rgba(50, 30, 18, .07)
    }

    * {
        box-sizing: border-box
    }

    body {
        margin: 0;
        background: var(--admin-bg);
        color: var(--admin-text);
        font-family: Inter, system-ui, -apple-system, "Segoe UI", sans-serif
    }

    .admin-shell {
        min-height: 100vh
    }

    .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        width: 260px;
        background: linear-gradient(180deg, var(--admin-dark), #19110d);
        color: #fff;
        z-index: 1040;
        overflow-y: auto;
        padding: 18px 14px
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 11px;
        color: #fff;
        text-decoration: none;
        padding: 8px 10px 20px
    }

    .brand-mark {
        width: 40px;
        height: 40px;
        border-radius: 13px;
        background: linear-gradient(135deg, #d08a5a, #7a3b21);
        display: grid;
        place-items: center;
        box-shadow: 0 8px 20px #0004
    }

    .brand small {
        display: block;
        color: #aa9d94;
        font-size: .7rem;
        font-weight: 500;
        margin-top: 1px
    }

    .nav-label {
        color: #877a71;
        font-size: .68rem;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        padding: 18px 11px 7px
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 11px;
        color: #d8cec7;
        text-decoration: none;
        padding: 10px 11px;
        margin: 3px 0;
        border-radius: 11px;
        font-size: .91rem;
        transition: .18s
    }

    .sidebar-nav a i {
        width: 19px;
        text-align: center;
        font-size: 1rem
    }

    .sidebar-nav a:hover {
        background: #ffffff0d;
        color: #fff
    }

    .sidebar-nav a.active {
        background: linear-gradient(90deg, #9b5734, #754025);
        color: #fff;
        box-shadow: 0 7px 18px #0002
    }

    .sidebar-footer {
        margin-top: 20px;
        padding: 14px 8px;
        border-top: 1px solid #ffffff12
    }

    .main {
        margin-left: 260px;
        min-height: 100vh
    }

    .content {
        padding: 24px 30px 42px
    }

    .topbar {
        position: sticky;
        top: 12px;
        z-index: 100;
        background: rgba(255, 255, 255, .92);
        backdrop-filter: blur(15px);
        border: 1px solid var(--admin-line);
        border-radius: 17px;
        padding: 11px 13px 11px 17px;
        margin-bottom: 24px;
        box-shadow: 0 8px 25px #00000008
    }

    .topbar-title {
        font-weight: 750;
        font-size: .94rem
    }

    .topbar-subtitle {
        font-size: .76rem;
        color: var(--admin-muted)
    }

    .mobile-menu {
        display: none
    }

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 18px;
        margin-bottom: 22px
    }

    .page-heading h1 {
        font-size: 1.8rem;
        letter-spacing: -.035em;
        margin: 0
    }

    .page-heading p {
        color: var(--admin-muted);
        margin: .35rem 0 0
    }

    .card {
        border: 1px solid var(--admin-line);
        border-radius: 18px;
        box-shadow: var(--admin-shadow);
        background: var(--admin-surface)
    }

    .table-card {
        overflow: hidden
    }

    .table> :not(caption)>*>* {
        padding: .82rem .8rem;
        border-bottom-color: #eee7e2
    }

    .table thead th {
        background: #fbf9f7;
        color: #756960;
        font-size: .74rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 800
    }

    .table tbody tr:hover {
        background: #fffaf6
    }

    .btn {
        border-radius: 10px;
        font-weight: 650
    }

    .btn-brand {
        background: var(--admin-brand);
        border-color: var(--admin-brand);
        color: #fff
    }

    .btn-brand:hover {
        background: #713719;
        border-color: #713719;
        color: #fff
    }

    .btn-soft {
        background: var(--admin-brand-soft);
        border-color: transparent;
        color: #713719
    }

    .btn-soft:hover {
        background: #ead5c5;
        color: #5f2f19
    }

    .form-label {
        font-size: .82rem;
        font-weight: 700;
        color: #4a3b33;
        margin-bottom: 6px
    }

    .form-control,
    .form-select,
    .input-group-text {
        border-color: #ded4cc;
        border-radius: 10px;
        min-height: 42px;
        padding: .58rem .75rem
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #a46747;
        box-shadow: 0 0 0 .2rem #9d674820
    }

    .form-check-input:checked {
        background-color: var(--admin-brand);
        border-color: var(--admin-brand)
    }

    .required::after {
        content: ' *';
        color: #dc3545
    }

    .field-error {
        display: block;
        color: #dc3545;
        font-size: .78rem;
        margin-top: 5px
    }

    .is-invalid {
        border-color: #dc3545 !important
    }

    .upload-preview {
        max-width: 190px;
        max-height: 115px;
        object-fit: cover;
        border-radius: 11px;
        border: 1px solid var(--admin-line)
    }

    .stat-card {
        padding: 20px;
        min-height: 126px
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--admin-brand-soft);
        color: var(--admin-brand);
        display: grid;
        place-items: center
    }

    .stat-value {
        font-size: 1.65rem;
        font-weight: 800;
        letter-spacing: -.03em
    }

    .muted {
        color: var(--admin-muted)
    }

    .badge-soft {
        background: var(--admin-brand-soft);
        color: #713719
    }

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: var(--admin-muted)
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 12px;
        border-radius: 15px;
        background: #f3ece7;
        display: grid;
        place-items: center;
        color: #9b735d;
        font-size: 1.35rem
    }

    .media-thumb {
        width: 68px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        background: #eee
    }

    .swal2-popup {
        font-size: .86rem !important;
        border-radius: 14px !important
    }

    .swal2-title {
        font-size: 1.05rem !important
    }

    .pagination {
        margin-bottom: 0
    }

    .pagination .page-link {
        color: var(--admin-brand);
        border-color: var(--admin-line)
    }

    .pagination .active .page-link {
        background: var(--admin-brand);
        border-color: var(--admin-brand);
        color: #fff
    }

    .overlay-loading {
        position: fixed;
        inset: 0;
        background: #20140ecc;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000
    }

    .overlay-loading.show {
        display: flex
    }

    .loading-card {
        background: #fff;
        border-radius: 16px;
        padding: 18px 22px;
        box-shadow: 0 20px 60px #0004
    }

    .sidebar-close {
        display: none
    }

    @media(max-width:991px) {
        .sidebar {
            transform: translateX(-105%);
            transition: transform .22s ease;
            box-shadow: 18px 0 40px #0004
        }

        .sidebar.open {
            transform: translateX(0)
        }

        .main {
            margin-left: 0
        }

        .mobile-menu {
            display: inline-flex
        }

        .content {
            padding: 18px
        }

        .topbar {
            top: 8px
        }

        .sidebar-close {
            display: inline-flex;
            position: absolute;
            right: 12px;
            top: 12px
        }

        .page-heading {
            align-items: flex-start;
            flex-direction: column
        }
    }

    @media(max-width:575px) {
        .content {
            padding: 13px
        }

        .topbar {
            border-radius: 13px
        }

        .topbar-subtitle {
            display: none
        }

        .page-heading h1 {
            font-size: 1.45rem
        }

        .card {
            border-radius: 14px
        }

        .stat-card {
            min-height: 112px
        }

        .table-responsive {
            border-radius: 14px
        }
    }
    </style>
</head>

<body>
    <div class="admin-shell">
        <aside class="sidebar" id="adminSidebar">
            <button class="btn btn-sm btn-dark sidebar-close" type="button" data-sidebar-close
                aria-label="Close menu"><i class="bi bi-x-lg"></i></button>
            <a href="{{ route('admin.dashboard') }}" class="brand">
                <span class="brand-mark"><i class="bi bi-stars"></i></span>
                <span><strong>{{ \App\Models\WebsiteSetting::get('business_name', 'Catering Pro') }}</strong><small>Content
                        Management</small></span>
            </a>
            <nav class="sidebar-nav">
                @php($current = request()->route()?->getName())
                <div class="nav-label">Overview</div>
                @foreach([
                ['admin.dashboard','speedometer2','Dashboard'],['admin.bookings','calendar-check','Bookings'],['admin.calendar','calendar3','Calendar'],['admin.tastings','cup-hot','Food
                Tastings'],['admin.enquiries','chat-left-text','Enquiries'],['admin.customers','people','Customers']
                ] as [$route,$icon,$label])
                <a class="{{ $current === $route ? 'active' : '' }}" href="{{ route($route) }}"><i
                        class="bi bi-{{ $icon }}"></i>{{ $label }}</a>
                @endforeach
                <div class="nav-label">Website Content</div>
                @foreach([
                ['admin.banners','images','Hero
                Banners'],['admin.services','stars','Services'],['admin.categories','tags','Food
                Categories'],['admin.foods','egg-fried','Foods /
                Menu'],['admin.packages','box-seam','Packages'],['admin.gallery','camera','Gallery'],['admin.videos','play-btn','Videos'],['admin.testimonials','chat-quote','Testimonials'],['admin.settings','sliders','Website
                Settings']
                ] as [$route,$icon,$label])
                <a class="{{ $current === $route ? 'active' : '' }}" href="{{ route($route) }}"><i
                        class="bi bi-{{ $icon }}"></i>{{ $label }}</a>
                @endforeach
            </nav>
            <div class="sidebar-footer">
                <a class="sidebar-nav d-flex align-items-center gap-2 text-decoration-none text-white-50 px-2 py-2"
                    href="{{ route('home') }}"><i class="bi bi-box-arrow-up-right"></i> View Website</a>
                <form method="post" action="{{ route('admin.logout') }}" data-no-ajax>
                    @csrf
                    <button class="btn btn-link text-white-50 p-2 text-decoration-none w-100 text-start"
                        type="submit"><i class="bi bi-box-arrow-left me-2"></i>Logout</button>
                </form>
            </div>
        </aside>

        <main class="main">
            <div class="content">
                <div class="topbar d-flex justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-light mobile-menu" type="button" data-sidebar-open><i
                                class="bi bi-list fs-5"></i></button>
                        <div>
                            <div class="topbar-title">Website Management</div>
                            <div class="topbar-subtitle">Manage your website content without touching the code.</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-back-button><i
                                class="bi bi-arrow-left me-1"></i>Back</button>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-brand"><i
                                class="bi bi-eye me-1"></i>Website</a>
                    </div>
                </div>

                @if(session('success'))<div class="alert alert-success shadow-sm border-0">{{ session('success') }}
                </div>@endif
                @if(session('error'))<div class="alert alert-danger shadow-sm border-0">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger shadow-sm border-0"><strong>Please fix the highlighted fields.</strong>
                    <ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <div class="overlay-loading" id="pageLoader">
        <div class="loading-card"><span class="spinner-border spinner-border-sm me-2 text-secondary"></span> Processing…
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    (() => {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2400,
            timerProgressBar: true
        });
        const sidebar = document.getElementById('adminSidebar');
        document.querySelector('[data-sidebar-open]')?.addEventListener('click', () => sidebar?.classList.add(
            'open'));
        document.querySelector('[data-sidebar-close]')?.addEventListener('click', () => sidebar?.classList.remove(
            'open'));

        const clearErrors = form => {
            form.querySelectorAll('.field-error').forEach(e => e.remove());
            form.querySelectorAll('.is-invalid').forEach(e => e.classList.remove('is-invalid'));
        };
        const showErrors = (form, errors = {}) => {
            clearErrors(form);
            Object.entries(errors).forEach(([field, messages]) => {
                const input = form.querySelector(`[name="${CSS.escape(field)}"]`);
                if (!input) return;
                input.classList.add('is-invalid');
                const error = document.createElement('div');
                error.className = 'field-error';
                error.textContent = Array.isArray(messages) ? messages[0] : messages;
                input.insertAdjacentElement('afterend', error);
            });
            form.querySelector('.is-invalid')?.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        };
        const setBusy = (form, busy) => {
            const button = form.querySelector('button[type="submit"],button:not([type])');
            if (!button) return;
            if (busy) {
                button.dataset.originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving…';
            } else {
                button.disabled = false;
                button.innerHTML = button.dataset.originalText || button.innerHTML;
            }
        };
        const requestForm = async form => {
            clearErrors(form);
            setBusy(form, true);
            const method = form.querySelector('input[name="_method"]')?.value?.toUpperCase() || 'POST';
            const data = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: data,
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf,
                        'X-HTTP-Method-Override': method
                    }
                });
                const payload = await response.json().catch(() => ({}));
                if (response.status === 422) {
                    showErrors(form, payload.errors || {});
                    toast.fire({
                        icon: 'error',
                        title: 'Please correct the highlighted fields.'
                    });
                    return;
                }
                if (!response.ok) throw new Error(payload.message || 'Unable to complete the request.');
                toast.fire({
                    icon: 'success',
                    title: payload.message || 'Saved successfully.'
                });
                setTimeout(() => window.location.reload(), 500);
            } catch (error) {
                toast.fire({
                    icon: 'error',
                    title: error.message || 'Request failed.'
                });
            } finally {
                setBusy(form, false);
            }
        };

        document.querySelectorAll('main form[method="post"]:not([data-no-ajax])').forEach(form => {
            form.addEventListener('submit', async event => {
                event.preventDefault();
                if (form.dataset.confirm) {
                    const result = await Swal.fire({
                        icon: 'warning',
                        title: 'Confirm action',
                        text: form.dataset.confirm,
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    });
                    if (!result.isConfirmed) return;
                }
                await requestForm(form);
            });
        });

        document.querySelectorAll('[data-back-button]').forEach(button => button.addEventListener('click', () => {
            const fallback = document.querySelector('meta[name="admin-last-page"]')?.content || @json(
                route('admin.dashboard'));
            if (document.referrer && new URL(document.referrer).origin === location.origin && history
                .length > 1) history.back();
            else if (fallback && fallback !== location.href) location.href = fallback;
            else location.href = @json(route('admin.dashboard'));
        }));

        @if(session('success')) toast.fire({
            icon: 'success',
            title: @json(session('success'))
        });
        @endif
        @if(session('error')) toast.fire({
            icon: 'error',
            title: @json(session('error'))
        });
        @endif
    })();
    </script>
</body>

</html>