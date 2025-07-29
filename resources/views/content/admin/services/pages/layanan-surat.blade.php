@extends('layouts/layoutMaster')

@section('title', 'Manajemen Layanan Surat')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    {{-- Pastikan file JS ini ada dan path-nya benar --}}
    @vite(['resources/assets/js/layanan-surat.js'])
@endsection

@section('content')
    {{-- Bagian 4 card statistik (DINAMIS) --}}
    <div class="row g-6 mb-6">
        {{-- Card Permohonan Baru --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Permohonan Baru</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- Menampilkan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['baru_hari_ini'] }}</h3>
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

        {{-- Card Masih Diproses --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Masih Diproses</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- Menampilkan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['diproses'] }}</h3>
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

        {{-- Card Perlu Tindak Lanjut --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Perlu Tindak Lanjut</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- Menampilkan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['ditolak'] }}</h3>
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

        {{-- Card Selesai --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Selesai</span>
                            <div class="d-flex align-items-center my-2">
                                {{-- Menampilkan data dinamis dari controller --}}
                                <h3 class="mb-0 me-2">{{ $stats['selesai_bulan_ini'] }}</h3>
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

    {{-- Card untuk DataTable (tidak ada perubahan) --}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Filter Pencarian</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-layanan table border-top">
                <thead>
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

    <div class="modal fade" id="detailPermohonanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Detail Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Konten Surat akan dimuat di sini --}}
                    <div id="surat-preview-content" class="p-4 border rounded">
                        {{-- Template ini akan kita isi dengan data dinamis --}}
                        <div class="text-center mb-4">
                            <h5 class="text-uppercase fw-bold mb-1"><u>Surat Pernyataan Tidak Keberatan</u></h5>
                            <p class="mb-0">Nomor: <span id="detail_kode_permohonan"></span></p>
                        </div>

                        <p>Yang bertanda tangan dibawah ini:</p>
                        <table class="table table-borderless table-sm mb-3">
                            <tr>
                                <td style="width: 30%;">Nama</td>
                                <td>: <span id="detail_pemohon_nama"></span></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>: <span id="detail_pemohon_nik"></span></td>
                            </tr>
                            <tr>
                                <td>Tempat/Tanggal Lahir</td>
                                <td>: <span id="detail_pemohon_ttl"></span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <span id="detail_pemohon_alamat"></span></td>
                            </tr>
                        </table>

                        <p>Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan Kartu Keluarga (KK) saya dipergunakan
                            oleh saudara/pihak di bawah ini:</p>
                        <table class="table table-borderless table-sm mb-3">
                            <tr>
                                <td style="width: 30%;">Nama</td>
                                <td>: <span id="detail_pihak2_nama"></span></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>: <span id="detail_pihak2_nik"></span></td>
                            </tr>
                            <tr>
                                <td>Tempat/Tanggal Lahir</td>
                                <td>: <span id="detail_pihak2_ttl"></span></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <span id="detail_pihak2_alamat"></span></td>
                            </tr>
                        </table>

                        <p>Adapun tujuan penggunaan tersebut adalah untuk: <br>
                            <strong id="detail_pernyataan_isi" class="d-block mt-2"></strong>
                        </p>

                        <p class="mt-4">Demikian pernyaan ini saya buat dengan sebenarnya, apabila pernyataan ini tidak
                            sesuai dengan sebenarnya, saya siap untuk diproses sebagaimana hukum yang berlaku.</p>

                        <div class="d-flex justify-content-end mt-5">
                            <div class="text-center">
                                <p class="mb-5">Mekarjaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} <br>
                                    Yang Membuat Pernyataan,</p>
                                <p class="fw-bold text-uppercase">( <span id="detail_pemohon_nama_bawah"></span> )</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                    {{-- Tombol Aksi akan ditambahkan secara dinamis oleh JS --}}
                    <div id="modal-action-buttons"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
