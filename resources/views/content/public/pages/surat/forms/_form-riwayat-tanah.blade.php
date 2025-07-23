{{--
    Formulir ini dirancang untuk Surat Keterangan Riwayat Tanah.
    Memiliki fitur untuk menambah riwayat kepemilikan secara dinamis.
--}}

<h5 class="mt-4">2. Data Tanah (Kondisi Saat Ini)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][dasar_pengecekan]">Dasar Pengecekan</label>
        <input type="text" id="form_data[tanah_sekarang][dasar_pengecekan]" name="form_data[tanah_sekarang][dasar_pengecekan]" class="form-control" placeholder="Contoh: Kikitir, Girik C Nomor" value="{{ old('form_data.tanah_sekarang.dasar_pengecekan') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][nomor_c]">Nomor C</label>
        <input type="text" id="form_data[tanah_sekarang][nomor_c]" name="form_data[tanah_sekarang][nomor_c]" class="form-control" placeholder="Isi nomor C/Girik" value="{{ old('form_data.tanah_sekarang.nomor_c') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][luas]">Luas Tanah</label>
        <input type="text" id="form_data[tanah_sekarang][luas]" name="form_data[tanah_sekarang][luas]" class="form-control" placeholder="Contoh: 240 M²" value="{{ old('form_data.tanah_sekarang.luas') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][nama_tercatat]">Nama Tercatat Saat Ini</label>
        <input type="text" id="form_data[tanah_sekarang][nama_tercatat]" name="form_data[tanah_sekarang][nama_tercatat]" class="form-control" placeholder="Nama pemilik terakhir" value="{{ old('form_data.tanah_sekarang.nama_tercatat') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][status_hak]">Status Hak Tanah</label>
        <input type="text" id="form_data[tanah_sekarang][status_hak]" name="form_data[tanah_sekarang][status_hak]" class="form-control" placeholder="Contoh: Hak Milik Adat" value="{{ old('form_data.tanah_sekarang.status_hak', 'Hak Milik Adat (Bukan Tanah Negara)') }}" required />
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[tanah_sekarang][sppt]">No. SPPT Terakhir</label>
        <input type="text" id="form_data[tanah_sekarang][sppt]" name="form_data[tanah_sekarang][sppt]" class="form-control" placeholder="Nomor SPPT" value="{{ old('form_data.tanah_sekarang.sppt') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[tanah_sekarang][lokasi]">Lokasi Tanah</label>
        <textarea name="form_data[tanah_sekarang][lokasi]" id="form_data[tanah_sekarang][lokasi]" class="form-control" rows="2" placeholder="Alamat/lokasi lengkap tanah" required>{{ old('form_data.tanah_sekarang.lokasi') }}</textarea>
    </div>

    <div class="col-12 mt-4"><label class="form-label">Batas-Batas Tanah</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah_sekarang][batas_utara]" class="form-control" placeholder="Batas Utara" value="{{ old('form_data.tanah_sekarang.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah_sekarang][batas_timur]" class="form-control" placeholder="Batas Timur" value="{{ old('form_data.tanah_sekarang.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah_sekarang][batas_selatan]" class="form-control" placeholder="Batas Selatan" value="{{ old('form_data.tanah_sekarang.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[tanah_sekarang][batas_barat]" class="form-control" placeholder="Batas Barat" value="{{ old('form_data.tanah_sekarang.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Riwayat Kepemilikan Tanah</h5>
<p class="text-muted">Tambahkan riwayat kepemilikan tanah secara berurutan, dari yang paling lama hingga yang terbaru.</p>

<div id="riwayat-list">
    {{-- Riwayat pertama (wajib) --}}
    <div class="card riwayat-item mb-3">
        <div class="card-body">
            <h6 class="card-title fw-bold">Riwayat 1</h6>
            <div class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="text" name="form_data[riwayat][0][tanggal]" class="form-control" placeholder="Contoh: 24-09-1960" required>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <label class="form-label">Jenis Riwayat</label>
                    <select name="form_data[riwayat][0][jenis]" class="form-select" required>
                        <option value="Tercatat atas nama">Tercatat atas nama</option>
                        <option value="Balik nama kepada">Balik nama kepada</option>
                        <option value="Jual Beli kepada">Jual Beli kepada</option>
                        <option value="Diwariskan kepada">Diwariskan kepada</option>
                        <option value="Dihibahkan kepada">Dihibahkan kepada</option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label">Nama Pihak Terkait</label>
                    <input type="text" name="form_data[riwayat][0][nama]" class="form-control" placeholder="Nama orang/pihak terkait" required>
                </div>
                <div class="col-12">
                     <label class="form-label">Keterangan Tambahan (Opsional)</label>
                     <input type="text" name="form_data[riwayat][0][keterangan]" class="form-control" placeholder="Contoh: Berdasarkan Segel Tahun 1993">
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" id="btn-tambah-riwayat" class="btn btn-outline-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Riwayat
</button>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnTambahRiwayat = document.getElementById('btn-tambah-riwayat');
    const listRiwayat = document.getElementById('riwayat-list');
    let riwayatIndex = 1; // Mulai dari 1 karena 0 sudah ada

    btnTambahRiwayat.addEventListener('click', function () {
        const newItem = document.createElement('div');
        newItem.classList.add('card', 'riwayat-item', 'mb-3');
        newItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title fw-bold">Riwayat ${riwayatIndex + 1}</h6>
                    <button type="button" class="btn-close btn-remove-item" aria-label="Close"></button>
                </div>
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="text" name="form_data[riwayat][${riwayatIndex}][tanggal]" class="form-control" placeholder="Contoh: 04-01-1993" required>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Jenis Riwayat</label>
                        <select name="form_data[riwayat][${riwayatIndex}][jenis]" class="form-select" required>
                            <option value="Tercatat atas nama">Tercatat atas nama</option>
                            <option value="Balik nama kepada">Balik nama kepada</option>
                            <option value="Jual Beli kepada">Jual Beli kepada</option>
                            <option value="Diwariskan kepada">Diwariskan kepada</option>
                            <option value="Dihibahkan kepada">Dihibahkan kepada</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label class="form-label">Nama Pihak Terkait</label>
                        <input type="text" name="form_data[riwayat][${riwayatIndex}][nama]" class="form-control" placeholder="Nama orang/pihak terkait" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keterangan Tambahan (Opsional)</label>
                        <input type="text" name="form_data[riwayat][${riwayatIndex}][keterangan]" class="form-control" placeholder="Contoh: Berdasarkan Segel Tahun 1993">
                    </div>
                </div>
            </div>`;
        
        listRiwayat.appendChild(newItem);
        riwayatIndex++;
    });

    // Event listener untuk tombol hapus
    listRiwayat.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-remove-item')) {
            e.target.closest('.riwayat-item').remove();
        }
    });
});
</script>