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
        const komposisiLayananData = @json($komposisiLayanan);
    </script>
    @vite(['resources/assets/js/dashboard-main.js', 'resources/assets/js/dashboard-content.js'])
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
                    <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="ti ti-file-plus ti-32px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <p class="mb-0 fw-medium">Artikel Terbit</p>
                            <h4 class="text-primary mb-0">12</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ti ti-eye ti-32px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <p class="mb-0 fw-medium">Total Pembaca</p>
                            <h4 class="text-info mb-0">8.2k</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-warning rounded">
                                <i class="ti ti-message-2 ti-32px"></i>
                            </div>
                        </div>
                        <div class="content-right">
                            <p class="mb-0 fw-medium">Total Komentar</p>
                            <h4 class="text-warning mb-0">35</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 ps-md-4 ps-lg-6">
                {{-- Diambil dari "Time Spendings" - Link 5 --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div>
                            <h5 class="mb-1">Sumber Pengunjung</h5>
                            <p class="mb-9">Laporan Bulan Ini</p>
                        </div>
                        <div class="time-spending-chart">
                            <h4 class="mb-2">15.2k</h4>
                            <span class="badge bg-label-success">+12.4%</span>
                        </div>
                    </div>
                    <div id="trafficSourceChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-6">
        {{-- Kartu Utama (4 kolom) --}}
        <div class="col-lg-4">
            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">
                    {{-- Slide 1: Layanan Publik (KONTEN ASLI ANDA) --}}
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Ringkasan Layanan Publik</h5>
                                <small>Data Keseluruhan</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Statistik Layanan</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['totalLayanan']) }}</p>
                                                    <p class="mb-0">Total</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['layananDiproses']) }}</p>
                                                    <p class="mb-0">Diproses</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ number_format($stats['layananSelesai']) }}</p>
                                                    <p class="mb-0">Selesai</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                    <img src="{{ asset('assets/img/illustrations/card-website-analytics-1.png') }}"
                                        alt="Layanan Publik" height="150" class="card-website-analytics-img">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 2: Kependudukan (KONTEN ASLI ANDA) --}}
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

        {{-- Kartu Permohonan Masuk (2 kolom) --}}
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="badge p-2 bg-label-primary mb-3 rounded"><i class="ti ti-file-import ti-28px"></i>
                    </div>
                    <h5 class="card-title mb-1">Permohonan Masuk</h5>
                    <p class="card-subtitle">Bulan Ini</p>
                    <p class="text-heading mb-3 mt-1">120</p>
                    <div>
                        <span class="badge bg-label-success">+15.7%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu Masih Dalam Proses (2 kolom) --}}
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="badge p-2 bg-label-warning mb-3 rounded"><i class="ti ti-hourglass ti-28px"></i></div>
                    <h5 class="card-title mb-1">Masih Dalam Proses</h5>
                    <p class="card-subtitle">Saat Ini</p>
                    <p class="text-heading mb-3 mt-1">8</p>
                    <div>
                        <span class="badge bg-label-secondary">Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu Selesai Tepat Waktu (2 kolom) - DENGAN IKON --}}
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div>
                        <div class="badge p-2 bg-label-success mb-3 rounded"><i class="ti ti-checks ti-28px"></i></div>
                        <h5 class="card-title mb-1">Selesai Tepat Waktu</h5>
                        <p class="card-subtitle">Bulan Ini</p>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <h4 class="mb-0">95%</h4>
                            <small class="text-success">+2.1%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu Permohonan Ditolak (2 kolom) - DENGAN IKON --}}
        <div class="col-lg-2 col-md-3 col-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div>
                        <div class="badge p-2 bg-label-danger mb-3 rounded"><i class="ti ti-file-x ti-28px"></i></div>
                        <h5 class="card-title mb-1">Permohonan Ditolak</h5>
                        <p class="card-subtitle">Bulan Ini</p>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <h4 class="mb-0">5</h4>
                            <small class="text-danger">-1.4%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Baris 2: Grafik Analisis --}}
    <div class="row g-6 mt-1">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Kategori Paling Populer</h5>
                </div>
                <div class="card-body">
                    <div id="popularCategoriesChart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Komposisi Kategori Layanan</h5>
                        <p class="card-subtitle">Berdasarkan jumlah permohonan</p>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                            <h2 class="mb-0">{{ number_format($stats['totalLayanan']) }}</h2>
                            <p class="mb-0">Total Layanan</p>
                        </div>
                        <ul class="p-0 m-0">
                            @foreach ($komposisiLayanan as $kategori)
                                <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                    <div class="badge rounded bg-label-primary p-1_5"><i class="ti ti-users ti-md"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">{{ $kategori->nama_kategori }}</h6>
                                        <small class="text-muted">{{ $kategori->total_permohonan }} Layanan</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                        <div id="serviceCompositionChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 3: Tabel Data --}}
    <div class="row g-6 mt-1">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-requests table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Jenis Layanan</th>
                                <th>Pemohon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
