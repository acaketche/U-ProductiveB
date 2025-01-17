<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data User</title>
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
        <h2>Laporan Data User</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->user_id ?? '-' }}</td>
                    <td>{{ $user->name ?? 'Nama tidak tersedia' }}</td>
                    <td>{{ $user->email ?? 'Email tidak tersedia' }}</td>
                    <td>{{ $user->role ?? 'Role tidak tersedia' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total User: {{ count($users) }}</p>
    </div>
</body>
</html>
