<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Rekomendasi</title>
    <style>
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 30px;
        }
        .kop-surat img {
            max-width: 100%;
            height: auto;
        }
        .content {
            margin-top: 20px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
            font-size: 14pt;
        }
        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }
        .body-text {
            text-align: justify;
            margin: 15px 0;
        }
        .indent {
            margin-left: 40px;
        }
        .details {
            margin: 20px 0 20px 40px;
        }
        .details-row {
            margin: 5px 0;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
        }
        .signature-space {
            margin-top: 60px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .no-border td {
            border: none;
            padding: 5px 0;
            vertical-align: top;
        }
        .label {
            width: 150px;
        }
    </style>
</head>
<body>
    @if($withKop)
    <div class="kop-surat">
        <img src="{{ public_path('kop.png') }}" alt="Kop Surat">
    </div>
    @endif

    <div class="content">
        <div class="title">
            SURAT REKOMENDASI
        </div>

        <div class="body-text">
            <p>Yang bertanda tangan di bawah ini:</p>
            
            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Nama</td>
                        <td>:</td>
                        <td>Direktur PDAM Tirta Kencana</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td>:</td>
                        <td>Direktur Utama</td>
                    </tr>
                    <tr>
                        <td class="label">Alamat</td>
                        <td>:</td>
                        <td>PDAM Tirta Kencana Kabupaten Nganjuk</td>
                    </tr>
                </table>
            </div>

            <p>Dengan ini memberikan rekomendasi kepada:</p>

            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Nama Perusahaan</td>
                        <td>:</td>
                        <td><strong>{{ $letter->nama_pt }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Jenis Kegiatan</td>
                        <td>:</td>
                        <td>{{ $letter->jenis_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nama Perumahan</td>
                        <td>:</td>
                        <td>{{ $letter->nama_perumahan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jumlah Unit</td>
                        <td>:</td>
                        <td>{{ $letter->jumlah_unit }} Unit</td>
                    </tr>
                    <tr>
                        <td class="label">Lokasi</td>
                        <td>:</td>
                        <td>{{ $letter->lokasi }}</td>
                    </tr>
                </table>
            </div>

            <p>
                Bahwa perusahaan tersebut telah memenuhi persyaratan dan layak untuk mendapatkan rekomendasi 
                dari PDAM Tirta Kencana Kabupaten Nganjuk dalam rangka {{ $letter->jenis_kegiatan }}.
            </p>

            <p>
                PDAM Tirta Kencana Kabupaten Nganjuk merekomendasikan perusahaan tersebut untuk dapat 
                melanjutkan proses perizinan yang diperlukan sesuai dengan peraturan yang berlaku.
            </p>

            <p>Demikian surat rekomendasi ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="signature">
            <p>Nganjuk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Hormat Kami,</p>
            <p><strong>PDAM Tirta Kencana</strong></p>
            <p><strong>Kabupaten Nganjuk</strong></p>
            <div class="signature-space"></div>
            <p><strong>Direktur Utama</strong></p>
        </div>
    </div>
</body>
</html>
