@extends('layouts/layoutMaster')

@section('title', 'Manajemen Artikel')

{{-- STYLESHEET & SCRIPT VENDOR SUDAH BENAR --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    {{-- Pastikan nama file JS ini sesuai dengan yang Anda gunakan --}}
    @vite(['resources/assets/js/article-list.js'])
@endsection

@section('content')
    {{-- KARTU STATISTIK DINAMIS --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Artikel</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- ✅ PERBAIKAN: Menggunakan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['total'] }}</h3>
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
                            <span>Diterbitkan</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- ✅ PERBAIKAN: Menggunakan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['published'] }}</h3>
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
                            <span>Draf</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- ✅ PERBAIKAN: Menggunakan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['draft'] }}</h3>
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
                            {{-- 💡 INFO: Statistik ini memerlukan kolom 'views' di database Anda --}}
                            <span>Total Dilihat</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{ number_format($stats['total_views']) }}</h3>
                            </div>
                            <p class="mb-0">Fitur belum aktif</p>
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

    {{-- TABEL DATATABLES --}}
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success m-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-datatable table-responsive">
            {{-- Nama class 'datatables-article' harus cocok dengan selector di JS --}}
            <table class="datatables-article table border-top">
                <thead>
                    <tr>
                        <th></th> {{-- Kolom kosong untuk responsive control --}}
                        <th>Artikel</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
