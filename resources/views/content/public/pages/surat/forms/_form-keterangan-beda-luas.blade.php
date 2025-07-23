{{--
    Formulir ini dirancang untuk Surat Keterangan Beda Luas Tanah.
--}}

<h5 class="mt-4">2. Data Tanah Sesuai Catatan Resmi</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][nama_tercatat]">Nama Tercatat</label>
        <input type="text" id="form_data[tanah][nama_tercatat]" name="form_data[tanah][nama_tercatat]" class="form-control" placeholder="Nama yang tertera pada catatan" value="{{ old('form_data.tanah.nama_tercatat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][status_hak]">Status Hak Tanah</label>
        <input type="text" id="form_data[tanah][status_hak]" name="form_data[tanah][status_hak]" class="form-control" placeholder="Contoh: Tanah Hak Milik Adat" value="{{ old('form_data.tanah.status_hak', 'Tanah Hak Milik Adat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][dasar_catatan]">Dasar Catatan</label>
        <input type="text" id="form_data[tanah][dasar_catatan]" name="form_data[tanah][dasar_catatan]" class="form-control" placeholder="Contoh: Buku DHKP" value="{{ old('form_data.tanah.dasar_catatan', 'Buku DHKP') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah][nomor_catatan]">Nomor pada Catatan</label>
        <input type="text" id="form_data[tanah][nomor_catatan]" name="form_data[tanah][nomor_catatan]" class="form-control" placeholder="Nomor pada DHKP/Girik/dll" value="{{ old('form_data.tanah.nomor_catatan') }}" required />
    </div>
     <div class="col-12">
        <label class="form-label" for="form_data[tanah][lokasi]">Lokasi Tanah</label>
        <textarea name="form_data[tanah][lokasi]" id="form_data[tanah][lokasi]" class="form-control" rows="2" placeholder="Tuliskan lokasi lengkap tanah (Kampung, RT/RW, Desa, Kecamatan)" required>{{ old('form_data.tanah.lokasi') }}</textarea>
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

<h5 class="mt-4">3. Detail Perbedaan Luas</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[luas][tercatat]">Luas Tercatat di SPPT</label>
        <input type="text" id="form_data[luas][tercatat]" name="form_data[luas][tercatat]" class="form-control" placeholder="Contoh: 12.461 M2" value="{{ old('form_data.luas.tercatat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[luas][sebenarnya]">Luas Sebenarnya (Hasil Ukur)</label>
        <input type="text" id="form_data[luas][sebenarnya]" name="form_data[luas][sebenarnya]" class="form-control" placeholder="Contoh: 12.660 M2" value="{{ old('form_data.luas.sebenarnya') }}" required />
    </div>
    <div class="col-12">
        <div class="form-text">
            Sistem akan otomatis menghitung selisih dari kedua luas yang Anda masukkan.
        </div>
    </div>
</div>