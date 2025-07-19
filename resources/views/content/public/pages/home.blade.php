@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/profile-desa.js'])
@endsection

@push('page-style')
    <style>
        /* CSS Kustom untuk Visi & Misi yang lebih menarik */
        .visi-container {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: #ffffff;
            padding: 3rem;
            border-radius: 0.75rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .visi-container .badge {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.5em 1em;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(5px);
        }

        .visi-container p {
            font-size: 1.25rem;
            font-weight: 500;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .misi-card {
            background-color: #ffffff;
            border: 1px solid #e7e7e7;
            border-radius: 0.75rem;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .misi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .misi-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #696cff;
            /* Warna primary dari template */
        }

        .misi-card h5 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .misi-card p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        /* Styling for editable content */
        [contenteditable="true"]:focus {
            outline: 2px solid #696cff;
            /* Highlight editable areas */
            border-radius: 4px;
            padding: 2px;
        }

        .editable-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .editable-image-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .editable-image-wrapper:hover::after {
            content: "Click to change image";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 0.9rem;
            pointer-events: none;
            /* Allow clicks to pass through to the input */
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example bg-body">
        <section id="hero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold mb-3">
                        {{ $dataProfil['hero']['title'] ?? 'Selamat Datang di Desa Mekarjaya' }}
                    </h1>
                    <h2 class="hero-sub-title h6">
                        {{ $dataProfil['hero']['subtitle'] ?? 'Kecamatan Kedungwaringin, Kabupaten Bekasi. "Mewujudkan Masyarakat Mandiri Berbasis Potensi dan Kearifan Lokal Desa".' }}
                    </h2>
                </div>
            </div>
        </section>
        <section id="main-menu" class="section-py">
            <div class="container">
                <div class="row g-4 justify-content-center">

                    <div class="col-lg-4 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-home-2 menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Profil Desa</h5>
                                <p class="card-text">
                                    Lihat sejarah, visi & misi, serta struktur pemerintahan desa kami.
                                </p>
                                <a href="{{-- Masukkan route ke profil desa di sini --}}" class="btn btn-primary">Lihat Profil</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-news menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Artikel & Berita</h5>
                                <p class="card-text">
                                    Baca berita terkini, pengumuman, dan informasi penting lainnya.
                                </p>
                                <a href="{{ route('public.article.index') }}" class="btn btn-primary">Baca Artikel</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-mail-forward menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Pengajuan Surat</h5>
                                <p class="card-text">
                                    Ajukan surat keterangan dan layanan administrasi lainnya secara online.
                                </p>
                                <a href="{{-- Masukkan route ke pengajuan surat di sini --}}" class="btn btn-primary">Ajukan Surat</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="latest-articles" class="section-py">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-label-primary">Informasi Terkini</span>
                    <h3 class="mt-2 display-6 fw-bold">Artikel & Berita Terbaru</h3>
                    <p class="text-muted">Ikuti perkembangan dan kegiatan terbaru dari desa kami.</p>
                </div>

                <div class="row g-4">
                    {{-- Loop untuk menampilkan 3 artikel terbaru --}}
                    {{-- Anda perlu mengirimkan variabel $latestArticles dari controller --}}
                    @forelse($latestArticles ?? [] as $article)
                        <div class="col-lg-4 col-md-6">
                            <div class="card article-card-minimal h-100">
                                <a href="{{ route('public.article.show', $article->slug) }}">
                                    <img src="{{ $article->thumbnail_url }}" class="card-img-top"
                                        alt="{{ $article->title }}">
                                </a>
                                <div class="card-body">
                                    <a href="#" class="badge bg-label-info mb-2">{{ $article->category }}</a>
                                    <h5 class="card-title">
                                        <a href="{{ route('public.article.show', $article->slug) }}"
                                            class="text-body">{{ Str::limit($article->title, 50) }}</a>
                                    </h5>
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <i class="ti ti-calendar-event"></i>
                                        <span>{{ $article->formatted_published_date }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Belum ada artikel yang dipublikasikan.</p>
                        </div>
                    @endforelse
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('public.article.index') }}" class="btn btn-primary">Lihat Semua Artikel</a>
                </div>
            </div>
        </section>
    </div>
@endsection
