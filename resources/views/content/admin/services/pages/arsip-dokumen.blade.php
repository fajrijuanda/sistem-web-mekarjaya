@extends('layouts/layoutMaster')

@section('title', 'Arsip Dokumen Digital')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    <script>
        // URL untuk mengambil data tabel (index)
        const arsipDokumenIndexUrl = '{{ route('admin.administrasi-arsip') }}';

        // URL untuk membuat data baru (store)
        const arsipStoreUrl = '{{ route('admin.administrasi-arsip.store') }}';

        // Template URL untuk mengambil, mengupdate, dan menghapus data
        // JavaScript akan mengganti ':id' dengan ID yang sesuai
        const arsipShowUrlTemplate = '{{ route('admin.administrasi-arsip.show', ['arsip' => ':id']) }}';
        const arsipUpdateUrlTemplate = '{{ route('admin.administrasi-arsip.update', ['arsip' => ':id']) }}';
        const arsipDeleteUrlTemplate = '{{ route('admin.administrasi-arsip.destroy', ['arsip' => ':id']) }}';
    </script>
    @vite(['resources/assets/js/arsip-dokumen.js'])
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Administrasi /</span> Arsip Dokumen
    </h4>

    <div class="card">
        {{-- BARU: Area khusus untuk menampung filter --}}
        <div class="card-body">
            <div class="row g-6">
                <div class="col-md-4">
                    <label class="form-label" for="filter-category">Filter Kategori:</label>
                    <select id="filter-category" class="form-select select2">
                        <option value="">Semua Kategori</option>
                        @foreach ($uniqueCategories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="filter-tahun">Filter Tahun:</label>
                    <select id="filter-tahun" class="form-select select2">
                        <option value="">Semua Tahun</option>
                        @foreach ($uniqueYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
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

    <div class="modal fade" id="uploadArsipModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Unggah Dokumen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="arsipForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="arsipMethod" value="POST">
                    <div class="modal-body">
                        <div id="error-container" class="alert alert-danger" style="display: none;"></div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" id="nama_dokumen" name="nama_dokumen" class="form-control"
                                    placeholder="Contoh: SK Pengangkatan Perangkat Desa" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label for="nomor_dokumen" class="form-label">Nomor Dokumen (Opsional)</label>
                                <input type="text" id="nomor_dokumen" name="nomor_dokumen" class="form-control"
                                    placeholder="Contoh: 141/001/SK/2025">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select id="kategori" name="kategori" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option>Surat Tanah</option>
                                    <option>Kependudukan</option>
                                    <option>Peraturan Desa</option>
                                    <option>Notulen Rapat</option>
                                    <option>Lainnya</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-12">
                                <label for="tanggal_unggah" class="form-label">Tanggal Unggah</label>
                                <input class="form-control" type="date" name="tanggal_unggah" id="tanggal_unggah"
                                    required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="file_dokumen" class="form-label">Pilih File</label>
                                <input class="form-control" type="file" id="file_dokumen" name="file_dokumen" required>
                                <div class="form-text">Tipe file yang diizinkan: PDF, DOC, DOCX, JPG, PNG, XLS, XLSX. Maks
                                    10MB.</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
