{{--
    Formulir ini dirancang berdasarkan SURAT KETERANGAN TIDAK MAMPU.
    Data Pemohon (NIK dan Nama) diambil dari form utama.
--}}

<h5 class="mt-4">2. Data Pemohon (Kepala Keluarga)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[pemohon][tempat_lahir]" name="form_data[pemohon][tempat_lahir]" class="form-control" placeholder="Tempat lahir Anda" value="{{ old('form_data.pemohon.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[pemohon][tanggal_lahir]" name="form_data[pemohon][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.pemohon.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[pemohon][jenis_kelamin]" name="form_data[pemohon][jenis_kelamin]" required>
            <option value="Laki-Laki" @if(old('form_data.pemohon.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if(old('form_data.pemohon.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pemohon][kewarganegaraan]">Kewarganegaraan</label>
        <input type="text" id="form_data[pemohon][kewarganegaraan]" name="form_data[pemohon][kewarganegaraan]" class="form-control" value="Indonesia" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pemohon][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pemohon][pekerjaan]" name="form_data[pemohon][pekerjaan]" class="form-control" placeholder="Pekerjaan Anda" value="{{ old('form_data.pemohon.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pemohon][alamat]">Alamat</label>
        <textarea name="form_data[pemohon][alamat]" id="form_data[pemohon][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.pemohon.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3*. Keperluan dan Data Pengguna Surat</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[pengguna][keperluan]">Keperluan Pembuatan Surat</label>
        <textarea name="form_data[pengguna][keperluan]" id="form_data[pengguna][keperluan]" class="form-control" rows="2" placeholder="Tuliskan tujuan pembuatan surat ini" required>{{ old('form_data.pengguna.keperluan') }}</textarea>
        <div class="form-text">Contoh: Untuk permohonan Beasiswa Sekolah.</div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pengguna][nama]">Surat Digunakan Atas Nama</label>
        <input type="text" id="form_data[pengguna][nama]" name="form_data[pengguna][nama]" class="form-control" placeholder="Nama anak/tanggungan" value="{{ old('form_data.pengguna.nama') }}" required />
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[pengguna][hubungan]">Hubungan dengan Pemohon</label>
        <input type="text" id="form_data[pengguna][hubungan]" name="form_data[pengguna][hubungan]" class="form-control" placeholder="Contoh: Anak Kandung" value="{{ old('form_data.pengguna.hubungan') }}" required />
    </div>
</div>