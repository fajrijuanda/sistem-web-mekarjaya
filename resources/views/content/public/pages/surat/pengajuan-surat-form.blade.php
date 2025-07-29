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

                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title fw-bold mb-1">{{ $layanan->nama_layanan }}</h4>
                        <p class="text-muted mb-0">{{ $layanan->deskripsi }}</p>
                    </div>
                    <div class="card-body">
                        <form id="pengajuanSuratForm" action="{{ route('public.pengajuan-surat.store', $layanan->slug) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            @if (!empty($layanan->syarat_pengajuan))
                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading fw-bold mb-2"><i class="ti ti-info-circle me-1"></i> Informasi
                                        & Persyaratan</h6>
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
                            </div>
                            <hr class="my-4">

                            @if (!empty($layanan->syarat_pengajuan))
                                <hr class="my-4" />
                                <h5 class="mb-3 fw-semibold">2. Unggah Berkas Persyaratan</h5>
                                <div class="row g-3">
                                    @foreach ($layanan->syarat_pengajuan as $syarat)
                                        <div class="col-md-6">
                                            <label for="file_{{ Str::slug($syarat) }}"
                                                class="form-label">{{ $syarat }}</label>
                                            <input class="form-control" type="file"
                                                name="berkas[{{ Str::slug($syarat) }}]"
                                                id="file_{{ Str::slug($syarat) }}" required>
                                            <div class="form-text">File: JPG, PNG, PDF (Maks. 2MB)</div>
                                            @error('berkas.' . Str::slug($syarat))
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                            {{-- ================================================================= --}}
                            {{-- == BLOK PEMUAT FORM SPESIFIK BERDASARKAN SLUG (DIPERBARUI) == --}}
                            {{-- ================================================================= --}}
                            @php
                                $slug = $layanan->slug;
                                $basePath = 'content.public.pages.surat.forms.';
                            @endphp

                            @if ($slug === 'jual-beli-tanah')
                                @include($basePath . '_form-jual-beli-tanah')
                            @elseif ($slug === 'keterangan-beda-luas-tanah')
                                @include($basePath . '_form-keterangan-beda-luas')
                            @elseif ($slug === 'keterangan-riwayat-tanah')
                                @include($basePath . '_form-riwayat-tanah')
                            @elseif ($slug === 'keterangan-waris')
                                {{-- Mengasumsikan nama file _form--keterangan-waris.blade.php adalah _form-keterangan-waris.blade.php --}}
                                @include($basePath . '_form-keterangan-waris')
                            @elseif ($slug === 'pelimpahan-hak-waris')
                                @include($basePath . '_form-pelimpahan-hak-waris')
                            @elseif ($slug === 'pembuatan-paspor')
                                @include($basePath . '_form-surat-pembuatan-paspor')
                            @elseif ($slug === 'pengantar-skck')
                                @include($basePath . '_form-pengantar-skck')
                            @elseif ($slug === 'permohonan-pindah-datang')
                                @include($basePath . '_form-pindah-datang')
                            @elseif ($slug === 'pernyataan-kelahiran')
                                @include($basePath . '_form-pernyataan-kelahiran')
                            @elseif ($slug === 'pernyataan-kepemilikan-tanah')
                                @include($basePath . '_form-pernyataan-kepemilikan')
                            @elseif ($slug === 'pernyataan-tidak-keberatan')
                                @include($basePath . '_form-pernyataan-tidak-keberatan')
                            @elseif ($slug === 'surat-belum-pernah-menikah')
                                @include($basePath . '_form-belum-pernah-menikah')
                            @elseif ($slug === 'surat-domisili')
                                @include($basePath . '_form-surat-domisili')
                            @elseif ($slug === 'surat-domisili-usaha')
                                @include($basePath . '_form-surat-domisili-usaha')
                            @elseif ($slug === 'surat-kelahiran')
                                @include($basePath . '_form-surat-kelahiran')
                            @elseif ($slug === 'surat-keterangan-usaha')
                                @include($basePath . '_form-surat-usaha')
                            @elseif ($slug === 'surat-kuasa')
                                @include($basePath . '_form-surat-kuasa')
                            @elseif ($slug === 'surat-pengantar-nikah')
                                @include($basePath . '_form-surat-nikah')
                            @elseif ($slug === 'surat-sudah-menikah')
                                @include($basePath . '_form-surat-sudah-menikah')
                            @elseif ($slug === 'surat-tidak-mampu')
                                @include($basePath . '_form-tidak-mampu')
                            @elseif ($slug === 'tanah-tidak-sengketa')
                                @include($basePath . '_form-tanah-tidak-sengketa')
                            @else
                                {{-- Fallback jika form untuk layanan belum dibuat --}}
                                <div class="alert alert-warning text-center" role="alert">
                                    <i class="ti ti-alert-triangle-filled ti-lg me-2"></i>
                                    Formulir untuk layanan ini belum tersedia.
                                </div>
                            @endif


                            {{-- Bagian Upload Berkas (Dibuat Dinamis) --}}
                            @if (!empty($layanan->syarat_pengajuan))
                                <hr class="my-4" />
                                <h5 class="mb-3">Unggah Berkas Persyaratan</h5>
                                <div class="row g-3">
                                    @foreach ($layanan->syarat_pengajuan as $syarat)
                                        <div class="col-md-6">
                                            <label for="file_{{ Str::slug($syarat) }}"
                                                class="form-label">{{ $syarat }}</label>
                                            <input class="form-control" type="file"
                                                name="berkas[{{ Str::slug($syarat) }}]"
                                                id="file_{{ Str::slug($syarat) }}" required>
                                            <div class="form-text">File: JPG, PNG, PDF (Maks. 2MB)</div>
                                            @error('berkas.' . Str::slug($syarat))
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="pt-4 text-center mt-4">
                                <a href="{{ route('public.pengajuan-surat.index') }}"
                                    class="btn btn-label-secondary me-2">Batal</a>
                                {{-- Tombol diubah untuk memicu SweetAlert --}}
                                <button type="button" id="submitBtn" class="btn btn-primary">Kirim Permohonan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection