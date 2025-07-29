{{--
    Formulir ini dirancang berdasarkan FORMULIR PERMOHONAN PINDAH DATANG WNI (F.1-37).
--}}

<h5 class="mt-4">2. Data Daerah Asal</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[asal][no_kk]">Nomor Kartu Keluarga</label>
        <input type="text" id="form_data[asal][no_kk]" name="form_data[asal][no_kk]" class="form-control"
            placeholder="16 digit nomor KK" value="{{ old('form_data.asal.no_kk') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[asal][nama_kk]">Nama Kepala Keluarga</label>
        <input type="text" id="form_data[asal][nama_kk]" name="form_data[asal][nama_kk]" class="form-control"
            placeholder="Nama sesuai KK" value="{{ old('form_data.asal.nama_kk') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[asal][alamat]">Alamat Asal</label>
        <textarea name="form_data[asal][alamat]" id="form_data[asal][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap daerah asal" required>{{ old('form_data.asal.alamat') }}</textarea>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="form_data[asal][rt]">RT</label>
        <input type="text" id="form_data[asal][rt]" name="form_data[asal][rt]" class="form-control" placeholder="001"
            value="{{ old('form_data.asal.rt') }}" required />
    </div>
    <div class="col-md-3">
        <label class="form-label" for="form_data[asal][rw]">RW</label>
        <input type="text" id="form_data[asal][rw]" name="form_data[asal][rw]" class="form-control" placeholder="001"
            value="{{ old('form_data.asal.rw') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[asal][kode_pos]">Kode Pos Asal</label>
        <input type="text" id="form_data[asal][kode_pos]" name="form_data[asal][kode_pos]" class="form-control"
            placeholder="Kode pos" value="{{ old('form_data.asal.kode_pos') }}" />
    </div>
</div>
<div class="alert alert-info p-2 mt-4" role="alert">
    <i class="ti ti-info-circle me-1"></i>
    Data NIK dan Nama Lengkap Pemohon diambil dari data pengajuan utama.
</div>


<hr class="my-4" />

<h5 class="mt-4">3. Data Kepindahan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[tujuan][alasan]">Alasan Pindah</label>
        <select class="form-select" id="form_data[tujuan][alasan]" name="form_data[tujuan][alasan]" required>
            <option value="" disabled selected>Pilih Alasan</option>
            <option value="Pekerjaan">Pekerjaan</option>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Keamanan">Keamanan</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Perumahan">Perumahan</option>
            <option value="Keluarga">Keluarga</option>
            <option value="Lainnya">Lainnya</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[tujuan][alamat]">Alamat Tujuan</label>
        <textarea name="form_data[tujuan][alamat]" id="form_data[tujuan][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap daerah tujuan pindah" required>{{ old('form_data.tujuan.alamat') }}</textarea>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="form_data[tujuan][rt]">RT</label>
        <input type="text" id="form_data[tujuan][rt]" name="form_data[tujuan][rt]" class="form-control"
            placeholder="001" value="{{ old('form_data.tujuan.rt') }}" required />
    </div>
    <div class="col-md-3">
        <label class="form-label" for="form_data[tujuan][rw]">RW</label>
        <input type="text" id="form_data[tujuan][rw]" name="form_data[tujuan][rw]" class="form-control"
            placeholder="001" value="{{ old('form_data.tujuan.rw') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tujuan][kode_pos]">Kode Pos Tujuan</label>
        <input type="text" id="form_data[tujuan][kode_pos]" name="form_data[tujuan][kode_pos]"
            class="form-control" placeholder="Kode pos" value="{{ old('form_data.tujuan.kode_pos') }}" />
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Data Keluarga yang Pindah</h5>
<p class="text-muted">Isi data anggota keluarga yang ikut pindah, termasuk pemohon sendiri. Klik "Tambah Anggota" untuk
    menambahkan.</p>
<div id="keluarga-pindah-list">
    {{-- Anggota keluarga pertama (wajib) --}}
    <div class="card keluarga-pindah-item mb-3">
        <div class="card-body">
            <h6 class="card-title fw-bold">Anggota 1</h6>
            <div class="row g-3">
                <div class="col-lg-4">
                    <label class="form-label">NIK</label>
                    <input type="text" name="form_data[keluarga_pindah][0][nik]" class="form-control"
                        placeholder="16 digit NIK" required>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="form_data[keluarga_pindah][0][nama]" class="form-control"
                        placeholder="Nama sesuai KTP" required>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">SHDK</label>
                    <select class="form-select" name="form_data[keluarga_pindah][0][shdk]" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Menantu">Menantu</option>
                        <option value="Cucu">Cucu</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Mertua">Mertua</option>
                        <option value="Famili Lain">Famili Lain</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" id="btn-tambah-keluarga" class="btn btn-outline-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Anggota Keluarga
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnTambahKeluarga = document.getElementById('btn-tambah-keluarga');
        const listKeluarga = document.getElementById('keluarga-pindah-list');
        let keluargaIndex = 1; // Mulai dari 1 karena 0 sudah ada

        if (btnTambahKeluarga && listKeluarga) {
            // Fungsi untuk memperbarui nomor urut dan atribut 'name'
            const updateIndexes = () => {
                const items = listKeluarga.querySelectorAll('.keluarga-pindah-item');
                items.forEach((item, index) => {
                    // Update judul (e.g., "Anggota 1", "Anggota 2")
                    const title = item.querySelector('.card-title');
                    if (title) {
                        title.textContent = `Anggota ${index + 1}`;
                    }

                    // Update atribut 'name' pada semua input/select di dalam item
                    const inputs = item.querySelectorAll('[name]');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        // Regex untuk mengganti angka di dalam kurung siku, e.g., keluarga_pindah[0][nik] -> keluarga_pindah[1][nik]
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        input.setAttribute('name', newName);
                    });
                });
            };

            btnTambahKeluarga.addEventListener('click', function() {
                const currentIndex = listKeluarga.querySelectorAll('.keluarga-pindah-item').length;
                const newItem = document.createElement('div');
                newItem.classList.add('card', 'keluarga-pindah-item', 'mb-3');

                // Template HTML untuk item baru. Perhatikan penggunaan `currentIndex` untuk indeks awal.
                newItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title fw-bold">Anggota ${currentIndex + 1}</h6>
                    <button type="button" class="btn-close btn-remove-item" aria-label="Close"></button>
                </div>
                <div class="row g-3">
                    <div class="col-lg-4">
                        <label class="form-label">NIK</label>
                        <input type="text" name="form_data[keluarga_pindah][${currentIndex}][nik]" class="form-control" placeholder="16 digit NIK" required>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="form_data[keluarga_pindah][${currentIndex}][nama]" class="form-control" placeholder="Nama sesuai KTP" required>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">SHDK</label>
                        <select class="form-select" name="form_data[keluarga_pindah][${currentIndex}][shdk]" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Suami">Suami</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Menantu">Menantu</option>
                            <option value="Cucu">Cucu</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Mertua">Mertua</option>
                            <option value="Famili Lain">Famili Lain</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>`;

                listKeluarga.appendChild(newItem);
            });

            // Event listener untuk tombol hapus (menggunakan event delegation)
            listKeluarga.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('btn-remove-item')) {
                    // Hapus elemen card dari DOM
                    e.target.closest('.keluarga-pindah-item').remove();
                    // Panggil fungsi untuk memperbarui semua nomor urut dan atribut 'name'
                    updateIndexes();
                }
            });
        }
    });
</script>
