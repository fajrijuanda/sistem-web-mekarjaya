@extends('layouts/layoutMaster')

@section('title', 'Arsip Dokumen Digital')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/arsip-dokumen.js'])
@endsection

@section('content')
    <h4 class="mb-4">Arsip Dokumen Digital</h4>

    <div class="card">
        {{-- Header Kartu Tetap Sederhana --}}
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Arsip</h5>
        </div>

        {{-- BARU: Area khusus untuk menampung filter --}}
        <div class="card-body">
            <div class="row g-6">
                <div class="col-md-4">
                    <label class="form-label" for="filter-category">Filter Kategori:</label>
                    <select id="filter-category" class="form-select select2"></select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="filter-tahun">Filter Tahun:</label>
                    <select id="filter-tahun" class="form-select select2"></select>
                </div>
            </div>
        </div>

        {{-- Tabel data dengan border-top untuk pemisah visual --}}
        <div class="card-datatable table-responsive border-top">
            <table class="datatables-arsip table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nama Dokumen</th>
                        <th>Kategori</th>
                        <th>Tanggal Unggah</th>
                        <th>Ukuran File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
