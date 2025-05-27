<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
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
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #ffc107;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #ffc107;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: calc(100% - 220px);
            min-height: 100vh;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 50px;
        }

        .btn {
            font-size: 14px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .table thead {
            background-color: #0d6efd;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s;
        }

        .alert {
            font-size: 14px;
        }

        h4 {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ url('/admin/dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ url('/admin/jumlah-tamu') }}">
            <i class="bi bi-bar-chart-line-fill"></i> Jumlah Tamu
        </a>
        <a href="{{ url('/admin/form-input') }}">
            <i class="bi bi-ui-checks-grid"></i> Form Input
        </a>
        <a href="{{ url('/admin/pengguna') }}">
            <i class="bi bi-people-fill"></i> Pengguna
        </a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <h4 class="fw-bold text-success">
                <i class="bi bi-people-fill me-2"></i> Daftar Pengguna
            </h4>
            <hr class="mx-auto" style="width: 200px; border-top: 3px solid #198754;" />
        </div>

        @if(session('success'))
            <div
                class="alert alert-success alert-dismissible fade show shadow-sm rounded-pill px-4 py-2 d-inline-flex align-items-center"
                role="alert"
                id="successAlert"
            >
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol Tambah Pengguna -->
        <button
            type="button"
            class="btn btn-outline-success d-inline-flex align-items-center gap-2 mb-3 shadow-sm px-4 py-2 rounded-pill"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPengguna"
        >
            <i class="bi bi-plus-circle-fill fs-5"></i>
            <span>Tambah Pengguna</span>
        </button>

        <!-- Modal Tambah Pengguna -->
        <div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-labelledby="modalTambahPenggunaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.pengguna.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahPenggunaLabel">
                                <i class="bi bi-person-plus-fill me-2"></i> Tambah Pengguna
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" class="form-control" id="password" name="password" required />
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Peran</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Pilih peran</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Pengguna -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Nama</th>
                                <th style="width: 30%;">Email</th>
                                <th style="width: 15%;">Role</th>
                                <th style="width: 25%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form
                                            action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-close alert dalam 4 detik
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 4000);
    </script>
</body>
</html>
