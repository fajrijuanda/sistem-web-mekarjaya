{{--
    Formulir ini dirancang berdasarkan data dari dokumen SURAT KETERANGAN DOMISILI USAHA ATAU PERUSAHAAN.
    Data NIK dan Nama Lengkap penanggung jawab sudah diisi pada form utama.
--}}

<h5 class="mt-4">2. Data Detail Penanggung Jawab</h5>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="form_data[tempat_lahir]">Tempat Lahir</label>
        <input type="text" id="form_data[tempat_lahir]" name="form_data[tempat_lahir]" class="form-control" placeholder="Sesuai KTP" value="{{ old('form_data.tempat_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[tanggal_lahir]">Tanggal Lahir</label>
        <input type="text" id="form_data[tanggal_lahir]" name="form_data[tanggal_lahir]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.tanggal_lahir') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[jenis_kelamin]">Jenis Kelamin</label>
        <select class="form-select" id="form_data[jenis_kelamin]" name="form_data[jenis_kelamin]" required>
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" @if(old('form_data.jenis_kelamin') == 'Laki-Laki') selected @endif>Laki-Laki</option>
            <option value="Perempuan" @if(old('form_data.jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[agama]">Agama</label>
        <input type="text" id="form_data[agama]" name="form_data[agama]" class="form-control" placeholder="Sesuai KTP" value="{{ old('form_data.agama') }}" required />
    </div>
     <div class="col-md-6">
        <label class="form-label" for="form_data[kewarganegaraan]">Kewarganegaraan</label>
        <input type="text" id="form_data[kewarganegaraan]" name="form_data[kewarganegaraan]" class="form-control" placeholder="Contoh: Indonesia" value="{{ old('form_data.kewarganegaraan', 'Indonesia') }}" required />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[pekerjaan]">Pekerjaan</label>
        <input type="text" id="form_data[pekerjaan]" name="form_data[pekerjaan]" class="form-control" placeholder="Pekerjaan sesuai KTP" value="{{ old('form_data.pekerjaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[alamat_pemohon]">Alamat Tempat Tinggal (Sesuai KTP)</label>
        <textarea name="form_data[alamat_pemohon]" id="form_data[alamat_pemohon]" class="form-control" rows="2" placeholder="Alamat lengkap penanggung jawab sesuai KTP" required>{{ old('form_data.alamat_pemohon') }}</textarea>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">3. Data Usaha / Perusahaan</h5>
<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="form_data[nama_perusahaan]">Nama Usaha / Perusahaan</label>
        <input type="text" id="form_data[nama_perusahaan]" name="form_data[nama_perusahaan]" class="form-control" placeholder="Contoh: PT. Sinar Mandiri Teknik" value="{{ old('form_data.nama_perusahaan') }}" required />
    </div>
    <div class="col-12">
        <label class="form-label" for="form_data[jenis_usaha]">Jenis Usaha / Klasifikasi</label>
        <textarea name="form_data[jenis_usaha]" id="form_data[jenis_usaha]" class="form-control" rows="2" placeholder="Contoh: Bidang Perdagangan Besar Alat Bantu Pabrik" required>{{ old('form_data.jenis_usaha') }}</textarea>
    </div>
     <div class="col-12">
        <label class="form-label" for="form_data[alamat_usaha]">Alamat Lengkap Tempat Usaha</label>
        <textarea name="form_data[alamat_usaha]" id="form_data[alamat_usaha]" class="form-control" rows="2" placeholder="Tuliskan alamat lengkap lokasi usaha Anda" required>{{ old('form_data.alamat_usaha') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="form_data[jumlah_karyawan]">Jumlah Karyawan</label>
        <div class="input-group">
            <input type="number" id="form_data[jumlah_karyawan]" name="form_data[jumlah_karyawan]" class="form-control" placeholder="Contoh: 20" value="{{ old('form_data.jumlah_karyawan') }}" required />
            <span class="input-group-text">Orang</span>
        </div>
    </div>
</div>

<hr class="my-4" />

<h5 class="mt-4">4. Data Legalitas (Opsional)</h5>
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="form_data[imb_nomor]">Nomor Izin Mendirikan Bangunan (IMB)</label>
        <input type="text" id="form_data[imb_nomor]" name="form_data[imb_nomor]" class="form-control" placeholder="Nomor IMB jika ada" value="{{ old('form_data.imb_nomor') }}" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="form_data[imb_tanggal]">Tanggal IMB</label>
        <input type="text" id="form_data[imb_tanggal]" name="form_data[imb_tanggal]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.imb_tanggal') }}" />
    </div>
</div>
<div class="row g-3 mt-1">
     <div class="col-12">
        <label class="form-label" for="form_data[akta_notaris_nama]">Nama Notaris Akta Pendirian</label>
        <input type="text" id="form_data[akta_notaris_nama]" name="form_data[akta_notaris_nama]" class="form-control" placeholder="Nama Notaris, contoh: TITIK HARMAITI., SH. MKn" value="{{ old('form_data.akta_notaris_nama') }}" />
    </div>
    <div class="col-md-8">
        <label class="form-label" for="form_data[akta_nomor]">Nomor Akta Pendirian</label>
        <input type="text" id="form_data[akta_nomor]" name="form_data[akta_nomor]" class="form-control" placeholder="Nomor Akta Pendirian Perusahaan" value="{{ old('form_data.akta_nomor') }}" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="form_data[akta_tanggal]">Tanggal Akta</label>
        <input type="text" id="form_data[akta_tanggal]" name="form_data[akta_tanggal]" class="form-control dob-picker" placeholder="YYYY-MM-DD" value="{{ old('form_data.akta_tanggal') }}" />
    </div>
</div>