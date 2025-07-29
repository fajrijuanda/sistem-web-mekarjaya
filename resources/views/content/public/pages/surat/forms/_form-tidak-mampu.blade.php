{{--
    Formulir ini dirancang untuk SURAT KETERANGAN TIDAK MAMPU (SKTM).
    Data pemohon utama (nama, NIK, alamat, dll.) sudah diambil dari form utama.
    Bagian ini untuk detail keperluan dan untuk siapa surat ini ditujukan.
--}}

<h5 class="mt-4 fw-semibold">2. Detail Keperluan Surat</h5>

<div class="row g-3">
    {{-- Pilihan untuk menentukan untuk siapa surat ini digunakan --}}
    <div class="col-12">
        <label class="form-label">Surat ini digunakan untuk:</label>
        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="form_data[pengguna_type]" id="pengguna_diri_sendiri"
                value="Diri Sendiri" @checked(old('form_data.pengguna_type', 'Diri Sendiri') == 'Diri Sendiri')>
            <label class="form-check-label" for="pengguna_diri_sendiri">
                Diri Sendiri (Pemohon)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="form_data[pengguna_type]" id="pengguna_keluarga_lain"
                value="Keluarga Lain" @checked(old('form_data.pengguna_type') == 'Keluarga Lain')>
            <label class="form-check-label" for="pengguna_keluarga_lain">
                Anggota Keluarga Lain (misal: Anak)
            </label>
        </div>
    </div>

    {{-- Kolom kondisional yang hanya muncul jika "Keluarga Lain" dipilih --}}
    <div id="data_pengguna_lain_div" class="row g-3 ps-4 ms-1 mt-2" style="display: none;">
        <div class="col-md-6">
            <label class="form-label" for="pengguna_nama">Nama Lengkap Pengguna Surat</label>
            <input type="text" id="pengguna_nama" name="form_data[pengguna][nama]" class="form-control"
                placeholder="Nama anak/tanggungan" value="{{ old('form_data.pengguna.nama') }}" />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="pengguna_hubungan">Hubungan dengan Pemohon</label>
            <input type="text" id="pengguna_hubungan" name="form_data[pengguna][hubungan]" class="form-control"
                placeholder="Contoh: Anak Kandung" value="{{ old('form_data.pengguna.hubungan') }}" />
        </div>
    </div>

    {{-- Kolom Keperluan yang selalu tampil --}}
    <div class="col-12 mt-3">
        <label class="form-label" for="keperluan">Keperluan Pembuatan Surat</label>
        <textarea name="form_data[keperluan]" id="keperluan" class="form-control" rows="2"
            placeholder="Tuliskan tujuan pembuatan surat ini. Contoh: Untuk pengajuan beasiswa sekolah atau untuk persyaratan BPJS."
            required>{{ old('form_data.keperluan') }}</textarea>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioDiriSendiri = document.getElementById('pengguna_diri_sendiri');
        const radioKeluargaLain = document.getElementById('pengguna_keluarga_lain');
        const dataPenggunaLainDiv = document.getElementById('data_pengguna_lain_div');
        const namaPenggunaInput = document.getElementById('pengguna_nama');
        const hubunganPenggunaInput = document.getElementById('pengguna_hubungan');

        function togglePenggunaFields() {
            if (radioKeluargaLain.checked) {
                dataPenggunaLainDiv.style.display = 'flex'; // Gunakan 'flex' agar sesuai dengan class 'row'
                namaPenggunaInput.required = true;
                hubunganPenggunaInput.required = true;
            } else {
                dataPenggunaLainDiv.style.display = 'none';
                namaPenggunaInput.required = false;
                hubunganPenggunaInput.required = false;
                // Kosongkan nilai saat disembunyikan untuk menghindari pengiriman data yang tidak perlu
                namaPenggunaInput.value = '';
                hubunganPenggunaInput.value = '';
            }
        }

        // Tambahkan event listener ke kedua radio button
        radioDiriSendiri.addEventListener('change', togglePenggunaFields);
        radioKeluargaLain.addEventListener('change', togglePenggunaFields);

        // Panggil fungsi sekali saat halaman dimuat untuk mengatur status awal
        // Ini penting jika ada error validasi dan halaman dimuat ulang dengan data lama (old).
        togglePenggunaFields();
    });
</script>
