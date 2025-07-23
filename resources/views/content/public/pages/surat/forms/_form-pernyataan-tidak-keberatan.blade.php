{{--
    Formulir ini dirancang berdasarkan SURAT PERNYATAAN TIDAK KEBERATAN.
    Data Pihak I (yang membuat pernyataan) diambil dari form utama sebagai data pemohon.
--}}

<h5 class="mt-4">2. Data Pihak I (Yang Membuat Pernyataan)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak1][tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[pihak1][tempat_lahir]" name="form_data[pihak1][tempat_lahir]" class="form-control" placeholder="Tempat lahir Anda" value="{{ old('form_data.pihak1.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak1][tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[pihak1][tanggal_lahir]" name="form_data[pihak1][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.pihak1.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pihak1][pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pihak1][pekerjaan]" name="form_data[pihak1][pekerjaan]" class="form-control" placeholder="Pekerjaan Anda" value="{{ old('form_data.pihak1.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pihak1][alamat]">Alamat</label>
        <textarea name="form_data[pihak1][alamat]" id="form_data[pihak1][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP">{{ old('form_data.pihak1.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Pihak II (Saudara yang Diberi Izin)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][nama]">Nama Lengkap Pihak II</label>
        <input type="text" id="form_data[pihak2][nama]" name="form_data[pihak2][nama]" class="form-control" placeholder="Nama lengkap saudara" value="{{ old('form_data.pihak2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][nik]">NIK Pihak II</label>
        <input type="text" id="form_data[pihak2][nik]" name="form_data[pihak2][nik]" class="form-control" placeholder="16 Digit NIK saudara" value="{{ old('form_data.pihak2.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][tempat_lahir]">Tempat Lahir Pihak II</label>
        <input type="text" id="form_data[pihak2][tempat_lahir]" name="form_data[pihak2][tempat_lahir]" class="form-control" placeholder="Tempat lahir saudara" value="{{ old('form_data.pihak2.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][tanggal_lahir]">Tanggal Lahir Pihak II</label>
        <input type="text" id="form_data[pihak2][tanggal_lahir]" name="form_data[pihak2][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.pihak2.tanggal_lahir') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pihak2][alamat]">Alamat Pihak II</label>
        <textarea name="form_data[pihak2][alamat]" id="form_data[pihak2][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap saudara sesuai KTP">{{ old('form_data.pihak2.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Detail Pernyataan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[pernyataan][isi]">Isi Pernyataan</label>
        <textarea name="form_data[pernyataan][isi]" id="form_data[pernyataan][isi]" class="form-control" rows="4" placeholder="Contoh: Tidak keberatan Kartu Keluarga (KK) saya digunakan oleh saudara saya untuk..." required>{{ old('form_data.pernyataan.isi', 'Bahwa saya tidak keberatan Kartu Keluarga (KK) saya Nomor: ................................ dipergunakan oleh saudara saya tersebut di atas untuk persyaratan permohonan pembuatan KTP-el.') }}</textarea>
        <div class="form-text">Jelaskan secara rinci mengenai hal apa Anda tidak merasa keberatan.</div>
    </div>
</div>