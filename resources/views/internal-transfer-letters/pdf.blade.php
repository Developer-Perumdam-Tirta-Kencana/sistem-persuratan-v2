<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pelimpahan Rekening</title>
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
            SURAT PELIMPAHAN REKENING
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

            <p>Dengan ini memberitahukan bahwa telah dilakukan pelimpahan rekening dengan rincian sebagai berikut:</p>

            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Bank Sumber</td>
                        <td>:</td>
                        <td>{{ $letter->bank_sumber }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Rekening Sumber</td>
                        <td>:</td>
                        <td>{{ $letter->no_rek_sumber }}</td>
                    </tr>
                    <tr>
                        <td class="label">Bank Tujuan</td>
                        <td>:</td>
                        <td>{{ $letter->bank_tujuan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Rekening Tujuan</td>
                        <td>:</td>
                        <td>{{ $letter->no_rek_tujuan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nominal</td>
                        <td>:</td>
                        <td>Rp {{ number_format($letter->nominal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <p>Pelimpahan rekening ini dilakukan dalam rangka pengelolaan keuangan PDAM Tirta Kencana Kabupaten Nganjuk sesuai dengan kebijakan dan peraturan yang berlaku.</p>

            <p>Demikian surat pelimpahan rekening ini kami sampaikan. Atas perhatiannya, kami ucapkan terima kasih.</p>
        </div>

        <div class="signature">
            <p>Nganjuk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Hormat Kami,</p>
            <p><strong>PDAM Tirta Kencana</strong></p>
            <p><strong>Kabupaten Nganjuk</strong></p>
            <div class="signature-space"></div>
            <p><strong>Direktur Utama</strong></p>
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
