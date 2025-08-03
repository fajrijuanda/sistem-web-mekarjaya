<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak - {{ $permohonan->kode_permohonan ?? 'Surat Pernyataan' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
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

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 1px 0;
            vertical-align: top;
        }

        u {
            text-decoration: underline;
        }

        p {
            text-align: justify;
            text-indent: 50px;
            margin: 0 0 1rem 0;
        }

        .no-indent {
            text-indent: 0;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="text-center mb-4">
            <h4 class="text-uppercase fw-bold mb-1"><u>Surat Pernyataan Tidak Keberatan</u></h4>
            <p class="mb-0 no-indent">Nomor: {{ $permohonan->kode_permohonan ?? '-' }}</p>
        </div>

        <p class="no-indent">Yang bertanda tangan dibawah ini:</p>
        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td>: {{ $permohonan->penduduk->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $permohonan->penduduk->nik }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>: {{ $permohonan->penduduk->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $permohonan->penduduk->kartuKeluarga->alamat }}</td>
            </tr>
        </table>

        <p class="mt-4">Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan Kartu Keluarga (KK) saya
            dipergunakan oleh saudara/pihak di bawah ini:</p>
        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td>: {{ $permohonan->form_data['pihak2']['nama'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $permohonan->form_data['pihak2']['nik'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>: {{ $permohonan->form_data['pihak2']['tempat_lahir'] ?? '' }},
                    {{ \Carbon\Carbon::parse($permohonan->form_data['pihak2']['tanggal_lahir'])->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $permohonan->form_data['pihak2']['alamat'] ?? '-' }}</td>
            </tr>
        </table>

        <p class="mt-4">Adapun tujuan penggunaan tersebut adalah untuk:</p>
        <p>Bahwa saya tidak keberatan Kartu Keluarga (KK) saya Nomor:
            <strong>{{ $permohonan->penduduk->kartuKeluarga->nomor_kk }}</strong> dipergunakan oleh adik kandung saya
            tersebut di atas untuk {{ $permohonan->form_data['pernyataan_kk']['isi'] ?? '-' }}</p>

        <p class="mt-4">Demikian pernyaan ini saya buat dengan sebenarnya, apabila pernyataan ini tidak sesuai dengan
            sebenarnya, saya siap untuk diproses sebagaimana hukum yang berlaku.</p>

        <div style="width: 40%; margin-left: 60%; text-align: left;" class="mt-5">
            <p class="no-indent">Mekarjaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p class="no-indent">Yang Membuat Pernyataan,</p>
            <p class="no-indent" style="margin-top: 80px; margin-bottom: 0;"><strong><u>(
                        {{ strtoupper($permohonan->penduduk->nama_lengkap) }} )</u></strong></p>
        </div>
    </div>
</body>

</html>
