<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak - Pernyataan Tidak Keberatan Akta - {{ $permohonan->penduduk->nama_lengkap }}</title>
    <style>
        @page {
            size: A4;
            margin: 2.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .fw-bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        h4 {
            font-size: 14pt;
            margin: 0;
            padding: 0;
        }

        p {
            text-align: justify;
            margin: 0 0 1rem 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 1px 0;
            vertical-align: top;
        }

        .data-section td {
            padding-left: 20px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="text-center mb-4">
        <h4 class="text-uppercase fw-bold underline">SURAT PERNYATAAN TIDAK KEBERATAN</h4>
    </div>

    <p>Yang bertanda tangan dibawah ini:</p>

    <table class="data-section">
        <tr>
            <td style="width: 35%;">Nama</td>
            <td>: {{ $permohonan->penduduk->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: {{ $permohonan->penduduk->tempat_lahir }},
                {{ \Carbon\Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama/Warga Negara</td>
            <td>: {{ $permohonan->penduduk->agama }} / Indonesia</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $permohonan->penduduk->kartuKeluarga->alamat }}</td>
        </tr>
    </table>

    <p class="mt-4">Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan dalam penerbitan kutipan akta kelahiran
        saya / anak saya*):</p>

    <table class="data-section">
        <tr>
            <td style="width: 35%;">Nama</td>
            <td>: {{ $permohonan->form_data['akta']['nama_anak'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: {{ $permohonan->form_data['akta']['ttl_anak'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin/ Anak Ke</td>
            <td>: {{ $permohonan->form_data['akta']['jenis_kelamin_anak'] ?? '-' }} / Anak Ke
                {{ $permohonan->form_data['akta']['anak_ke'] ?? '-' }}</td>
        </tr>
    </table>

    <p class="mt-4">Hanya Tercantum Nama Ibu saja karena saya / Ibu saya*) tidak mempunyai akta nikah / Akta
        perkawinan yang di keluarkan di kantor urusan agama (KUA) / dinas kependudukan dan pencatatan sipil.</p>
    <p>Demikian pernyaan ini saya buat dengan sebenarnya, apabila pernyataan ini tidak sesuai dengan sebenarnya, saya
        siap untuk diperoses sebagaimana hukum yang berlaku.</p>

    <div style="width: 40%; margin-left: 60%; text-align: left;" class="mt-5">
        <p>Bekasi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Yang Membuat Pernyataan,</p>
        <p style="margin-top: 1rem; margin-bottom: 4rem;">Matrai 6000</p>
        <p class="fw-bold underline" style="margin-top: 80px;">( {{ strtoupper($permohonan->penduduk->nama_lengkap) }}
            )</p>
    </div>

</body>

</html>
