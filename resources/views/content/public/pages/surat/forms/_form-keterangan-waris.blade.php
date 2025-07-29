{{--
    Formulir ini dirancang untuk menangani berbagai skenario Surat Keterangan Waris.
    Termasuk kemampuan untuk menambah ahli waris secara dinamis.
--}}

<h5 class="mt-4">2. Data Pewaris (Almarhum/Almarhumah)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pewaris][nama]">Nama Lengkap Pewaris</label>
        <input type="text" id="form_data[pewaris][nama]" name="form_data[pewaris][nama]" class="form-control"
            placeholder="Nama sesuai dokumen kependudukan" value="{{ old('form_data.pewaris.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pewaris][umur]">Umur Terakhir</label>
        <input type="number" id="form_data[pewaris][umur]" name="form_data[pewaris][umur]" class="form-control"
            placeholder="Contoh: 80" value="{{ old('form_data.pewaris.umur') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pewaris][pekerjaan]">Pekerjaan Terakhir</label>
        <input type="text" id="form_data[pewaris][pekerjaan]" name="form_data[pewaris][pekerjaan]"
            class="form-control" placeholder="Contoh: Mengurus Rumah Tangga"
            value="{{ old('form_data.pewaris.pekerjaan') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pewaris][tanggal_meninggal]">Tanggal Meninggal Dunia</label>
        <input type="text" id="form_data[pewaris][tanggal_meninggal]" name="form_data[pewaris][tanggal_meninggal]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pewaris.tanggal_meninggal') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pewaris][alamat]">Alamat Terakhir</label>
        <textarea name="form_data[pewaris][alamat]" id="form_data[pewaris][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap terakhir sesuai KTP" required>{{ old('form_data.pewaris.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Ahli Waris</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[ahli_waris_hubungan]">Hubungan Ahli Waris dengan Pewaris</label>
        <select class="form-select" id="form_data[ahli_waris_hubungan]" name="form_data[ahli_waris_hubungan]" required>
            <option value="Anak" @if (old('form_data.ahli_waris_hubungan') == 'Anak') selected @endif>Anak</option>
            <option value="Cucu" @if (old('form_data.ahli_waris_hubungan') == 'Cucu') selected @endif>Cucu</option>
        </select>
    </div>
</div>

<div id="ahli-waris-list" class="mt-4">
    {{-- Ahli waris pertama (wajib) --}}
    <div class="card ahli-waris-item mb-3">
        <div class="card-body">
            <h6 class="card-title fw-bold">Ahli Waris 1</h6>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="form_data[ahli_waris][0][nama]" class="form-control"
                        placeholder="Nama ahli waris" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NIK (Opsional)</label>
                    <input type="text" name="form_data[ahli_waris][0][nik]" class="form-control"
                        placeholder="16 digit NIK">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat, Tanggal Lahir (Opsional)</label>
                    <input type="text" name="form_data[ahli_waris][0][ttl]" class="form-control"
                        placeholder="Contoh: Bekasi, 01-01-1990">
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" id="btn-tambah-ahli-waris" class="btn btn-outline-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Ahli Waris
</button>


<hr class="my-4" />

<h5 class="mt-4">4. Data Saksi</h5>
<p class="text-muted">Isi dengan nama Ketua RT dan RW setempat.</p>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1][nama]">Nama Saksi 1</label>
        <input type="text" id="form_data[saksi_1][nama]" name="form_data[saksi_1][nama]" class="form-control"
            placeholder="Nama lengkap saksi pertama" value="{{ old('form_data.saksi_1.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_1][jabatan]">Jabatan Saksi 1</label>
        <input type="text" id="form_data[saksi_1][jabatan]" name="form_data[saksi_1][jabatan]"
            class="form-control" placeholder="Contoh: Ketua RT. 001" value="{{ old('form_data.saksi_1.jabatan') }}"
            required />
    </div>
</div>
<div class="row g-3 mt-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2][nama]">Nama Saksi 2</label>
        <input type="text" id="form_data[saksi_2][nama]" name="form_data[saksi_2][nama]" class="form-control"
            placeholder="Nama lengkap saksi kedua" value="{{ old('form_data.saksi_2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[saksi_2][jabatan]">Jabatan Saksi 2</label>
        <input type="text" id="form_data[saksi_2][jabatan]" name="form_data[saksi_2][jabatan]"
            class="form-control" placeholder="Contoh: Ketua RW. 001" value="{{ old('form_data.saksi_2.jabatan') }}"
            required />
    </div>
</div>

{{-- ▼▼▼ PERBAIKAN: Skrip dipindahkan dari @push ke tag <script> langsung ▼▼▼ --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnTambahWaris = document.getElementById('btn-tambah-ahli-waris');
        const listWaris = document.getElementById('ahli-waris-list');

        if (btnTambahWaris && listWaris) {
            const updateIndexes = () => {
                const items = listWaris.querySelectorAll('.ahli-waris-item');
                items.forEach((item, index) => {
                    const title = item.querySelector('.card-title');
                    if (title) {
                        title.textContent = `Ahli Waris ${index + 1}`;
                    }

                    const inputs = item.querySelectorAll('[name]');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        input.setAttribute('name', newName);
                    });
                });
            };

            btnTambahWaris.addEventListener('click', function() {
                const currentIndex = listWaris.querySelectorAll('.ahli-waris-item').length;
                const newItem = document.createElement('div');
                newItem.classList.add('card', 'ahli-waris-item', 'mb-3');

                newItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title fw-bold">Ahli Waris ${currentIndex + 1}</h6>
                    <button type="button" class="btn-close btn-remove-item" aria-label="Close"></button>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="form_data[ahli_waris][${currentIndex}][nama]" class="form-control" placeholder="Nama ahli waris" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK (Opsional)</label>
                        <input type="text" name="form_data[ahli_waris][${currentIndex}][nik]" class="form-control" placeholder="16 digit NIK">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat, Tanggal Lahir (Opsional)</label>
                        <input type="text" name="form_data[ahli_waris][${currentIndex}][ttl]" class="form-control" placeholder="Contoh: Bekasi, 01-01-1990">
                    </div>
                </div>
            </div>`;

                listWaris.appendChild(newItem);
            });

            listWaris.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('btn-remove-item')) {
                    e.target.closest('.ahli-waris-item').remove();
                    updateIndexes();
                }
            });
        }
    });
</script>
