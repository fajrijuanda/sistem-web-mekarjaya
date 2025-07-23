{{--
    Formulir ini dirancang berdasarkan SURAT PERMOHONAN PEMBUATAN PASPOR.
    Data NIK dan Nama Lengkap diambil dari form utama sebagai data pemohon.
--}}

<h5 class="mt-4">1. Data Diri Pemohon</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[tempat_lahir]" name="form_data[tempat_lahir]" class="form-control" placeholder="Contoh: Bekasi" value="{{ old('form_data.tempat_lahir') }}" required />
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
        <label class="form-label" for="form_data[kewarganegaraan]">Kewarganegaraan</label>
        <input type="text" id="form_data[kewarganegaraan]" name="form_data[kewarganegaraan]" class="form-control" value="Indonesia" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pekerjaan]" name="form_data[pekerjaan]" class="form-control" placeholder="Contoh: Mengurus Rumah Tangga" value="{{ old('form_data.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[alamat]">Alamat</label>
        <textarea name="form_data[alamat]" id="form_data[alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('form_data.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">2. Keperluan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[keperluan]">Keperluan Pembuatan Surat</label>
        <textarea name="form_data[keperluan]" id="form_data[keperluan]" class="form-control" rows="2" placeholder="Tuliskan tujuan pembuatan surat ini" required>{{ old('form_data.keperluan', 'Sebagai kelengkapan Administrasi dalam Pembuatan PASPOR.') }}</textarea>
    </div>
</div>