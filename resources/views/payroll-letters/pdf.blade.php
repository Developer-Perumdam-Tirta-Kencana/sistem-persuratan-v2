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
        .kop-surat img {
            width: 100%;
            display: block;
        }
        .garis-kop {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            margin: 10px 0 20px 0;
        }
        .content {
            padding: 0 48px;
            text-align: justify;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .meta-table td {
            vertical-align: top;
            padding: 2px 0;
        }
        .ttd-area {
            margin-top: 50px;
            width: 100%;
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
@endif

<div class="content">

    <p style="text-align:right;">
        {{ \App\Models\SystemSetting::get('district', 'Jombang') }},
        {{ $letter->tanggal_surat->translatedFormat('d F Y') }}
    </p>

    <table class="meta-table">
        <tr>
            <td width="120">Nomor</td>
            <td>: {{ $letter->nomor_surat }}</td>
        </tr>
        <tr>
            <td>Sifat</td>
            <td>: Penting</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>: 2 (dua) lembar</td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>: Permohonan Pemindahbukuan Rekening</td>
        </tr>
    </table>

    <p>
        Kepada Yth.<br>
        <strong>Pimpinan Bank Jatim</strong><br>
        Kantor Cabang {{ $letter->bank_cabang ?? 'Jombang' }}<br>
        Di –<br>
        <strong>{{ strtoupper($letter->bank_cabang ?? 'JOMBANG') }}</strong>
    </p>

    <p>Dengan hormat,</p>

    <p style="text-indent:30px;">
        Sehubungan dengan pemberian gaji bulan
        <strong>{{ $letter->bulan_gaji }}</strong>
        bagi Pegawai
        <strong>{{ \App\Models\SystemSetting::get('company_line2', 'PERUMDAM TIRTA KENCANA KABUPATEN JOMBANG') }}</strong>
        yang dibayarkan melalui rekening Bank Jatim Cabang Jombang,
        maka bersama ini kami mohon kepada Bank Jatim Cabang Jombang
        untuk <strong>MEMINDAHBUKUKAN</strong> rekening Simpeda atas nama
        <strong>{{ \App\Models\SystemSetting::get('company_line2') }}</strong>
        dengan nomor rekening
        <strong>{{ $letter->nomor_rekening_sumber }}</strong>
        sebesar
        <strong>
            Rp {{ number_format($letter->total_nominal, 0, ',', '.') }}
        </strong>
        ({{ ucwords(terbilang($letter->total_nominal)) }} Rupiah)
        ke rekening masing-masing pegawai sesuai data terlampir.
    </p>

    <p>
        Demikian mohon perhatiannya dan atas segala informasi serta
        kerjasamanya kami sampaikan terima kasih.
    </p>

    <table class="ttd-area">
        <tr>
            <td width="50%" style="text-align:center;">
                Mengetahui,<br>
                <strong>Direktur</strong><br>
                {{ \App\Models\SystemSetting::get('company_line2') }}<br><br><br><br>
                <strong>{{ \App\Models\SystemSetting::get('director_name') }}</strong><br>
                NIP. {{ \App\Models\SystemSetting::get('director_nip') }}
            </td>
            <td width="50%" style="text-align:center;">
                Manajer Administrasi & Keuangan<br><br><br><br><br>
                <strong>{{ \App\Models\SystemSetting::get('finance_manager_name', 'NORMA DIARINI, S.Sos') }}</strong><br>
                NIP. {{ \App\Models\SystemSetting::get('finance_manager_nip', '19731228 200012 2 041') }}
            </td>
        </tr>
    </table>

</div>

</body>
</html>
