{{-- TEMPLATE 1: SURAT PERNYATAAN TIDAK KEBERATAN KK --}}
<div id="preview-surat-pernyataan-tidak-keberatan-kk">
    {{-- Konten disalin dari file Anda, tidak ada perubahan --}}
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>Surat Pernyataan Tidak Keberatan</u></h5>
        <p class="mb-0">Nomor: <span class="detail-kode-permohonan"></span></p>
    </div>
    <p>Yang bertanda tangan dibawah ini:</p>
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <span class="detail-pemohon-nama"></span></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>
    <p>Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan Kartu Keluarga (KK) saya dipergunakan oleh
        saudara/pihak di bawah ini:</p>
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <span id="detail_pihak2_nama"></span></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span id="detail_pihak2_nik"></span></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: <span id="detail_pihak2_ttl"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span id="detail_pihak2_alamat"></span></td>
        </tr>
    </table>
    <p>Adapun tujuan penggunaan tersebut adalah untuk: <br> <strong id="detail_pernyataan_isi_kk"
            class="d-block mt-2"></strong></p>
    <p class="mt-4">Demikian pernyaan ini saya buat dengan sebenarnya...</p>
</div>

{{-- TEMPLATE 2: SURAT PERNYATAAN AKTA --}}
<div id="preview-pernyataan-tidak-keberatan-akta">
    {{-- Konten disalin dari file Anda, judul diperbaiki --}}
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1">SURAT PERNYATAAN TIDAK KEBERATAN</h5>
    </div>

    <p class="mb-1">Yang bertanda tangan dibawah ini:</p>
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <span class="detail-pemohon-nama"></span></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Agama/Warga Negara</td>
            <td>: <span id="detail_pemohon_agama_wn"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p class="mb-1">Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan dalam penerbitan kutipan akta
        kelahiran saya / anak saya*):</p>
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <span id="detail_akta_nama_anak"></span></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: <span id="detail_akta_ttl_anak"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin/ Anak Ke</td>
            <td>: <span id="detail_akta_jenis_kelamin"></span> / Anak Ke <span id="detail_akta_anak_ke"></span>
            </td>
        </tr>
    </table>

    <p class="mb-4">Hanya Tercantum Nama Ibu saja karena saya / Ibu saya*) tidak mempunyai akta nikah / Akta
        perkawinan yang di keluarkan di kantor urusan agama (KUA) / dinas kependudukan dan pencatatan sipil.</p>

    <p>Demikian pernyaan ini saya buat dengan sebenarnya, apabila pernyataan ini tidak sesuai dengan sebenarnya,
        saya siap untuk diperoses sebagaimana hukum yang berlaku.</p>

    <div class="d-flex justify-content-end mt-5">
        <div class="text-center">
            <p class="mb-5">Bekasi, <span class="detail-tanggal-surat"></span><br>Yang Membuat Pernyataan,</p>
            <p>Matrai 6000</p>
            <p class="fw-bold text-uppercase mt-5">(..............................................)</p>
        </div>
    </div>

</div>

{{-- TEMPLATE 3: SURAT KETERANGAN BELUM MENIKAH --}}
<div id="preview-surat-belum-menikah">
    <div class="text-center mb-4">
        {{-- KOP SURAT (opsional, bisa ditambahkan jika perlu) --}}
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN BELUM PERNAH MENIKAH</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa:</p>

    <table class="table table-borderless table-sm mb-3" style="width: 100%;">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <span class="detail-pemohon-nama"></span></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_bm_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_bm_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_bm_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p>Nama Tersebut Benar warga/penduduk kami sesuai alamat tersebut diatas, yang menurut sepengetahuan kami nama
        orang tersebut yang pada saat ini Bersetatus Belum Pernah Menikah/<span id="detail_bm_status_perkawinan"
            class="fw-bold"></span>.</p>
    <p>Demikian surat keterangan ini kami buat, untuk dapat dipergunakan sebagai <strong
            id="detail_bm_keperluan"></strong>.</p>

    <div class="d-flex justify-content-between mt-5">
        <div class="text-center">
            <p class="mb-5">Tandatangan Ybs</p>
            <p class="fw-bold text-uppercase mt-5">( <span class="detail-pemohon-nama-bawah"></span> )</p>
        </div>
        <div class="text-center">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepaladesa Mekarjaya
            </p>
            <p class="fw-bold text-uppercase mt-5">( <span id="detail_bm_nama_pejabat"></span> )</p>
        </div>
    </div>
</div>

{{-- TEMPLATE 5: SURAT SUDAH MENIKAH --}}
<div id="preview-surat-sudah-menikah">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN SUDAH MENIKAH/KAWIN</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    {{-- Data Suami --}}
    <table class="table table-borderless table-sm mb-2">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_sm_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_sm_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p>Nama Tersebut Benar warga penduduk Desa kami sesuai alamat tersebut diatas, yang menurut sepengetahuan kami
        nama
        orang tersebut benar yang pada saat ini bersetatus sudah menikah denagan :</p>

    {{-- Data Istri --}}
    <table class="table table-borderless table-sm mb-2">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase" id="detail_sm_nama_istri"></strong></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span id="detail_sm_ttl_istri"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: Perempuan</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span id="detail_sm_alamat_istri"></span></td>
        </tr>
    </table>

    {{-- Detail Nikah --}}
    <table class="table table-borderless table-sm mb-4">
        <tr>
            <td style="width: 30%;">Dengan Wali Nikah</td>
            <td>: <strong class="text-uppercase" id="detail_sm_wali_nikah"></strong></td>
        </tr>
        <tr>
            <td>Dengan maskawin</td>
            <td>: <span id="detail_sm_maskawin"></span></td>
        </tr>
    </table>

    <p>Demikian surat keterangan ini kami buat, untuk dapat dipergunakan sebagaimana mestinya dan kepada pihak yang
        berkepentingan dapat menjadi tahu dan maklum adanya.</p>

    {{-- Tanda Tangan Suami, Istri, Pejabat --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 30%;">
            <p class="mb-5">SUAMI</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;" id="detail_sm_nama_suami_ttd">
            </p>
        </div>
        <div style="width: 30%;">
            <p class="mb-5">ISTRI</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;" id="detail_sm_nama_istri_ttd">
            </p>
        </div>
        <div style="width: 30%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepaladesa Mekarjaya
            </p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;" id="detail_sm_nama_pejabat">
            </p>
        </div>
    </div>

    {{-- Tanda Tangan Saksi --}}
    <div class="mt-5">
        <table class="table table-borderless table-sm">
            <tr>
                <td style="width: 15%;">SAKSI I</td>
                <td style="width: 35%;">: <span id="detail_sm_saksi_1"></span></td>
                <td style="width: 50%;">(........................................)</td>
            </tr>
            <tr>
                <td>SAKSI II</td>
                <td>: <span id="detail_sm_saksi_2"></span></td>
                <td>(........................................)</td>
            </tr>
        </table>
    </div>
</div>

{{-- TEMPLATE 6: SURAT KETERANGAN TIDAK MAMPU --}}
<div id="preview-surat-tidak-mampu">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN TIDAK MAMPU</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_stm_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_stm_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_stm_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
        <tr>
            <td>KK</td>
            <td>: <strong class="text-uppercase" id="detail_stm_nama_kk"></strong></td>
        </tr>
    </table>

    <p>Nama Tersebut Benar warga penduduk kami sesuai alamat tersebut diatas, yang menurut sepengetahuan kami
        keluarga tersebut dikategorikan keluarga tidak mampu/miskin.</p>
    <p>Surat keterangan ini kami buat untuk <strong id="detail_stm_keperluan"></strong>.</p>
    <p>Demikian surat keterangan ini kami buat, untuk dapat dipergunakan sebagaimana mestinya dan kepada pihak yang
        berkepentingan dapat menjadi tahu dan maklum adanya.</p>

    {{-- Tanda Tangan --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 45%;">
            <p class="mb-5">Tandatangan Ybs</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_stm_nama_tandatangan_pemohon"></p>
        </div>
        <div style="width: 45%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepaladesa Mekarjaya
            </p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;" id="detail_stm_nama_pejabat">
            </p>
        </div>
    </div>

    {{-- Bagian Camat --}}
    <div class="mt-5">
        <table class="table table-borderless table-sm">
            <tr>
                <td style="width: 20%;">Nomor</td>
                <td>: ..............................</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: ..............................</td>
            </tr>
            <tr>
                <td>Tercatat</td>
                <td>: ..............................</td>
            </tr>
        </table>
        <div class="text-center mt-3">
            <p>Camat kedungwaringin</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">..............................</p>
            <p>NIP. ..............................</p>
        </div>
    </div>
</div>

<div id="preview-surat-domisili">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN DOMISILI</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_sd_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_sd_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_sd_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p>Nama tersebut benar warga/penduduk Desa kami sesuai alamat tersebut diatas, yang pada saat ini nama tersebut
        berdomisili sesua alamat tersebut di atas.</p>
    <p>Surat keterangan ini kami buat untuk <strong id="detail_sd_keperluan"></strong>.</p>
    <p>Demikian surat keterangan domisili ini kami buat dengan sebenarnya, untuk dapat dipergunakan sebagaimana
        mestinya dan kepada pihak yang berkepentingan dapat menjadi tahu dan maklum adanya.</p>

    {{-- Tanda Tangan Saksi --}}
    <div class="mt-4">
        <p>Tanda tangan saksi:</p>
        <table class="table table-borderless table-sm">
            <tr>
                <td style="width: 2%;">1.</td>
                <td style="width: 48%;"><span id="detail_sd_saksi_1_nama"></span> (<span
                        id="detail_sd_saksi_1_jabatan"></span>)</td>
                <td>: ........................................</td>
            </tr>
            <tr>
                <td>2.</td>
                <td><span id="detail_sd_saksi_2_nama"></span> (<span id="detail_sd_saksi_2_jabatan"></span>)</td>
                <td>: ........................................</td>
            </tr>
        </table>
    </div>

    {{-- Tanda Tangan Pemohon & Pejabat --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 45%;">
            <p class="mb-5">Tandatangan Ybs</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sd_nama_pemohon_ttd"></p>
        </div>
        <div style="width: 45%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepala Desa Mekarjaya
            </p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sd_nama_pejabat_ttd"></p>
        </div>
    </div>
</div>

<div id="preview-surat-domisili-usaha">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN DOMISILI USAHA ATAU PERUSAHAAN</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    {{-- Data Penanggung Jawab --}}
    <table class="table table-borderless table-sm">
        <tr>
            <td style="width: 35%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_sdu_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_sdu_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p class="mt-2">Benar pada saat ini membuka/mempunyai Usaha sebagaimana tersebut di bawah ini :</p>

    {{-- Data Usaha --}}
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 35%;">Nama Usaha/Perusahaan</td>
            <td>: <strong class="text-uppercase" id="detail_sdu_nama_perusahaan"></strong></td>
        </tr>
        <tr>
            <td>Jenis Usaha/Klasifikasi</td>
            <td>: <span id="detail_sdu_jenis_usaha"></span></td>
        </tr>
        <tr>
            <td>Alamat Usaha</td>
            <td>: <span id="detail_sdu_alamat_usaha"></span></td>
        </tr>
        <tr>
            <td>Jumlah Karyawan</td>
            <td>: <span id="detail_sdu_jumlah_karyawan"></span></td>
        </tr>
        <tr>
            <td>Penanggung Jawab/Pimpinan</td>
            <td>: <strong class="text-uppercase" id="detail_sdu_penanggung_jawab"></strong></td>
        </tr>
        <tr>
            <td>Ijin Mendirikan Bangunan</td>
            <td>: <span id="detail_sdu_imb"></span></td>
        </tr>
        <tr>
            <td>Akta Pendirian Usaha/ Perusahaan</td>
            <td>: <span id="detail_sdu_akta"></span></td>
        </tr>
    </table>

    <p><strong>CATATAN :</strong> Apabila usaha di atas tanah Negara/titi sara/tanah pengairan siap dibongkar
        apabila tanah tersebut akan dipergunakan oleh pemerintah dan tidak akan menuntut ganti rugi.</p>
    <p>Demikian surat keterangan domisili ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    {{-- Tanda Tangan --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 45%;">
            <p class="mb-5">Tandatangan Ybs</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sdu_nama_pemohon_ttd"></p>
        </div>
        <div style="width: 45%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>Kepala Desa Mekarjaya</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sdu_nama_pejabat_ttd"></p>
        </div>
    </div>

    {{-- Bagian Camat (jika diperlukan) --}}
    <div class="mt-5 text-center">
        <hr>
        <p>Nomor : ............................ <br> Tanggal : ............................</p>
    </div>
</div>

<div id="preview-surat-keterangan-usaha">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN USAHA</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertanda tangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    {{-- Data Pemohon --}}
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_sku_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_sku_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_sku_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p>Nama Tersebut Benar/warga penduduk Desa kami sesuai alamat tersebut diatas, yang mempunyai usaha:</p>

    {{-- Data Usaha --}}
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Usaha Pokok</td>
            <td>: <strong class="text-uppercase" id="detail_sku_nama_usaha"></strong></td>
        </tr>
        <tr>
            <td>Usaha Sampingan</td>
            <td>: <span id="detail_sku_usaha_sampingan"></span></td>
        </tr>
        <tr>
            <td>Alamat Usaha</td>
            <td>: <span id="detail_sku_alamat_usaha"></span></td>
        </tr>
    </table>

    <p>Demikian surat keterangan ini kami buat, untuk dapat dipergunakan sebagaimana mestinya dan kepada pihak yang
        berkepentingan dapat menjadi tahu dan maklum adanya.</p>

    {{-- Tanda Tangan --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 45%;">
            <p class="mb-5">Tanda Tangan YBS</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sku_nama_pemohon_ttd"></p>
        </div>
        <div style="width: 45%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>Kepala Desa Mekarjaya</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_sku_nama_pejabat_ttd"></p>
        </div>
    </div>
</div>

<div id="preview-pengantar-skck">
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN SKCK</u></h5>
        <p class="mb-0">NOMOR: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p>Yang bertandatangan di bawah ini Kepala Desa Mekarjaya Kecamatan Kedungwaringin Kabupaten Bekasi, dengan ini
        menerangkan bahwa :</p>

    {{-- Data Pemohon --}}
    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>Tempat Tgl Lahir</td>
            <td>: <span class="detail-pemohon-ttl"></span></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <span id="detail_ps_jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>Bangsa/Agama</td>
            <td>: <span id="detail_ps_bangsa_agama"></span></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <span id="detail_ps_pekerjaan"></span></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <span class="detail-pemohon-alamat"></span></td>
        </tr>
    </table>

    <p>Nama Tersebut Benar warga/penduduk Desa kami sesuai alamat tersebut diatas, dan menurut sepengetahuan kami
        nama/orang tersebut belum pernah terlibat tindak perkara, baik perdata maupun pidana, dan dikategorikan
        (Berkelakuan Baik).</p>
    <p>Surat keterangan ini kami berikan untuk :</p>
    <p class="text-center fw-bold" id="detail_ps_keperluan" style="font-style: italic;"></p>
    <p>Demikian surat pengantar ini kami buat dengan sebenarnya agar kepada pihak yang berkepentingan menjadi tau
        dan maklum adanya.</p>

    {{-- Tanda Tangan --}}
    <div class="d-flex justify-content-between text-center mt-5">
        <div style="width: 45%;">
            <p class="mb-5">Tanda Tangan Ybs</p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_ps_nama_pemohon_ttd"></p>
        </div>
        <div style="width: 45%;">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepala Desa Mekarjaya
            </p>
            <p class="fw-bold text-uppercase mt-5" style="text-decoration: underline;"
                id="detail_ps_nama_pejabat_ttd"></p>
        </div>
    </div>
</div>

{{-- ✅ TAMBAHKAN TEMPLATE BARU INI --}}
<div id="preview-surat-kelahiran">
    <style>
        .preview-table td {
            padding-top: 0.1rem !important;
            padding-bottom: 0.1rem !important;
            font-size: 0.9rem;
        }

        .preview-table-title {
            background-color: #f3f4f6;
            font-weight: bold;
            padding: 0.5rem;
        }
    </style>
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN KELAHIRAN</u></h5>
        <p class="mb-0">Nomor: <span class="detail-kode-permohonan"></span></p>
    </div>

    <p class="mb-1">Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

    {{-- DATA BAYI --}}
    <p class="preview-table-title mt-3">I. DATA BAYI / ANAK</p>
    <table class="table table-borderless table-sm preview-table">
        <tr>
            <td style="width: 35%;">1. Nama</td>
            <td>: <strong class="text-uppercase bayi-nama"></strong></td>
        </tr>
        <tr>
            <td>2. Jenis Kelamin</td>
            <td>: <span class="bayi-jenis_kelamin"></span></td>
        </tr>
        <tr>
            <td>3. Tempat Dilahirkan</td>
            <td>: <span class="bayi-tempat_dilahirkan"></span></td>
        </tr>
        <tr>
            <td>4. Tempat Kelahiran</td>
            <td>: <span class="bayi-tempat_kelahiran"></span></td>
        </tr>
        <tr>
            <td>5. Hari dan Tanggal Lahir</td>
            <td>: <span class="bayi-tanggal_lahir"></span></td>
        </tr>
        <tr>
            <td>6. Pukul</td>
            <td>: <span class="bayi-waktu_lahir"></span></td>
        </tr>
        <tr>
            <td>7. Jenis Kelahiran</td>
            <td>: <span class="bayi-jenis_kelahiran"></span></td>
        </tr>
        <tr>
            <td>8. Kelahiran Ke</td>
            <td>: <span class="bayi-kelahiran_ke"></span></td>
        </tr>
        <tr>
            <td>9. Penolong Kelahiran</td>
            <td>: <span class="bayi-penolong_kelahiran"></span></td>
        </tr>
        <tr>
            <td>10. Berat Bayi</td>
            <td>: <span class="bayi-berat"></span> gram</td>
        </tr>
        <tr>
            <td>11. Panjang Bayi</td>
            <td>: <span class="bayi-panjang"></span> cm</td>
        </tr>
    </table>

    {{-- DATA IBU --}}
    <p class="preview-table-title mt-3">II. DATA IBU</p>
    <table class="table table-borderless table-sm preview-table">
        <tr>
            <td style="width: 35%;">1. NIK</td>
            <td>: <span class="ibu-nik"></span></td>
        </tr>
        <tr>
            <td>2. Nama Lengkap</td>
            <td>: <strong class="text-uppercase ibu-nama_lengkap"></strong></td>
        </tr>
        <tr>
            <td>3. Tanggal Lahir / Umur</td>
            <td>: <span class="ibu-tanggal_lahir"></span></td>
        </tr>
        <tr>
            <td>4. Pekerjaan</td>
            <td>: <span class="ibu-pekerjaan"></span></td>
        </tr>
        <tr>
            <td>5. Alamat</td>
            <td>: <span class="ibu-alamat"></span></td>
        </tr>
    </table>

    {{-- DATA AYAH --}}
    <p class="preview-table-title mt-3">III. DATA AYAH</p>
    <table class="table table-borderless table-sm preview-table">
        <tr>
            <td style="width: 35%;">1. NIK</td>
            <td>: <span class="ayah-nik"></span></td>
        </tr>
        <tr>
            <td>2. Nama Lengkap</td>
            <td>: <strong class="text-uppercase ayah-nama_lengkap"></strong></td>
        </tr>
        <tr>
            <td>3. Tanggal Lahir / Umur</td>
            <td>: <span class="ayah-tanggal_lahir"></span></td>
        </tr>
        <tr>
            <td>4. Pekerjaan</td>
            <td>: <span class="ayah-pekerjaan"></span></td>
        </tr>
        <tr>
            <td>5. Alamat</td>
            <td>: <span class="ayah-alamat"></span></td>
        </tr>
    </table>

    {{-- DATA PELAPOR --}}
    <p class="preview-table-title mt-3">IV. DATA PELAPOR</p>
    <table class="table table-borderless table-sm preview-table">
        <tr>
            <td style="width: 35%;">1. NIK</td>
            <td>: <span class="detail-pemohon-nik"></span></td>
        </tr>
        <tr>
            <td>2. Nama Lengkap</td>
            <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
        </tr>
    </table>

    {{-- DATA SAKSI --}}
    <p class="preview-table-title mt-3">V. DATA SAKSI</p>
    <table class="table table-borderless table-sm preview-table">
        <tr>
            <td style="width: 35%;">1. NIK Saksi I</td>
            <td>: <span class="saksi1-nik"></span></td>
        </tr>
        <tr>
            <td>2. Nama Lengkap Saksi I</td>
            <td>: <strong class="text-uppercase saksi1-nama_lengkap"></strong></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>3. NIK Saksi II</td>
            <td>: <span class="saksi2-nik"></span></td>
        </tr>
        <tr>
            <td>4. Nama Lengkap Saksi II</td>
            <td>: <strong class="text-uppercase saksi2-nama_lengkap"></strong></td>
        </tr>
    </table>

    <div class="d-flex justify-content-end mt-5">
        <div class="text-center">
            <p class="mb-5">Mekarjaya, <span class="detail-tanggal-surat"></span><br>An. Kepala Desa Mekarjaya</p>
            <br><br>
            <p class="fw-bold text-uppercase mt-5 detail-nama-pejabat" style="text-decoration: underline;"></p>
        </div>
    </div>
</div>

{{-- ✅ TAMBAHKAN TEMPLATE BARU INI --}}
<div id="preview-surat-kematian">
    <style>
        .preview-table-kematian td {
            padding: 0.1rem 0.5rem;
            font-size: 0.9rem;
        }

        .preview-table-kematian .section-title {
            background-color: #f3f4f6;
            font-weight: bold;
        }
    </style>
    <div class="text-center mb-4">
        <h5 class="text-uppercase fw-bold mb-1"><u>SURAT KETERANGAN KEMATIAN</u></h5>
        <p class="mb-0">Nomor: <span class="detail-kode-permohonan"></span></p>
    </div>
    <table class="table table-bordered preview-table-kematian">
        <tbody>
            <tr class="section-title">
                <td colspan="2">JENAZAH</td>
            </tr>
            <tr>
                <td style="width: 35%;">1. NIK</td>
                <td>: <span class="jenazah-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase jenazah-nama"></strong></td>
            </tr>
            <tr>
                <td>3. Jenis Kelamin</td>
                <td>: <span class="jenazah-jenis_kelamin"></span></td>
            </tr>
            <tr>
                <td>4. Tanggal Lahir</td>
                <td>: <span class="jenazah-tanggal_lahir"></span></td>
            </tr>
            <tr>
                <td>5. Tempat Lahir</td>
                <td>: <span class="jenazah-tempat_lahir"></span></td>
            </tr>
            <tr>
                <td>6. Agama</td>
                <td>: <span class="jenazah-agama"></span></td>
            </tr>
            <tr>
                <td>7. Pekerjaan</td>
                <td>: <span class="jenazah-pekerjaan"></span></td>
            </tr>
            <tr>
                <td>8. Alamat</td>
                <td>: <span class="jenazah-alamat"></span></td>
            </tr>
            <tr>
                <td>9. Anak Ke</td>
                <td>: <span class="jenazah-anak_ke"></span></td>
            </tr>
            <tr>
                <td>10. Tanggal Kematian</td>
                <td>: <span class="jenazah-tanggal_kematian"></span></td>
            </tr>
            <tr>
                <td>11. Pukul</td>
                <td>: <span class="jenazah-waktu_kematian"></span></td>
            </tr>
            <tr>
                <td>12. Sebab Kematian</td>
                <td>: <span class="jenazah-sebab_kematian"></span></td>
            </tr>
            <tr>
                <td>13. Tempat Kematian</td>
                <td>: <span class="jenazah-tempat_kematian"></span></td>
            </tr>
            <tr>
                <td>14. Yang Menerangkan</td>
                <td>: <span class="jenazah-yang_menerangkan"></span></td>
            </tr>
            <tr class="section-title">
                <td colspan="2">AYAH</td>
            </tr>
            <tr>
                <td>1. NIK</td>
                <td>: <span class="ayah-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase ayah-nama_lengkap"></strong></td>
            </tr>
            <tr class="section-title">
                <td colspan="2">IBU</td>
            </tr>
            <tr>
                <td>1. NIK</td>
                <td>: <span class="ibu-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase ibu-nama_lengkap"></strong></td>
            </tr>
            <tr class="section-title">
                <td colspan="2">PELAPOR</td>
            </tr>
            <tr>
                <td>1. NIK</td>
                <td>: <span class="detail-pemohon-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase detail-pemohon-nama"></strong></td>
            </tr>
            <tr class="section-title">
                <td colspan="2">SAKSI I</td>
            </tr>
            <tr>
                <td>1. NIK</td>
                <td>: <span class="saksi1-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase saksi1-nama_lengkap"></strong></td>
            </tr>
            <tr class="section-title">
                <td colspan="2">SAKSI II</td>
            </tr>
            <tr>
                <td>1. NIK</td>
                <td>: <span class="saksi2-nik"></span></td>
            </tr>
            <tr>
                <td>2. Nama Lengkap</td>
                <td>: <strong class="text-uppercase saksi2-nama_lengkap"></strong></td>
            </tr>
        </tbody>
    </table>
</div>
