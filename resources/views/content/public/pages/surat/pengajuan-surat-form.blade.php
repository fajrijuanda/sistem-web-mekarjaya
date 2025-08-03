@extends('layouts/layoutMaster')

@section('title', 'Form Pengajuan: ' . $layanan->nama_layanan)

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/form-layouts.js'])
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y mt-10">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-12 mx-auto">

                {{-- ✅ DIUBAH: Form sekarang memiliki atribut data-template-slug --}}
                <form id="pengajuanSuratForm" action="{{ route('public.pengajuan-surat.store', $layanan->slug) }}"
                    method="POST" enctype="multipart/form-data" data-template-slug="{{ $layanan->slug }}">
                    @csrf

                    {{-- Bagian Form Input --}}
                    <div id="form-input-section">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title fw-bold mb-1">{{ $layanan->nama_layanan }}</h4>
                                <p class="text-muted mb-0">{{ $layanan->deskripsi }}</p>
                            </div>
                            <div class="card-body">

                                @if (!empty($layanan->syarat_pengajuan))
                                    <div class="alert alert-info" role="alert">
                                        <h6 class="alert-heading fw-bold mb-2"><i class="ti ti-info-circle me-1"></i>
                                            Informasi & Persyaratan</h6>
                                        <p class="mb-2">Pastikan Anda telah menyiapkan semua dokumen yang diperlukan dalam
                                            format digital (JPG, PNG, atau PDF) sebelum melanjutkan.</p>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($layanan->syarat_pengajuan as $syarat)
                                                <li>{{ $syarat }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Data Diri Pemohon (Umum untuk semua form) --}}
                                <h5 class="mt-4 fw-semibold">1. Data Diri Pemohon</h5>
                                <p class="text-muted">Masukkan data diri Anda sesuai dengan KTP dan Kartu Keluarga.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="nik">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="16 Digit NIK Sesuai KTP" value="{{ old('nik') }}" required
                                            maxlength="16" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                            placeholder="Sesuai KTP" value="{{ old('nama_lengkap') }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="nomor_kk">Nomor Kartu Keluarga (KK)</label>
                                        <input type="text" id="nomor_kk" name="nomor_kk" class="form-control"
                                            placeholder="16 Digit Nomor KK" value="{{ old('nomor_kk') }}" required
                                            maxlength="16" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="no_hp">Nomor HP / WhatsApp</label>
                                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                                            placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                            placeholder="Kota Tempat Lahir" value="{{ old('tempat_lahir') }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir"
                                            class="form-control flatpickr-date" placeholder="YYYY-MM-DD"
                                            value="{{ old('tanggal_lahir') }}" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="agama">Agama</label>
                                        <select id="agama" name="agama" class="form-select" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
                                            <option value="Kristen Protestan" @selected(old('agama') == 'Kristen Protestan')>Kristen Protestan
                                            </option>
                                            <option value="Kristen Katolik" @selected(old('agama') == 'Kristen Katolik')>Kristen Katolik
                                            </option>
                                            <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
                                            <option value="Buddha" @selected(old('agama') == 'Buddha')>Buddha</option>
                                            <option value="Khonghucu" @selected(old('agama') == 'Khonghucu')>Khonghucu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="pekerjaan">Pekerjaan</label>
                                        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control"
                                            placeholder="Contoh: Karyawan Swasta, Pelajar/Mahasiswa"
                                            value="{{ old('pekerjaan') }}" required />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="alamat">Alamat Lengkap (Sesuai KK)</label>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3"
                                            placeholder="Nama Jalan, Desa/Kelurahan, Kecamatan, Kabupaten/Kota" required>{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="rt">RT</label>
                                        <input type="text" id="rt" name="rt" class="form-control"
                                            placeholder="001" value="{{ old('rt') }}" required maxlength="3" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="rw">RW</label>
                                        <input type="text" id="rw" name="rw" class="form-control"
                                            placeholder="001" value="{{ old('rw') }}" required maxlength="3" />
                                    </div>
                                    {{-- ✅ DITAMBAHKAN: Input untuk upload foto KTP --}}
                                    <div class="col-md-12">
                                        <label for="foto_ktp" class="form-label">Unggah Foto/Scan KTP</label>
                                        <input class="form-control" type="file" name="foto_ktp" id="foto_ktp"
                                            required>
                                        <div class="form-text">File: JPG, PNG, PDF (Maks. 2MB)</div>
                                    </div>
                                </div>

                                {{-- Blok pemuat form spesifik berdasarkan slug --}}
                                @include('content.public.pages.surat.form-loader')

                                {{-- Bagian Upload Berkas Persyaratan (jika ada) --}}
                                @if (!empty($layanan->syarat_pengajuan))
                                    <hr class="my-4" />
                                    <h5 class="mb-3 fw-semibold">Unggah Berkas Persyaratan Lainnya</h5>
                                    <div class="row g-3">
                                        @foreach ($layanan->syarat_pengajuan as $syarat)
                                            <div class="col-md-6">
                                                <label for="file_{{ Str::slug($syarat) }}"
                                                    class="form-label">{{ $syarat }}</label>
                                                <input class="form-control" type="file"
                                                    name="berkas[{{ Str::slug($syarat) }}]"
                                                    id="file_{{ Str::slug($syarat) }}" required>
                                                <div class="form-text">File: JPG, PNG, PDF (Maks. 2MB)</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="pt-4 text-center mt-4">
                                    <a href="{{ route('public.pengajuan-surat.index') }}"
                                        class="btn btn-label-secondary me-2">Batal</a>
                                    <button type="button" id="submitBtn" class="btn btn-primary">Kirim
                                        Permohonan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- ✅ DITAMBAHKAN: Bagian Pratinjau Surat (awalnya tersembunyi) --}}
                <div id="preview-section" class="mt-4" style="display: none;">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-bold mb-0"><i class="ti ti-eye me-2"></i>Pratinjau Surat</h5>
                            <button type="button" id="backToFormBtn" class="btn btn-sm btn-label-secondary"><i
                                    class="ti ti-arrow-left me-1"></i> Kembali & Edit</button>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Harap periksa kembali data Anda pada pratinjau di bawah ini. Jika sudah
                                sesuai, klik tombol "Konfirmasi & Kirim".</p>

                            <div id="surat-preview-container" class="p-4 border rounded bg-white shadow-sm">
                                {{-- Akan diisi oleh JavaScript --}}
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" id="confirmSubmitBtn" class="btn btn-success btn-lg">
                                <i class="ti ti-check me-1"></i> Konfirmasi & Kirim
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ✅ PENTING: Salin SEMUA template dari layanan-surat.blade.php ke sini --}}
    <div id="template-container" style="display: none;">
        {{-- Anda bisa membuat file parsial terpisah untuk ini agar lebih rapi --}}
        @include('content.admin.services.pages.surat-templates')
    </div>
@endsection
