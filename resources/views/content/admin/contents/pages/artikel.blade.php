@extends('layouts/layoutMaster')

@section('title', 'Manajemen Artikel')

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
@vite(['resources/assets/js/artikel.js'])
@endsection

@section('content')
<div class="row g-6 mb-6">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Artikel</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">86</h3>
            </div>
            <p class="mb-0">Semua Artikel</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="ti ti-file-text ti-28px"></i>
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
            <span>Terpublikasi</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">78</h3>
            </div>
            <p class="mb-0">Bisa dilihat publik</p>
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
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Masih Draf</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">8</h3>
            </div>
            <p class="mb-0">Belum dipublikasi</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-secondary">
              <i class="ti ti-edit-circle ti-28px"></i>
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
            <span>Total Dilihat</span>
            <div class="d-flex align-items-center my-2">
              <h3 class="mb-0 me-2">12.8k</h3>
            </div>
            <p class="mb-0">Dalam 30 hari</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="ti ti-eye ti-28px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-datatable table-responsive">
    <table class="datatables-artikel table border-top">
      <thead>
        <tr>
          <th></th>
          <th>Judul Artikel</th>
          <th>Kategori</th>
          <th>Penulis</th>
          <th>Tanggal Terbit</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection