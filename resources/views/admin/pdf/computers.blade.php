<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Tugas Akhir Prodi Komputer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Tugas Akhir Prodi Komputer</h2>
        <p>Diekspor pada: {{ $exported_at }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>User</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teknik_computers as $index => $teknik_computer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teknik_computer->title ?? '-' }}</td>
                    <td>{{ optional($teknik_computer->category)->name ?? 'Kategori tidak ditemukan' }}</td>
                    <td>{{ optional($teknik_computer->user)->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $teknik_computer->create_at ?? 'No Date Available' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Tugas AKhir: {{ count($teknik_computers) }}</p>
    </div>
</body>
</html>
