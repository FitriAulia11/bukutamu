<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        }
        .card-header {
            background-color: #ffffff;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-bottom: 1px solid #e9ecef;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .btn {
            border-radius: 10px;
        }
        .alert {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mx-auto" style="max-width: 720px;">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-lines-fill me-2 text-primary"></i> Formulir Data Tamu
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                <form action="{{ route('admin.tamu.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Tamu</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <input type="tel" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror"
                               value="{{ old('telepon') }}" required>
                        @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal & Jam Datang</label>
                        <input type="datetime-local" name="tanggal_datang" id="tanggal"
                               class="form-control @error('tanggal_datang') is-invalid @enderror"
                               value="{{ old('tanggal_datang', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('tanggal_datang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                  rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <input type="text" name="keperluan" id="keperluan"
                               class="form-control @error('keperluan') is-invalid @enderror"
                               value="{{ old('keperluan') }}" required>
                        @error('keperluan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                            @foreach(['Wali Santri', 'Tamu Hotel', 'Orangtua Siswa', 'Kunjungan Dinas', 'Calon Siswa', 'Tokoh Masyarakat', 'Kunjungan Sekolah'] as $kategori)
                                <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary w-50">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-save2 me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
