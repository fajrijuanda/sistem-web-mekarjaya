@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Daftar Artikel')

@section('page-style')
    <style>
        /* Custom CSS for the shadow effect */
        .article-preview-container {
            position: relative;
            overflow: hidden;
            /* Penting untuk memotong konten */
        }

        .article-preview-content {
            max-height: 300px;
            /* Diperpanjang untuk lebih banyak teks agar tidak tertutup */
            overflow: hidden;
            position: relative;
            padding-bottom: 60px;
            /* Ruang untuk tombol "Lihat Lebih Lanjut" */
        }

        .article-preview-shadow {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 120px;
            /* Tinggi shadow diperpanjang */
            pointer-events: none;
            /* Agar tidak menghalangi klik pada konten di bawahnya */

            /* Perbaikan untuk Dark Mode: Menggunakan warna yang adaptif */
            /* Default Light Mode */
            background: linear-gradient(to top, #ffffff 0%, rgba(255, 255, 255, 0) 100%);
        }

        /* Aturan untuk Dark Mode */
        /* Asumsi: body memiliki kelas 'dark-style' atau 'data-bs-theme="dark"' saat dalam mode gelap */
        /* Sesuaikan selector ini sesuai dengan implementasi tema Anda */
        body[data-bs-theme="dark"] .article-preview-shadow,
        .dark-mode .article-preview-shadow,
        .layout-navbar-dark .article-preview-shadow {
            /* Menggunakan warna background yang lebih gelap untuk fade di Dark Mode */
            /* Ganti #2b2c40 dengan warna background card atau body di dark mode tema Anda jika berbeda */
            background: linear-gradient(to top, #2b2c40 0%, rgba(43, 44, 64, 0) 100%);
        }


        .read-more-overlay {
            position: absolute;
            bottom: 25px;
            /* Sesuaikan posisi tombol di atas shadow */
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            pointer-events: auto;
            /* Agar tombol bisa diklik */
        }

        /* Styles for responsive image in content */
        .article-content-img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Additional styles for better spacing and aesthetics */
        .section-title {
            font-size: 2.5rem;
            /* Larger title for public page */
            font-weight: 700;
            color: #333;
            /* Darker color */
        }

        .section-description {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        /* Perbaikan warna teks untuk Dark Mode */
        body[data-bs-theme="dark"] .section-title,
        .dark-mode .section-title,
        .layout-navbar-dark .section-title {
            color: #e0e0e0;
            /* Warna terang untuk judul di dark mode */
        }

        body[data-bs-theme="dark"] .section-description,
        .dark-mode .section-description,
        .layout-navbar-dark .section-description {
            color: #a0a0a0;
            /* Warna terang untuk deskripsi di dark mode */
        }


        .card-img-top {
            object-fit: cover;
            /* Ensures images cover the area without distortion */
            height: 300px;
            /* Fixed height for consistency */
        }

        /* Adjust container padding to prevent collision with 'front' layout header/footer */
        .container-xxl.container-p-y {
            padding-top: 2rem !important;
            /* Sesuaikan padding atas */
            padding-bottom: 2rem !important;
            /* Sesuaikan padding bawah */
            /* Anda mungkin perlu menyesuaikan ini lebih lanjut tergantung pada layout 'front' Anda */
            /* Jika ada header/navbar tetap, mungkin perlu padding-top lebih besar */
        }

        /* Custom CSS untuk menghilangkan garis pembatas pada card filter */
        .card .card-header {
            border-bottom: none !important;
            /* Menghilangkan garis bawah pada header card */
        }

        /* Perbaikan warna teks di card header filter untuk Dark Mode */
        body[data-bs-theme="dark"] .card-header .card-title,
        .dark-mode .card-header .card-title,
        .layout-navbar-dark .card-header .card-title {
            color: #e0e0e0;
            /* Warna terang untuk judul di dark mode */
        }

        /* Perbaikan warna teks di card body filter untuk Dark Mode */
        body[data-bs-theme="dark"] .card-body .form-label,
        .dark-mode .card-body .form-label,
        .layout-navbar-dark .card-body .form-label {
            color: #a0a0a0;
            /* Warna terang untuk label di dark mode */
        }

        /* Perbaikan warna teks di card body artikel untuk Dark Mode */
        body[data-bs-theme="dark"] .card-body .card-title,
        .dark-mode .card-body .card-title,
        .layout-navbar-dark .card-body .card-title {
            color: #e0e0e0;
            /* Warna terang untuk judul artikel di dark mode */
        }

        body[data-bs-theme="dark"] .card-body .text-muted small,
        .dark-mode .card-body .text-muted small,
        .layout-navbar-dark .card-body .text-muted small {
            color: #cccccc !important;
            /* Warna terang untuk meta info di dark mode */
        }

        /* Perbaikan warna teks di preview content untuk Dark Mode */
        body[data-bs-theme="dark"] .article-preview-content,
        .dark-mode .article-preview-content,
        .layout-navbar-dark .article-preview-content {
            color: #f0f0f0;
            /* Warna terang untuk konten preview di dark mode */
        }
    </style>
@endsection

@section('vendor-script')
    {{-- Tambahkan script vendor jika diperlukan untuk filter, dll. --}}
@endsection

@section('page-script')
    {{-- Arahkan ke file JS khusus untuk halaman ini --}}
    @vite(['resources/assets/js/public-artikel.js'])
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y pt-5 pb-5">
        <div class="text-center mb-5 mt-10"> <!-- Menambahkan mt-5 untuk jarak dari header -->
            <h2 class="section-title mb-3">Baca Artikel Terbaru Kami</h2>
            <p class="section-description mx-auto" style="max-width: 700px;">
                Temukan berbagai informasi menarik dan berita terkini seputar desa kami. Dari kegiatan komunitas hingga
                laporan pembangunan, kami hadirkan untuk Anda.
            </p>
        </div>

        <!-- Filter Section -->
        <div class="card mb-5 shadow-sm">
            {{-- Hapus kelas 'border-bottom' dari card-header --}}
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Artikel</h5>
            </div>
            <div class="card-body">
                <form id="filter-form" class="row g-3">
                    <div class="col-md-4">
                        <label for="sort_by" class="form-label">Urutkan Berdasarkan:</label>
                        <select id="sort_by" name="sort_by" class="form-select">
                            <option value="newest" {{ $currentSortBy == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $currentSortBy == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="year" class="form-label">Tahun:</label>
                        <select id="year" name="year" class="form-select">
                            <option value="all" {{ $currentYear == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                            @foreach ($uniqueYears as $year)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="category" class="form-label">Kategori:</label>
                        <select id="category" name="category" class="form-select">
                            <option value="all" {{ $currentCategory == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                            @foreach ($uniqueCategories as $category)
                                <option value="{{ $category }}" {{ $currentCategory == $category ? 'selected' : '' }}>
                                    {{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Hapus tombol "Terapkan Filter" --}}
                    {{-- <div class="col-12 text-end mt-4">
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div> --}}
                </form>
            </div>
        </div>
        <!-- /Filter Section -->

        <!-- Article List -->
        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-lg">
                        @if ($article->thumbnail_url)
                            <img class="card-img-top rounded-top-lg" src="{{ $article->thumbnail_url }}"
                                alt="{{ $article->judul }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate-2-lines mb-2">{{ $article->judul }}</h5>
                            <div class="text-muted mb-3">
                                <small>
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $article->published_at_formatted ?? 'Tanggal tidak tersedia' }}
                                    <span class="mx-2">|</span>
                                    <i class="ti ti-tag me-1"></i> {{ $article->kategori ?? 'Tanpa Kategori' }}
                                </small>
                            </div>
                            <div class="article-preview-container flex-grow-1">
                                <div class="article-preview-content">
                                    {!! $article->preview_content !!}
                                </div>
                                <div class="article-preview-shadow"></div>
                                <div class="read-more-overlay">
                                    <a href="{{ route('public.artikel-view', $article->slug) }}"
                                        class="btn btn-sm btn-primary rounded-pill px-4">Lihat Lebih Lanjut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center mt-5" role="alert">
                        Tidak ada artikel yang ditemukan dengan kriteria filter yang dipilih.
                    </div>
                </div>
            @endforelse
        </div>
        <!-- /Article List -->

        {{-- Jika Anda mengimplementasikan pagination di controller, tambahkan di sini --}}
        {{-- <div class="mt-4">
        {{ $articles->links() }}
    </div> --}}
    </div>
@endsection
