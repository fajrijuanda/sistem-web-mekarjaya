{{--
    Formulir ini dirancang berdasarkan SURAT KUASA.
    Data Pemberi Kuasa (Pihak I) NIK & Nama diambil dari form utama sebagai data pemohon.
--}}

<h5 class="mt-4 fw-semibold">2. Data Pemberi Kuasa (Pihak I)</h5>
{{-- Wrapper untuk menampung semua blok PEMBERI kuasa --}}
<div id="pemberi-kuasa-wrapper">
    {{-- Blok pertama untuk Pemberi Kuasa (Pemohon Utama) --}}
    <div class="pemberi-kuasa-blok mb-3">
        <div class="alert alert-info p-2" role="alert">
            <i class="ti ti-info-circle me-1"></i>
            <strong>Pemberi Kuasa 1 (Anda sebagai Pemohon Utama):</strong> Data Anda (Nama, NIK, Alamat, dll.) diambil
            dari form "1. Data Diri Pemohon".
        </div>
    </div>
</div>
{{-- Tombol untuk menambah PEMBERI kuasa baru --}}
<button type="button" id="tambah-pemberi-btn" class="btn btn-label-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Pemberi Kuasa Lain
</button>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">3. Data Penerima Kuasa (Pihak II)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="pihak2_nama">Nama Lengkap Penerima Kuasa</label>
        <input type="text" id="pihak2_nama" name="form_data[pihak2][nama]" class="form-control"
            placeholder="Nama lengkap Pihak II" value="{{ old('form_data.pihak2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_nik">NIK Penerima Kuasa</label>
        <input type="text" id="pihak2_nik" name="form_data[pihak2][nik]" class="form-control"
            placeholder="16 Digit NIK Pihak II" value="{{ old('form_data.pihak2.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_tempat_lahir">Tempat Lahir Penerima Kuasa</label>
        <input type="text" id="pihak2_tempat_lahir" name="form_data[pihak2][tempat_lahir]" class="form-control"
            placeholder="Tempat lahir Pihak II" value="{{ old('form_data.pihak2.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="pihak2_tanggal_lahir">Tanggal Lahir Penerima Kuasa</label>
        <input type="text" id="pihak2_tanggal_lahir" name="form_data[pihak2][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="YYYY-MM-DD"
            value="{{ old('form_data.pihak2.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="pihak2_pekerjaan">Pekerjaan Penerima Kuasa</label>
        <input type="text" id="pihak2_pekerjaan" name="form_data[pihak2][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Pihak II" value="{{ old('form_data.pihak2.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="pihak2_alamat">Alamat Penerima Kuasa</label>
        <textarea name="form_data[pihak2][alamat]" id="pihak2_alamat" class="form-control" rows="2"
            placeholder="Alamat lengkap Pihak II sesuai KTP" required>{{ old('form_data.pihak2.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4 fw-semibold">4. Isi Kuasa</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="kuasa_tujuan">Tujuan Pemberian Kuasa</label>
        <textarea name="form_data[kuasa][tujuan]" id="kuasa_tujuan" class="form-control" rows="3"
            placeholder="Jelaskan untuk apa surat kuasa ini dibuat" required>{{ old('form_data.kuasa.tujuan', 'Untuk pengambilan BPKB dan STNK Kendaraan Roda 2 (dua) Atas Nama PIHAK I (PEMBERI KUASA).') }}</textarea>
    </div>

    <div class="col-12">
        <h6 class="fw-semibold mt-3">Data Objek yang Dikuasakan (Contoh: Kendaraan)</h6>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_merk_tipe">Merk / Tipe</label>
        <input type="text" id="kendaraan_merk_tipe" name="form_data[kendaraan][merk_tipe]" class="form-control"
            placeholder="Contoh: HONDA / NF 125 TR" value="{{ old('form_data.kendaraan.merk_tipe') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_tahun_cc">Tahun Pembuatan / CC</label>
        <input type="text" id="kendaraan_tahun_cc" name="form_data[kendaraan][tahun_cc]" class="form-control"
            placeholder="Contoh: 2008 / 125 CC" value="{{ old('form_data.kendaraan.tahun_cc') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_warna">Warna</label>
        <input type="text" id="kendaraan_warna" name="form_data[kendaraan][warna]" class="form-control"
            placeholder="Contoh: HITAM" value="{{ old('form_data.kendaraan.warna') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_no_polisi">No. Polisi</label>
        <input type="text" id="kendaraan_no_polisi" name="form_data[kendaraan][no_polisi]" class="form-control"
            placeholder="Contoh: B 6520 FVE" value="{{ old('form_data.kendaraan.no_polisi') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_no_rangka">No. Rangka</label>
        <input type="text" id="kendaraan_no_rangka" name="form_data[kendaraan][no_rangka]" class="form-control"
            placeholder="Nomor Rangka Kendaraan" value="{{ old('form_data.kendaraan.no_rangka') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="kendaraan_no_mesin">No. Mesin</label>
        <input type="text" id="kendaraan_no_mesin" name="form_data[kendaraan][no_mesin]" class="form-control"
            placeholder="Nomor Mesin Kendaraan" value="{{ old('form_data.kendaraan.no_mesin') }}" />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="kendaraan_no_bpkb">No. BPKB</label>
        <input type="text" id="kendaraan_no_bpkb" name="form_data[kendaraan][no_bpkb]" class="form-control"
            placeholder="Nomor BPKB" value="{{ old('form_data.kendaraan.no_bpkb') }}" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk menambah/hapus pemberi kuasa
        const wrapper = document.getElementById('pemberi-kuasa-wrapper');
        const addButton = document.getElementById('tambah-pemberi-btn');

        if (wrapper && addButton) {
            const updateIndexes = () => {
                const items = wrapper.querySelectorAll('.pemberi-kuasa-blok');
                items.forEach((item, index) => {
                    // Lewati item pertama (pemohon utama) karena tidak memiliki input form
                    if (index === 0) return;

                    const title = item.querySelector('h6');
                    if (title) {
                        title.textContent = `Pemberi Kuasa ${index + 1}`;
                    }

                    const inputs = item.querySelectorAll('[name]');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        // Ganti indeks array, misal: pihak1[0] menjadi pihak1[1]
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        input.setAttribute('name', newName);
                    });
                });
            };

            addButton.addEventListener('click', function() {
                const currentIndex = wrapper.querySelectorAll('.pemberi-kuasa-blok').length;
                const newBlock = document.createElement('div');
                newBlock.className = 'pemberi-kuasa-blok mb-3 border p-3 rounded';

                newBlock.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-semibold mb-0">Pemberi Kuasa ${currentIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-label-danger hapus-pemberi-btn">
                            <i class="ti ti-trash me-1"></i>Hapus
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK Pemberi Kuasa</label>
                            <input type="text" name="form_data[pihak1][${currentIndex}][nik]" class="form-control" placeholder="16 Digit NIK" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Pemberi Kuasa</label>
                            <input type="text" name="form_data[pihak1][${currentIndex}][nama]" class="form-control" placeholder="Nama Lengkap" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="form_data[pihak1][${currentIndex}][tempat_lahir]" class="form-control" placeholder="Tempat Lahir" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="text" name="form_data[pihak1][${currentIndex}][tanggal_lahir]" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" required />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="form_data[pihak1][${currentIndex}][pekerjaan]" class="form-control" placeholder="Pekerjaan" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="form_data[pihak1][${currentIndex}][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required></textarea>
                        </div>
                    </div>
                `;
                wrapper.appendChild(newBlock);
                // Inisialisasi ulang flatpickr untuk elemen baru
                if (typeof flatpickr !== 'undefined') {
                    flatpickr(newBlock.querySelector('.flatpickr-date'), {});
                }
            });

            // Event listener untuk tombol hapus
            wrapper.addEventListener('click', function(e) {
                const deleteButton = e.target.closest('.hapus-pemberi-btn');
                if (deleteButton) {
                    deleteButton.closest('.pemberi-kuasa-blok').remove();
                    updateIndexes();
                }
            });
        }
    });
</script>
