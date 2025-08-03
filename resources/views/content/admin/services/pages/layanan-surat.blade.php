@extends('layouts/layoutMaster')

@section('title', 'Manajemen Layanan Surat')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/layanan-surat.js'])
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Administrasi /</span> Layanan Surat
    </h4>

    {{-- Card Statistik --}}
    <div class="row g-6 mb-6">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Permohonan Baru</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{ $stats['baru_hari_ini'] }}</h3>
                            </div>
                            <p class="mb-0">Total hari ini</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary"><i
                                    class="ti ti-mail-plus ti-28px"></i></span>
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
                                <h3 class="mb-0 me-2">{{ $stats['diproses'] }}</h3>
                            </div>
                            <p class="mb-0">Total saat ini</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="ti ti-hourglass-high ti-28px"></i></span>
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
                            {{-- Mengganti "Perlu Tindak Lanjut" menjadi "Ditolak" agar konsisten --}}
                            <span>Ditolak</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{ $stats['ditolak'] }}</h3>
                            </div>
                            <p class="mb-0">Ditolak atau revisi</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class="ti ti-alert-circle ti-28px"></i></span>
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
                                <h3 class="mb-0 me-2">{{ $stats['selesai_bulan_ini'] }}</h3>
                            </div>
                            <p class="mb-0">Total bulan ini</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success"><i
                                    class="ti ti-circle-check ti-28px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-layanan table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Nomor Surat</th>
                        <th>Jenis Layanan</th>
                        <th>Pemohon</th>
                        <th>No. WhatsApp</th>
                        <th>Berkas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal untuk Pratinjau --}}
    <div class="modal fade" id="detailPermohonanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Detail Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- KONTENER INI KOSONG, AKAN DIISI OLEH JAVASCRIPT --}}
                    <div id="surat-preview-container" class="p-4 border rounded">
                        <div class="text-center">Memuat pratinjau...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                    <div id="modal-action-buttons"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ DITAMBAHKAN: Modal Baru untuk Pratinjau Berkas --}}
    <div class="modal fade" id="berkasPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="berkasPreviewModalTitle">Pratinjau Berkas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="berkas-preview-content" class="text-center">
                        {{-- Konten pratinjau (gambar atau PDF) akan dimuat di sini oleh JavaScript --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ STRUKTUR DIPERBAIKI: Semua template diletakkan di sini, di luar modal --}}
    <div id="template-container" style="display: none;">
        {{-- Anda bisa membuat file parsial terpisah untuk ini agar lebih rapi --}}
        @include('content.admin.services.pages.surat-templates')
    </div>
@endsection
