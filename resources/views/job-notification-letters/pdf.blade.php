<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pemberitahuan Pekerjaan</title>
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
            SURAT PEMBERITAHUAN PEKERJAAN
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

            <p>Dengan ini memberitahukan kepada <strong>{{ $letter->instansi_tujuan }}</strong> bahwa akan dilaksanakan pekerjaan dengan rincian sebagai berikut:</p>

            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Jenis Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $letter->jenis_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Lokasi Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $letter->lokasi_pekerjaan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Hari/Tanggal</td>
                        <td>:</td>
                        <td>{{ $letter->hari_tanggal_pelaksanaan }}</td>
                    </tr>
                    @if($letter->waktu_mulai || $letter->waktu_selesai)
                    <tr>
                        <td class="label">Waktu Pelaksanaan</td>
                        <td>:</td>
                        <td>
                            @if($letter->waktu_mulai && $letter->waktu_selesai)
                                {{ $letter->waktu_mulai }} - {{ $letter->waktu_selesai }} WIB
                            @elseif($letter->waktu_mulai)
                                Mulai {{ $letter->waktu_mulai }} WIB
                            @elseif($letter->waktu_selesai)
                                Sampai {{ $letter->waktu_selesai }} WIB
                            @endif
                        </td>
                    </tr>
                    @endif
                </table>
            </div>

            <p>Demikian surat pemberitahuan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
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
