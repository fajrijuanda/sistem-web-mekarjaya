@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Layanan Pengajuan Surat')

@section('page-style')
    {{-- CSS untuk halaman dan kustomisasi --}}
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
    <style>
        /* Filter Kategori */
        .nav-pills .nav-link {
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .nav-pills .nav-link:not(.active):hover {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: var(--bs-primary);
            box-shadow: 0 4px 8px rgba(var(--bs-primary-rgb), 0.3);
        }

        .nav-pills.flex-nowrap {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .nav-pills.flex-nowrap::-webkit-scrollbar {
            display: none;
        }

        /* Card Layanan Baru */
        .service-card {
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 2rem 1.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            background-color: #fff;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(var(--bs-primary-rgb), 0.12);
            border-color: rgba(var(--bs-primary-rgb), 0.6);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--bs-primary);
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
            line-height: 1;
        }

        .service-card h6 {
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .service-card p {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .service-card .btn {
            width: 100%;
            margin-top: auto;
        }

        /* Animasi untuk filter */
        .service-item-col {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .service-item-col.is-hidden {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
        }
    </style>
@endsection

@section('page-script')
    {{-- Memuat file JavaScript filter yang terpisah --}}
    @vite(['resources/assets/js/service-filter.js'])
@endsection

@section('content')
    @php
        // Pemetaan slug ke ikon Tabler yang lebih variatif
        $iconMap = [
            // Kependudukan & Pernikahan
            'surat-pengantar-nikah' => 'ti-heart-handshake', // 💍
            'surat-domisili' => 'ti-home-2', // 🏠
            'surat-kelahiran' => 'ti-baby-carriage', // 👶
            'surat-sudah-menikah' => 'ti-user-check',
            'surat-belum-pernah-menikah' => 'ti-user-off',
            'permohonan-pindah-datang' => 'ti-truck-delivery', // 🚚
            'pengantar-skck' => 'ti-shield-lock', // 🛡️
            'pembuatan-paspor' => 'ti-world', // 🌍

            // Perizinan & Usaha
            'surat-keterangan-usaha' => 'ti-building-store', // 🏪
            'surat-domisili-usaha' => 'ti-map-pin', // 📍

            // Layanan Sosial
            'surat-tidak-mampu' => 'ti-coin-off', // 💰❌

            // Pertanahan
            'keterangan-waris' => 'ti-users-group',
            'pelimpahan-hak-waris' => 'ti-transform',
            'jual-beli-tanah' => 'ti-transfer-in', // 💸
            'tanah-tidak-sengketa' => 'ti-file-check',
            'keterangan-riwayat-tanah' => 'ti-history', // 📜
            'pernyataan-kepemilikan-tanah' => 'ti-file-certificate',
            'keterangan-beda-luas-tanah' => 'ti-arrows-split-2',

            // Lain-lain
            'surat-kuasa' => 'ti-signature', // ✍️
            'pernyataan-tidak-keberatan' => 'ti-thumb-up', // 👍
        ];
    @endphp
    <div data-bs-spy="scroll" class="scrollspy-example">

        {{-- Bagian Hero --}}
        <section id="hero" class="section-py landing-hero position-relative">
            <div class="container mt-10">
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

        {{-- Bagian Daftar Layanan dengan Filter --}}
        <section id="service-list" class="pt-4 pb-5 bg-body-tertiary">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-start justify-content-md-center flex-nowrap overflow-auto mb-5 pb-4"
                            id="service-filter">
                            <li class="nav-item m-1">
                                <a class="nav-link active" href="#" data-filter="all">Semua Layanan</a>
                            </li>
                            @foreach ($kategoriLayanan as $kategori)
                                <li class="nav-item m-1">
                                    <a class="nav-link" href="#"
                                        data-filter="{{ Str::slug($kategori->nama_kategori) }}">{{ $kategori->nama_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row g-4" id="service-grid">
                    @forelse($kategoriLayanan as $kategori)
                        @foreach ($kategori->jenisLayanan as $layanan)
                            <div class="col-md-6 col-lg-4 service-item-col"
                                data-category="{{ Str::slug($kategori->nama_kategori) }}">
                                <div class="service-card">
                                    {{-- Ikon diubah menjadi dinamis berdasarkan slug --}}
                                    <i class="ti {{ $iconMap[$layanan->slug] ?? 'ti-file-text' }} service-icon"></i>
                                    <h6 class="fw-semibold">{{ $layanan->nama_layanan }}</h6>
                                    <p>{{ $layanan->deskripsi ?? 'Ajukan surat ini secara online.' }}</p>
                                    <a href="{{ route('public.pengajuan-surat.create', $layanan->slug) }}"
                                        class="btn btn-primary">
                                        Ajukan Sekarang
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Saat ini belum ada layanan surat yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
