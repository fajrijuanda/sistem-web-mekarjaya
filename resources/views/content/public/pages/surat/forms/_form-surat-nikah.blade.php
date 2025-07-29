{{--
    Formulir Surat Nikah Versi Final dan Paling Lengkap.
    Dirancang berdasarkan kelengkapan data dari Form N1 s/d N6.
    Struktur datar tanpa accordion untuk pengisian langsung.
--}}

{{-- Data Calon Mempelai 1 (Pemohon) --}}
<h5 class="mt-4 fw-semibold">2. Data Lanjutan Calon Mempelai (Pemohon)</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="mempelai1_status_perkawinan">Status Perkawinan</label>
        <select class="form-select" name="form_data[mempelai1][status_perkawinan]" id="mempelai1_status_perkawinan"
            required>
            <option value="">-- Pilih Status --</option>
            <option value="Jejaka" @selected(old('form_data.mempelai1.status_perkawinan') == 'Jejaka')>Jejaka</option>
            <option value="Perawan" @selected(old('form_data.mempelai1.status_perkawinan') == 'Perawan')>Perawan</option>
            <option value="Duda" @selected(old('form_data.mempelai1.status_perkawinan') == 'Duda')>Duda</option>
            <option value="Janda" @selected(old('form_data.mempelai1.status_perkawinan') == 'Janda')>Janda</option>
            <option value="Beristri" @selected(old('form_data.mempelai1.status_perkawinan') == 'Beristri')>Beristri</option>
        </select>
    </div>
    <div class="col-md-6" id="mempelai1_istri_ke_div" style="display: none;">
        <label class="form-label" for="mempelai1_istri_ke">Istri Ke-</label>
        <input type="number" name="form_data[mempelai1][istri_ke]" id="mempelai1_istri_ke" class="form-control"
            placeholder="Istri Ke- (angka)" value="{{ old('form_data.mempelai1.istri_ke') }}">
    </div>
    <div class="col-md-6" id="mempelai1_pasangan_terdahulu_div" style="display: none;">
        <label class="form-label" for="mempelai1_pasangan_terdahulu">Nama Pasangan Terdahulu</label>
        <input type="text" name="form_data[mempelai1][pasangan_terdahulu]" id="mempelai1_pasangan_terdahulu"
            class="form-control" placeholder="Nama Istri/Suami Terdahulu"
            value="{{ old('form_data.mempelai1.pasangan_terdahulu') }}">
    </div>
</div>

{{-- Data Orang Tua Mempelai 1 --}}
<hr class="my-4">
<h5 class="mt-4 fw-semibold">3. Data Orang Tua Calon Mempelai (Pemohon)</h5>
<h6 class="fw-semibold text-muted">Data Ayah Kandung</h6>
<div class="row g-3 mb-3">
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Ayah" value="{{ old('form_data.ortu1.ayah.nama_lengkap') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][nik]" class="form-control"
            placeholder="NIK Ayah" value="{{ old('form_data.ortu1.ayah.nik') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Ayah" value="{{ old('form_data.ortu1.ayah.tempat_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Ayah"
            value="{{ old('form_data.ortu1.ayah.tanggal_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][agama]" class="form-control"
            value="{{ old('form_data.ortu1.ayah.agama', 'Islam') }}" placeholder="Agama Ayah"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ayah" value="{{ old('form_data.ortu1.ayah.pekerjaan') }}"></div>
    <div class="col-12">
        <textarea name="form_data[ortu1][ayah][alamat]" class="form-control" rows="2" placeholder="Alamat Ayah">{{ old('form_data.ortu1.ayah.alamat') }}</textarea>
    </div>
</div>
<h6 class="fw-semibold text-muted mt-3">Data Ibu Kandung</h6>
<div class="row g-3">
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Ibu" value="{{ old('form_data.ortu1.ibu.nama_lengkap') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][nik]" class="form-control"
            placeholder="NIK Ibu" value="{{ old('form_data.ortu1.ibu.nik') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Ibu" value="{{ old('form_data.ortu1.ibu.tempat_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Ibu"
            value="{{ old('form_data.ortu1.ibu.tanggal_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][agama]" class="form-control"
            value="{{ old('form_data.ortu1.ibu.agama', 'Islam') }}" placeholder="Agama Ibu"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ibu" value="{{ old('form_data.ortu1.ibu.pekerjaan') }}"></div>
    <div class="col-12">
        <textarea name="form_data[ortu1][ibu][alamat]" class="form-control" rows="2" placeholder="Alamat Ibu">{{ old('form_data.ortu1.ibu.alamat') }}</textarea>
    </div>
</div>

{{-- Data Calon Mempelai 2 --}}
<hr class="my-4">
<h5 class="mt-4 fw-semibold">4. Data Calon Pasangan</h5>
<div class="row g-3">
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Pasangan" value="{{ old('form_data.mempelai2.nama_lengkap') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][nik]" class="form-control"
            placeholder="NIK Pasangan" value="{{ old('form_data.mempelai2.nik') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Pasangan" value="{{ old('form_data.mempelai2.tempat_lahir') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Pasangan"
            value="{{ old('form_data.mempelai2.tanggal_lahir') }}" required></div>
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][warganegara]" class="form-control"
            value="{{ old('form_data.mempelai2.warganegara', 'Indonesia') }}" placeholder="Warganegara Pasangan"
            required></div>
    <div class="col-md-6"><input type="text" name="form_data[mempelai2][agama]" class="form-control"
            value="{{ old('form_data.mempelai2.agama', 'Islam') }}" placeholder="Agama Pasangan" required></div>
    <div class="col-md-12"><input type="text" name="form_data[mempelai2][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Pasangan" value="{{ old('form_data.mempelai2.pekerjaan') }}" required></div>
    <div class="col-12">
        <textarea name="form_data[mempelai2][alamat]" class="form-control" rows="2"
            placeholder="Alamat Lengkap Pasangan">{{ old('form_data.mempelai2.alamat') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="mempelai2_status_perkawinan">Status Perkawinan Pasangan</label>
        <select class="form-select" name="form_data[mempelai2][status_perkawinan]" id="mempelai2_status_perkawinan"
            required>
            <option value="">-- Pilih Status --</option>
            <option value="Jejaka" @selected(old('form_data.mempelai2.status_perkawinan') == 'Jejaka')>Jejaka</option>
            <option value="Perawan" @selected(old('form_data.mempelai2.status_perkawinan') == 'Perawan')>Perawan</option>
            <option value="Duda" @selected(old('form_data.mempelai2.status_perkawinan') == 'Duda')>Duda</option>
            <option value="Janda" @selected(old('form_data.mempelai2.status_perkawinan') == 'Janda')>Janda</option>
        </select>
    </div>
    <div class="col-md-6" id="mempelai2_pasangan_terdahulu_div" style="display: none;">
        <label class="form-label" for="mempelai2_pasangan_terdahulu">Nama Pasangan Terdahulu</label>
        <input type="text" name="form_data[mempelai2][pasangan_terdahulu]" id="mempelai2_pasangan_terdahulu"
            class="form-control" placeholder="Nama Istri/Suami Terdahulu"
            value="{{ old('form_data.mempelai2.pasangan_terdahulu') }}">
    </div>
</div>

{{-- Data Orang Tua Mempelai 2 --}}
<hr class="my-4">
<h5 class="mt-4 fw-semibold">5. Data Orang Tua Calon Pasangan</h5>
<h6 class="fw-semibold text-muted">Data Ayah Kandung Pasangan</h6>
<div class="row g-3 mb-3">
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Ayah Pasangan" value="{{ old('form_data.ortu2.ayah.nama_lengkap') }}" required>
    </div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][nik]" class="form-control"
            placeholder="NIK Ayah Pasangan" value="{{ old('form_data.ortu2.ayah.nik') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Ayah Pasangan" value="{{ old('form_data.ortu2.ayah.tempat_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Ayah Pasangan"
            value="{{ old('form_data.ortu2.ayah.tanggal_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][agama]" class="form-control"
            value="{{ old('form_data.ortu2.ayah.agama', 'Islam') }}" placeholder="Agama Ayah Pasangan"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ayah Pasangan" value="{{ old('form_data.ortu2.ayah.pekerjaan') }}"></div>
    <div class="col-12">
        <textarea name="form_data[ortu2][ayah][alamat]" class="form-control" rows="2"
            placeholder="Alamat Ayah Pasangan">{{ old('form_data.ortu2.ayah.alamat') }}</textarea>
    </div>
</div>
<h6 class="fw-semibold text-muted mt-3">Data Ibu Kandung Pasangan</h6>
<div class="row g-3">
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Ibu Pasangan" value="{{ old('form_data.ortu2.ibu.nama_lengkap') }}" required>
    </div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][nik]" class="form-control"
            placeholder="NIK Ibu Pasangan" value="{{ old('form_data.ortu2.ibu.nik') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Ibu Pasangan" value="{{ old('form_data.ortu2.ibu.tempat_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Ibu Pasangan"
            value="{{ old('form_data.ortu2.ibu.tanggal_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][agama]" class="form-control"
            value="{{ old('form_data.ortu2.ibu.agama', 'Islam') }}" placeholder="Agama Ibu Pasangan"></div>
    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Ibu Pasangan" value="{{ old('form_data.ortu2.ibu.pekerjaan') }}"></div>
    <div class="col-12">
        <textarea name="form_data[ortu2][ibu][alamat]" class="form-control" rows="2"
            placeholder="Alamat Ibu Pasangan">{{ old('form_data.ortu2.ibu.alamat') }}</textarea>
    </div>
</div>

{{-- Data Wali Nikah --}}
<hr class="my-4">
<h5 class="mt-4 fw-semibold">6. Data Wali Nikah <small class="text-muted fw-normal">(Isi jika wali bukan Ayah
        Kandung)</small></h5>
<div class="row g-3">
    <div class="col-md-6"><input type="text" name="form_data[wali][nama_lengkap]" class="form-control"
            placeholder="Nama Lengkap Wali" value="{{ old('form_data.wali.nama_lengkap') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[wali][nik]" class="form-control"
            placeholder="NIK Wali" value="{{ old('form_data.wali.nik') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[wali][tempat_lahir]" class="form-control"
            placeholder="Tempat Lahir Wali" value="{{ old('form_data.wali.tempat_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[wali][tanggal_lahir]"
            class="form-control flatpickr-date" placeholder="Tanggal Lahir Wali"
            value="{{ old('form_data.wali.tanggal_lahir') }}"></div>
    <div class="col-md-6"><input type="text" name="form_data[wali][agama]" class="form-control"
            value="{{ old('form_data.wali.agama', 'Islam') }}" placeholder="Agama Wali"></div>
    <div class="col-md-6"><input type="text" name="form_data[wali][pekerjaan]" class="form-control"
            placeholder="Pekerjaan Wali" value="{{ old('form_data.wali.pekerjaan') }}"></div>
    <div class="col-12">
        <textarea name="form_data[wali][alamat]" class="form-control" rows="2" placeholder="Alamat Wali">{{ old('form_data.wali.alamat') }}</textarea>
    </div>
    <div class="col-12"><input type="text" name="form_data[wali][hubungan]" class="form-control"
            placeholder="Hubungan dengan Calon Mempelai" value="{{ old('form_data.wali.hubungan') }}"></div>
</div>

{{-- Rencana Pelaksanaan Pernikahan --}}
<hr class="my-4">
<h5 class="mt-4 fw-semibold">7. Rencana Pelaksanaan Pernikahan</h5>
<div class="row g-3">
    <div class="col-md-6"><input type="text" name="form_data[akad][tanggal]" class="form-control flatpickr-date"
            placeholder="Tanggal Akad Nikah" value="{{ old('form_data.akad.tanggal') }}" required></div>
    <div class="col-md-6"><input type="time" name="form_data[akad][waktu]" class="form-control"
            placeholder="Waktu Akad Nikah" value="{{ old('form_data.akad.waktu') }}" required></div>
    <div class="col-12">
        <textarea name="form_data[akad][tempat]" class="form-control" rows="2" placeholder="Tempat/Lokasi Akad Nikah"
            required>{{ old('form_data.akad.tempat') }}</textarea>
    </div>
    <div class="col-12">
        <textarea name="form_data[akad][maskawin]" class="form-control" rows="2" placeholder="Maskawin / Mahar"
            required>{{ old('form_data.akad.maskawin') }}</textarea>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk Mempelai 1
        const statusMempelai1 = document.getElementById('mempelai1_status_perkawinan');
        const istriKeDiv = document.getElementById('mempelai1_istri_ke_div');
        const pasanganTerdahulu1Div = document.getElementById('mempelai1_pasangan_terdahulu_div');

        function handleMempelai1Change() {
            if (!statusMempelai1) return;
            istriKeDiv.style.display = statusMempelai1.value === 'Beristri' ? 'block' : 'none';
            pasanganTerdahulu1Div.style.display = (statusMempelai1.value === 'Duda' || statusMempelai1.value ===
                'Janda') ? 'block' : 'none';
        }

        if (statusMempelai1) {
            statusMempelai1.addEventListener('change', handleMempelai1Change);
            handleMempelai1Change(); // Initial check
        }

        // Logika untuk Mempelai 2
        const statusMempelai2 = document.getElementById('mempelai2_status_perkawinan');
        const pasanganTerdahulu2Div = document.getElementById('mempelai2_pasangan_terdahulu_div');

        function handleMempelai2Change() {
            if (!statusMempelai2) return;
            pasanganTerdahulu2Div.style.display = (statusMempelai2.value === 'Duda' || statusMempelai2.value ===
                'Janda') ? 'block' : 'none';
        }

        if (statusMempelai2) {
            statusMempelai2.addEventListener('change', handleMempelai2Change);
            handleMempelai2Change(); // Initial check
        }
    });
</script>
