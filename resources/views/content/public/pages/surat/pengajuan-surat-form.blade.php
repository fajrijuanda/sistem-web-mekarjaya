@extends('layouts/layoutMaster')

@section('title', 'Form Pengajuan: ' . $layanan->nama_layanan)

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
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
                        <form action="{{ route('public.pengajuan-surat.store', $layanan->slug) }}" method="POST"
                            enctype="multipart/form-data">
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
                            <h5 class="mt-4">1. Data Diri Pemohon</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        placeholder="16 Digit NIK Sesuai KTP" value="{{ old('nik') }}" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control"
                                        placeholder="Sesuai KTP" value="{{ old('nama_lengkap') }}" required />
                                </div>
                            </div>
                            <hr class="my-4">


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
                                                name="berkas[{{ Str::slug($syarat) }}]" id="file_{{ Str::slug($syarat) }}"
                                                required>
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
                                <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kode Javascript untuk form dinamis bisa diletakkan di sini jika perlu --}}
    @if (in_array($layanan->slug, [
            'keterangan-waris',
            'pelimpahan-hak-waris',
            'permohonan-pindah-datang',
            'keterangan-riwayat-tanah',
        ]))
        @include('content.public.pages.surat.forms._form-dinamis-js')
    @endif

@endsection
