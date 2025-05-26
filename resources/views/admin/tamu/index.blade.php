<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #000;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            font-size: 16px;
            font-weight: 500;
        }

        .sidebar h4 {
            font-size: 22px;
            margin-bottom: 30px;
            text-align: center;
            color: #ffc107;
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: #fff;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #ffc107;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #ffc107;
        }

        .content {
            margin-left: 240px;
            transition: margin-left 0.3s ease;
        }
        .content.full {
            margin-left: 0;
        }
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
        }
    </style>
</head>
<body>

<!-- Toggle Button -->
<button class="btn btn-secondary toggle-btn" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <h4 class="text-white mb-4">Admin Panel</h4>
    <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="{{ url('/admin/jumlah-tamu') }}"><i class="bi bi-bar-chart-line-fill me-2"></i> Jumlah Tamu</a>
    <a href="{{ url('/admin/form-input') }}"><i class="bi bi-ui-checks-grid me-2"></i> Form Input</a>
    <a href="{{ url('/admin/pengguna') }}"><i class="bi bi-people-fill me-2"></i> Pengguna</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-link text-start text-white p-0 text-decoration-none">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>

<!-- Main Content -->
<div id="mainContent" class="content p-4">
    <div class="container">
        <h4 class="mb-4">Data Tamu (Admin)</h4>

        <a href="{{ route('admin.tamu.create') }}" class="btn btn-primary mb-3">Tambah Data Baru</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari nama tamu..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tamus as $index => $tamu)
                    <tr>
                        <td>{{ $tamus->firstItem() + $index }}</td>
                        <td>{{ $tamu->nama }}</td>
                        <td>{{ $tamu->telepon }}</td>
                        <td>{{ $tamu->alamat }}</td>
                        <td>{{ $tamu->keperluan }}</td>
                        <td>{{ $tamu->kategori }}</td>
                        <td>{{ \Carbon\Carbon::parse($tamu->tanggal_datang)->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.tamu.edit', $tamu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.tamu.destroy', $tamu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Tidak ada data ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $tamus->withQueryString()->links() }}
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('mainContent');
        sidebar.classList.toggle('hide');
        content.classList.toggle('full');
    }
</script>

</body>
</html>
