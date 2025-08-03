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

{{-- ======================================================================= --}}
{{-- ✅ DROPDOWN PEMILIHAN SUB-JENIS SURAT --}}
{{-- ======================================================================= --}}
<h5 class="mt-4 fw-semibold">2. Pilih Jenis Pernyataan</h5>
<div class="row">
    <div class="col-md-7 mb-4">
        <label for="sub_jenis_surat" class="form-label">Jenis Pernyataan Tidak Keberatan yang Anda butuhkan:</label>
        <select id="sub_jenis_surat" name="form_data[sub_jenis]" class="form-select" required>
            <option value="" selected disabled>-- Pilih Jenis Pernyataan --</option>
            <option value="kk">Untuk Penggunaan Kartu Keluarga (KK)</option>
            <option value="akta">Untuk Penerbitan Akta Kelahiran</option>
        </select>
    </div>
</div>


{{-- ======================================================================= --}}
{{-- ✅ KONTENER UNTUK FORM PENGGUNAAN KK (Awalnya tersembunyi) --}}
{{-- ======================================================================= --}}
<div id="form-container-kk" class="form-wrapper" style="display: none;">
    <h5 class="mt-4 fw-semibold">3. Data Pihak II (Pihak yang Diberi Izin Penggunaan KK)</h5>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="pihak2_nama">Nama Lengkap Pihak II</label>
            <input type="text" id="pihak2_nama" name="form_data[pihak2][nama]" class="form-control"
                placeholder="Nama lengkap saudara/pihak terkait" value="{{ old('form_data.pihak2.nama') }}" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="pihak2_nik">NIK Pihak II</label>
            <input type="text" id="pihak2_nik" name="form_data[pihak2][nik]" class="form-control"
                placeholder="16 Digit NIK saudara/pihak terkait" value="{{ old('form_data.pihak2.nik') }}" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="pihak2_tempat_lahir">Tempat Lahir Pihak II</label>
            <input type="text" id="pihak2_tempat_lahir" name="form_data[pihak2][tempat_lahir]" class="form-control"
                placeholder="Tempat lahir Pihak II" value="{{ old('form_data.pihak2.tempat_lahir') }}" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="pihak2_tanggal_lahir">Tanggal Lahir Pihak II</label>
            <input type="date" id="pihak2_tanggal_lahir" name="form_data[pihak2][tanggal_lahir]" class="form-control"
                placeholder="YYYY-MM-DD" value="{{ old('form_data.pihak2.tanggal_lahir') }}" />
        </div>
        <div class="col-12">
            <label class="form-label" for="pihak2_alamat">Alamat Pihak II</label>
            <textarea name="form_data[pihak2][alamat]" id="pihak2_alamat" class="form-control" rows="2"
                placeholder="Alamat lengkap Pihak II sesuai KTP">{{ old('form_data.pihak2.alamat') }}</textarea>
        </div>
    </div>

    <hr class="my-4" />

    <h5 class="mt-4 fw-semibold">4. Detail Pernyataan KK</h5>
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label" for="pernyataan_isi_kk">Tujuan Penggunaan KK</label>
            <textarea name="form_data[pernyataan_kk][isi]" id="pernyataan_isi_kk" class="form-control" rows="3"
                placeholder="Contoh: persyaratan administrasi perpanjangan kontrak kerja">{{ old('form_data.pernyataan_kk.isi') }}</textarea>
            <div class="form-text">Jelaskan untuk keperluan apa KK akan digunakan.</div>
        </div>
    </div>
</div>


{{-- ======================================================================= --}}
{{-- ✅ KONTENER UNTUK FORM AKTA KELAHIRAN (Awalnya tersembunyi) --}}
{{-- ======================================================================= --}}
<div id="form-container-akta" class="form-wrapper" style="display: none;">
    <h5 class="mt-4 fw-semibold">3. Data Anak</h5>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="akta_nama_anak">Nama Lengkap Anak</label>
            <input type="text" id="akta_nama_anak" name="form_data[akta][nama_anak]" class="form-control" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="akta_ttl_anak">Tempat/Tanggal Lahir Anak</label>
            <input type="text" id="akta_ttl_anak" name="form_data[akta][ttl_anak]" class="form-control"
                placeholder="Contoh: Bekasi, 01 Januari 2020" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="akta_jenis_kelamin">Jenis Kelamin</label>
            <select id="akta_jenis_kelamin" name="form_data[akta][jenis_kelamin_anak]" class="form-select">
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="akta_anak_ke">Anak Ke</label>
            <input type="number" id="akta_anak_ke" name="form_data[akta][anak_ke]" class="form-control"
                placeholder="Contoh: 1" />
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subJenisDropdown = document.getElementById('sub_jenis_surat');

        subJenisDropdown.addEventListener('change', function() {
            // Sembunyikan semua form wrapper terlebih dahulu
            document.querySelectorAll('.form-wrapper').forEach(function(wrapper) {
                wrapper.style.display = 'none';
            });

            // Tampilkan form yang sesuai dengan pilihan
            const selectedFormId = `form-container-${this.value}`;
            const selectedForm = document.getElementById(selectedFormId);
            if (selectedForm) {
                selectedForm.style.display = 'block';
            }
        });
    });
</script>
