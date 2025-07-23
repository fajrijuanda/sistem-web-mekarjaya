{{--
    Formulir ini dirancang berdasarkan data dari dokumen SURAT KETERANGAN DOMISILI (Perorangan).
    Data NIK dan Nama Lengkap sudah diisi pada form utama.
--}}

<h5 class="mt-4">2. Data Detail Pemohon</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[tempat_lahir]" name="form_data[tempat_lahir]" class="form-control"
            placeholder="Sesuai KTP" value="{{ old('form_data.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[tanggal_lahir]" name="form_data[tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.tanggal_lahir') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[jenis_kelamin]" name="form_data[jenis_kelamin]" required>
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" @if (old('form_data.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if (old('form_data.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kewarganegaraan]">Kewarganegaraan</label>
        <input type="text" id="form_data[kewarganegaraan]" name="form_data[kewarganegaraan]" class="form-control"
            placeholder="Contoh: Indonesia" value="{{ old('form_data.kewarganegaraan', 'Indonesia') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[agama]">Agama</label>
        <select class="form-select" id="form_data[agama]" name="form_data[agama]" required>
            <option value="" disabled selected>Pilih Agama</option>
            <option value="Islam" @if (old('form_data.agama') == 'Islam') selected @endif>Islam</option>
            <option value="Kristen Protestan" @if (old('form_data.agama') == 'Kristen Protestan') selected @endif>Kristen Protestan
            </option>
            <option value="Kristen Katolik" @if (old('form_data.agama') == 'Kristen Katolik') selected @endif>Kristen Katolik</option>
            <option value="Hindu" @if (old('form_data.agama') == 'Hindu') selected @endif>Hindu</option>
            <option value="Buddha" @if (old('form_data.agama') == 'Buddha') selected @endif>Buddha</option>
            <option value="Khonghucu" @if (old('form_data.agama') == 'Khonghucu') selected @endif>Khonghucu</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pekerjaan]" name="form_data[pekerjaan]" class="form-control"
            placeholder="Contoh: Karyawan Swasta" value="{{ old('form_data.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[alamat]">Alamat Lengkap Domisili</label>
        <textarea name="form_data[alamat]" id="form_data[alamat]" class="form-control" rows="2"
            placeholder="Tuliskan alamat lengkap domisili Anda di desa ini." required>{{ old('form_data.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Keperluan Surat</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[keperluan]">Tujuan Pembuatan Surat</label>
        <textarea id="form_data[keperluan]" name="form_data[keperluan]" class="form-control" rows="2"
            placeholder="Contoh: Untuk persyaratan administrasi di Pengadilan Agama Cikarang." required>{{ old('form_data.keperluan') }}</textarea>
    </div>
</div>

<hr class="my-4" />

{{-- ▼▼▼ BAGIAN YANG DITAMBAHKAN ▼▼▼ --}}
<h5 class="mt-4">4. Data Saksi</h5>
<p class="text-muted">Isi dengan nama Ketua RT dan RW setempat atau perangkat desa yang mengetahui.</p>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1_nama]">Nama Saksi 1</label>
        <input type="text" id="form_data[saksi_1_nama]" name="form_data[saksi_1_nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1_jabatan]">Jabatan Saksi 1</label>
        <input type="text" id="form_data[saksi_1_jabatan]" name="form_data[saksi_1_jabatan]" class="form-control"
            placeholder="Contoh: Ketua RT. 002" value="{{ old('form_data.saksi_1_jabatan') }}" required />
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2_nama]">Nama Saksi 2</label>
        <input type="text" id="form_data[saksi_2_nama]" name="form_data[saksi_2_nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2_jabatan]">Jabatan Saksi 2</label>
        <input type="text" id="form_data[saksi_2_jabatan]" name="form_data[saksi_2_jabatan]" class="form-control"
            placeholder="Contoh: Ketua RW. 001" value="{{ old('form_data.saksi_2_jabatan') }}" required />
    </div>
</div>
