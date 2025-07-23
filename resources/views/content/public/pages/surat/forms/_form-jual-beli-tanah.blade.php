{{--
    Formulir ini dirancang untuk Surat Pernyataan Jual Beli Tanah (Pra-Akte).
    Data pemohon utama (NIK & Nama) diasumsikan sebagai data Pihak Pertama (Penjual).
--}}

<h5 class="mt-4">2. Data Pihak Pertama (Penjual)</h5>
<div class="alert alert-info p-2" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    Data NIK dan Nama Lengkap Penjual telah diisi dari form sebelumnya.
</div>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[penjual][tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[penjual][tempat_lahir]" name="form_data[penjual][tempat_lahir]" class="form-control" placeholder="Sesuai KTP" value="{{ old('form_data.penjual.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[penjual][tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[penjual][tanggal_lahir]" name="form_data[penjual][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.penjual.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[penjual][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[penjual][pekerjaan]" name="form_data[penjual][pekerjaan]" class="form-control" placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.penjual.pekerjaan') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[penjual][agama]">Agama</label>
        <input type="text" id="form_data[penjual][agama]" name="form_data[penjual][agama]" class="form-control" placeholder="Contoh: Islam" value="{{ old('form_data.penjual.agama') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[penjual][alamat]">Alamat</label>
        <textarea name="form_data[penjual][alamat]" id="form_data[penjual][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.penjual.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Pihak Kedua (Pembeli)</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[pembeli][nama]">Nama Lengkap</label>
        <input type="text" id="form_data[pembeli][nama]" name="form_data[pembeli][nama]" class="form-control" placeholder="Nama lengkap pembeli" value="{{ old('form_data.pembeli.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pembeli][tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[pembeli][tempat_lahir]" name="form_data[pembeli][tempat_lahir]" class="form-control" placeholder="Sesuai KTP" value="{{ old('form_data.pembeli.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pembeli][tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[pembeli][tanggal_lahir]" name="form_data[pembeli][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.pembeli.tanggal_lahir') }}" required />
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[pembeli][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pembeli][pekerjaan]" name="form_data[pembeli][pekerjaan]" class="form-control" placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.pembeli.pekerjaan') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pembeli][agama]">Agama</label>
        <input type="text" id="form_data[pembeli][agama]" name="form_data[pembeli][agama]" class="form-control" placeholder="Contoh: Islam" value="{{ old('form_data.pembeli.agama') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pembeli][alamat]">Alamat</label>
        <textarea name="form_data[pembeli][alamat]" id="form_data[pembeli][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.pembeli.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Data Tanah dan Detail Transaksi</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Tanggal Transaksi</label>
    </div>
    <div class="col-md-3 col-6">
        <select class="form-select" name="form_data[transaksi][hari]" required>
            <option value="" disabled selected>Pilih Hari</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
        </select>
    </div>
     <div class="col-md-3 col-6">
        <input type="text" name="form_data[transaksi][tanggal_angka]" class="form-control" placeholder="Tgl (Angka)" required>
    </div>
    <div class="col-md-3 col-6">
        <input type="text" name="form_data[transaksi][tanggal_terbilang]" class="form-control" placeholder="Tgl (Terbilang)" required>
    </div>
    <div class="col-md-3 col-6">
        <input type="text" name="form_data[transaksi][bulan]" class="form-control" placeholder="Bulan" required>
    </div>
    <div class="col-md-3 col-6">
        <input type="text" name="form_data[transaksi][tahun_angka]" class="form-control" placeholder="Tahun (Angka)" required>
    </div>
     <div class="col-md-3 col-6">
        <input type="text" name="form_data[transaksi][tahun_terbilang]" class="form-control" placeholder="Tahun (Terbilang)" required>
    </div>
    <div class="col-md-6">
        <label class="form-label mt-3" for="form_data[objek][luas]">Luas Tanah</label>
        <input type="text" id="form_data[objek][luas]" name="form_data[objek][luas]" class="form-control" placeholder="Contoh: 150 M²" value="{{ old('form_data.objek.luas') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label mt-3" for="form_data[objek][no_sertifikat]">Nomor Sertifikat/Girik</label>
        <input type="text" id="form_data[objek][no_sertifikat]" name="form_data[objek][no_sertifikat]" class="form-control" placeholder="Nomor bukti kepemilikan" value="{{ old('form_data.objek.no_sertifikat') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[objek][lokasi]">Lokasi Tanah</label>
        <textarea name="form_data[objek][lokasi]" id="form_data[objek][lokasi]" class="form-control" rows="2" placeholder="Lokasi/alamat lengkap tanah" required>{{ old('form_data.objek.lokasi') }}</textarea>
    </div>

    <div class="col-12"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_utara]" class="form-control" placeholder="Batas Utara" value="{{ old('form_data.objek.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_timur]" class="form-control" placeholder="Batas Timur" value="{{ old('form_data.objek.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_selatan]" class="form-control" placeholder="Batas Selatan" value="{{ old('form_data.objek.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_barat]" class="form-control" placeholder="Batas Barat" value="{{ old('form_data.objek.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">5. Data Saksi-Saksi</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1_nama]">Nama Saksi 1</label>
        <input type="text" id="form_data[saksi_1_nama]" name="form_data[saksi_1_nama]" class="form-control" placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2_nama]">Nama Saksi 2</label>
        <input type="text" id="form_data[saksi_2_nama]" name="form_data[saksi_2_nama]" class="form-control" placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
</div>