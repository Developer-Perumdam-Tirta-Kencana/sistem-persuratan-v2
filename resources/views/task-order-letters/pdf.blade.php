<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Perintah Tugas</title>
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
        .petugas-table {
            margin: 20px 0;
            width: 100%;
            border: 1px solid #000;
        }
        .petugas-table th,
        .petugas-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .petugas-table th {
            background-color: #f3f4f6;
            font-weight: bold;
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
            SURAT PERINTAH TUGAS
        </div>

        <div class="body-text">
            <p><strong>DASAR:</strong></p>
            <div class="indent">
                <p>{{ $letter->dasar_surat }}</p>
            </div>

            <p><strong>MENUGASKAN:</strong></p>
            
            <p>Kepada petugas yang namanya tercantum di bawah ini:</p>

            <table class="petugas-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No.</th>
                        <th>Nama Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $listPetugas = is_array($letter->list_petugas) ? $letter->list_petugas : json_decode($letter->list_petugas, true);
                    @endphp
                    @foreach($listPetugas as $index => $petugas)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $petugas }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>UNTUK:</strong></p>

            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Hari/Tanggal</td>
                        <td>:</td>
                        <td>{{ $letter->hari_tanggal_tugas }}</td>
                    </tr>
                    <tr>
                        <td class="label">Waktu</td>
                        <td>:</td>
                        <td>{{ $letter->waktu_tugas }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tempat</td>
                        <td>:</td>
                        <td>{{ $letter->tempat_tugas }}</td>
                    </tr>
                    <tr>
                        <td class="label">Keperluan</td>
                        <td>:</td>
                        <td>{{ $letter->keperluan_tugas }}</td>
                    </tr>
                    @if($letter->pakaian)
                    <tr>
                        <td class="label">Pakaian</td>
                        <td>:</td>
                        <td>{{ $letter->pakaian }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <p>Demikian surat perintah tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab.</p>
        </div>

        <div class="signature">
            <p>Nganjuk, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
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
