{{--
    Formulir ini dirancang untuk SURAT KETERANGAN USAHA (SKU).
    Semua data pribadi pemohon (NIK, Nama, Alamat, dll.) sudah diisi pada form utama.
    Bagian ini hanya untuk data spesifik mengenai usaha yang dijalankan.
--}}

<h5 class="mt-4 fw-semibold">2. Data Usaha</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="nama_usaha">Jenis / Nama Usaha Pokok</label>
        <input type="text" id="nama_usaha" name="form_data[usaha][nama_usaha]" class="form-control" placeholder="Contoh: Warung Sembako, Jasa Laundry, atau Jual Beli Pakaian" value="{{ old('form_data.usaha.nama_usaha') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="usaha_sampingan">Usaha Sampingan (Opsional)</label>
        <input type="text" id="usaha_sampingan" name="form_data[usaha][usaha_sampingan]" class="form-control" placeholder="Isi jika ada, misal: Konter Pulsa, Jasa Pengetikan" value="{{ old('form_data.usaha.usaha_sampingan') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="alamat_usaha">Alamat Lengkap Tempat Usaha</label>
        <textarea name="form_data[usaha][alamat_usaha]" id="alamat_usaha" class="form-control" rows="2" placeholder="Tuliskan alamat lengkap lokasi usaha Anda" required>{{ old('form_data.usaha.alamat_usaha') }}</textarea>
    </div>
</div>
