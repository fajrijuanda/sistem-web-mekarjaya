{{--
    File Pemandu (Loader) untuk Formulir Surat Spesifik
    ----------------------------------------------------
    File ini berisi logika untuk memuat file view formulir yang sesuai
    berdasarkan 'slug' dari layanan yang dipilih.
--}}

@php
    $slug = $layanan->slug;
    // Menentukan path dasar untuk semua file form parsial agar lebih ringkas
    $basePath = 'content.public.pages.surat.forms.';
@endphp

{{-- ======================================================================= --}}
{{-- == BAGIAN INTI: KONDISI UNTUK MEMUAT FORM YANG SESUAI == --}}
{{-- ======================================================================= --}}

@if ($slug === 'surat-domisili')
    @include($basePath . '_form-surat-domisili')
@elseif ($slug === 'surat-kelahiran')
    @include($basePath . '_form-surat-kelahiran')
@elseif ($slug === 'surat-kematian')
    @include($basePath . '_form-surat-kematian')
@elseif ($slug === 'surat-sudah-menikah')
    @include($basePath . '_form-surat-sudah-menikah')
@elseif ($slug === 'surat-belum-pernah-menikah')
    @include($basePath . '_form-belum-pernah-menikah')
@elseif ($slug === 'pengantar-skck')
    @include($basePath . '_form-pengantar-skck')
@elseif ($slug === 'surat-keterangan-usaha')
    @include($basePath . '_form-surat-usaha')
@elseif ($slug === 'surat-domisili-usaha')
    @include($basePath . '_form-surat-domisili-usaha')
@elseif ($slug === 'surat-tidak-mampu')
    @include($basePath . '_form-tidak-mampu')
@elseif ($slug === 'pernyataan-tidak-keberatan')
    @include($basePath . '_form-pernyataan-tidak-keberatan')
@else
    {{-- Fallback jika form untuk layanan yang valid belum dibuat --}}
    <hr class="my-4">
    <div class="alert alert-warning text-center mt-4" role="alert">
        <h5 class="alert-heading mb-2"><i class="ti ti-alert-triangle-filled ti-lg me-2"></i> Formulir Belum Tersedia</h5>
        <p class="mb-0">Formulir spesifik untuk layanan ini sedang dalam pengembangan.</p>
    </div>
@endif
