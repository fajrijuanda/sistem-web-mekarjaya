@extends('layouts/layoutMaster')

{{-- Perhatikan bahwa title di sini akan diatur oleh JS jika JS berhasil mengambil data --}}
@section('title', 'Detail Artikel')

{{-- Vendor Styles --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/quill/typography.scss'])
@endsection

{{-- Page-specific Styles --}}
@section('page-style')
    <style>
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
    </style>
@endsection

{{-- Page-specific Scripts --}}
@section('page-script')
    @vite(['resources/assets/js/artikel-view.js']) {{-- Pastikan ini dimuat --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card p-4">
                <div class="card-body">
                    {{-- Judul Artikel --}}
                    <h1 class="mb-3" id="article-title">Memuat Judul Artikel...</h1>

                    {{-- Metadata Artikel --}}
                    <div class="article-meta mb-4">
                        <span class="badge bg-label-primary me-2" id="article-category-badge">Kategori</span>
                        <i class="ti ti-calendar-event me-1"></i>
                        <span id="article-date">Tanggal Publikasi</span>
                    </div>

                    {{-- Thumbnail Artikel --}}
                    <img id="article-thumbnail" src="" alt="Thumbnail Artikel"
                        class="img-fluid rounded mb-4 w-100 d-none">

                    {{-- Konten Artikel --}}
                    <div class="article-content" id="article-content">
                        <p class="text-muted">Memuat konten artikel...</p>
                    </div>

                    <hr class="my-5">

                    {{-- Tombol Kembali --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ url()->previous() }}" class="btn btn-label-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
