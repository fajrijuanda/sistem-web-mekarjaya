@extends('layouts/layoutMaster')

@section('title', 'Buat Artikel')

{{-- Vendor Styles --}}
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
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
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

{{-- Page-specific Scripts --}}
@section('page-script')
    {{-- Mengarah ke file JS terpisah yang baru --}}
    @vite(['resources/assets/js/artikel-editor.js'])
@endsection

@section('content')
    <div class="row g-4">

        <!-- Kolom Editor Utama -->
        <div class="col-12 col-lg-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Buat Artikel</h5>
                    <div class="d-flex gap-2">
                        <button id="save-draft-btn" class="btn btn-label-secondary">Simpan Draf</button>
                        <button id="publish-btn" class="btn btn-primary">Publikasikan</button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Thumbnail Image Area -->
                    <div id="thumbnail-container"
                        class="mb-4 p-4 border-dashed rounded-3 text-center cursor-pointer image-placeholder">
                        <div id="thumbnail-placeholder">
                            <i class="ti ti-photo-plus ti-2x text-muted"></i>
                            <p class="mt-2 text-sm text-heading">Klik untuk mengunggah <span class="fw-medium">Gambar
                                    Thumbnail</span></p>
                            <p class="text-xs text-muted">Rekomendasi ukuran 1200x800px</p>
                        </div>
                        <img id="thumbnail-preview" src="" class="d-none w-100 h-auto rounded-3 object-cover"
                            alt="Thumbnail Preview" />
                    </div>

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
                            <h2>Judul Artikel</h2>
                            <p><br></p>
                            <p>Ini adalah paragraf awal. Anda bisa mulai menulis di sini. Gunakan blok dari sidebar kanan
                                untuk menambahkan elemen lain seperti gambar atau sub judul lainnya.</p>
                        </div>
                    </div>
                </div>
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
                            <p class="text-muted small">Klik untuk menambahkan blok ke akhir artikel.</p>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button data-block-type="heading"
                                        class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                        <i class="ti ti-h-2 ti-lg mb-1"></i>
                                        <span class="fs-xs">Sub Judul</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button data-block-type="image"
                                        class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                        <i class="ti ti-photo ti-lg mb-1"></i>
                                        <span class="fs-xs">Gambar</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button data-block-type="quote"
                                        class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                        <i class="ti ti-quote ti-lg mb-1"></i>
                                        <span class="fs-xs">Kutipan</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button data-block-type="list"
                                        class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                        <i class="ti ti-list-numbers ti-lg mb-1"></i>
                                        <span class="fs-xs">Daftar</span>
                                    </button>
                                </div>
                                <div class="col-12">
                                    <hr class="my-2">
                                </div>
                                <div class="col-6">
                                    <button data-block-type="image-text-left"
                                        class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center w-100 p-3 block-btn">
                                        <i class="ti ti-layout-sidebar-right ti-lg mb-1"></i>
                                        <span class="fs-xs">Gambar Kiri</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button data-block-type="image-text-right"
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
                                    <label for="slug" class="form-label">URL Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="judul-artikel-ini">
                                </div>
                                <div>
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select id="kategori" name="kategori" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="Berita Desa">Berita Desa</option>
                                        <option value="Pengumuman">Pengumuman</option>
                                        <option value="UMKM">UMKM</option>
                                        <option value="Kesehatan">Kesehatan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Status</label>
                                    <div class="form-check">
                                        <input id="status-publish" name="status" type="radio" checked
                                            class="form-check-input">
                                        <label for="status-publish" class="form-check-label">Publikasikan</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="status-draft" name="status" type="radio" class="form-check-input">
                                        <label for="status-draft" class="form-check-label">Simpan sebagai Draf</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden file input -->
    <input type="file" id="image-upload-input" class="d-none" accept="image/*">
    <input type="file" id="thumbnail-upload-input" class="d-none" accept="image/*">
@endsection
