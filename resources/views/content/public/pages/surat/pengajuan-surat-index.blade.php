@extends('layouts/layoutMaster')

@section('title', 'Layanan Pengajuan Surat')

@section('vendor-style')
    {{-- Memuat Swiper CSS --}}
    @vite(['resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('page-style')
    {{-- CSS untuk halaman dan kustomisasi Swiper --}}
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
    <style>
        .service-card {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            border: 1px solid #e7e7e7;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background-color: #fff;
            height: 100%;
            /* Memastikan tinggi kartu sama */
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-color: #696cff;
        }

        .service-icon {
            font-size: 2rem;
            color: #696cff;
            margin-right: 1rem;
        }

        .service-card h6 {
            margin-bottom: 0.1rem;
        }

        .service-card p {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Kustomisasi Swiper */
        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            width: auto;
            /* Agar lebar slide menyesuaikan konten */
            height: auto;
            display: flex;
        }

        /* Menghilangkan scrollbar bawaan jika muncul */
        .swiper-wrapper {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .swiper-wrapper::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }
    </style>
@endsection

@section('vendor-script')
    {{-- Memuat Swiper JS --}}
    @vite(['resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">

        {{-- Bagian Hero --}}
        <section id="hero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold mb-3">
                        Layanan Pengajuan Surat Online
                    </h1>
                    <h2 class="hero-sub-title h6">
                        Pilih jenis surat yang Anda butuhkan dari daftar di bawah ini untuk memulai proses pengajuan.
                    </h2>
                </div>
            </div>
        </section>

        {{-- Bagian Daftar Layanan dengan Swiper --}}
        <section id="service-list" class="section-py bg-body-tertiary">
            <div class="container-fluid">

                {{-- Loop untuk setiap kategori layanan --}}
                @forelse($kategoriLayanan as $kategori)
                    <div class="mb-5">
                        <h3 class="mb-4 fw-bold text-center text-md-start px-3">{{ $kategori->nama_kategori }}</h3>

                        <div class="swiper swiper-category" id="swiper-{{ Str::slug($kategori->nama_kategori) }}">
                            <div class="swiper-wrapper">
                                {{-- Loop untuk setiap jenis layanan di dalam kategori --}}
                                @foreach ($kategori->jenisLayanan as $layanan)
                                    <div class="swiper-slide" style="width: 400px;"> {{-- Atur lebar slide di sini --}}
                                        <a href="{{ route('public.pengajuan-surat.create', $layanan->slug) }}"
                                            class="text-body text-decoration-none d-block h-100">
                                            <div class="service-card">
                                                <i class="ti ti-file-text service-icon"></i>
                                                <div>
                                                    <h6 class="fw-semibold">{{ $layanan->nama_layanan }}</h6>
                                                    <p>{{ $layanan->deskripsi ?? 'Ajukan surat ini secara online.' }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <p class="text-muted">Saat ini belum ada layanan surat yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection


@push('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi semua swiper dengan class .swiper-category
            const swiperContainers = document.querySelectorAll('.swiper-category');

            swiperContainers.forEach(container => {
                new Swiper(container, {
                    // Konfigurasi untuk marquee effect
                    loop: true,
                    freeMode: true,
                    spaceBetween: 24, // Jarak antar slide
                    grabCursor: true,
                    slidesPerView: 'auto', // Menampilkan slide sebanyak mungkin tanpa merubah ukuran
                    autoplay: {
                        delay: 1, // Delay 1ms untuk gerakan yang hampir instan
                        disableOnInteraction: false, // Terus berjalan meskipun ada interaksi user
                        reverseDirection: false, // Atur ke true jika ingin slide bergerak dari kanan ke kiri
                    },
                    speed: 5000, // Kecepatan transisi slide (dalam milidetik)

                    // Nonaktifkan navigasi dan pagination
                    navigation: false,
                    pagination: false,
                    scrollbar: false,
                });
            });
        });
    </script>
@endpush
