<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Perintah Tugas</title>
    <style>
        @page {
            margin: 20mm;
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
            margin-bottom: 0;
        }
        .kop-surat img {
            width: 100%;
            display: block;
        }
        /* full-bleed kop for PDF: extend image outside page margins */
        .kop-surat.full-bleed {
            position: absolute;
            left: 0;
            top: 0;
            width: calc(100% + 40mm);
            margin-left: -20mm;
        }
        .kop-surat.full-bleed img {
            width: 100%;
            display: block;
        }
        .content {
            margin-top: 10px;
            padding: 0 24px;
            box-sizing: border-box;
            /* ensure content doesn't overflow page in PDF render */
            overflow: visible;
        }
        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
            font-size: 14pt;
        }
        .nomor-center {
            text-align: center;
            margin-bottom: 8px;
            font-size: 11pt;
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
        /* fixed signature anchored to page bottom-right for PDF */
        .signature-fixed {
            position: fixed;
            right: 20mm;
            bottom: 20mm;
            width: 45%;
            text-align: right;
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
        .petugas-columns {
            -webkit-column-width: 220px;
            -moz-column-width: 220px;
            column-width: 220px;
            column-gap: 24px;
            -webkit-column-gap: 24px;
            -moz-column-gap: 24px;
            padding-left: 20px;
        }
        .petugas-columns li {
            break-inside: avoid;
            -webkit-column-break-inside: avoid;
            -moz-column-break-inside: avoid;
            margin-bottom: 6px;
        }
        .dasar-full {
            width: 100%;
            margin-bottom: 8px;
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
    <div class="kop-surat" style="height: 120px;"></div>
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
                    <p style="text-align:justify; margin:0;">{!! nl2br(e($letter->dasar_surat)) !!}</p>
                </div>

                <p style="margin-top:6px; margin-bottom:6px;"><strong>MEMERINTAHKAN :</strong></p>

                @php
                    $listPetugas = is_array($letter->list_petugas) ? $letter->list_petugas : (is_string($letter->list_petugas) ? json_decode($letter->list_petugas, true) : []);
                    $petugasCount = count($listPetugas);
                @endphp
                <div style="margin-bottom:8px;">
                    @if($petugasCount > 10)
                        @php
                            $half = (int) ceil($petugasCount / 2);
                            $left = array_slice($listPetugas, 0, $half);
                            $right = array_slice($listPetugas, $half);
                        @endphp
                        <div style="display:flex; gap:24px;">
                            <ol style="margin:0; padding-left:18px; width:50%;">
                                @foreach($left as $index => $petugas)
                                    @php $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas; @endphp
                                    <li style="margin-bottom:4px; font-weight:600;">{{ strtoupper($name) }}</li>
                                @endforeach
                            </ol>
                            <ol start="{{ $half + 1 }}" style="margin:0; padding-left:18px; width:50%;">
                                @foreach($right as $index => $petugas)
                                    @php $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas; @endphp
                                    <li style="margin-bottom:4px; font-weight:600;">{{ strtoupper($name) }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @else
                        <ol style="margin:0; padding-left:18px;">
                            @foreach($listPetugas as $index => $petugas)
                                @php $name = is_array($petugas) ? ($petugas['name'] ?? $petugas['nama'] ?? '') : (string)$petugas; @endphp
                                <li style="margin-bottom:4px; font-weight:600;">{{ strtoupper($name) }}</li>
                            @endforeach
                        </ol>
                    @endif
                </div>

                <p style="margin-top:6px; margin-bottom:12px;"><strong>Kepada</strong>
                <span style="margin-left:8px;">&nbsp;</span></p>

                <div style="margin-top:4px;">
                    <table class="no-border">
                        <tr>
                            <td style="width:80px;">Hari</td>
                            <td style="width:8px;">:</td>
                            <td>{{ $letter->hari ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ $letter->tanggal_surat ? $letter->tanggal_surat->format('d F Y') : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                            <td>{{ $letter->waktu_tugas }}</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td>{{ $letter->tempat_tugas }}</td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td>:</td>
                            <td style="text-align:justify;">{{ $letter->keperluan_tugas }}</td>
                        </tr>
                    </table>
                </div>

                <p style="margin-top:12px;">Demikian Surat Perintah Tugas ini untuk dilaksanakan dengan penuh tanggung jawab.</p>
            </div>

                    <div style="margin-top:18px; position:relative; min-height:120px;">
                        <div class="signature-fixed">
                            <p style="margin:0;">Dikeluarkan di : {{ \App\Models\SystemSetting::get('district', 'Jombang') }}</p>
                            <p style="margin:0;">Pada Tanggal  : {{ $letter->tanggal_surat ? $letter->tanggal_surat->format('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                            <p style="margin:6px 0 8px;">--------------------------------------------</p>
                            <p style="margin:0; font-weight:700;">{{ \App\Models\SystemSetting::get('company_line1', 'Perusahaan Umum Daerah Air Minum') }}</p>
                            <p style="margin:0; font-weight:700;">{{ \App\Models\SystemSetting::get('company_line2', 'Tirta Kencana Kab. Jombang') }}</p>
                            <p style="margin:6px 0 0; font-weight:700;">{{ \App\Models\SystemSetting::get('director_name', 'KHOIRUL HASYIM. S.Pd, M.Pd') }}</p>
                            <p style="margin:0;">NIP. {{ \App\Models\SystemSetting::get('director_nip', '19800815 202502 1 001') }}</p>
                        </div>
                    </div>
        </div>
    </div>
</body>
</html>
