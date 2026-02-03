<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Izin Magang/PKL</title>
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
            text-align: right;
        }
        .signature-space {
            margin-top: 60px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .no-border td {
            border: none;
            padding: 5px 0;
            vertical-align: top;
        }
        .label {
            width: 150px;
        }
        .student-table {
            border: 1px solid #000;
            margin: 20px 0;
        }
        .student-table th,
        .student-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .student-table th {
            background-color: #f5f5f5;
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
            SURAT IZIN MAGANG/PKL
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

            <p>Dengan ini memberikan izin kepada <strong>{{ $letter->instansi_pendidikan }}</strong> untuk melaksanakan magang/praktik kerja lapangan (PKL) dengan rincian sebagai berikut:</p>

            <div class="details">
                <table class="no-border">
                    <tr>
                        <td class="label">Nomor Surat Permohonan</td>
                        <td>:</td>
                        <td>{{ $letter->nomor_surat_permohonan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Mulai</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($letter->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Selesai</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($letter->tanggal_selesai)->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
            </div>

            <p><strong>Daftar Peserta Magang/PKL:</strong></p>

            @if($letter->list_mahasiswa && count($letter->list_mahasiswa) > 0)
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
                    @foreach($letter->list_mahasiswa as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mahasiswa['nama'] ?? '-' }}</td>
                        <td>{{ $mahasiswa['nim'] ?? '-' }}</td>
                        <td>{{ $mahasiswa['prodi'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <p>Peserta magang/PKL diharapkan dapat mematuhi peraturan dan tata tertib yang berlaku di PDAM Tirta Kencana Kabupaten Nganjuk serta memberikan hasil kerja yang baik selama pelaksanaan magang.</p>

            <p>Demikian surat izin magang/PKL ini kami sampaikan. Atas perhatiannya, kami ucapkan terima kasih.</p>
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
