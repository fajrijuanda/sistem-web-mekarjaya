{{--
    Formulir ini dirancang berdasarkan data dari dokumen SURAT KETERANGAN SUDAH MENIKAH/KAWIN.
    Data NIK dan Nama Lengkap Suami diasumsikan sebagai data pemohon utama.
--}}

<h5 class="mt-4">2. Data Suami (Pemohon)</h5>
<div class="row g-3">
    <div class="col-12">
      <div class="alert alert-info p-2" role="alert">
        <i class="ti ti-info-circle me-1"></i>
        Data NIK dan Nama Lengkap Suami telah diisi dari form sebelumnya.
      </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[suami][tempat_lahir]">Tempat Lahir Suami</label>
        <input type="text" id="form_data[suami][tempat_lahir]" name="form_data[suami][tempat_lahir]" class="form-control" placeholder="Sesuai KTP Suami" value="{{ old('form_data.suami.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[suami][tanggal_lahir]">Tanggal Lahir Suami</label>
        <input type="text" id="form_data[suami][tanggal_lahir]" name="form_data[suami][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.suami.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[suami][agama]">Agama Suami</label>
        <input type="text" id="form_data[suami][agama]" name="form_data[suami][agama]" class="form-control" placeholder="Contoh: Islam" value="{{ old('form_data.suami.agama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[suami][pekerjaan]">Pekerjaan Suami</label>
        <input type="text" id="form_data[suami][pekerjaan]" name="form_data[suami][pekerjaan]" class="form-control" placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.suami.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[suami][alamat]">Alamat Suami</label>
        <textarea name="form_data[suami][alamat]" id="form_data[suami][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap Suami sesuai KTP" required>{{ old('form_data.suami.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Istri (Pasangan)</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[istri][nama_lengkap]">Nama Lengkap Istri</label>
        <input type="text" id="form_data[istri][nama_lengkap]" name="form_data[istri][nama_lengkap]" class="form-control" placeholder="Nama lengkap Istri sesuai KTP" value="{{ old('form_data.istri.nama_lengkap') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[istri][tempat_lahir]">Tempat Lahir Istri</label>
        <input type="text" id="form_data[istri][tempat_lahir]" name="form_data[istri][tempat_lahir]" class="form-control" placeholder="Sesuai KTP Istri" value="{{ old('form_data.istri.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[istri][tanggal_lahir]">Tanggal Lahir Istri</label>
        <input type="text" id="form_data[istri][tanggal_lahir]" name="form_data[istri][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.istri.tanggal_lahir') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[istri][alamat]">Alamat Istri</label>
        <textarea name="form_data[istri][alamat]" id="form_data[istri][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap Istri sesuai KTP" required>{{ old('form_data.istri.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Detail Pernikahan</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[detail_nikah][wali_nikah]">Wali Nikah</label>
        <input type="text" id="form_data[detail_nikah][wali_nikah]" name="form_data[detail_nikah][wali_nikah]" class="form-control" placeholder="Nama wali dari pihak istri" value="{{ old('form_data.detail_nikah.wali_nikah') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[detail_nikah][maskawin]">Maskawin</label>
        <input type="text" id="form_data[detail_nikah][maskawin]" name="form_data[detail_nikah][maskawin]" class="form-control" placeholder="Contoh: Uang Tunai Rp 50.000,-" value="{{ old('form_data.detail_nikah.maskawin') }}" required />
    </div>
</div>


<hr class="my-4" />

<h5 class="mt-4">5. Data Saksi Pernikahan</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1_nama]">Nama Saksi I</label>
        <input type="text" id="form_data[saksi_1_nama]" name="form_data[saksi_1_nama]" class="form-control" placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2_nama]">Nama Saksi II</label>
        <input type="text" id="form_data[saksi_2_nama]" name="form_data[saksi_2_nama]" class="form-control" placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
</div>