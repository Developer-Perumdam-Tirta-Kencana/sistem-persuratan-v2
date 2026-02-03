<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Payroll - {{ $letter->nomor_surat }}</title>
    <style>
        @page {
            margin: 0;
            size: {{ $paperSize ?? 'A4' }};
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
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
        .garis-kop {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            margin: 10px 0 20px 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            text-align: justify;
            margin-top: 10px;
            padding: 0 48px;
            box-sizing: border-box;
        }
        .table-data {
            width: 100%;
            margin: 20px 0;
        }
        .table-data td {
            padding: 5px;
        }
        .ttd {
            margin-top: 50px;
            text-align: right;
        }
        .ttd-space {
            margin-top: 80px;
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
    <div class="garis-kop"></div>
    @else
    <div class="kop-surat" style="height: 120px;"></div>
    @endif

    <div class="header">
        <h3 style="margin: 5px 0;">SURAT PENGANTAR SLIP GAJI</h3>
    </div>

    <div class="nomor-surat">
        <strong>Nomor: {{ $letter->nomor_surat }}</strong>
    </div>

    <div class="content">
        <p>Kepada Yth,<br>
        <strong>{{ strtoupper($letter->bank_tujuan) }}</strong><br>
        Di Tempat</p>

        <p>Dengan hormat,</p>

        <p style="text-indent: 30px;">
            Bersama ini kami sampaikan slip gaji karyawan untuk periode <strong>{{ $letter->bulan_gaji }}</strong> 
            dengan total nominal sebesar <strong>Rp {{ number_format($letter->total_nominal, 0, ',', '.') }}</strong> 
            ({{ ucwords(terbilang($letter->total_nominal)) }} Rupiah).
        </p>

        <table class="table-data">
            <tr>
                <td width="200">Tanggal</td>
                <td>: {{ $letter->tanggal_surat->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Bulan Gaji</td>
                <td>: {{ $letter->bulan_gaji }}</td>
            </tr>
            <tr>
                <td>Bank Tujuan</td>
                <td>: {{ $letter->bank_tujuan }}</td>
            </tr>
            <tr>
                <td>No. Rekening Sumber</td>
                <td>: {{ $letter->nomor_rekening_sumber }}</td>
            </tr>
            <tr>
                <td>Total Nominal</td>
                <td>: Rp {{ number_format($letter->total_nominal, 0, ',', '.') }}</td>
            </tr>
        </table>

        <p>Demikian surat pengantar ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <div class="ttd">
        <p>{{ \App\Models\SystemSetting::get('district', 'Kabupaten Jombang') }}, {{ $letter->tanggal_surat->format('d F Y') }}</p>
        <p><strong>Hormat kami,</strong></p>
        <p><strong>{{ \App\Models\SystemSetting::get('company_line1', 'Perusahaan Umum Daerah Air Minum') }}</strong></p>
        <p><strong>{{ \App\Models\SystemSetting::get('company_line2', 'Tirta Kencana Jombang') }}</strong></p>
        <div class="ttd-space"></div>
        <p><strong>{{ \App\Models\SystemSetting::get('director_name', 'KHOIRUL HASYIM. S.Pd, M.Pd') }}</strong></p>
        <p>NIP. {{ \App\Models\SystemSetting::get('director_nip', '19800815 202502 1 001') }}</p>
        @if($letter->status === 'disetujui' && $letter->approver)
        <hr style="margin-top: 40px; margin-bottom: 20px;">
        <p style="font-size: 10pt; color: #666;">
            Disetujui oleh: {{ $letter->approver->name }} <br>
            Tanggal: {{ $letter->approved_at ? $letter->approved_at->translatedFormat('d F Y H:i') : '' }}
        </p>
        @endif
    </div>
</body>
</html>
