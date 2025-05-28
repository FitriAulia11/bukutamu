<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        #toast-success {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            min-width: 300px;
            max-width: 500px;
            border-radius: 12px;
            animation: fadeSlide 0.5s ease forwards;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
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

    <!-- Notifikasi -->
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

    <!-- Tombol trigger modal -->
    <button class="btn btn-outline-primary d-inline-flex align-items-center gap-2 mb-4 shadow-sm px-4 py-2 rounded-pill" 
            data-bs-toggle="modal" data-bs-target="#modalTambahTamu">
        <i class="bi bi-plus-circle-fill fs-5"></i>
        <span>Tambah Data Baru</span>
    </button>

    <!-- Modal Tambah Tamu -->
    <div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-labelledby="modalTambahTamuLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="{{ route('admin.tamu.store') }}" method="POST">
            @csrf
         <div class="modal-header border-0 justify-content-center position-relative bg-primary text-white py-3 rounded-top shadow-sm">
  <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="modalTambahTamuLabel">
    <i class="bi bi-person-plus-fill fs-4"></i> <!-- Icon Bootstrap person plus -->
    Tambah Data Tamu
  </h5>
  <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Tutup"></button>
</div>

            <div class="modal-body row g-3">
              <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" required>
              </div>
              <div class="col-md-12">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
              </div>
              <div class="col-md-6">
                <label for="keperluan" class="form-label">Keperluan</label>
                <input type="text" name="keperluan" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach(['Wali Santri','Tamu Hotel','Orangtua Siswa','Kunjungan Dinas','Calon Siswa','Tokoh Masyarakat','Kunjungan Sekolah'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
              <div class="col-md-6">
                <label for="tanggal_datang" class="form-label">Tanggal Datang</label>
                <input type="datetime-local" name="tanggal_datang" class="form-control" required>
              </div>
            </div>
           <div class="modal-footer d-flex justify-content-center gap-3">
  <button type="button" class="btn btn-secondary px-4 py-2 rounded-pill" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-2"></i> Batal
  </button>
  <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
    <i class="bi bi-check-circle me-2"></i> Simpan
  </button>
</div>

          </form>
        </div>
      </div>
    </div>

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

    <div class="d-flex justify-content-center mt-4">
        {{ $tamus->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

    // Auto-dismiss toast success
    setTimeout(() => {
        const toast = document.getElementById('toast-success');
        if (toast) {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>

</body>
</html>
