{{--
    Formulir ini dirancang berdasarkan SURAT PERNYATAAN TIDAK KEBERATAN.
    Data Pihak I (yang membuat pernyataan) diambil dari form utama sebagai data pemohon.
--}}

<div class="alert alert-info p-2 mt-4" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    <strong>Data Pihak I (Anda sebagai Pembuat Pernyataan):</strong> Data diri Anda (Nama, NIK, Alamat, dll.) diambil
    dari form "1. Data Diri Pemohon".
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">2. Data Pihak II (Pihak yang Diberi Izin)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="pihak2_nama">Nama Lengkap Pihak II</label>
        <input type="text" id="pihak2_nama" name="form_data[pihak2][nama]" class="form-control"
            placeholder="Nama lengkap saudara/pihak terkait" value="{{ old('form_data.pihak2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_nik">NIK Pihak II</label>
        <input type="text" id="pihak2_nik" name="form_data[pihak2][nik]" class="form-control"
            placeholder="16 Digit NIK saudara/pihak terkait" value="{{ old('form_data.pihak2.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_tempat_lahir">Tempat Lahir Pihak II</label>
        <input type="text" id="pihak2_tempat_lahir" name="form_data[pihak2][tempat_lahir]" class="form-control"
            placeholder="Tempat lahir Pihak II" value="{{ old('form_data.pihak2.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_tanggal_lahir">Tanggal Lahir Pihak II</label>
        <input type="text" id="pihak2_tanggal_lahir" name="form_data[pihak2][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pihak2.tanggal_lahir') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="pihak2_alamat">Alamat Pihak II</label>
        <textarea name="form_data[pihak2][alamat]" id="pihak2_alamat" class="form-control" rows="2"
            placeholder="Alamat lengkap Pihak II sesuai KTP">{{ old('form_data.pihak2.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Detail Pernyataan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="pernyataan_isi">Isi Pernyataan</label>
        <textarea name="form_data[pernyataan][isi]" id="pernyataan_isi" class="form-control" rows="4"
            placeholder="Contoh: Tidak keberatan Kartu Keluarga (KK) saya digunakan oleh saudara saya untuk..." required>{{ old('form_data.pernyataan.isi', 'Bahwa saya tidak keberatan Kartu Keluarga (KK) saya Nomor: ................................ dipergunakan oleh saudara saya tersebut di atas untuk persyaratan permohonan pembuatan KTP-el.') }}</textarea>
        <div class="form-text">Jelaskan secara rinci mengenai hal apa Anda tidak merasa keberatan.</div>
    </div>
</div>
