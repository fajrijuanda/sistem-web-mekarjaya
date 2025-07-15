@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Pelayanan Publik')

{{-- Menggabungkan Aset CSS & JS yang Diperlukan dari Semua Link --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
    {{-- Arahkan ke file JS khusus untuk dashboard ini --}}
    @vite(['resources/assets/js/dashboard-public-service.js'])
@endsection

@section('content')

    {{-- Baris 1: Kartu Statistik Operasional --}}
    <div class="row g-6">
        {{-- Diambil dari "Total Profit" - Link 2 --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="badge p-2 bg-label-primary mb-3 rounded"><i class="ti ti-file-import ti-28px"></i></div>
                    <h5 class="card-title mb-1">Permohonan Masuk</h5>
                    <p class="card-subtitle ">Bulan Ini</p>
                    <p class="text-heading mb-3 mt-1">120</p>
                    <div>
                        <span class="badge bg-label-success">+15.7%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diambil dari "Total Sales" - Link 2 --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="badge p-2 bg-label-warning mb-3 rounded"><i class="ti ti-hourglass ti-28px"></i></div>
                    <h5 class="card-title mb-1">Masih Dalam Proses</h5>
                    <p class="card-subtitle ">Saat Ini</p>
                    <p class="text-heading mb-3 mt-1">8</p>
                    <div>
                        <span class="badge bg-label-secondary">Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diambil dari "Order" - Link 2 --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-3">
                    <h5 class="card-title mb-1">Selesai Tepat Waktu</h5>
                    <p class="card-subtitle">Bulan Ini</p>
                </div>
                <div class="card-body">
                    <div id="completedOnTimeChart"></div>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <h4 class="mb-0">95%</h4>
                        <small class="text-success">+2.1%</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diambil dari "Sales" - Link 2 --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-3">
                    <h5 class="card-title mb-1">Permohonan Ditolak</h5>
                    <p class="card-subtitle">Bulan Ini</p>
                </div>
                <div class="card-body">
                    <div id="rejectedRequestsChart"></div>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <h4 class="mb-0">5</h4>
                        <small class="text-danger">-1.4%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Baris 2: Analisis Kinerja & Beban Kerja --}}
    <div class="row g-6 mt-4">
        {{-- Diambil dari "Earning Reports" - Link 1 --}}
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Rata-rata Waktu Proses</h5>
                        <p class="card-subtitle">Berdasarkan Jenis Layanan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="processingTimeChart"></div>
                </div>
            </div>
        </div>

        {{-- Diambil dari "Popular Instructors" - Link 5 --}}
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Beban Kerja Staf</h5>
                </div>
                <div class="px-5 py-4 border border-start-0 border-end-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 text-uppercase">Nama Staf</p>
                        <p class="mb-0 text-uppercase">Layanan Selesai</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4"><img src="{{ asset('assets/img/avatars/1.png') }}"
                                    alt="Avatar" class="rounded-circle" /></div>
                            <div>
                                <h6 class="mb-0 text-truncate">Ahmad Susanto</h6>
                                <small class="text-truncate text-body">Kaur Pelayanan</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">45</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4"><img src="{{ asset('assets/img/avatars/2.png') }}"
                                    alt="Avatar" class="rounded-circle" /></div>
                            <div>
                                <h6 class="mb-0 text-truncate">Citra Lestari</h6>
                                <small class="text-truncate text-body">Staf Pelayanan</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">38</h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar me-4"><img src="{{ asset('assets/img/avatars/3.png') }}"
                                    alt="Avatar" class="rounded-circle" /></div>
                            <div>
                                <h6 class="mb-0 text-truncate">Bambang Wijoyo</h6>
                                <small class="text-truncate text-body">Staf Pelayanan</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">29</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 3: Tabel Kerja Utama --}}
    {{-- <div class="row g-6 mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Semua Permohonan Layanan</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-services table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Jenis Layanan</th>
                                <th>Pemohon</th>
                                <th>Tanggal Masuk</th>
                                <th>Status</th>
                                <th>Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
