@extends('layouts/layoutMaster')

@section('title', 'Manajemen Layanan Surat')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/select2/select2.js'
])
@endsection

@section('page-script')
{{-- Arahkan ke file JS khusus untuk halaman ini --}}
@vite(['resources/assets/js/layanan-surat.js'])
@endsection

@section('content')
<div class="row g-6 mb-6">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Permohonan Baru</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">25</h3>
              <p class="text-success mb-0">(+15%)</p>
            </div>
            <p class="mb-0">Total hari ini</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="ti ti-mail-plus ti-28px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Masih Diproses</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">8</h3>
            </div>
            <p class="mb-0">Total saat ini</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="ti ti-hourglass-high ti-28px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Perlu Tindak Lanjut</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">5</h3>
            </div>
            <p class="mb-0">Ditolak atau revisi</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="ti ti-alert-circle ti-28px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Selesai</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">120</h3>
            </div>
            <p class="mb-0">Total bulan ini</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="ti ti-circle-check ti-28px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-0">Daftar Semua Permohonan Surat</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-layanan table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th>ID</th>
          <th>Nomor Surat</th>
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
@endsection