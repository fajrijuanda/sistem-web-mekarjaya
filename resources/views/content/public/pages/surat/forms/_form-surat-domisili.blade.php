{{--
    Formulir ini dirancang untuk SURAT KETERANGAN DOMISILI.
    Semua data pribadi pemohon (NIK, Nama, Alamat, dll.) sudah diisi pada form utama.
    Bagian ini hanya untuk data tambahan yang spesifik untuk surat ini.
--}}

<h5 class="mt-4 fw-semibold">2. Keperluan Surat</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="keperluan">Tujuan Pembuatan Surat Domisili</label>
        <textarea id="keperluan" name="form_data[keperluan]" class="form-control" rows="2"
            placeholder="Contoh: Untuk persyaratan administrasi di Pengadilan Agama Cikarang." required>{{ old('form_data.keperluan') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Data Saksi</h5>
<p class="text-muted">Isi dengan nama Ketua RT dan RW setempat atau perangkat desa yang mengetahui domisili Anda.</p>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_nama">Nama Saksi 1</label>
        <input type="text" id="saksi_1_nama" name="form_data[saksi_1_nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_jabatan">Jabatan Saksi 1</label>
        <input type="text" id="saksi_1_jabatan" name="form_data[saksi_1_jabatan]" class="form-control"
            placeholder="Contoh: Ketua RT. 002" value="{{ old('form_data.saksi_1_jabatan') }}" required />
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_nama">Nama Saksi 2</label>
        <input type="text" id="saksi_2_nama" name="form_data[saksi_2_nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_jabatan">Jabatan Saksi 2</label>
        <input type="text" id="saksi_2_jabatan" name="form_data[saksi_2_jabatan]" class="form-control"
            placeholder="Contoh: Ketua RW. 001" value="{{ old('form_data.saksi_2_jabatan') }}" required />
    </div>
</div>
