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
@push('page-script')
    {{-- ✅ SEMATKAN DATA DARI PHP KE JAVASCRIPT DI SINI --}}
    <script>
        // Data artikel dari controller diubah menjadi objek JSON
        const articleData = @json($article->load('user'));
    </script>

    {{-- Muat file JS utama Anda setelah data disematkan --}}
    @vite(['resources/assets/js/article-view.js'])
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    {{-- Tampilkan thumbnail jika ada --}}
                    @if ($article->thumbnail)
                        <img src="{{ $article->thumbnail_url }}" alt="Thumbnail Artikel" class="img-fluid rounded mb-4 w-100"
                            style="max-height: 450px; object-fit: cover;">
                    @endif

                    {{-- Tampilkan metadata --}}
                    <div class="article-meta mb-3">
                        <span class="badge bg-label-primary me-2">{{ $article->category }}</span>
                        <i class="ti ti-calendar-event me-1"></i>
                        <span>{{ $article->formatted_published_date }}</span>
                        <span class="mx-2">|</span>
                        <i class="ti ti-user-circle me-1"></i>
                        <span>Oleh: {{ $article->user->name ?? 'Admin' }}</span>
                        <span class="mx-2">|</span>
                        <i class="ti ti-eye me-1"></i>
                        <span>{{ number_format($article->views) }} Dilihat</span>
                    </div>

                    {{-- Tampilkan judul --}}
                    <h1 class="mb-4">{{ $article->title }}</h1>

                    {{-- Tampilkan konten artikel --}}
                    <div class="article-content ql-snow">
                        <div class="ql-editor p-0">
                            {!! $article->content !!}
                        </div>
                    </div>

                    <hr class="my-5">

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.article.index') }}" class="btn btn-label-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                        <a href="{{ route('admin.article.edit', $article) }}" class="btn btn-primary">
                            <i class="ti ti-pencil me-1"></i> Edit Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
