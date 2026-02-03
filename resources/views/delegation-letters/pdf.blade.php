<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Kuasa Pelimpahan</title>
    <style>
        @page {
            margin: 0;
            size: {{ $paperSize ?? 'A4' }};
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 100%;
            display: block;
        }
        .content {
            margin-top: 20px;
            padding: 0 40px;
            box-sizing: border-box;
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
        }
        .signature-grid {
            display: table;
            width: 100%;
            margin-top: 40px;
        }
        .signature-column {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            vertical-align: top;
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
    @php
        $kopBase64 = null;
        if ($withKop) {
            $kopPath = public_path('kop.png');
            if (file_exists($kopPath)) {
                $kopBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($kopPath));
            }
        }
    @endphp

    @if($kopBase64)
    <div class="kop-surat">
        <img src="{{ $kopBase64 }}" alt="Kop Surat">
    </div>
    @else
    <div class="kop-surat" style="height: 120px;"></div>
    @endif

    <div class="content">
        <div class="title">
            SURAT KUASA PELIMPAHAN
        </div>

        <div class="body-text">
            <p>Yang bertanda tangan di bawah ini:</p>
            
            <div class="details">
                <p><strong>I. PEMBERI KUASA PERTAMA</strong></p>
                <table class="no-border">
                    <tr>
                        <td class="label">Nama</td>
                        <td>:</td>
                        <td><strong>{{ $letter->pemberiKuasaPertama->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td>:</td>
                        <td>{{ $letter->pemberiKuasaPertama->email }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td>:</td>
                        <td>PDAM Tirta Kencana Kabupaten Nganjuk</td>
                    </tr>
                </table>

                <p style="margin-top: 20px;"><strong>II. PEMBERI KUASA KEDUA</strong></p>
                <table class="no-border">
                    <tr>
                        <td class="label">Nama</td>
                        <td>:</td>
                        <td><strong>{{ $letter->pemberiKuasaKedua->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td>:</td>
                        <td>{{ $letter->pemberiKuasaKedua->email }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td>:</td>
                        <td>PDAM Tirta Kencana Kabupaten Nganjuk</td>
                    </tr>
                </table>
            </div>

            <p>Selanjutnya disebut sebagai <strong>PEMBERI KUASA</strong></p>

            <p>Dengan ini memberikan kuasa kepada:</p>

            <div class="details">
                <p><strong>PENERIMA KUASA</strong></p>
                <table class="no-border">
                    <tr>
                        <td class="label">Nama</td>
                        <td>:</td>
                        <td><strong>{{ $letter->penerimaKuasa->name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td>:</td>
                        <td>{{ $letter->penerimaKuasa->email }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td>:</td>
                        <td>PDAM Tirta Kencana Kabupaten Nganjuk</td>
                    </tr>
                </table>
            </div>

            <p>Selanjutnya disebut sebagai <strong>PENERIMA KUASA</strong></p>

            <p><strong>TUJUAN PELIMPAHAN:</strong></p>
            <div class="indent">
                <p>{{ $letter->tujuan_transaksi }}</p>
            </div>

            <p>
                Demikian surat kuasa pelimpahan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
                Segala tindakan yang dilakukan oleh PENERIMA KUASA sehubungan dengan kuasa ini adalah sah dan 
                mengikat PEMBERI KUASA.
            </p>
        </div>

        <div class="signature">
            <p style="text-align: center;">Nganjuk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            
            <div class="signature-grid">
                <div class="signature-column">
                    <p><strong>Pemberi Kuasa I</strong></p>
                    <div class="signature-space"></div>
                    <p><strong>{{ $letter->pemberiKuasaPertama->name }}</strong></p>
                </div>
                <div class="signature-column">
                    <p><strong>Pemberi Kuasa II</strong></p>
                    <div class="signature-space"></div>
                    <p><strong>{{ $letter->pemberiKuasaKedua->name }}</strong></p>
                </div>
                <div class="signature-column">
                    <p><strong>Penerima Kuasa</strong></p>
                    <div class="signature-space"></div>
                    <p><strong>{{ $letter->penerimaKuasa->name }}</strong></p>
                </div>
            </div>

            @if($letter->status === 'disetujui' && $letter->approver)
            <hr style="margin-top: 40px; margin-bottom: 20px;">
            <p style="font-size: 10pt; color: #666;">
                Disetujui oleh: {{ $letter->approver->name }} <br>
                Tanggal: {{ $letter->approved_at ? $letter->approved_at->translatedFormat('d F Y H:i') : '' }}
            </p>
            @endif
        </div>
    </div>
</body>
</html>
