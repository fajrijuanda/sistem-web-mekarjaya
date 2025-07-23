{{--
    Formulir ini dirancang berdasarkan data dari dokumen SURAT KETERANGAN USAHA.
    Data NIK dan Nama Lengkap sudah diisi di form utama.
--}}

<h5 class="mt-4">2. Data Detail Pemohon</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[tempat_lahir]" name="form_data[tempat_lahir]" class="form-control" placeholder="Sesuai KTP/Akta Kelahiran" value="{{ old('form_data.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[tanggal_lahir]" name="form_data[tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[jenis_kelamin]" name="form_data[jenis_kelamin]" required>
            <option value="Laki-Laki" @if(old('form_data.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if(old('form_data.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pekerjaan]" name="form_data[pekerjaan]" class="form-control" placeholder="Pekerjaan pribadi sesuai KTP" value="{{ old('form_data.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[alamat_pemohon]">Alamat Tempat Tinggal</label>
        <textarea name="form_data[alamat_pemohon]" id="form_data[alamat_pemohon]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.alamat_pemohon') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Usaha</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[usaha][nama_usaha]">Jenis / Nama Usaha Pokok</label>
        <input type="text" id="form_data[usaha][nama_usaha]" name="form_data[usaha][nama_usaha]" class="form-control" placeholder="Contoh: Jual Beli Pasir" value="{{ old('form_data.usaha.nama_usaha') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[usaha][usaha_sampingan]">Usaha Sampingan (Opsional)</label>
        <input type="text" id="form_data[usaha][usaha_sampingan]" name="form_data[usaha][usaha_sampingan]" class="form-control" placeholder="Isi jika ada, misal: Konter Pulsa" value="{{ old('form_data.usaha.usaha_sampingan') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[usaha][alamat_usaha]">Alamat Lengkap Tempat Usaha</label>
        <textarea name="form_data[usaha][alamat_usaha]" id="form_data[usaha][alamat_usaha]" class="form-control" rows="2" placeholder="Tuliskan alamat lengkap lokasi usaha Anda" required>{{ old('form_data.usaha.alamat_usaha') }}</textarea>
    </div>
</div>