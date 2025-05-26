<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; margin: 0; }
        .sidebar {
            width: 220px; height: 100vh; background-color: #000; color: #fff;
            padding-top: 20px; position: fixed; font-size: 16px;
        }
        .sidebar h4 { font-size: 22px; text-align: center; margin-bottom: 30px; }
        .sidebar a {
            display: block; padding: 14px 20px; color: #fff; text-decoration: none;
        }
        .sidebar a:hover { background-color: #333; color: #ffc107; }
        .main-content {
            margin-left: 220px; padding: 20px; width: 100%;
            background-color: #f8f9fa; min-height: 100vh;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ url('/admin/jumlah-tamu') }}"><i class="bi bi-bar-chart-line-fill"></i> Jumlah Tamu</a>
        <a href="{{ url('/admin/form-input') }}"><i class="bi bi-ui-checks-grid"></i> Form Input</a>
        <a href="{{ url('/admin/pengguna') }}"><i class="bi bi-people-fill"></i> Pengguna</a>
        <a href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h4>Tambah Pengguna</h4>
        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

</body>
</html>
