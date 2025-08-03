{{--
    Formulir ini dirancang berdasarkan data dari file Excel SURAT KETERANGAN KEMATIAN.
    Data Pelapor (NIK dan Nama) diambil dari form utama "1. Data Diri Pemohon".
--}}

<hr class="my-4" />
<h5 class="mt-4 fw-semibold">2. Data Jenazah</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="jenazah_nik">NIK Jenazah</label>
        <input type="text" id="jenazah_nik" name="form_data[jenazah][nik]" class="form-control"
            placeholder="16 Digit NIK Jenazah" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_nama">Nama Lengkap Jenazah</label>
        <input type="text" id="jenazah_nama" name="form_data[jenazah][nama_lengkap]" class="form-control"
            placeholder="Nama Sesuai KTP" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_jenis_kelamin">Jenis Kelamin</label>
        <select class="form-select" name="form_data[jenazah][jenis_kelamin]" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_tanggal_lahir">Tanggal Lahir</label>
        <input type="text" name="form_data[jenazah][tanggal_lahir]" class="form-control flatpickr-date"
            placeholder="YYYY-MM-DD" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_tempat_lahir">Tempat Lahir</label>
        <input type="text" name="form_data[jenazah][tempat_lahir]" class="form-control"
            placeholder="Kota/Kabupaten Kelahiran" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_agama">Agama</label>
        <input type="text" name="form_data[jenazah][agama]" class="form-control" placeholder="Agama Jenazah"
            required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="jenazah_pekerjaan">Pekerjaan Terakhir</label>
        <input type="text" name="form_data[jenazah][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Terakhir Jenazah" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="jenazah_alamat">Alamat Terakhir</label>
        <textarea name="form_data[jenazah][alamat]" class="form-control" rows="2" placeholder="Alamat Terakhir Jenazah"
            required></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_anak_ke">Anak Ke-</label>
        <input type="number" name="form_data[jenazah][anak_ke]" class="form-control" placeholder="1, 2, 3..."
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_tanggal_kematian">Tanggal Kematian</label>
        <input type="text" name="form_data[jenazah][tanggal_kematian]" class="form-control flatpickr-date"
            placeholder="YYYY-MM-DD" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_waktu_kematian">Pukul (Waktu Kematian)</label>
        <input type="time" name="form_data[jenazah][waktu_kematian]" class="form-control" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_sebab_kematian">Sebab Kematian</label>
        <select class="form-select" name="form_data[jenazah][sebab_kematian]" required>
            <option value="Sakit biasa / Tua">Sakit biasa / Tua</option>
            <option value="Wabah Penyakit">Wabah Penyakit</option>
            <option value="Kecelakaan">Kecelakaan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_tempat_kematian">Tempat Kematian</label>
        <input type="text" name="form_data[jenazah][tempat_kematian]" class="form-control"
            placeholder="Contoh: Rumah Sakit, Rumah" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenazah_yang_menerangkan">Yang Menerangkan</label>
        <select class="form-select" name="form_data[jenazah][yang_menerangkan]" required>
            <option value="Dokter">Dokter</option>
            <option value="Tenaga Kesehatan">Tenaga Kesehatan</option>
            <option value="Kepolisian">Kepolisian</option>
            <option value="Lainnya">Lainnya</option>
        </select>
    </div>
</div>

<hr class="my-4" />
<h5 class="mt-4 fw-semibold">3. Data Ayah Kandung Jenazah</h5>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="ayah_nik">NIK Ayah</label><input type="text"
            name="form_data[ayah][nik]" class="form-control" placeholder="16 Digit NIK Ayah" required /></div>
    <div class="col-md-6"><label class="form-label" for="ayah_nama">Nama Lengkap Ayah</label><input type="text"
            name="form_data[ayah][nama_lengkap]" class="form-control" placeholder="Nama Ayah" required /></div>
</div>

<hr class="my-4" />
<h5 class="mt-4 fw-semibold">4. Data Ibu Kandung Jenazah</h5>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="ibu_nik">NIK Ibu</label><input type="text"
            name="form_data[ibu][nik]" class="form-control" placeholder="16 Digit NIK Ibu" required /></div>
    <div class="col-md-6"><label class="form-label" for="ibu_nama">Nama Lengkap Ibu</label><input type="text"
            name="form_data[ibu][nama_lengkap]" class="form-control" placeholder="Nama Ibu" required /></div>
</div>

<div class="alert alert-info p-2 mt-4" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    <strong>Data Pelapor:</strong> Data diri Anda sebagai pelapor diambil dari form "1. Data Diri Pemohon".
</div>

<hr class="my-4" />
<h5 class="mt-4 fw-semibold">5. Data Saksi</h5>
<p class="text-muted">Masukkan data dua orang saksi yang mengetahui peristiwa kematian.</p>
{{-- Saksi 1 --}}
<h6 class="mt-3">Saksi 1</h6>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="saksi1_nik">NIK Saksi 1</label><input type="text"
            name="form_data[saksi1][nik]" class="form-control" placeholder="16 Digit NIK Saksi 1" required /></div>
    <div class="col-md-6"><label class="form-label" for="saksi1_nama">Nama Lengkap Saksi 1</label><input
            type="text" name="form_data[saksi1][nama_lengkap]" class="form-control" placeholder="Nama Saksi 1"
            required /></div>
</div>
{{-- Saksi 2 --}}
<h6 class="mt-3">Saksi 2</h6>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label" for="saksi2_nik">NIK Saksi 2</label><input type="text"
            name="form_data[saksi2][nik]" class="form-control" placeholder="16 Digit NIK Saksi 2" required /></div>
    <div class="col-md-6"><label class="form-label" for="saksi2_nama">Nama Lengkap Saksi 2</label><input
            type="text" name="form_data[saksi2][nama_lengkap]" class="form-control" placeholder="Nama Saksi 2"
            required /></div>
</div>
