@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Konten & Website')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/apex-charts/apexcharts.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/dashboard-content.js'])
@endsection

@section('content')
{{-- Diambil dari "Hour chart" - Link 5 --}}
<div class="card bg-transparent shadow-none my-6 border-0">
  <div class="card-body row p-0 pb-6 g-6">
    <div class="col-12 col-lg-8 card-separator">
      <h5 class="mb-2">Selamat datang kembali, <span class="h4">Admin Konten! 👋🏻</span></h5>
      <div class="col-12 col-lg-7">
        <p>Statistik performa konten website desa Anda minggu ini. Terus tingkatkan kualitas informasi untuk warga!</p>
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
  {{-- Diambil dari "Topic you are interested in" - Link 5 --}}
  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Kategori Paling Populer</h5>
      </div>
      <div class="card-body">
        <div id="popularCategoriesChart"></div>
      </div>
    </div>
  </div>
  {{-- Diambil dari "Top Courses" - Link 5 --}}
  <div class="col-lg-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Artikel Paling Banyak Dilihat</h5>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="d-flex mb-6 align-items-center">
            <div class="avatar flex-shrink-0 me-4">
              <span class="avatar-initial rounded bg-label-success"><i class="ti ti-receipt-2 ti-lg"></i></span>
            </div>
            <div class="row w-100 align-items-center">
              <div class="col-sm-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                <h6 class="mb-0">Penyaluran Bantuan Langsung Tunai (BLT)</h6>
              </div>
              <div class="col-sm-4 d-flex justify-content-sm-end">
                <div class="badge bg-label-secondary">2.8k Dilihat</div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-6 align-items-center">
            <div class="avatar flex-shrink-0 me-4">
              <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-building-cottage ti-lg"></i></span>
            </div>
            <div class="row w-100 align-items-center">
              <div class="col-sm-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                <h6 class="mb-0">Profil UMKM Desa: Keripik Singkong Makmur</h6>
              </div>
              <div class="col-sm-4 d-flex justify-content-sm-end">
                <div class="badge bg-label-secondary">1.5k Dilihat</div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-6 align-items-center">
            <div class="avatar flex-shrink-0 me-4">
              <span class="avatar-initial rounded bg-label-info"><i class="ti ti-calendar-event ti-lg"></i></span>
            </div>
            <div class="row w-100 align-items-center">
              <div class="col-sm-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                <h6 class="mb-0">Jadwal Posyandu Bulan Agustus</h6>
              </div>
              <div class="col-sm-4 d-flex justify-content-sm-end">
                <div class="badge bg-label-secondary">986 Dilihat</div>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-4">
              <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-alert-triangle ti-lg"></i></span>
            </div>
            <div class="row w-100 align-items-center">
              <div class="col-sm-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                <h6 class="mb-0">Peringatan Dini Cuaca Ekstrem</h6>
              </div>
              <div class="col-sm-4 d-flex justify-content-sm-end">
                <div class="badge bg-label-secondary">761 Dilihat</div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </div>
@endsection