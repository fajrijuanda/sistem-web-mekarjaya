@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;
    $currentRouteName = Route::currentRouteName();
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4 me-xl-8">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-lg align-middle text-heading fw-medium"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{ url('/') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])</span>
                    <span
                        class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-lg"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    {{-- home --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ $currentRouteName === 'pages-home' ? 'active' : '' }}"
                            aria-current="page" href="{{ url('/') }}">
                            <i class="ti ti-home-2 me-1"></i>Home
                        </a>
                    </li>
                    {{-- profil desa --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ $currentRouteName === 'pages-profil-desa' ? 'active' : '' }}"
                            aria-current="page" href="{{ url('/profil-desa') }}">
                            <i class="ti ti-info-circle me-1"></i>Profil Desa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ $currentRouteName === 'public.peta-desa' ? 'active' : '' }}"
                            href="{{ route('public.peta-desa') }}">
                            <i class="ti ti-map-2 me-1"></i>Peta Desa
                        </a>
                    </li>
                    {{-- artikel --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ $currentRouteName === 'pages-artikel' ? 'active' : '' }}"
                            href="{{ url('/artikel') }}">
                            <i class="ti ti-news me-1"></i>Artikel
                        </a>
                    </li>
                    {{-- pengajuan surat --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Str::startsWith($currentRouteName, 'public.pengajuan-surat') ? 'active' : '' }}"
                            href="{{ route('public.pengajuan-surat.index') }}">
                            <i class="ti ti-file-text me-1"></i>Pengajuan Surat
                        </a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- navbar button: Start -->
                <li>
                    {{-- ✅ LOGIKA BARU DIMULAI DI SINI --}}
                    @auth
                        {{-- Jika pengguna sudah login, tampilkan tombol ini --}}
                        <a href="{{ route('dashboard-utama') }}" class="btn btn-primary">
                            <span class="tf-icons ti ti-layout-dashboard scaleX-n1-rtl me-md-1"></span>
                            <span class="d-none d-md-block">Halaman Admin</span>
                        </a>
                    @else
                        {{-- Jika pengguna belum login, tampilkan tombol ini --}}
                        <a href="{{ url('/login') }}" class="btn btn-primary" target="_blank">
                            <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                            <span class="d-none d-md-block">Login</span>
                        </a>
                    @endauth
                    {{-- ✅ LOGIKA BARU BERAKHIR DI SINI --}}
                </li>
                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->
