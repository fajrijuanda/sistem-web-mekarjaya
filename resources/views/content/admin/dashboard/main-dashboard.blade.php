@extends('layouts/layoutMaster')

@section('title', 'Dashboard Utama - Analytics')

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
    @vite(['resources/assets/js/main-dashboard.js'])
@endsection

@section('content')
    {{-- Baris 1: Kartu Statistik Utama (KPI) --}}
    <div class="row g-6">
        <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">
                    {{-- Slide 1: Layanan Publik --}}
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Ringkasan Layanan & Kependudukan</h5>
                                <small>Data bulan ini.</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Layanan Publik</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">120</p>
                                                    <p class="mb-0">Total Layanan</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.5 Hari</p>
                                                    <p class="mb-0">Waktu Proses</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">95%</p>
                                                    <p class="mb-0">Selesai</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">8</p>
                                                    <p class="mb-0">Diproses</p>
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
                    {{-- Slide 2: Kependudukan --}}
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Ringkasan Layanan & Kependudukan</h5>
                                <small>Data terbaru.</small>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">Kependudukan</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">3,450</p>
                                                <p class="mb-0">Jiwa</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1,204</p>
                                                <p class="mb-0">KK</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1,720</p>
                                                <p class="mb-0">Pria</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1,730</p>
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
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0 card-title">Statistik Website & Konten</h5>
                    <p class="card-text fw-medium text-success">+18.2%</p>
                </div>
                <div class="card-body d-flex justify-content-around align-items-center">
                    <div class="text-center">
                        <div class="d-flex gap-2 align-items-center mb-2 justify-content-center">
                            <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-eye ti-sm"></i></span>
                            <p class="mb-0">Pengunjung</p>
                        </div>
                        <h5 class="mb-0 pt-1">1.2k</h5>
                        <small class="text-muted">Hari Ini</small>
                    </div>
                    <div class="text-center">
                        <div class="d-flex gap-2 align-items-center mb-2 justify-content-center">
                            <span class="badge bg-label-info p-1 rounded"><i class="ti ti-news ti-sm"></i></span>
                            <p class="mb-0">Artikel</p>
                        </div>
                        <h5 class="mb-0 pt-1">25</h5>
                        <small class="text-muted">Bulan Ini</small>
                    </div>
                    <div class="text-center">
                        <div class="d-flex gap-2 align-items-center mb-2 justify-content-center">
                            <span class="badge bg-label-warning p-1 rounded"><i class="ti ti-message-2 ti-sm"></i></span>
                            <p class="mb-0">Komentar</p>
                        </div>
                        <h5 class="mb-0 pt-1">35</h5>
                        <small class="text-muted">Total</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 2: Grafik Analisis --}}
    <div class="row g-6 mt-1">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Grafik Tren Aktivitas Desa</h5>
                        <p class="card-subtitle">Rangkuman 6 bulan terakhir</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                            <a class="dropdown-item" href="javascript:void(0);">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="activityChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Komposisi Kategori Layanan</h5>
                        <p class="card-subtitle">Berdasarkan jumlah permohonan</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="supportTrackerMenu" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                            <a class="dropdown-item" href="javascript:void(0);">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                            <h2 class="mb-0">120</h2>
                            <p class="mb-0">Total Layanan</p>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-primary p-1_5"><i class="ti ti-users ti-md"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Kependudukan</h6>
                                    <small class="text-muted">75 Layanan</small>
                                </div>
                            </li>
                            <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-info p-1_5"><i class="ti ti-briefcase ti-md"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Usaha</h6>
                                    <small class="text-muted">30 Layanan</small>
                                </div>
                            </li>
                            <li class="d-flex gap-4 align-items-center pb-1">
                                <div class="badge rounded bg-label-warning p-1_5"><i class="ti ti-heart ti-md"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Sosial</h6>
                                    <small class="text-muted">15 Layanan</small>
                                </div>
                            </li>
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
