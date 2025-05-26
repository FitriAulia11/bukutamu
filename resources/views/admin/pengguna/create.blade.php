<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; }
               /* Sidebar */
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



        .main-content {
            margin-left: 220px; width: calc(100% - 220px);
            min-height: 100vh; display: flex; justify-content: center; align-items: center;
            padding: 40px 20px;
        }

        .form-container {
            width: 100%; max-width: 800px;
        }

        .card {
            background: #fff; border: none; border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .form-label { font-weight: 500; }

        .btn-primary {
            background-color: #007bff; border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d; border-color: #6c757d;
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
        <div class="form-container">
            <div class="card p-4">
                <h4 class="mb-4">Tambah Data Tamu</h4>
                <form action="{{ route('form.tamu.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">No. Telepon</label>
                            <input type="text" name="telepon" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="Wali Santri">Wali Santri</option>
                                <option value="Tamu Hotel">Tamu Hotel</option>
                                <option value="Orangtua Siswa">Orangtua Siswa</option>
                                <option value="Kunjungan Dinas">Kunjungan Dinas</option>
                                <option value="Calon Siswa">Calon Siswa</option>
                                <option value="Tokoh Masyarakat">Tokoh Masyarakat</option>
                                <option value="Kunjungan Sekolah">Kunjungan Sekolah</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal & Jam Datang</label>
                            <input type="datetime-local" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url('/admin/pengguna') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
