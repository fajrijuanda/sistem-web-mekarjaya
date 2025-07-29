{{--
    Formulir ini dirancang untuk SURAT KETERANGAN SUDAH MENIKAH/KAWIN.
    Data pemohon (diasumsikan sebagai Suami) sudah diisi pada form utama.
    Bagian ini hanya untuk data tambahan yang spesifik.
--}}

<h5 class="mt-4 fw-semibold">2. Data Pasangan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="istri_nama_lengkap">Nama Lengkap Istri</label>
        <input type="text" id="istri_nama_lengkap" name="form_data[istri][nama_lengkap]" class="form-control" placeholder="Nama lengkap Istri sesuai KTP" value="{{ old('form_data.istri.nama_lengkap') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="istri_tempat_lahir">Tempat Lahir Istri</label>
        <input type="text" id="istri_tempat_lahir" name="form_data[istri][tempat_lahir]" class="form-control" placeholder="Sesuai KTP Istri" value="{{ old('form_data.istri.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="istri_tanggal_lahir">Tanggal Lahir Istri</label>
        <input type="text" id="istri_tanggal_lahir" name="form_data[istri][tanggal_lahir]" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="{{ old('form_data.istri.tanggal_lahir') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="istri_alamat">Alamat Istri</label>
        <textarea name="form_data[istri][alamat]" id="istri_alamat" class="form-control" rows="2" placeholder="Alamat lengkap Istri sesuai KTP" required>{{ old('form_data.istri.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Detail Pernikahan</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="wali_nikah">Wali Nikah</label>
        <input type="text" id="wali_nikah" name="form_data[detail_nikah][wali_nikah]" class="form-control" placeholder="Nama wali dari pihak istri" value="{{ old('form_data.detail_nikah.wali_nikah') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="maskawin">Maskawin</label>
        <input type="text" id="maskawin" name="form_data[detail_nikah][maskawin]" class="form-control" placeholder="Contoh: Uang Tunai Rp 500.000,-" value="{{ old('form_data.detail_nikah.maskawin') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">4. Data Saksi Pernikahan</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_nama">Nama Saksi I</label>
        <input type="text" id="saksi_1_nama" name="form_data[saksi_1_nama]" class="form-control" placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_nama">Nama Saksi II</label>
        <input type="text" id="saksi_2_nama" name="form_data[saksi_2_nama]" class="form-control" placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
</div>
