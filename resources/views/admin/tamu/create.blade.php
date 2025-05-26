<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow border-0 rounded">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <h4 class="mb-0 flex-grow-1">Form Input Data Tamu</h4>
                <i class="bi bi-person-plus-fill fs-4"></i>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.tamu.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Tamu</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required autofocus placeholder="Masukkan nama tamu" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label fw-semibold">No. Telepon</label>
                        <input type="tel" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror" required placeholder="0812xxxxxx" value="{{ old('telepon') }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-semibold">Tanggal & Jam Datang</label>
                        <input type="datetime-local" name="tanggal_datang" id="tanggal" class="form-control @error('tanggal_datang') is-invalid @enderror" value="{{ old('tanggal_datang', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('tanggal_datang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keperluan" class="form-label fw-semibold">Keperluan</label>
                        <input type="text" name="keperluan" id="keperluan" class="form-control @error('keperluan') is-invalid @enderror" required placeholder="Tujuan kunjungan" value="{{ old('keperluan') }}">
                        @error('keperluan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                            <option value="Wali Santri" {{ old('kategori') == 'Wali Santri' ? 'selected' : '' }}>Wali Santri</option>
                            <option value="Tamu Hotel" {{ old('kategori') == 'Tamu Hotel' ? 'selected' : '' }}>Tamu Hotel</option>
                            <option value="Orangtua Siswa" {{ old('kategori') == 'Orangtua Siswa' ? 'selected' : '' }}>Orangtua Siswa</option>
                            <option value="Kunjungan Dinas" {{ old('kategori') == 'Kunjungan Dinas' ? 'selected' : '' }}>Kunjungan Dinas</option>
                            <option value="Calon Siswa" {{ old('kategori') == 'Calon Siswa' ? 'selected' : '' }}>Calon Siswa</option>
                            <option value="Tokoh Masyarakat" {{ old('kategori') == 'Tokoh Masyarakat' ? 'selected' : '' }}>Tokoh Masyarakat</option>
                            <option value="Kunjungan Sekolah" {{ old('kategori') == 'Kunjungan Sekolah' ? 'selected' : '' }}>Kunjungan Sekolah</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
