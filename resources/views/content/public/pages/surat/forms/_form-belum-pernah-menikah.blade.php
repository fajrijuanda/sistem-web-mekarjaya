{{--
    Formulir ini dirancang untuk SURAT KETERANGAN BELUM PERNAH MENIKAH.
    Semua data pribadi pemohon (NIK, Nama, Alamat, dll.) sudah diisi pada form utama.
    Bagian ini hanya untuk data tambahan yang spesifik untuk surat ini.
--}}

<h5 class="mt-4 fw-semibold">2. Keperluan Pembuatan Surat</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="keperluan">Keperluan</label>
        <textarea name="form_data[keperluan]" id="keperluan" class="form-control" rows="2"
            placeholder="Tuliskan tujuan pembuatan surat ini. Contoh: Untuk melamar pekerjaan." required>{{ old('form_data.keperluan') }}</textarea>
    </div>
</div>
