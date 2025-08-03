{{--
    Formulir ini dirancang untuk Surat Pernyataan Tanah Tidak Sengketa.
    Data pemohon utama (NIK & Nama) diasumsikan sebagai data Pihak yang Membuat Pernyataan.
--}}

<div class="alert alert-info p-2 mt-4" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    Data diri Anda sebagai pemilik tanah (Nama, NIK, Alamat, dll.) diambil dari form "1. Data Diri Pemohon".
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">2. Data Objek Tanah</h5>
<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label" for="objek_jenis_tanah">Jenis Tanah</label>
        <input type="text" id="objek_jenis_tanah" name="form_data[objek][jenis_tanah]" class="form-control"
            placeholder="Contoh: Tanah Sawah, Tanah Darat, Kebun"
            value="{{ old('form_data.objek.jenis_tanah', 'Tanah Sawah') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="objek_lokasi">Lokasi Tanah</label>
        <input type="text" id="objek_lokasi" name="form_data[objek][lokasi]" class="form-control"
            placeholder="Contoh: Kp. Cebong Rt.001/001 Desa Mekarjaya" value="{{ old('form_data.objek.lokasi') }}"
            required />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="objek_sppt">No. SPPT</label>
        <input type="text" id="objek_sppt" name="form_data[objek][sppt]" class="form-control"
            placeholder="Nomor SPPT" value="{{ old('form_data.objek.sppt') }}" required />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="objek_blok">Blok</label>
        <input type="text" id="objek_blok" name="form_data[objek][blok]" class="form-control"
            placeholder="Nomor Blok" value="{{ old('form_data.objek.blok') }}" required />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="objek_luas">Luas Tanah</label>
        <input type="text" id="objek_luas" name="form_data[objek][luas]" class="form-control"
            placeholder="Contoh: 13.700 M²" value="{{ old('form_data.objek.luas') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="objek_nama_tercatat">Atas Nama Tercatat di Bukti Kepemilikan</label>
        <input type="text" id="objek_nama_tercatat" name="form_data[objek][nama_tercatat]" class="form-control"
            placeholder="Nama yang tertera pada bukti kepemilikan" value="{{ old('form_data.objek.nama_tercatat') }}"
            required />
    </div>

    <div class="col-12 mt-4"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_utara]" class="form-control" placeholder="Batas Utara"
            value="{{ old('form_data.objek.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_timur]" class="form-control" placeholder="Batas Timur"
            value="{{ old('form_data.objek.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_selatan]" class="form-control" placeholder="Batas Selatan"
            value="{{ old('form_data.objek.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_barat]" class="form-control" placeholder="Batas Barat"
            value="{{ old('form_data.objek.batas_barat') }}" required />
    </div>
    {{-- Tambahkan ini di bagian "2. Data Objek Tanah" --}}
    <div class="col-12">
        <label class="form-label" for="objek_dasar_kepemilikan">Dasar Kepemilikan (Nama di Akta Sebelumnya)</label>
        <input type="text" id="objek_dasar_kepemilikan" name="form_data[objek][dasar_kepemilikan]"
            class="form-control" placeholder="Nama yang tertera pada akta jual beli/hibah/waris sebelumnya"
            value="{{ old('form_data.objek.dasar_kepemilikan') }}" />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Data Saksi-Saksi</h5>
<p class="text-muted">Isi dengan nama Ketua RT dan RW setempat atau saksi lain yang mengetahui.</p>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_nama">Nama Saksi 1</label>
        <input type="text" id="saksi_1_nama" name="form_data[saksi_1][nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_1_jabatan">Jabatan Saksi 1</label>
        <input type="text" id="saksi_1_jabatan" name="form_data[saksi_1][jabatan]" class="form-control"
            placeholder="Contoh: Ketua RT. 001" value="{{ old('form_data.saksi_1.jabatan') }}" required />
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_nama">Nama Saksi 2</label>
        <input type="text" id="saksi_2_nama" name="form_data[saksi_2][nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="saksi_2_jabatan">Jabatan Saksi 2</label>
        <input type="text" id="saksi_2_jabatan" name="form_data[saksi_2][jabatan]" class="form-control"
            placeholder="Contoh: Ketua RW. 001" value="{{ old('form_data.saksi_2.jabatan') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">4. Konfirmasi Pernyataan</h5>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="konfirmasi_pernyataan"
        name="konfirmasi_pernyataan" required>
    <label class="form-check-label" for="konfirmasi_pernyataan">
        Saya menyatakan dengan sebenar-benarnya bahwa tanah tersebut:
    </label>
    <ul class="ps-4 mt-2">
        <li>Tidak pernah dalam sengketa baik hak maupun batas-batasnya;</li>
        <li>Tidak pernah dijual belikan kepada orang lain;</li>
        <li>Tidak pernah dikuasakan kepada orang lain dengan hal apapun juga;</li>
        <li>Tidak pernah dijaminkan pada Bank Pemerintah maupun Swasta;</li>
        <li>Tidak pernah dikeluarkan sertifikat;</li>
        <li>Pajak Bumi dan Bangunan tahun berjalan telah dibayar lunas.</li>
    </ul>
    <p>Apabila di kemudian hari surat pernyataan ini tidak benar atau palsu, maka saya bersedia dituntut berdasarkan
        peraturan yang berlaku.</p>
</div>
