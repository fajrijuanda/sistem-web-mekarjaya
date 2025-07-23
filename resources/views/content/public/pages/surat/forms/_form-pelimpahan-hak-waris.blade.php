{{--
    Formulir ini dirancang untuk Surat Pelimpahan Hak Waris,
    dimana beberapa ahli waris (Pihak Pertama) melimpahkan haknya
    kepada ahli waris lain (Pihak Kedua).
--}}

<h5 class="mt-4">2. Data Pewaris Asal (Sumber Warisan)</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[pewaris_asal][nama]">Nama Almarhum/Almarhumah</label>
        <input type="text" id="form_data[pewaris_asal][nama]" name="form_data[pewaris_asal][nama]" class="form-control"
            placeholder="Nama pewaris asal dari harta" value="{{ old('form_data.pewaris_asal.nama') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Pihak Pertama (Pemberi Hak Waris)</h5>
<p class="text-muted">Isi data semua ahli waris yang setuju melimpahkan haknya. Klik "Tambah Pemberi" jika lebih dari
    satu.</p>

<div id="pemberi-waris-list">
    {{-- Pemberi waris pertama (wajib) --}}
    <div class="card pemberi-waris-item mb-3">
        <div class="card-body">
            <h6 class="card-title fw-bold">Pemberi Hak 1</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="form_data[pihak_pertama][0][nama]" class="form-control"
                        placeholder="Nama pemberi hak" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Umur</label>
                    <input type="number" name="form_data[pihak_pertama][0][umur]" class="form-control"
                        placeholder="Contoh: 59" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="form_data[pihak_pertama][0][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap"
                        required></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" id="btn-tambah-pemberi" class="btn btn-outline-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Pemberi Hak
</button>

<hr class="my-4" />

<h5 class="mt-4">4. Data Pihak Kedua (Penerima Hak Waris)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak_kedua][nama]">Nama Lengkap</label>
        <input type="text" id="form_data[pihak_kedua][nama]" name="form_data[pihak_kedua][nama]" class="form-control"
            placeholder="Nama penerima hak" value="{{ old('form_data.pihak_kedua.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak_kedua][umur]">Umur</label>
        <input type="number" id="form_data[pihak_kedua][umur]" name="form_data[pihak_kedua][umur]" class="form-control"
            placeholder="Contoh: 61" value="{{ old('form_data.pihak_kedua.umur') }}" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pihak_kedua][jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[pihak_kedua][jenis_kelamin]"
            name="form_data[pihak_kedua][jenis_kelamin]" required>
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" @if (old('form_data.pihak_kedua.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if (old('form_data.pihak_kedua.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pihak_kedua][alamat]">Alamat</label>
        <textarea name="form_data[pihak_kedua][alamat]" id="form_data[pihak_kedua][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap penerima hak" required>{{ old('form_data.pihak_kedua.alamat') }}</textarea>
    </div>
</div>


<hr class="my-4" />

<h5 class="mt-4">5. Data Objek Warisan yang Dilimpahkan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[objek][deskripsi]">Deskripsi Objek</label>
        <input type="text" id="form_data[objek][deskripsi]" name="form_data[objek][deskripsi]" class="form-control"
            placeholder="Contoh: Sebidang Tanah Sawah" value="{{ old('form_data.objek.deskripsi') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[objek][luas]">Luas</label>
        <input type="text" id="form_data[objek][luas]" name="form_data[objek][luas]" class="form-control"
            placeholder="Contoh: 21.080 M2" value="{{ old('form_data.objek.luas') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[objek][sppt]">No. SPPT (jika ada)</label>
        <input type="text" id="form_data[objek][sppt]" name="form_data[objek][sppt]" class="form-control"
            placeholder="Contoh: 012-0077" value="{{ old('form_data.objek.sppt') }}" />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[objek][lokasi]">Lokasi Objek</label>
        <textarea name="form_data[objek][lokasi]" id="form_data[objek][lokasi]" class="form-control" rows="2"
            placeholder="Lokasi/alamat lengkap objek warisan" required>{{ old('form_data.objek.lokasi') }}</textarea>
    </div>
    <div class="col-12"><label class="form-label">Batas-Batas Objek</label></div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_utara]" class="form-control" placeholder="Batas Utara"
            value="{{ old('form_data.objek.batas_utara') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_timur]" class="form-control" placeholder="Batas Timur"
            value="{{ old('form_data.objek.batas_timur') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_selatan]" class="form-control"
            placeholder="Batas Selatan" value="{{ old('form_data.objek.batas_selatan') }}" required />
    </div>
    <div class="col-md-6 col-lg-3">
        <input type="text" name="form_data[objek][batas_barat]" class="form-control" placeholder="Batas Barat"
            value="{{ old('form_data.objek.batas_barat') }}" required />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">6. Data Saksi-Saksi</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1_nama]">Nama Saksi 1</label>
        <input type="text" id="form_data[saksi_1_nama]" name="form_data[saksi_1_nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1_nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2_nama]">Nama Saksi 2</label>
        <input type="text" id="form_data[saksi_2_nama]" name="form_data[saksi_2_nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2_nama') }}" required />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnTambahPemberi = document.getElementById('btn-tambah-pemberi');
        const listPemberi = document.getElementById('pemberi-waris-list');
        let pemberiIndex = 1; // Mulai dari 1 karena 0 sudah ada

        btnTambahPemberi.addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.classList.add('card', 'pemberi-waris-item', 'mb-3');
            newItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title fw-bold">Pemberi Hak ${pemberiIndex + 1}</h6>
                    <button type="button" class="btn-close btn-remove-pemberi" aria-label="Close"></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="form_data[pihak_pertama][${pemberiIndex}][nama]" class="form-control" placeholder="Nama pemberi hak" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Umur</label>
                        <input type="number" name="form_data[pihak_pertama][${pemberiIndex}][umur]" class="form-control" placeholder="Contoh: 59" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="form_data[pihak_pertama][${pemberiIndex}][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap" required></textarea>
                    </div>
                </div>
            </div>`;

            listPemberi.appendChild(newItem);
            pemberiIndex++;
        });

        // Event listener untuk tombol hapus
        listPemberi.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-pemberi')) {
                e.target.closest('.pemberi-waris-item').remove();
            }
        });
    });
</script>
