<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .modal-content {
  background: linear-gradient(135deg, #ffffff, #e9f0ff);
  border-radius: 1rem !important;
  box-shadow: 0 8px 20px rgba(0, 123, 255, 0.15);
}

.modal-header .modal-title i {
  color: #0d6efd;
  transition: transform 0.3s ease;
}

.modal-header .modal-title:hover i {
  transform: rotate(20deg);
}

.form-control, .form-select {
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus, .form-select:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 8px rgba(13, 110, 253, 0.3);
  outline: none;
}

.btn-primary {
  background: linear-gradient(45deg, #0d6efd, #0048d6);
  border: none;
  transition: background 0.3s ease;
}

.btn-primary:hover {
  background: linear-gradient(45deg, #0048d6, #0d6efd);
  box-shadow: 0 4px 15px rgba(0, 72, 214, 0.6);
}

.btn-outline-danger {
  border-color: #dc3545;
  color: #dc3545;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  color: white;
  box-shadow: 0 4px 15px rgba(220, 53, 69, 0.6);
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            timer: 2000,
            showConfirmButton: false,
            position: 'center'
        });
    });
</script>
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
  <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Ukuran medium, center vertikal -->
    <div class="modal-content rounded-5 shadow-lg border-0">
      <form action="{{ route('admin.pengguna.store') }}" method="POST" novalidate>
        @csrf
        <div class="modal-header border-0 pb-2">
          <h5 class="modal-title d-flex align-items-center fw-bold text-primary" id="modalTambahPenggunaLabel" style="font-size: 1.75rem;">
            <i class="bi bi-person-plus-fill me-3 fs-2" style="color: #0d6efd;"></i>
            Tambah Pengguna
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body pt-0 px-5">
          <div class="mb-4">
            <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
            <input type="text" class="form-control form-control-lg shadow-sm border border-1 border-primary rounded-4" id="name" name="name" placeholder="Masukkan nama lengkap" required />
          </div>

          <div class="mb-4">
            <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
            <input type="email" class="form-control form-control-lg shadow-sm border border-1 border-primary rounded-4" id="email" name="email" placeholder="contoh@mail.com" required />
          </div>

          <div class="mb-4">
            <label for="password" class="form-label fw-semibold text-secondary">Kata Sandi</label>
            <input type="password" class="form-control form-control-lg shadow-sm border border-1 border-primary rounded-4" id="password" name="password" placeholder="Minimal 8 karakter" required />
          </div>

          <div class="mb-3">
            <label for="role" class="form-label fw-semibold text-secondary">Peran</label>
            <select class="form-select form-select-lg shadow-sm border border-1 border-primary rounded-4" id="role" name="role" required>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>

        <div class="modal-footer border-0 pt-3 justify-content-center gap-4">
          <button type="button" class="btn btn-outline-danger px-5 py-2 fw-semibold rounded-pill shadow-sm" data-bs-dismiss="modal" style="transition: all 0.3s ease;">
            <i class="bi bi-x-circle me-2 fs-5"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-pill shadow-sm" style="transition: all 0.3s ease;">
            <i class="bi bi-check-circle me-2 fs-5"></i> Simpan
          </button>
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
