{{--
    Formulir ini dirancang berdasarkan SURAT PERNYATAAN KETERANGAN KELAHIRAN.
    Data Pembuat Pernyataan (NIK dan Nama) diambil dari form utama sebagai data pemohon.
--}}

<h5 class="mt-4">2. Data Pembuat Pernyataan (Orang Tua 1)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pembuat_pernyataan][tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[pembuat_pernyataan][tempat_lahir]"
            name="form_data[pembuat_pernyataan][tempat_lahir]" class="form-control" placeholder="Tempat lahir Anda"
            value="{{ old('form_data.pembuat_pernyataan.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pembuat_pernyataan][tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[pembuat_pernyataan][tanggal_lahir]"
            name="form_data[pembuat_pernyataan][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pembuat_pernyataan.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pembuat_pernyataan][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pembuat_pernyataan][pekerjaan]"
            name="form_data[pembuat_pernyataan][pekerjaan]" class="form-control" placeholder="Pekerjaan Anda"
            value="{{ old('form_data.pembuat_pernyataan.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pembuat_pernyataan][alamat]">Alamat</label>
        <textarea name="form_data[pembuat_pernyataan][alamat]" id="form_data[pembuat_pernyataan][alamat]" class="form-control"
            rows="2" placeholder="Alamat lengkap sesuai KTP">{{ old('form_data.pembuat_pernyataan.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Pasangan (Orang Tua 2)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pasangan][nama]">Nama Pasangan</label>
        <input type="text" id="form_data[pasangan][nama]" name="form_data[pasangan][nama]" class="form-control"
            placeholder="Nama lengkap istri/suami" value="{{ old('form_data.pasangan.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pasangan][nik]">NIK Pasangan</label>
        <input type="text" id="form_data[pasangan][nik]" name="form_data[pasangan][nik]" class="form-control"
            placeholder="16 Digit NIK istri/suami" value="{{ old('form_data.pasangan.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pasangan][tempat_lahir]">Tempat Lahir Pasangan</label>
        <input type="text" id="form_data[pasangan][tempat_lahir]" name="form_data[pasangan][tempat_lahir]"
            class="form-control" placeholder="Tempat lahir istri/suami"
            value="{{ old('form_data.pasangan.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pasangan][tanggal_lahir]">Tanggal Lahir Pasangan</label>
        <input type="text" id="form_data[pasangan][tanggal_lahir]" name="form_data[pasangan][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pasangan.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pasangan][pekerjaan]">Pekerjaan Pasangan</label>
        <input type="text" id="form_data[pasangan][pekerjaan]" name="form_data[pasangan][pekerjaan]"
            class="form-control" placeholder="Pekerjaan istri/suami" value="{{ old('form_data.pasangan.pekerjaan') }}"
            required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pasangan][alamat]">Alamat Pasangan</label>
        <textarea name="form_data[pasangan][alamat]" id="form_data[pasangan][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap sesuai KTP">{{ old('form_data.pasangan.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Data Anak yang Dilahirkan</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[anak][nama]">Nama Anak</label>
        <input type="text" id="form_data[anak][nama]" name="form_data[anak][nama]" class="form-control"
            placeholder="Nama lengkap anak" value="{{ old('form_data.anak.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[anak][jenis_kelamin]">Jenis Kelamin Anak</label>
        <select class="form-select" id="form_data[anak][jenis_kelamin]" name="form_data[anak][jenis_kelamin]"
            required>
            <option value="Laki-Laki" @if (old('form_data.anak.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if (old('form_data.anak.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[anak][tempat_lahir]">Dilahirkan di</label>
        <input type="text" id="form_data[anak][tempat_lahir]" name="form_data[anak][tempat_lahir]"
            class="form-control" placeholder="Contoh: Rumah, RS. Harapan Bunda"
            value="{{ old('form_data.anak.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[anak][tanggal_lahir]">Pada Tanggal</label>
        <input type="text" id="form_data[anak][tanggal_lahir]" name="form_data[anak][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.anak.tanggal_lahir') }}" required />
    </div>
</div>
