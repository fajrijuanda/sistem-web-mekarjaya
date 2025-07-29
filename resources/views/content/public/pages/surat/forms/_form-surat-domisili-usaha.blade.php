{{--
    Formulir ini dirancang untuk SURAT KETERANGAN DOMISILI USAHA.
    Semua data pribadi penanggung jawab (NIK, Nama, Alamat, dll.) sudah diisi pada form utama.
    Bagian ini hanya untuk data spesifik mengenai usaha yang dijalankan.
--}}

<h5 class="mt-4 fw-semibold">2. Data Usaha / Perusahaan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="nama_perusahaan">Nama Usaha / Perusahaan</label>
        <input type="text" id="nama_perusahaan" name="form_data[nama_perusahaan]" class="form-control"
            placeholder="Contoh: PT. Sinar Mandiri Teknik" value="{{ old('form_data.nama_perusahaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="jenis_usaha">Jenis Usaha / Klasifikasi</label>
        <textarea name="form_data[jenis_usaha]" id="jenis_usaha" class="form-control" rows="2"
            placeholder="Contoh: Bidang Perdagangan Besar Alat Bantu Pabrik" required>{{ old('form_data.jenis_usaha') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label" for="alamat_usaha">Alamat Lengkap Tempat Usaha</label>
        <textarea name="form_data[alamat_usaha]" id="alamat_usaha" class="form-control" rows="2"
            placeholder="Tuliskan alamat lengkap lokasi usaha Anda" required>{{ old('form_data.alamat_usaha') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jumlah_karyawan">Jumlah Karyawan</label>
        <div class="input-group">
            <input type="number" id="jumlah_karyawan" name="form_data[jumlah_karyawan]" class="form-control"
                placeholder="Contoh: 20" value="{{ old('form_data.jumlah_karyawan') }}" required />
            <span class="input-group-text">Orang</span>
        </div>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Data Legalitas (Opsional)</h5>
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="imb_nomor">Nomor Izin Mendirikan Bangunan (IMB)</label>
        <input type="text" id="imb_nomor" name="form_data[imb_nomor]" class="form-control"
            placeholder="Nomor IMB jika ada" value="{{ old('form_data.imb_nomor') }}" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="imb_tanggal">Tanggal IMB</label>
        <input type="text" id="imb_tanggal" name="form_data[imb_tanggal]" class="form-control flatpickr-date"
            placeholder="YYYY-MM-DD" value="{{ old('form_data.imb_tanggal') }}" />
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-12">
        <label class="form-label" for="akta_notaris_nama">Nama Notaris Akta Pendirian</label>
        <input type="text" id="akta_notaris_nama" name="form_data[akta_notaris_nama]" class="form-control"
            placeholder="Nama Notaris, contoh: TITIK HARMAITI., SH. MKn"
            value="{{ old('form_data.akta_notaris_nama') }}" />
    </div>
    <div class="col-md-8">
        <label class="form-label" for="akta_nomor">Nomor Akta Pendirian</label>
        <input type="text" id="akta_nomor" name="form_data[akta_nomor]" class="form-control"
            placeholder="Nomor Akta Pendirian Perusahaan" value="{{ old('form_data.akta_nomor') }}" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="akta_tanggal">Tanggal Akta</label>
        <input type="text" id="akta_tanggal" name="form_data[akta_tanggal]" class="form-control flatpickr-date"
            placeholder="YYYY-MM-DD" value="{{ old('form_data.akta_tanggal') }}" />
    </div>
</div>
