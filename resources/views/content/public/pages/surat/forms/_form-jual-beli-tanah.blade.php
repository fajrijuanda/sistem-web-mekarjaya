{{--
    Formulir ini dirancang untuk Surat Pernyataan Jual Beli Tanah (Pra-Akte).
    Data pemohon utama (NIK & Nama) diasumsikan sebagai data Pihak Pertama (Penjual).
--}}

<h5 class="mt-4 fw-semibold">2. Data Pihak Kedua (Pembeli)</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="pembeli_nama">Nama Lengkap</label>
        <input type="text" id="pembeli_nama" name="form_data[pembeli][nama]" class="form-control"
            placeholder="Nama lengkap pembeli" value="{{ old('form_data.pembeli.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pembeli_tempat_lahir">Tempat Lahir</label>
        <input type="text" id="pembeli_tempat_lahir" name="form_data[pembeli][tempat_lahir]" class="form-control"
            placeholder="Sesuai KTP" value="{{ old('form_data.pembeli.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pembeli_tanggal_lahir">Tanggal Lahir</label>
        <input type="text" id="pembeli_tanggal_lahir" name="form_data[pembeli][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pembeli.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pembeli_pekerjaan">Pekerjaan</label>
        <input type="text" id="pembeli_pekerjaan" name="form_data[pembeli][pekerjaan]" class="form-control"
            placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.pembeli.pekerjaan') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pembeli_agama">Agama</label>
        <input type="text" id="pembeli_agama" name="form_data[pembeli][agama]" class="form-control"
            placeholder="Contoh: Islam" value="{{ old('form_data.pembeli.agama') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="pembeli_alamat">Alamat</label>
        <textarea name="form_data[pembeli][alamat]" id="pembeli_alamat" class="form-control" rows="2"
            placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.pembeli.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Data Tanah dan Detail Transaksi</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Tanggal Transaksi</label>
        <input type="text" name="form_data[transaksi][tanggal]" class="form-control flatpickr-date"
            placeholder="Pilih Tanggal Transaksi" value="{{ old('form_data.transaksi.tanggal') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label mt-3" for="objek_luas">Luas Tanah</label>
        <input type="text" id="objek_luas" name="form_data[objek][luas]" class="form-control"
            placeholder="Contoh: 150 M²" value="{{ old('form_data.objek.luas') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label mt-3" for="objek_no_sertifikat">Nomor Sertifikat/Girik</label>
        <input type="text" id="objek_no_sertifikat" name="form_data[objek][no_sertifikat]" class="form-control"
            placeholder="Nomor bukti kepemilikan" value="{{ old('form_data.objek.no_sertifikat') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="objek_lokasi">Lokasi Tanah</label>
        <textarea name="form_data[objek][lokasi]" id="objek_lokasi" class="form-control" rows="2"
            placeholder="Lokasi/alamat lengkap tanah" required>{{ old('form_data.objek.lokasi') }}</textarea>
    </div>

    <div class="col-12"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_utara]" class="form-control" placeholder="Batas Utara"
            value="{{ old('form_data.objek.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_timur]" class="form-control" placeholder="Batas Timur"
            value="{{ old('form_data.objek.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_selatan]" class="form-control"
            placeholder="Batas Selatan" value="{{ old('form_data.objek.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_barat]" class="form-control" placeholder="Batas Barat"
            value="{{ old('form_data.objek.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">4. Data Saksi-Saksi</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_nama">Nama Saksi 1</label>
        <input type="text" id="saksi_1_nama" name="form_data[saksi_1_nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_nama">Nama Saksi 2</label>
        <input type="text" id="saksi_2_nama" name="form_data[saksi_2_nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
</div>
