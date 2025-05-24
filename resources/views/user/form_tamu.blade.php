@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient-primary text-white rounded-top-4">
            <h4 class="mb-0">Form Input Data Tamu</h4>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('form.tamu.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama Tamu</label>
                    <input type="text" name="nama" id="nama" class="form-control shadow-sm" required autofocus placeholder="Masukkan nama tamu">
                </div>

                <div class="mb-4">
                    <label for="telepon" class="form-label fw-semibold">No. Telepon</label>
                    <input type="tel" name="telepon" id="telepon" class="form-control shadow-sm" required placeholder="0812xxxxxx">
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal & Jam Datang</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" class="form-control shadow-sm" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control shadow-sm" rows="3" required placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="mb-4">
                    <label for="keperluan" class="form-label fw-semibold">Keperluan</label>
                    <input type="text" name="keperluan" id="keperluan" class="form-control shadow-sm" required placeholder="Tujuan kunjungan">
                </div>

                <div class="mb-5">
                    <label for="kategori" class="form-label fw-semibold">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select shadow-sm" required>
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

                <button type="submit" class="btn btn-gradient-primary w-100 fw-semibold py-2 fs-5 rounded-pill shadow-sm">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom gradient untuk header dan tombol */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #1cc88a, #17a673);
        border: none;
        color: white;
        transition: background 0.3s ease;
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #17a673, #13855b);
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 8px rgba(34, 74, 190, 0.5);
        border-color: #224abe;
    }
</style>
@endsection
