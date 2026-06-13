<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Matakuliah - Cyber City University</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
            background: #fff;
            margin: 0;
            padding: 10px;
            line-height: 1.3;
        }

        /* ================= CYBER CITY LETTERHEAD ================= */
        .kop-container {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #0f172a;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .kop-logo {
            flex: 0 0 85px;
            margin-right: 20px;
        }
        .kop-logo img {
            width: 85px;
            height: auto;
            display: block;
        }
        .kop-teks {
            flex: 1;
            text-align: left;
        }
        .kop-teks .nama-univ {
            font-size: 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin: 0 0 2px 0;
        }
        .kop-teks .tagline {
            font-size: 11px;
            font-style: italic;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 8px 0;
        }
        .kop-teks .detail-kontak {
            font-size: 10.5px;
            color: #475569;
            line-height: 1.4;
        }

        /* ================= ISI DOKUMEN ================= */
        .judul-laporan {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .sub-judul-laporan {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 25px;
        }

        /* ================= DATA TABLE MODERN ================= */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #cbd5e1;
            padding: 10px 14px;
            font-size: 12px;
        }
        .data-table th {
            background-color: #0f172a !important;
            color: #ffffff !important;
            font-weight: 600;
            text-align: left;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .text-center {
            text-align: center;
        }

        /* ================= TANDA TANGAN ================= */
        .ttd-container {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: left;
            font-size: 12px;
        }
        .ttd-tanggal {
            margin-bottom: 65px;
            color: #475569;
        }
        .ttd-nama {
            font-weight: 700;
            color: #0f172a;
        }
        .ttd-jabatan {
            color: #64748b;
            font-size: 11px;
        }

        @media print {
            body { padding: 0; }
            @page { size: A4; margin: 2cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-container">
        <div class="kop-logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Universitas">
        </div>
        <div class="kop-teks">
            <div class="nama-univ">Cyber City University</div>
            <div class="tagline">Connecting Knowledge, Inspiring Innovation</div>
            <div class="detail-kontak">
                Biro Administrasi Akademik — Departemen Kurikulum dan Pembelajaran<br>
                Jl. Tech Boulevard No. 101, Blok Barat, Cyber City 12340<br>
                Telp: (021) 5555-9999 | Email: academic@cybercity.ac.id | Web: www.cybercity.ac.id
            </div>
        </div>
    </div>

    <div class="judul-laporan">Daftar Manifest Matakuliah Aktif</div>
    <div class="sub-judul-laporan">Kurikulum Berbasis Kompetensi Kerja — Dicetak pada: {{ date('d F Y') }}</div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="6%" class="text-center">No</th>
                <th>Nama Matakuliah</th>
                <th width="12%" class="text-center">SKS</th>
                <th width="35%">Jurusan / Program Studi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matakuliah as $item)
            <tr>
                <td class="text-center" style="color: #64748b;">{{ $loop->iteration }}</td>
                <td style="font-weight: 500;">{{ $item->nama_matakuliah }}</td>
                <td class="text-center">{{ $item->sks }} SKS</td>
                <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-tanggal">Jakarta, {{ date('d F Y') }}</div>
        <div class="ttd-jabatan">Mengetahui,</div>
        <div style="margin-top: 60px;" class="ttd-nama">Dr. Ir. Nama Akademik, M.T.</div>
        <div class="ttd-jabatan">Kepala Biro Administrasi Akademik</div>
    </div>

</body>
</html>