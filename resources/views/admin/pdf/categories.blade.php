<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Daftar Kategori</h1>
    <table>
        <thead>
            <tr>
                <th>Kategori ID</th>
                <th>Nama Kategori</th>
                <th>Nama Prodi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ optional($category->prodi)->name ?? 'Prodi tidak ditemukan' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
