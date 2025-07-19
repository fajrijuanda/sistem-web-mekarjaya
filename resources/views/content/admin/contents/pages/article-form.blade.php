@php
    // Tentukan apakah kita dalam mode edit atau create
    $isEdit = $article->exists;
@endphp

@extends('layouts/layoutMaster')

@section('title', $isEdit ? 'Edit Artikel' : 'Buat Artikel Baru')
{{-- Vendor Styles --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

{{-- Page-specific Styles --}}
@section('page-style')
    @push('page-style')
        <style>
            .image-placeholder {
                transition: all 0.2s ease-in-out;
                border: 2px dashed #d9dee3;
                /* Warna border dari template */
            }

            .image-placeholder:hover {
                border-color: #696cff;
                /* Warna primary */
                background-color: #f5f5f9;
            }

            /* Mengatur tinggi editor Quill */
            #quill-editor-container .ql-editor {
                min-height: 450px;
            }

            /* Styling untuk blok konten di sidebar */
            .block-btn {
                transition: all 0.2s ease-in-out;
                height: 100%;
            }
        </style>
    @endpush
@endsection

{{-- Vendor Scripts --}}
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

{{-- Page-specific Scripts --}}
@section('page-script')
    {{-- Mengarah ke file JS terpisah yang baru --}}
    @vite(['resources/assets/js/article-editor.js'])
@endsection

@section('content')
    <form id="article-form"
        action="{{ $isEdit ? route('admin.article.update', $article->slug) : route('admin.article.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row g-4">

            <!-- Kolom Editor Utama -->
            <div class="col-12 col-lg-8">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{-- ✅ JUDUL DINAMIS --}}
                        <h5 class="mb-0">{{ $isEdit ? 'Edit Artikel' : 'Buat Artikel Baru' }}</h5>
                        <div class="d-flex gap-2">
                            <button type="submit" id="save-draft-btn" class="btn btn-label-secondary">Simpan Draf</button>
                            {{-- ✅ TEKS TOMBOL DINAMIS --}}
                            <button type="submit" id="publish-btn"
                                class="btn btn-primary">{{ $isEdit ? 'Perbarui' : 'Publikasikan' }}</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="title" class="form-label fs-5">Judul Artikel</label>
                            {{-- ✅ VALUE DINAMIS: Menggunakan old() helper dengan data default dari model --}}
                            <input type="text" name="title" id="title"
                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                placeholder="Ketik judul artikel di sini..." value="{{ old('title', $article->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Thumbnail Image Area -->
                        <label class="form-label">Thumbnail</label>
                        <div id="thumbnail-container"
                            class="p-4 border-dashed rounded-3 text-center cursor-pointer image-placeholder mb-3">
                            {{-- ✅ Tampilkan placeholder atau gambar yang sudah ada --}}
                            <div id="thumbnail-placeholder" class="{{ $article->thumbnail ? 'd-none' : '' }}">
                                <i class="ti ti-photo-plus ti-2x text-muted"></i>
                                <p class="mt-2 text-sm text-heading">Klik untuk mengunggah/mengubah thumbnail</p>
                            </div>
                            <img id="thumbnail-preview" src="{{ $article->thumbnail_url }}"
                                class="{{ $article->thumbnail ? '' : 'd-none' }} w-100 h-auto rounded-3"
                                alt="Thumbnail Preview" />
                        </div>
                        @error('thumbnail')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror


                        <!-- Quill Snow Editor -->
                        <div id="quill-editor-container">
                            <div id="quill-toolbar">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-link"></button>
                                    <button class="ql-image"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-align" value=""></button>
                                    <button class="ql-align" value="center"></button>
                                    <button class="ql-align" value="right"></button>
                                    <button class="ql-align" value="justify"></button>
                                </span>
                            </div>
                            <div id="quill-editor">
                                @if (old('content'))
                                    {!! old('content') !!}
                                @elseif($isEdit)
                                    {!! $article->content !!}
                                @else
                                    {{-- Konten default hanya untuk mode 'create' --}}
                                    <h3>Sub Judul</h3>
                                    <p>Ini adalah paragraf awal. Anda bisa mulai menulis di sini. Gunakan blok dari sidebar
                                        kanan untuk menambahkan elemen lain seperti gambar atau sub judul lainnya.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @error('content')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Sidebar Kanan -->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#panel-blok" aria-controls="panel-blok" aria-selected="true">Blok
                                    Konten</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#panel-pengaturan" aria-controls="panel-pengaturan"
                                    aria-selected="false">Pengaturan</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Content Blocks Panel -->
                            <div class="tab-pane fade show active" id="panel-blok" role="tabpanel">
                                <p class="text-muted small">Klik untuk menambahkan blok ke akhir article.</p>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" data-block-type="heading"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-h-2 ti-lg mb-1"></i>
                                            <span class="fs-xs">Sub Judul</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" data-block-type="image"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-photo ti-lg mb-1"></i>
                                            <span class="fs-xs">Gambar</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" data-block-type="quote"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-quote ti-lg mb-1"></i>
                                            <span class="fs-xs">Kutipan</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" data-block-type="list"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-list-numbers ti-lg mb-1"></i>
                                            <span class="fs-xs">Daftar</span>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-6">
                                        <button type="button" data-block-type="image-text-left"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-layout-sidebar-right ti-lg mb-1"></i>
                                            <span class="fs-xs">Gambar Kiri</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" data-block-type="image-text-right"
                                            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                            <i class="ti ti-layout-sidebar ti-lg mb-1"></i>
                                            <span class="fs-xs">Gambar Kanan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Settings Panel -->
                            <div class="tab-pane fade" id="panel-pengaturan" role="tabpanel">
                                <div class="d-flex flex-column gap-4">
                                    <div>
                                        <label for="category" class="form-label">Kategori</label>
                                        <select id="category" name="category" class="select2 form-select">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Berita Desa" @selected(old('category', $article->category) == 'Berita Desa')>Berita Desa</option>
                                            <option value="Pengumuman" @selected(old('category', $article->category) == 'Pengumuman')>Pengumuman</option>
                                            <option value="UMKM" @selected(old('category', $article->category) == 'UMKM')>UMKM</option>
                                            <option value="Kesehatan" @selected(old('category', $article->category) == 'Kesehatan')>Kesehatan</option>
                                            <option value="Kegiatan" @selected(old('category', $article->category) == 'Kegiatan')>Kegiatan</option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ✅ 4. INPUT TERSEMBUNYI DAN INPUT FILE DENGAN ATRIBUT 'NAME' --}}
            <input type="hidden" name="content" id="quill-content-input">
            <input type="hidden" name="status" id="status-input">
            <input type="file" name="thumbnail" id="thumbnail-upload-input" class="d-none" accept="image/*">
            <input type="file" id="image-upload-input" class="d-none" accept="image/*">
    </form>
@endsection
