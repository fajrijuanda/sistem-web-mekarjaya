@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Peta Desa')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">

        {{-- PERUBAHAN 1: Jarak padding section-py dikurangi --}}
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background"
                    class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100" data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title display-6 fw-extrabold">Peta Wilayah Desa</h1>
                        {{-- PERUBAHAN 2: Margin bawah mb-6 dikurangi menjadi mb-4 --}}
                        <h2 class="hero-sub-title h6 mb-4">
                            Temukan lokasi dan batas wilayah Desa Mekarjaya, Kecamatan Kedungwaringin.
                        </h2>
                    </div>
                </div>
            </div>
            {{-- PERUBAHAN 3: Menghapus div 'landing-hero-blank' yang memberi jarak besar --}}
            {{-- <div class="landing-hero-blank"></div> --}}
        </section>

        {{-- PERUBAHAN 4: Jarak padding section-py dikurangi --}}
        <section id="peta-desa" class="py-5 bg-body">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary">Lokasi</span>
                </div>
                {{-- PERUBAHAN 5: Margin bawah mb-12 dikurangi menjadi mb-6 --}}
                <h4 class="text-center mb-6">
                    <span class="position-relative fw-extrabold z-1">
                        Lokasi Desa Kami
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                            alt="section title icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h4>

                <div class="card shadow-lg">
                    <div class="card-body p-2">
                        {{-- Ganti "src" iframe ini dengan embed peta dari Google Maps Anda --}}
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15863.856984252192!2d107.28821815541991!3d-6.268739199999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6983a514755157%3A0x137583a484e568e!2sMekarjaya%2C%20Kec.%20Kedungwaringin%2C%20Kabupaten%20Bekasi%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1721970220970!5m2!1sid!2sid"
                            width="100%" height="600" style="border:0; border-radius: 0.5rem;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
