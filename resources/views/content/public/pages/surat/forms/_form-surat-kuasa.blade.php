{{--
    Formulir ini dirancang berdasarkan SURAT KUASA.
    Data Pemberi Kuasa (Pihak I) NIK & Nama diambil dari form utama sebagai data pemohon.
--}}

<h5 class="mt-4">1. Data Pemberi Kuasa (Pihak I)</h5>
{{-- Wrapper untuk menampung semua blok PEMBERI kuasa --}}
<div id="pemberi-kuasa-wrapper">
    {{-- Blok pertama untuk Pemberi Kuasa (Pemohon Utama) --}}
    <div class="pemberi-kuasa-blok mb-3 border p-3 rounded">
        <h6 class="fw-semibold">Pemberi Kuasa 1 (Pemohon Utama)</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                {{-- NIK dan Nama untuk Pemberi Kuasa 1 diambil dari form utama --}}
                <input type="text" name="form_data[pihak1][0][tempat_lahir]" class="form-control"
                    placeholder="Tempat lahir Anda" required />
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="text" name="form_data[pihak1][0][tanggal_lahir]" class="form-control dob-picker"
                    placeholder="YYYY-MM-DD" required />
            </div>
            <div class="col-md-12">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="form_data[pihak1][0][pekerjaan]" class="form-control"
                    placeholder="Pekerjaan Anda" required />
            </div>
            <div class="col-12">
                <label class="form-label">Alamat</label>
                <textarea name="form_data[pihak1][0][alamat]" class="form-control" rows="2"
                    placeholder="Alamat lengkap sesuai KTP" required></textarea>
            </div>
            {{-- Input tersembunyi untuk NIK dan Nama dari form utama --}}
            <input type="hidden" name="form_data[pihak1][0][nik]" value="">
            <input type="hidden" name="form_data[pihak1][0][nama]" value="">
        </div>
    </div>
</div>
{{-- Tombol untuk menambah PEMBERI kuasa baru --}}
<button type="button" id="tambah-pemberi-btn" class="btn btn-label-primary mt-2">
    <i class="ti ti-plus me-1"></i>Tambah Pemberi Kuasa
</button>

<hr class="my-4" />

<h5 class="mt-4">2. Data Penerima Kuasa (Pihak II)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][nama]">Nama Lengkap Penerima Kuasa</label>
        <input type="text" id="form_data[pihak2][nama]" name="form_data[pihak2][nama]" class="form-control"
            placeholder="Nama lengkap Pihak II" value="{{ old('form_data.pihak2.nama') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][nik]">NIK Penerima Kuasa</label>
        <input type="text" id="form_data[pihak2][nik]" name="form_data[pihak2][nik]" class="form-control"
            placeholder="16 Digit NIK Pihak II" value="{{ old('form_data.pihak2.nik') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][tempat_lahir]">Tempat Lahir Penerima Kuasa</label>
        <input type="text" id="form_data[pihak2][tempat_lahir]" name="form_data[pihak2][tempat_lahir]"
            class="form-control" placeholder="Tempat lahir Pihak II" value="{{ old('form_data.pihak2.tempat_lahir') }}"
            required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pihak2][tanggal_lahir]">Tanggal Lahir Penerima Kuasa</label>
        <input type="text" id="form_data[pihak2][tanggal_lahir]" name="form_data[pihak2][tanggal_lahir]"
            class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.pihak2.tanggal_lahir') }}"
            required />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[pihak2][pekerjaan]">Pekerjaan Penerima Kuasa</label>
        <input type="text" id="form_data[pihak2][pekerjaan]" name="form_data[pihak2][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Pihak II" value="{{ old('form_data.pihak2.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[pihak2][alamat]">Alamat Penerima Kuasa</label>
        <textarea name="form_data[pihak2][alamat]" id="form_data[pihak2][alamat]" class="form-control" rows="2"
            placeholder="Alamat lengkap Pihak II sesuai KTP" required>{{ old('form_data.pihak2.alamat') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Isi Kuasa</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[kuasa][tujuan]">Tujuan Pemberian Kuasa</label>
        <textarea name="form_data[kuasa][tujuan]" id="form_data[kuasa][tujuan]" class="form-control" rows="3"
            placeholder="Jelaskan untuk apa surat kuasa ini dibuat" required>{{ old('form_data.kuasa.tujuan', 'Untuk pengambilan BPKB dan STNK Kendaraan Roda 2 (dua) Atas Nama PIHAK I (PEMBERI KUASA).') }}</textarea>
    </div>

    <div class="col-12">
        <h6 class="fw-semibold mt-3">Data Objek yang Dikuasakan (Contoh: Kendaraan)</h6>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][merk_tipe]">Merk / Tipe</label>
        <input type="text" id="form_data[kendaraan][merk_tipe]" name="form_data[kendaraan][merk_tipe]"
            class="form-control" placeholder="Contoh: HONDA / NF 125 TR"
            value="{{ old('form_data.kendaraan.merk_tipe') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][tahun_cc]">Tahun Pembuatan / CC</label>
        <input type="text" id="form_data[kendaraan][tahun_cc]" name="form_data[kendaraan][tahun_cc]"
            class="form-control" placeholder="Contoh: 2008 / 125 CC"
            value="{{ old('form_data.kendaraan.tahun_cc') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][warna]">Warna</label>
        <input type="text" id="form_data[kendaraan][warna]" name="form_data[kendaraan][warna]"
            class="form-control" placeholder="Contoh: HITAM" value="{{ old('form_data.kendaraan.warna') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][no_polisi]">No. Polisi</label>
        <input type="text" id="form_data[kendaraan][no_polisi]" name="form_data[kendaraan][no_polisi]"
            class="form-control" placeholder="Contoh: B 6520 FVE"
            value="{{ old('form_data.kendaraan.no_polisi') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][no_rangka]">No. Rangka</label>
        <input type="text" id="form_data[kendaraan][no_rangka]" name="form_data[kendaraan][no_rangka]"
            class="form-control" placeholder="Nomor Rangka Kendaraan"
            value="{{ old('form_data.kendaraan.no_rangka') }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[kendaraan][no_mesin]">No. Mesin</label>
        <input type="text" id="form_data[kendaraan][no_mesin]" name="form_data[kendaraan][no_mesin]"
            class="form-control" placeholder="Nomor Mesin Kendaraan"
            value="{{ old('form_data.kendaraan.no_mesin') }}" />
    </div>
    <div class="col-md-12">
        <label class="form-label" for="form_data[kendaraan][no_bpkb]">No. BPKB</label>
        <input type="text" id="form_data[kendaraan][no_bpkb]" name="form_data[kendaraan][no_bpkb]"
            class="form-control" placeholder="Nomor BPKB" value="{{ old('form_data.kendaraan.no_bpkb') }}" />
    </div>
</div>

@push('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sync NIK dan Nama dari form utama ke data Pihak I[0]
            const mainNikInput = document.getElementById('nik');
            const mainNamaInput = document.getElementById('nama_lengkap');
            const hiddenNikInput = document.querySelector('input[name="form_data[pihak1][0][nik]"]');
            const hiddenNamaInput = document.querySelector('input[name="form_data[pihak1][0][nama]"]');

            function syncPemberi1() {
                hiddenNikInput.value = mainNikInput.value;
                hiddenNamaInput.value = mainNamaInput.value;
            }
            mainNikInput.addEventListener('input', syncPemberi1);
            mainNamaInput.addEventListener('input', syncPemberi1);
            syncPemberi1(); // Panggil saat awal load

            // Logika untuk menambah/hapus pemberi kuasa
            const wrapper = document.getElementById('pemberi-kuasa-wrapper');
            const addButton = document.getElementById('tambah-pemberi-btn');
            let pemberiCount = 1;

            addButton.addEventListener('click', function() {
                pemberiCount++;
                const newBlock = document.createElement('div');
                newBlock.className = 'pemberi-kuasa-blok mb-3 border p-3 rounded';
                // Formulir untuk pemberi kuasa tambahan akan meminta NIK dan Nama
                newBlock.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-semibold mb-0">Pemberi Kuasa ${pemberiCount}</h6>
                <button type="button" class="btn btn-sm btn-label-danger hapus-pemberi-btn">
                    <i class="ti ti-trash me-1"></i>Hapus
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">NIK Pemberi Kuasa</label>
                    <input type="text" name="form_data[pihak1][${pemberiCount-1}][nik]" class="form-control" placeholder="16 Digit NIK" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap Pemberi Kuasa</label>
                    <input type="text" name="form_data[pihak1][${pemberiCount-1}][nama]" class="form-control" placeholder="Nama Lengkap" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="form_data[pihak1][${pemberiCount-1}][tempat_lahir]" class="form-control" placeholder="Tempat Lahir" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="text" name="form_data[pihak1][${pemberiCount-1}][tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" required />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" name="form_data[pihak1][${pemberiCount-1}][pekerjaan]" class="form-control" placeholder="Pekerjaan" required />
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="form_data[pihak1][${pemberiCount-1}][alamat]" class="form-control" rows="2" placeholder="Alamat lengkap sesuai KTP" required></textarea>
                </div>
            </div>
        `;
                wrapper.appendChild(newBlock);
                flatpickr(newBlock.querySelector('.dob-picker'), {
                    monthSelectorType: 'static'
                });
            });

            // Event listener untuk tombol hapus
            wrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('hapus-pemberi-btn') || e.target.closest(
                        '.hapus-pemberi-btn')) {
                    e.target.closest('.pemberi-kuasa-blok').remove();
                }
            });
        });
    </script>
@endpush
