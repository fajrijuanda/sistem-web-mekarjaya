{{--
    Formulir ini dirancang untuk Surat Pernyataan Kepemilikan Tanah.
    Data pemohon utama (NIK & Nama) diasumsikan sebagai data Pihak yang Membuat Pernyataan.
--}}

<div class="alert alert-info p-2 mt-4" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    Data diri Anda sebagai pemilik tanah (Nama, NIK, Alamat, dll.) diambil dari form "1. Data Diri Pemohon".
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">2. Data Tanah yang Dimiliki</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="tanah_jenis">Jenis Tanah</label>
        <input type="text" id="tanah_jenis" name="form_data[tanah][jenis]" class="form-control"
            placeholder="Contoh: Tanah Sawah/Darat" value="{{ old('form_data.tanah.jenis', 'Tanah Sawah/Darat') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="tanah_luas">Luas Tanah</label>
        <input type="text" id="tanah_luas" name="form_data[tanah][luas]" class="form-control"
            placeholder="Contoh: 128 M²" value="{{ old('form_data.tanah.luas') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="tanah_sppt">No. SPPT</label>
        <input type="text" id="tanah_sppt" name="form_data[tanah][sppt]" class="form-control"
            placeholder="Nomor SPPT" value="{{ old('form_data.tanah.sppt') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="tanah_blok">Blok</label>
        <input type="text" id="tanah_blok" name="form_data[tanah][blok]" class="form-control"
            placeholder="Nomor Blok" value="{{ old('form_data.tanah.blok') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="tanah_lokasi">Lokasi Lengkap Tanah</label>
        <textarea name="form_data[tanah][lokasi]" id="tanah_lokasi" class="form-control" rows="2"
            placeholder="Tuliskan lokasi lengkap tanah (Kampung, RT/RW, Desa, Kecamatan, Kabupaten)" required>{{ old('form_data.tanah.lokasi') }}</textarea>
    </div>

    <div class="col-12 mt-4"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_utara]" class="form-control" placeholder="Batas Utara"
            value="{{ old('form_data.tanah.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_timur]" class="form-control" placeholder="Batas Timur"
            value="{{ old('form_data.tanah.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_selatan]" class="form-control" placeholder="Batas Selatan"
            value="{{ old('form_data.tanah.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_barat]" class="form-control" placeholder="Batas Barat"
            value="{{ old('form_data.tanah.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Konfirmasi</h5>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="konfirmasi_pernyataan"
        name="konfirmasi_pernyataan" required>
    <label class="form-check-label" for="konfirmasi_pernyataan">
        Saya menyatakan surat pernyataan ini dibuat dengan sebenarnya, dan apabila pernyataan ini tidak benar saya siap
        dituntut sesuai peraturan perundang-undangan yang berlaku.
    </label>
</div>
