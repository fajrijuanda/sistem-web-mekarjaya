{{--
    Formulir Surat Nikah Versi Final dan Paling Lengkap.
    Dirancang berdasarkan kelengkapan data dari Form N1 s/d N6.
    Menggunakan struktur Accordion untuk kemudahan pengisian.
--}}

<div class="accordion" id="accordionNikah">

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingMempelai1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMempelai1"
                aria-expanded="true" aria-controls="collapseMempelai1">
                <i class="ti ti-user-check ti-md me-2"></i>
                <strong>2. Data Calon Mempelai 1 (Pemohon)</strong>
            </button>
        </h2>
        <div id="collapseMempelai1" class="accordion-collapse collapse show" aria-labelledby="headingMempelai1"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <div class="row g-3">
                    {{-- Data Pemohon ada di form utama (NIK, Nama Lengkap) --}}
                    <div class="col-md-6"><input type="text" name="form_data[mempelai1][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai1][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir (YYYY-MM-DD)" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai1][warganegara]"
                            class="form-control" value="Indonesia" placeholder="Warganegara" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai1][agama]" class="form-control"
                            value="Islam" placeholder="Agama" required></div>
                    <div class="col-md-12"><input type="text" name="form_data[mempelai1][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan" required></div>
                    <div class="col-md-12">
                        <textarea name="form_data[mempelai1][alamat]" class="form-control" rows="2" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="form_data[mempelai1][status_perkawinan]" id="status_mempelai1"
                            required>
                            <option value="">-- Status Perkawinan --</option>
                            <option value="Jejaka">Jejaka</option>
                            <option value="Perawan">Perawan</option>
                            <option value="Duda">Duda</option>
                            <option value="Janda">Janda</option>
                            <option value="Beristri">Beristri</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="istri_ke_div" style="display: none;">
                        <input type="number" name="form_data[mempelai1][istri_ke]" class="form-control"
                            placeholder="Istri Ke- (angka)">
                    </div>
                    <div class="col-md-6" id="pasangan_terdahulu1_div" style="display: none;">
                        <input type="text" name="form_data[mempelai1][pasangan_terdahulu]" class="form-control"
                            placeholder="Nama Istri/Suami Terdahulu">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOrtu1">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOrtu1" aria-expanded="false" aria-controls="collapseOrtu1">
                <i class="ti ti-users ti-md me-2"></i>
                <strong>3. Data Orang Tua Calon Mempelai 1</strong>
            </button>
        </h2>
        <div id="collapseOrtu1" class="accordion-collapse collapse" aria-labelledby="headingOrtu1"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <h6 class="fw-semibold">Data Ayah Kandung (untuk data Bin)</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Ayah" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][nik]" class="form-control"
                            placeholder="NIK Ayah"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Ayah"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Ayah"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][agama]"
                            class="form-control" value="Islam" placeholder="Agama Ayah"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ayah][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Ayah"></div>
                    <div class="col-12">
                        <textarea name="form_data[ortu1][ayah][alamat]" class="form-control" rows="2" placeholder="Alamat Ayah"></textarea>
                    </div>
                </div>
                <hr>
                <h6 class="fw-semibold mt-3">Data Ibu Kandung</h6>
                <div class="row g-3">
                    {{-- Fields for mother --}}
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Ibu" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][nik]"
                            class="form-control" placeholder="NIK Ibu"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Ibu"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Ibu"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][agama]"
                            class="form-control" value="Islam" placeholder="Agama Ibu"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu1][ibu][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Ibu"></div>
                    <div class="col-12">
                        <textarea name="form_data[ortu1][ibu][alamat]" class="form-control" rows="2" placeholder="Alamat Ibu"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingMempelai2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseMempelai2" aria-expanded="false" aria-controls="collapseMempelai2">
                <i class="ti ti-user-heart ti-md me-2"></i>
                <strong>4. Data Calon Mempelai 2 (Pasangan)</strong>
            </button>
        </h2>
        <div id="collapseMempelai2" class="accordion-collapse collapse" aria-labelledby="headingMempelai2"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][nik]"
                            class="form-control" placeholder="NIK Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][warganegara]"
                            class="form-control" value="Indonesia" placeholder="Warganegara Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[mempelai2][agama]"
                            class="form-control" value="Islam" placeholder="Agama Pasangan" required></div>
                    <div class="col-md-12"><input type="text" name="form_data[mempelai2][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Pasangan" required></div>
                    <div class="col-md-12">
                        <textarea name="form_data[mempelai2][alamat]" class="form-control" rows="2"
                            placeholder="Alamat Lengkap Pasangan"></textarea>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="form_data[mempelai2][status_perkawinan]"
                            id="status_mempelai2" required>
                            <option value="">-- Status Perkawinan --</option>
                            <option value="Jejaka">Jejaka</option>
                            <option value="Perawan">Perawan</option>
                            <option value="Duda">Duda</option>
                            <option value="Janda">Janda</option>
                            <option value="Beristri">Beristri</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="pasangan_terdahulu2_div" style="display: none;">
                        <input type="text" name="form_data[mempelai2][pasangan_terdahulu]" class="form-control"
                            placeholder="Nama Istri/Suami Terdahulu">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOrtu2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOrtu2" aria-expanded="false" aria-controls="collapseOrtu2">
                <i class="ti ti-users ti-md me-2"></i>
                <strong>5. Data Orang Tua Calon Mempelai 2</strong>
            </button>
        </h2>
        <div id="collapseOrtu2" class="accordion-collapse collapse" aria-labelledby="headingOrtu2"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <h6 class="fw-semibold">Data Ayah Kandung Pasangan (untuk data Bin)</h6>
                <div class="row g-3 mb-3">
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Ayah Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][nik]"
                            class="form-control" placeholder="NIK Ayah Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Ayah Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Ayah Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][agama]"
                            class="form-control" value="Islam" placeholder="Agama Ayah Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ayah][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Ayah Pasangan"></div>
                    <div class="col-12">
                        <textarea name="form_data[ortu2][ayah][alamat]" class="form-control" rows="2"
                            placeholder="Alamat Ayah Pasangan"></textarea>
                    </div>
                </div>
                <hr>
                <h6 class="fw-semibold mt-3">Data Ibu Kandung Pasangan</h6>
                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Ibu Pasangan" required></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][nik]"
                            class="form-control" placeholder="NIK Ibu Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Ibu Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Ibu Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][agama]"
                            class="form-control" value="Islam" placeholder="Agama Ibu Pasangan"></div>
                    <div class="col-md-6"><input type="text" name="form_data[ortu2][ibu][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Ibu Pasangan"></div>
                    <div class="col-12">
                        <textarea name="form_data[ortu2][ibu][alamat]" class="form-control" rows="2"
                            placeholder="Alamat Ibu Pasangan"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="accordion-item">
        <h2 class="accordion-header" id="headingWali">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseWali" aria-expanded="false" aria-controls="collapseWali">
                <i class="ti ti-user-shield ti-md me-2"></i>
                <strong>6. Data Wali Nikah</strong> <small class="text-muted ms-2">(Isi jika wali bukan Ayah Kandung
                    mempelai wanita)</small>
            </button>
        </h2>
        <div id="collapseWali" class="accordion-collapse collapse" aria-labelledby="headingWali"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="form_data[wali][nama_lengkap]"
                            class="form-control" placeholder="Nama Lengkap Wali"></div>
                    <div class="col-md-6"><input type="text" name="form_data[wali][nik]" class="form-control"
                            placeholder="NIK Wali"></div>
                    <div class="col-md-6"><input type="text" name="form_data[wali][tempat_lahir]"
                            class="form-control" placeholder="Tempat Lahir Wali"></div>
                    <div class="col-md-6"><input type="text" name="form_data[wali][tanggal_lahir]"
                            class="form-control dob-picker" placeholder="Tanggal Lahir Wali"></div>
                    <div class="col-md-6"><input type="text" name="form_data[wali][agama]" class="form-control"
                            value="Islam" placeholder="Agama Wali"></div>
                    <div class="col-md-6"><input type="text" name="form_data[wali][pekerjaan]"
                            class="form-control" placeholder="Pekerjaan Wali"></div>
                    <div class="col-12">
                        <textarea name="form_data[wali][alamat]" class="form-control" rows="2" placeholder="Alamat Wali"></textarea>
                    </div>
                    <div class="col-12"><input type="text" name="form_data[wali][hubungan]" class="form-control"
                            placeholder="Hubungan dengan Calon Mempelai"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingAkad">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseAkad" aria-expanded="false" aria-controls="collapseAkad">
                <i class="ti ti-calendar-event ti-md me-2"></i>
                <strong>7. Rencana Pelaksanaan Pernikahan</strong>
            </button>
        </h2>
        <div id="collapseAkad" class="accordion-collapse collapse" aria-labelledby="headingAkad"
            data-bs-parent="#accordionNikah">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-md-6"><input type="text" name="form_data[akad][tanggal]"
                            class="form-control dob-picker" placeholder="Tanggal Akad Nikah" required></div>
                    <div class="col-md-6"><input type="time" name="form_data[akad][waktu]" class="form-control"
                            placeholder="Waktu Akad Nikah" required></div>
                    <div class="col-12">
                        <textarea name="form_data[akad][tempat]" class="form-control" rows="2" placeholder="Tempat/Lokasi Akad Nikah"></textarea>
                    </div>
                    <div class="col-12">
                        <textarea name="form_data[akad][maskawin]" class="form-control" rows="2" placeholder="Maskawin / Mahar"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk menampilkan/menyembunyikan field kondisional --}}
@push('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusMempelai1 = document.getElementById('status_mempelai1');
            const istriKeDiv = document.getElementById('istri_ke_div');
            const pasanganTerdahulu1Div = document.getElementById('pasangan_terdahulu1_div');

            statusMempelai1.addEventListener('change', function() {
                istriKeDiv.style.display = this.value === 'Beristri' ? 'block' : 'none';
                pasanganTerdahulu1Div.style.display = (this.value === 'Duda' || this.value === 'Janda') ?
                    'block' : 'none';
            });

            const statusMempelai2 = document.getElementById('status_mempelai2');
            const pasanganTerdahulu2Div = document.getElementById('pasangan_terdahulu2_div');

            statusMempelai2.addEventListener('change', function() {
                pasanganTerdahulu2Div.style.display = (this.value === 'Duda' || this.value === 'Janda') ?
                    'block' : 'none';
            });

            // Trigger change on page load to set initial state based on old() value
            statusMempelai1.dispatchEvent(new Event('change'));
            statusMempelai2.dispatchEvent(new Event('change'));
        });
    </script>
@endpush
