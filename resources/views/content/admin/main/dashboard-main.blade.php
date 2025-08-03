@php
    use Illuminate\Support\Str;

    $categoryBadges = [
        'Berita Desa' => 'bg-label-primary',
        'Kesehatan' => 'bg-label-danger',
        'UMKM' => 'bg-label-success',
        'Pengumuman' => 'bg-label-info',
        'Kegiatan' => 'bg-label-warning',
        'Teknologi' => 'bg-label-dark', // Contoh tambahan
        // Tambahkan kategori lain jika perlu
    ];
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Dashboard Utama')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/cards-advance.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
    {{-- Kirim data dari PHP ke JavaScript --}}
    <script>
        const trenData = @json($trenData);
        const sumberPengunjungData = @json($pembacaPerKategori);
        const popularCategoriesData = @json($popularCategories);
    </script>
    @vite(['resources/assets/js/dashboard-main.js'])
@endsection

@section('content')
    {{-- Baris 1: Kartu Statistik Utama (KPI) --}}
    <div class="card bg-transparent shadow-none my-6 border-0">
        <div class="card-body row p-0 pb-6 g-6">
            <div class="col-12 col-lg-8 card-separator">
                <h5 class="mb-2">Selamat datang kembali, <span class="h4">Admin! 👋🏻</span></h5>
                <div class="col-12 col-lg-7">
                    <p>Statistik performa konten website desa Anda minggu ini. Terus tingkatkan kualitas informasi untuk
                        warga!</p>
                </div>
                <div class="d-flex justify-content-between flex-wrap gap-4 me-12">
                    {{-- Kartu Artikel Terbit --}}
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="ti ti-file-plus ti-32px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <p class="mb-0 fw-medium">Artikel Terbit</p>
                            {{-- Data Dinamis --}}
                            <h4 class="text-primary mb-0">{{ number_format($stats['artikelMingguIni']) }}</h4>
                        </div>
                    </div>
                    {{-- Kartu Total Pembaca --}}
                    <div class="d-flex align-items-center gap-4">
                        <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ti ti-eye ti-32px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <p class="mb-0 fw-medium">Total Pembaca</p>
                            {{-- Data Dinamis --}}
                            <h4 class="text-info mb-0">{{ number_format($stats['totalPembaca']) }}</h4>
                        </div>
                    </div>
                    {{-- KARTU KOMENTAR DIHAPUS --}}
                </div>
            </div>
            {{-- Ganti bagian kartu "Pengunjung Artikel" --}}
            <div class="col-12 col-lg-4 ps-md-4 ps-lg-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div>
                            <h5 class="mb-1">Total Pengunjung</h5>
                            <p class="mb-9">Laporan Bulan Ini</p>
                        </div>
                        <div class="time-spending-chart">
                            <h4 class="mb-2">
                                @php
                                    $pengunjung = $stats['pengunjungBulanIni'];
                                    if ($pengunjung >= 1000) {
                                        echo number_format($pengunjung / 1000, 1) . 'k';
                                    } else {
                                        echo number_format($pengunjung);
                                    }
                                @endphp
                            </h4>

                            @if ($stats['persentasePerubahanPengunjung'] != 0)
                                <span
                                    class="badge {{ $stats['persentasePerubahanPengunjung'] > 0 ? 'bg-label-success' : 'bg-label-danger' }}">
                                    {{ $stats['persentasePerubahanPengunjung'] > 0 ? '+' : '' }}{{ number_format($stats['persentasePerubahanPengunjung'], 1) }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- ✅ DIUBAH: Tag <img> diganti dengan struktur ikon --}}
                    <div class="avatar">
                        <div class="avatar-initial bg-label-success rounded">
                            <i class="ti ti-users ti-28px"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row g-6">
        {{-- Kartu Utama (4 kolom) --}}
        <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg h-100"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Ringkasan Konten Website</h5>
                                <small>Data Keseluruhan</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Statistik Konten</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['totalArtikel']) }}</p>
                                                    <p class="mb-0">Artikel</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['totalPembaca']) }}</p>
                                                    <p class="mb-0">Pembaca</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['totalKategoriArtikel']) }}</p>
                                                    <p class="mb-0">Kategori</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['totalPengguna']) }}</p>
                                                    <p class="mb-0">Pengguna</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                    <img src="{{ asset('assets/img/illustrations/card-website-analytics-1.png') }}"
                                        alt="Konten Website" height="150" class="card-website-analytics-img">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Ringkasan Kependudukan</h5>
                                <small>Data terbaru.</small>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">Demografi</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                    {{ number_format($stats['totalPenduduk']) }}</p>
                                                <p class="mb-0">Jiwa</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                    {{ number_format($stats['totalKK']) }}</p>
                                                <p class="mb-0">KK</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                    {{ number_format($stats['totalPria']) }}</p>
                                                <p class="mb-0">Pria</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                    {{ number_format($stats['totalWanita']) }}</p>
                                                <p class="mb-0">Wanita</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                <img src="{{ asset('assets/img/illustrations/card-website-analytics-2.png') }}"
                                    alt="Kependudukan" height="150" class="card-website-analytics-img">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- Wrapper baru untuk grid 2x2 kartu statistik --}}
        <div class="col-lg-6">
            <div class="row g-6">
                {{-- Kartu Permohonan Masuk --}}
                <div class="col-lg-6 col-md-6 col-6"> {{-- Kelas kolom diubah untuk layout 2x2 --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="content-left">
                                    <h5 class="card-title mb-1">Permohonan Masuk</h5>
                                    <p class="card-subtitle small">Bulan Ini</p>
                                    <h4 class="mb-0 mt-3">{{ number_format($stats['permohonanMasukBulanIni']) }}</h4>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class="ti ti-file-import ti-28px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu Masih Dalam Proses --}}
                <div class="col-lg-6 col-md-6 col-6"> {{-- Kelas kolom diubah untuk layout 2x2 --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="content-left">
                                    <h5 class="card-title mb-1">Dalam Proses</h5>
                                    <p class="card-subtitle small">Saat Ini</p>
                                    <h4 class="mb-0 mt-3">{{ number_format($stats['layananDiproses']) }}</h4>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-warning rounded">
                                        <i class="ti ti-hourglass-low ti-28px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu Selesai --}}
                <div class="col-lg-6 col-md-6 col-6"> {{-- Kelas kolom diubah untuk layout 2x2 --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="content-left">
                                    <h5 class="card-title mb-1">Selesai</h5>
                                    <p class="card-subtitle small">Total Keseluruhan</p>
                                    <h4 class="mb-0 mt-3">{{ number_format($stats['layananSelesai']) }}</h4>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-success rounded">
                                        <i class="ti ti-checks ti-28px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu Ditolak --}}
                <div class="col-lg-6 col-md-6 col-6"> {{-- Kelas kolom diubah untuk layout 2x2 --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="content-left">
                                    <h5 class="card-title mb-1">Ditolak</h5>
                                    <p class="card-subtitle small">Bulan Ini</p>
                                    <h4 class="mb-0 mt-3">{{ number_format($stats['permohonanDitolakBulanIni']) }}</h4>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-danger rounded">
                                        <i class="ti ti-file-x ti-28px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Baris 2: Grafik Analisis --}}
    <div class="row g-6 mt-1">

        <div class="col-lg-6">
            <div class="row g-6">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Kategori Paling Populer</h5>
                        </div>
                        <div class="card-body">
                            <div id="popularCategoriesChart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="mb-1">Grafik Tren Aktivitas Desa</h5>
                                <p class="card-subtitle">Rangkuman 6 bulan terakhir</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="activityChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Artikel Terbaru</h5>
                        <p class="card-subtitle">5 artikel yang baru saja ditambahkan</p>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <ul class="list-unstyled mb-0">
                        @forelse ($latestArticles as $article)
                            <li class="mb-4">
                                <div class="d-flex">
                                    {{-- FOTO THUMBNAIL ARTIKEL --}}
                                    <div class="flex-shrink-0 me-3">
                                        <a href="{{ route('admin.article.show', ['article' => $article->slug]) }}">
                                            <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                                class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                                        </a>
                                    </div>

                                    <div class="flex-grow-1">
                                        {{-- JUDUL ARTIKEL --}}
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.article.show', ['article' => $article->slug]) }}"
                                                class="text-body">{{ $article->title }}</a>
                                        </h6>

                                        {{-- CUPLIKAN ISI --}}
                                        <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                            {!! $article->preview_content !!}
                                        </p>

                                        {{-- META INFO: Penulis, Tanggal, dan Kategori --}}
                                        <div class="d-flex align-items-center flex-wrap text-muted"
                                            style="font-size: 0.8rem;">
                                            {{-- Penulis dengan avatar kecil --}}
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-1">
                                                    <img src="{{ $article->user->avatar_url ?? asset('assets/img/avatars/1.png') }}"
                                                        alt="{{ $article->user->name ?? 'Admin' }}"
                                                        class="rounded-circle">
                                                </div>
                                                <span>{{ $article->user->name ?? 'Admin' }}</span>
                                            </div>

                                            <span class="mx-2">•</span>
                                            <span>{{ $article->formatted_published_date }}</span>
                                            <span class="mx-2">•</span>

                                            {{-- Badge Kategori --}}
                                            <span
                                                class="badge rounded-pill {{ $categoryBadges[$article->category] ?? 'bg-label-secondary' }}">
                                                {{ $article->category ?? 'Lainnya' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-center">
                                <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>


@endsection
