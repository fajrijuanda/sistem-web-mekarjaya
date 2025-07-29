@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/profile-desa.js'])
@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example bg-body">
        <section id="hero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold mb-3">
                        {{ $dataProfil['hero']['title'] ?? 'Selamat Datang di Desa Mekarjaya' }}
                    </h1>
                    <h2 class="hero-sub-title h6">
                        {{ $dataProfil['hero']['subtitle'] ?? 'Kecamatan Kedungwaringin, Kabupaten Bekasi. "Mewujudkan Masyarakat Mandiri Berbasis Potensi dan Kearifan Lokal Desa".' }}
                    </h2>
                </div>
            </div>
        </section>
        <section id="main-menu" class="py-10">
            <div class="container">
                {{-- Menggunakan class justify-content-center agar card berada di tengah --}}
                <div class="row g-4 justify-content-center">

                    {{-- Card Profil Desa --}}
                    {{-- PERUBAHAN: Mengubah class kolom dari col-lg-4 menjadi col-lg-5 agar lebih lebar --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-info-circle menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Profil Desa</h5>
                                <p class="card-text">
                                    Lihat sejarah, visi & misi, serta struktur pemerintahan desa kami.
                                </p>
                                <a href="{{ route('public.profil-desa') }}" class="btn btn-primary">Lihat Profil</a>
                            </div>
                        </div>
                    </div>

                    {{-- Card Artikel & Berita --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-map-2 menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Peta Desa</h5>
                                <p class="card-text">
                                    Jelajahi lokasi dan batas wilayah Desa Mekarjaya secara interaktif.
                                </p>
                                <a href="{{ route('public.peta-desa') }}" class="btn btn-primary">Lihat Peta</a>
                            </div>
                        </div>
                    </div>

                    {{-- Card Pengajuan Surat --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-news menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Artikel & Berita</h5>
                                <p class="card-text">
                                    Baca berita terkini, pengumuman, dan informasi penting lainnya.
                                </p>
                                <a href="{{ route('public.article.index') }}" class="btn btn-primary">Baca Artikel</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <div class="card menu-card h-100 text-center border-0 shadow-sm">
                            <div class="card-body">
                                <i class="ti ti-mail-forward menu-card-icon"></i>
                                <h5 class="card-title fw-bold">Pengajuan Surat</h5>
                                <p class="card-text">
                                    Ajukan surat keterangan dan layanan administrasi lainnya secara online.
                                </p>
                                <a href="{{ route('public.pengajuan-surat.index') }}" class="btn btn-primary">Ajukan
                                    Surat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
