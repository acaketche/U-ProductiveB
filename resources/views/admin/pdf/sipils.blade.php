<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Tugas Akhir Prodi Teknik Sipiil</title>
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
        <h2>Laporan Data Tugas Akhir Prodi Teknik Sipil</h2>
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
            @foreach($teknik_sipils as $index => $teknik_sipil)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teknik_sipil->title ?? '-' }}</td>
                    <td>{{ optional($teknik_sipil->category)->name ?? 'Kategori tidak ditemukan' }}</td>
                    <td>{{ optional($teknik_sipil->user)->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $teknik_sipil->create_at ?? 'No Date Available' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Tugas AKhir: {{ count($teknik_sipils) }}</p>
    </div>
</body>
</html>
