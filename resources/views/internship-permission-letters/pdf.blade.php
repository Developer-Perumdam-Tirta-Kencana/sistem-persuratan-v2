<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Persetujuan Magang/PKL</title>
    <style>
        @page {
            size: 210mm 330mm;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
        }

        .kop-surat img {
            width: 100%;
            display: block;
            margin-bottom: 0;
        }

        .content {
            padding: 0 48px;
            text-align: justify;
        }

        .right {
            text-align: right;
        }

        .subject-table {
            width: 100%;
            margin-top: 20px;
        }

        .subject-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .label {
            width: 90px;
        }

        .colon {
            width: 10px;
        }

        .body-text {
            margin-top: 20px;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table {
            margin: 15px 0;
            border: 1px solid #000;
        }

        .student-table th,
        .student-table td {
            border: 1px solid #000;
            padding: 6px;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }

        .signature .name {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

@php
    $kopBase64 = null;
    if ($withKop) {
        $path = public_path('kop.png');
        if (file_exists($path)) {
            $kopBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
        }
    }
@endphp

@if($kopBase64)
<div class="kop-surat">
    <img src="{{ $kopBase64 }}">
</div>
@endif

<div class="content" style="margin-top: {{ $withKop ? '0px' : '50px' }};">

    <div class="right">
        {{ \App\Models\SystemSetting::get('district','Kabupaten Jombang') }},
        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <table class="subject-table">
        <tr>
            <td class="label">Nomor</td><td class="colon">:</td>
            <td>{{ $letter->nomor_surat_permohonan }}</td>
        </tr>
        <tr>
            <td>Lamp.</td><td>:</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Sifat</td><td>:</td>
            <td>Penting</td>
        </tr>
        <tr>
            <td>Hal</td><td>:</td>
            <td><strong>Persetujuan Magang / PKL</strong></td>
        </tr>
    </table>

    <div class="body-text">
        <p>
            Kepada Yth.<br>
            <strong>Yth. Sdr.  Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Jombang</strong><br>
            di –<br>
            <strong>JOMBANG</strong>
        </p>

        <p>Dengan hormat,</p>

        <p>
            Menindaklanjuti surat dari <strong>{{ $letter->instansi_pendidikan }}</strong>
            Nomor: <strong>{{ $letter->nomor_surat_permohonan }}</strong>,
            perihal Permohonan Izin Magang / Praktik Kerja Lapangan,
            maka dengan ini kami memberikan izin kepada mahasiswa/i berikut:
        </p>

        <table class="student-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($letter->list_mahasiswa as $i => $mhs)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $mhs['nama'] }}</td>
                    <td>{{ $mhs['nim'] }}</td>
                    <td>{{ $mhs['prodi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>
            Untuk melaksanakan Magang / PKL di
            <strong>Perusahaan Umum Daerah Air Minum Tirta Kencana Kabupaten Jombang</strong>
            terhitung mulai tanggal
            <strong>{{ \Carbon\Carbon::parse($letter->tanggal_mulai)->translatedFormat('d F Y') }}</strong>
            sampai dengan
            <strong>{{ \Carbon\Carbon::parse($letter->tanggal_selesai)->translatedFormat('d F Y') }}</strong>.
        </p>

        <p>
            Demikian surat persetujuan ini kami sampaikan.
            Atas perhatian dan kerja samanya diucapkan terima kasih.
        </p>
    </div>

<div style="width:100%; margin-top:50px;">
    <div style="width:45%; margin-left:auto; text-align:center;">
        <p>
            <strong>Direktur</strong><br>
            {{ \App\Models\SystemSetting::get('company_line2') }}<br>
        </p>

        <!-- Jarak tanda tangan -->
        <div style="height:70px;"></div>

        <p style="margin:0;">
            <strong style="text-decoration:underline;">
                {{ \App\Models\SystemSetting::get('director_name', 'KHOIRUL HASYIM. S.Pd, M.Pd') }}
            </strong><br>
            NIP. {{ \App\Models\SystemSetting::get('director_nip', '19800815 202502 1 001') }}
        </p>
    </div>
</div>


</div>
</body>
</html>
