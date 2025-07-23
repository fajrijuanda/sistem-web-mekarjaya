{{--
    Formulir ini dirancang untuk Surat Pernyataan Kepemilikan Tanah.
    Data pemohon utama (NIK & Nama) diasumsikan sebagai data Pihak yang Membuat Pernyataan.
--}}

<h5 class="mt-4">2. Data Pembuat Pernyataan</h5>
<div class="alert alert-info p-2" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    Data NIK dan Nama Lengkap diambil dari data pengajuan utama.
</div>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][umur]">Umur</label>
        <input type="number" id="form_data[pemohon][umur]" name="form_data[pemohon][umur]" class="form-control" placeholder="Umur dalam tahun" value="{{ old('form_data.pemohon.umur') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[pemohon][jenis_kelamin]" name="form_data[pemohon][jenis_kelamin]" required>
             <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" @if(old('form_data.pemohon.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if(old('form_data.pemohon.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pemohon][pekerjaan]" name="form_data[pemohon][pekerjaan]" class="form-control" placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.pemohon.pekerjaan') }}" required />
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][agama]">Agama</label>
        <input type="text" id="form_data[pemohon][agama]" name="form_data[pemohon][agama]" class="form-control" placeholder="Contoh: Islam" value="{{ old('form_data.pemohon.agama') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pemohon][alamat]">Alamat</label>
        <textarea name="form_data[pemohon][alamat]" id="form_data[pemohon][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.pemohon.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Tanah yang Dimiliki</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][jenis]">Jenis Tanah</label>
        <input type="text" id="form_data[tanah][jenis]" name="form_data[tanah][jenis]" class="form-control" placeholder="Contoh: Tanah Sawah/Darat" value="{{ old('form_data.tanah.jenis', 'Tanah Sawah/Darat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][luas]">Luas Tanah</label>
        <input type="text" id="form_data[tanah][luas]" name="form_data[tanah][luas]" class="form-control" placeholder="Contoh: 128 M²" value="{{ old('form_data.tanah.luas') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][sppt]">No. SPPT</label>
        <input type="text" id="form_data[tanah][sppt]" name="form_data[tanah][sppt]" class="form-control" placeholder="Nomor SPPT" value="{{ old('form_data.tanah.sppt') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][blok]">Blok</label>
        <input type="text" id="form_data[tanah][blok]" name="form_data[tanah][blok]" class="form-control" placeholder="Nomor Blok" value="{{ old('form_data.tanah.blok') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[tanah][lokasi]">Lokasi Lengkap Tanah</label>
        <textarea name="form_data[tanah][lokasi]" id="form_data[tanah][lokasi]" class="form-control" rows="2" placeholder="Tuliskan lokasi lengkap tanah (Kampung, RT/RW, Desa, Kecamatan, Kabupaten)" required>{{ old('form_data.tanah.lokasi') }}</textarea>
    </div>

    <div class="col-12 mt-4"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_utara]" class="form-control" placeholder="Batas Utara" value="{{ old('form_data.tanah.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_timur]" class="form-control" placeholder="Batas Timur" value="{{ old('form_data.tanah.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_selatan]" class="form-control" placeholder="Batas Selatan" value="{{ old('form_data.tanah.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah][batas_barat]" class="form-control" placeholder="Batas Barat" value="{{ old('form_data.tanah.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Konfirmasi</h5>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="konfirmasi_pernyataan" name="konfirmasi_pernyataan" required>
    <label class="form-check-label" for="konfirmasi_pernyataan">
        Saya menyatakan surat pernyataan ini dibuat dengan sebenarnya, dan apabila pernyataan ini tidak benar saya siap dituntut sesuai peraturan perundang-undangan yang berlaku.
    </label>
</div>