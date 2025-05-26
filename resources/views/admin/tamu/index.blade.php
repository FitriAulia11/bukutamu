<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
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
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            z-index: 1050;
        }

        .sidebar.hide {
            margin-left: -220px;
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
            margin-left: 220px;
            transition: margin-left 0.3s ease;
            padding: 30px 40px;
        }

        .content.full {
            margin-left: 0;
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 235px;
            z-index: 1100;
            transition: left 0.3s ease;
        }

        .sidebar.hide ~ .content .toggle-btn {
            left: 15px;
        }

        .title-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-section h4 {
            font-weight: bold;
            color: #0d6efd;
        }

        .title-section hr {
            width: 200px;
            border-top: 3px solid #0d6efd;
            margin: 10px auto;
        }

        .search-form .form-control {
            border-radius: 10px;
        }

        .search-form .btn {
            border-radius: 10px;
        }

        .table th, .table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>

<!-- Toggle Button -->
<button id="toggleBtn" class="btn btn-secondary toggle-btn" onclick="toggleSidebar()">
    <i id="toggleIcon" class="bi bi-chevron-left"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ url('/admin/jumlah-tamu') }}"><i class="bi bi-bar-chart-line-fill"></i> Jumlah Tamu</a>
    <a href="{{ url('/admin/form-input') }}"><i class="bi bi-ui-checks-grid"></i> Form Input</a>
    <a href="{{ url('/admin/pengguna') }}"><i class="bi bi-people-fill"></i> Pengguna</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<!-- Main Content -->
<div id="mainContent" class="content">
    <div class="title-section">
        <h4><i class="bi bi-clipboard-data-fill me-2"></i>Data Tamu (Admin)</h4>
        <hr>
    </div>

    <a href="{{ route('admin.tamu.create') }}" 
       class="btn btn-outline-primary d-inline-flex align-items-center gap-2 mb-4 shadow-sm px-4 py-2 rounded-pill">
        <i class="bi bi-plus-circle-fill fs-5"></i>
        <span>Tambah Data Baru</span>
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" class="row g-3 mb-4 search-form">
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

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
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
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $tamus->withQueryString()->links() }}
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');
        const toggleIcon = document.getElementById('toggleIcon');

        sidebar.classList.toggle('hide');
        content.classList.toggle('full');

        if (sidebar.classList.contains('hide')) {
            toggleBtn.style.left = '15px';
            toggleIcon.classList.replace('bi-chevron-left', 'bi-chevron-right');
        } else {
            toggleBtn.style.left = '235px';
            toggleIcon.classList.replace('bi-chevron-right', 'bi-chevron-left');
        }
    }
</script>

</body>
</html>
