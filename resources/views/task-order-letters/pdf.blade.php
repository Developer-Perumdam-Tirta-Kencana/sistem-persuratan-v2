<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Perintah Tugas</title>
    <style>
        @page {
            size: 210mm 330mm; /* F4 */
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.45;
        }

        .kop-surat {
            margin-bottom: 0;
        }

        .kop-surat img {
            width: 100%;
            display: block;
            margin-bottom: 0;
        }

        .garis-kop {
            display: none; /* aman, kop sudah bergaris */
        }

        .content {
            padding: 0 48px;
            margin-top: -25%;
            text-align: justify;
        }
        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 14px 0 6px;
            font-size: 14pt;
        }
        .nomor-center {
            text-align: center;
            margin-bottom: 10px;
            font-size: 11pt;
        }
        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }
        .body-text {
            text-align: justify;
            margin: 10px 0;
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
        /* fixed signature anchored to page bottom-right for PDF */
        .signature-fixed {
            position: fixed;
            right: 24mm;
            bottom: 18mm;
            width: 42%;
            text-align: right;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
        }
        .signature-fixed p {
            margin: 2px 0;
            line-height: 1.3;
        }
        .signature-name {
            margin-top: 50px;
            font-weight: bold;
            text-decoration: underline;
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
        .petugas-list {
            margin: 0;
            padding-left: 24px;
            width: 100%;
        }
        .petugas-list li {
            margin-bottom: 3px;
            font-weight: 600;
            line-height: 1.35;
        }
        .petugas-columns-2 {
            width: 100%;
            border-collapse: collapse;
        }
        .petugas-columns-2 td {
            vertical-align: top;
            width: 50%;
            padding-right: 24px;
        }
        .petugas-columns-2 ol {
            margin: 0;
            padding-left: 24px;
        }
        .petugas-columns-2 li {
            margin-bottom: 3px;
            font-weight: 600;
            line-height: 1.35;
        }
        .dasar-full {
            width: 100%;
            margin-bottom: 8px;
        }
        .dasar-full p {
            margin: 0;
            line-height: 1.45;
            text-align: justify;
        }
        .kepada-section {
            margin: 12px 0;
        }
        .detail-table {
            margin-top: 8px;
            width: 100%;
        }
        .detail-table td {
            padding: 2px 0;
            vertical-align: top;
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
    <div class="kop-surat full-bleed">
        <img src="{{ $kopBase64 }}" alt="Kop Surat">
    </div>
    <div style="height: 140px;"></div>
    @else
    <div class="kop-surat" style="height: 200px;"></div>
    @endif

    <div class="content">
        <div style="position: relative;">
            <div class="title">
                SURAT PERINTAH TUGAS
            </div>

            @if(!empty($letter->nomor_surat))
            <div class="nomor-center">
                Nomor : {{ $letter->nomor_surat }}
            </div>
            @endif

            <div class="body-text">
                <p style="margin-bottom:6px;"><strong>DASAR</strong></p>
                <div class="dasar-full">
                    <p>{!! nl2br(e($letter->dasar_surat)) !!}</p>
                </div>

                <p style="margin-top:10px; margin-bottom:4px;"><strong>Memerintahkan :</strong></p>

                @php
                    $listPetugas = is_array($letter->list_petugas) ? $letter->list_petugas : (is_string($letter->list_petugas) ? json_decode($letter->list_petugas, true) : []);
                    $petugasCount = count($listPetugas);
                @endphp
                <div style="margin-bottom:4px;">
                    @if($petugasCount > 10)
                        @php
                            $left = array_slice($listPetugas, 0, 10);
                            $right = array_slice($listPetugas, 10);
                        @endphp
                        <table class="petugas-columns-2" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <ol style="margin:0; padding-left:20px;">
                                        @foreach($left as $petugas)
                                            @php 
                                                $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas;
                                                $name = ucwords(strtolower(trim($name)));
                                            @endphp
                                            <li>{{ $name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <ol start="11" style="margin:0; padding-left:20px;">
                                        @foreach($right as $petugas)
                                            @php 
                                                $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas;
                                                $name = ucwords(strtolower(trim($name)));
                                            @endphp
                                            <li>{{ $name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        </table>
                    @else
                        <ol class="petugas-list">
                            @foreach($listPetugas as $petugas)
                                @php 
                                    $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas;
                                    $name = ucwords(strtolower(trim($name)));
                                @endphp
                                <li>{{ $name }}</li>
                            @endforeach
                        </ol>
                    @endif
                </div>

                <p style="margin:10px 0 4px;"><strong>Kepada:</strong></p>

                <div style="margin-top:2px;">
                    <table class="no-border detail-table">
                        <tr>
                            <td style="width:70px;">Hari</td>
                            <td style="width:8px;">:</td>
                            <td style="padding-left:8px;">{{ $letter->hari ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td style="padding-left:8px;">{{ $letter->tanggal_surat ? $letter->tanggal_surat->format('d F Y') : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                            <td style="padding-left:8px;">{{ $letter->waktu_tugas }}</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td style="padding-left:8px;">{{ $letter->tempat_tugas }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top;">Keperluan</td>
                            <td style="vertical-align:top;">:</td>
                            <td style="padding-left:8px; text-align:justify;">{{ $letter->keperluan_tugas }}</td>
                        </tr>
                    </table>
                </div>

                <p style="margin-top:10px;">Demikian Surat Perintah Tugas ini untuk dilaksanakan dengan penuh tanggung jawab.</p>
            </div>

                    <div style="margin-top:16px; position:relative; min-height:120px;">
                        <div class="signature-fixed">
                            <p>Dikeluarkan di : {{ \App\Models\SystemSetting::get('district', 'Jombang') }}</p>
                            <p>Pada Tanggal  : {{ $letter->tanggal_surat ? $letter->tanggal_surat->format('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                            <p style="margin-top:10px; border-bottom:1px solid #000; height:40px;"></p>
                            <p style="margin-top:4px; font-weight:700;">{{ \App\Models\SystemSetting::get('company_line1', 'Perusahaan Umum Daerah Air Minum') }}</p>
                            <p style="margin:0; font-weight:700;">{{ \App\Models\SystemSetting::get('company_line2', 'Tirta Kencana Kab. Jombang') }}</p>
                            <p style="margin-top:2px; font-weight:700;">{{ \App\Models\SystemSetting::get('director_name', 'KHOIRUL HASYIM. S.Pd, M.Pd') }}</p>
                            <p style="margin:0;">NIP. {{ \App\Models\SystemSetting::get('director_nip', '19800815 202502 1 001') }}</p>
                        </div>
                    </div>
        </div>
    </div>
</body>
</html>
