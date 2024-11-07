<!DOCTYPE html>
<html>
<head>
    <title>Laporan Video</title>
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
        <h2>Laporan Daftar Video</h2>
        <p>Diekspor pada: {{ $exported_at }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->video_id ?? '-' }}</td>
                    <td>{{ $video->title ?? '-' }}</td>
                    <td>{{ optional($video->user)->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ optional($video->category)->name ?? 'Kategori tidak ditemukan' }}</td>
                    <td>{{ ucfirst($video->status) ?? '-' }}</td>
                    <td>{{ optional($video->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Artikel: {{ count($videos) }}</p>
    </div>
</body>
</html>
