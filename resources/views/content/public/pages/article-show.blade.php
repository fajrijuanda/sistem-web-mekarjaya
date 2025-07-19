@php
    $configData = Helper::appClasses();

    // ✅ LANGKAH 1: Definisikan pemetaan warna untuk setiap category
    $categoryBadges = [
        'Berita Desa' => 'bg-label-primary',
        'Kesehatan' => 'bg-label-danger',
        'UMKM' => 'bg-label-success',
        'Pengumuman' => 'bg-label-info',
        'Kegiatan' => 'bg-label-warning',
    ];
@endphp

@extends('layouts/layoutMaster')

{{-- Perhatikan bahwa title di sini akan diatur oleh JS jika JS berhasil mengambil data --}}
@section('title', $article->title)
{{-- Vendor Styles --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/quill/typography.scss'])
@endsection

{{-- Page-specific Styles --}}
@section('page-style')
    <style>
        .article-view-container {
            margin-top: 5rem;
            /* Sesuaikan nilai ini dengan tinggi navbar Anda */
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 1em;
        }

        .article-content img[style*="float: left"] {
            float: left;
            margin: 0 1em 1em 0;
        }

        .article-content img[style*="float: right"] {
            float: right;
            margin: 0 0 1em 1em;
        }

        .article-content blockquote {
            border-left: 4px solid #696cff;
            padding-left: 1em;
            margin: 1em 0;
            font-style: italic;
            color: #566a7f;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .article-content p {
            margin-bottom: 1em;
            line-height: 1.6;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1em;
            padding-left: 1.5em;
        }

        .article-meta {
            font-size: 0.875em;
            color: #828a99;
        }

        .article-thumbnail {
            max-height: 500px;
            /* 保持最大高度限制 */
            width: 100%;
            /* 图片宽度撑满父容器 */
            object-fit: cover;
            /* 保持图片比例，超出部分裁剪 */
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            /* 增加底部外边距 */
        }

        /* ✅ TAMBAHKAN KODE DI BAWAH INI */
        @media (max-width: 767.98px) {
            #article-title {
                font-size: 1.75rem;
                /* Sesuaikan nilainya agar pas */
                line-height: 1.3;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y mt-10">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">

                @if ($article)
                    <div class="card shadow-sm">
                        <div class="card-body p-4 p-md-5">

                            {{-- Header Artikel: Judul & Metadata --}}
                            <div class="article-header"> {{-- Pusatkan metadata --}}
                                <h1 class="article-title mb-3">{{ $article->title }}</h1>
                                <div class="article-meta d-flex justify-content-left flex-wrap gap-3 align-items-center">

                                    {{-- KATEGORI DENGAN WARNA DINAMIS --}}
                                    <a href="{{ route('public.article.index', ['category' => $article->category]) }}"
                                        class="badge rounded-pill {{ $categoryBadges[$article->category] ?? 'bg-label-secondary' }}">
                                        {{ $article->category }}
                                    </a>

                                    {{-- METADATA LAINNYA --}}
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-user-circle ti-sm me-1"></i>Oleh:
                                        {{ $article->user->name ?? 'Admin' }}
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i
                                            class="ti ti-calendar-event ti-sm me-1"></i>{{ $article->formatted_published_date }}
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-eye ti-sm me-1"></i>{{ number_format($article->views) }} Dilihat
                                    </span>
                                </div>
                            </div>

                            {{-- Thumbnail Artikel (jika ada) --}}
                            @if ($article->thumbnail)
                                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                    class="article-thumbnail my-4">
                            @endif

                            {{-- Konten Artikel --}}
                            <div class="article-content ql-snow mt-4">
                                <div class="ql-editor p-0">
                                    {!! $article->content !!}
                                </div>
                            </div>

                            {{-- Tombol Kembali --}}
                            <div class="text-center back-to-list-btn">
                                <a href="{{ route('public.article.index') }}" class="btn btn-outline-primary">
                                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar Artikel
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Tampilan jika artikel tidak ditemukan --}}
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <h4 class="mb-3">Artikel Tidak Ditemukan</h4>
                            <p class="text-muted">Maaf, artikel yang Anda cari tidak tersedia.</p>
                            <a href="{{ route('public.article.index') }}" class="btn btn-primary">Kembali ke Daftar
                                Artikel</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
