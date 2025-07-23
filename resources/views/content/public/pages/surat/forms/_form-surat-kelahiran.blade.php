{{--
    Formulir ini dirancang berdasarkan data dari file Excel SURAT KETERANGAN KELAHIRAN.
    Data Pelapor (NIK dan Nama) diambil dari form utama.
--}}

<h5 class="mt-4">2. Data Kepala Keluarga</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[kepala_keluarga][nama]">Nama Kepala Keluarga</label>
        <input type="text" id="form_data[kepala_keluarga][nama]" name="form_data[kepala_keluarga][nama]"
            class="form-control" placeholder="Sesuai Kartu Keluarga" value="{{ old('form_data.kepala_keluarga.nama') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kepala_keluarga][no_kk]">Nomor Kartu Keluarga</label>
        <input type="text" id="form_data[kepala_keluarga][no_kk]" name="form_data[kepala_keluarga][no_kk]"
            class="form-control" placeholder="16 Digit Nomor KK" value="{{ old('form_data.kepala_keluarga.no_kk') }}"
            required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Bayi / Anak yang Dilahirkan</h5>
{{-- ... (Isi bagian ini tetap sama seperti sebelumnya, tidak perlu diubah) ... --}}
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][nama]">Nama Lengkap Bayi</label>
        <input type="text" id="form_data[bayi][nama]" name="form_data[bayi][nama]" class="form-control"
            placeholder="Nama lengkap bayi" value="{{ old('form_data.bayi.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[bayi][jenis_kelamin]" name="form_data[bayi][jenis_kelamin]" required>
            <option value="Laki-Laki" @if (old('form_data.bayi.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if (old('form_data.bayi.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][tempat_dilahirkan]">Tempat Dilahirkan</label>
        <select class="form-select" id="form_data[bayi][tempat_dilahirkan]" name="form_data[bayi][tempat_dilahirkan]"
            required>
            <option value="RUMAH SAKIT/RUMAH BERSALIN">RUMAH SAKIT/RUMAH BERSALIN</option>
            <option value="PUSKESMAS">PUSKESMAS</option>
            <option value="POLINDES">POLINDES</option>
            <option value="RUMAH">RUMAH</option>
            <option value="LAINNYA">LAINNYA</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][tempat_kelahiran]">Tempat Kelahiran (Kota/Kab)</label>
        <input type="text" id="form_data[bayi][tempat_kelahiran]" name="form_data[bayi][tempat_kelahiran]"
            class="form-control" placeholder="Contoh: Bekasi" value="{{ old('form_data.bayi.tempat_kelahiran') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][tanggal_lahir]">Hari dan Tanggal Lahir</label>
        <input type="text" id="form_data[bayi][tanggal_lahir]" name="form_data[bayi][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.bayi.tanggal_lahir') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][waktu_lahir]">Pukul (Waktu Kelahiran)</label>
        <input type="time" id="form_data[bayi][waktu_lahir]" name="form_data[bayi][waktu_lahir]" class="form-control"
            value="{{ old('form_data.bayi.waktu_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][jenis_kelahiran]">Jenis Kelahiran</label>
        <select class="form-select" id="form_data[bayi][jenis_kelahiran]" name="form_data[bayi][jenis_kelahiran]"
            required>
            <option value="Tunggal">1. Tunggal</option>
            <option value="Kembar 2">2. Kembar 2</option>
            <option value="Kembar 3">3. Kembar 3</option>
            <option value="Kembar 4">4. Kembar 4</option>
            <option value="Lainnya">5. Lainnya</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][kelahiran_ke]">Anak Ke-</label>
        <input type="number" id="form_data[bayi][kelahiran_ke]" name="form_data[bayi][kelahiran_ke]"
            class="form-control" placeholder="1, 2, 3, ..." value="{{ old('form_data.bayi.kelahiran_ke') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][penolong_kelahiran]">Penolong Kelahiran</label>
        <select class="form-select" id="form_data[bayi][penolong_kelahiran]"
            name="form_data[bayi][penolong_kelahiran]" required>
            <option value="Dokter">1. Dokter</option>
            <option value="Bidan/Perawat">2. Bidan/Perawat</option>
            <option value="Dukun">3. Dukun</option>
            <option value="Lainnya">4. Lainnya</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][berat]">Berat Bayi (gram)</label>
        <input type="number" id="form_data[bayi][berat]" name="form_data[bayi][berat]" class="form-control"
            placeholder="Contoh: 3100" value="{{ old('form_data.bayi.berat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[bayi][panjang]">Panjang Bayi (cm)</label>
        <input type="number" id="form_data[bayi][panjang]" name="form_data[bayi][panjang]" class="form-control"
            placeholder="Contoh: 48" value="{{ old('form_data.bayi.panjang') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Data Ibu Kandung</h5>
{{-- ... (Isi bagian ini tetap sama seperti sebelumnya, tidak perlu diubah) ... --}}
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[ibu][nik]">NIK Ibu</label>
        <input type="text" id="form_data[ibu][nik]" name="form_data[ibu][nik]" class="form-control"
            placeholder="16 Digit NIK Ibu" value="{{ old('form_data.ibu.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ibu][nama_lengkap]">Nama Lengkap Ibu</label>
        <input type="text" id="form_data[ibu][nama_lengkap]" name="form_data[ibu][nama_lengkap]"
            class="form-control" placeholder="Nama Lengkap Ibu" value="{{ old('form_data.ibu.nama_lengkap') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ibu][tanggal_lahir]">Tanggal Lahir Ibu</label>
        <input type="text" id="form_data[ibu][tanggal_lahir]" name="form_data[ibu][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.ibu.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ibu][pekerjaan]">Pekerjaan Ibu</label>
        <input type="text" id="form_data[ibu][pekerjaan]" name="form_data[ibu][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ibu" value="{{ old('form_data.ibu.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[ibu][alamat]">Alamat Ibu</label>
        <textarea name="form_data[ibu][alamat]" id="form_data[ibu][alamat]" class="form-control" rows="2"
            placeholder="Alamat Lengkap Sesuai KTP">{{ old('form_data.ibu.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">5. Data Ayah Kandung</h5>
{{-- ... (Isi bagian ini tetap sama seperti sebelumnya, tidak perlu diubah) ... --}}
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[ayah][nik]">NIK Ayah</label>
        <input type="text" id="form_data[ayah][nik]" name="form_data[ayah][nik]" class="form-control"
            placeholder="16 Digit NIK Ayah" value="{{ old('form_data.ayah.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ayah][nama_lengkap]">Nama Lengkap Ayah</label>
        <input type="text" id="form_data[ayah][nama_lengkap]" name="form_data[ayah][nama_lengkap]"
            class="form-control" placeholder="Nama Lengkap Ayah" value="{{ old('form_data.ayah.nama_lengkap') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ayah][tanggal_lahir]">Tanggal Lahir Ayah</label>
        <input type="text" id="form_data[ayah][tanggal_lahir]" name="form_data[ayah][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.ayah.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[ayah][pekerjaan]">Pekerjaan Ayah</label>
        <input type="text" id="form_data[ayah][pekerjaan]" name="form_data[ayah][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ayah" value="{{ old('form_data.ayah.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[ayah][alamat]">Alamat Ayah</label>
        <textarea name="form_data[ayah][alamat]" id="form_data[ayah][alamat]" class="form-control" rows="2"
            placeholder="Alamat Lengkap Sesuai KTP">{{ old('form_data.ayah.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

{{-- BAGIAN BARU YANG DITAMBAHKAN --}}
<h5 class="mt-4">6. Data Saksi</h5>
<div class="row g-3">
    {{-- Saksi 1 --}}
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi1][nik]">NIK Saksi 1</label>
        <input type="text" id="form_data[saksi1][nik]" name="form_data[saksi1][nik]" class="form-control"
            placeholder="16 Digit NIK Saksi 1" value="{{ old('form_data.saksi1.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi1][nama_lengkap]">Nama Lengkap Saksi 1</label>
        <input type="text" id="form_data[saksi1][nama_lengkap]" name="form_data[saksi1][nama_lengkap]"
            class="form-control" placeholder="Nama Lengkap Saksi 1"
            value="{{ old('form_data.saksi1.nama_lengkap') }}" required />
    </div>

    {{-- Saksi 2 --}}
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi2][nik]">NIK Saksi 2</label>
        <input type="text" id="form_data[saksi2][nik]" name="form_data[saksi2][nik]" class="form-control"
            placeholder="16 Digit NIK Saksi 2" value="{{ old('form_data.saksi2.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi2][nama_lengkap]">Nama Lengkap Saksi 2</label>
        <input type="text" id="form_data[saksi2][nama_lengkap]" name="form_data[saksi2][nama_lengkap]"
            class="form-control" placeholder="Nama Lengkap Saksi 2"
            value="{{ old('form_data.saksi2.nama_lengkap') }}" required />
    </div>
</div>
