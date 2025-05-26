@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                position: 'center',
                toast: false,
                customClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });
        });
    </script>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">📋 Daftar Tamu</h3>
        <button class="btn btn-outline-primary fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahTamu">
            <i class="bi bi-plus-circle me-2"></i> Tambah Tamu
        </button>
    </div>

    {{-- Search dan Filter --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('tamu.index') }}" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Cari nama tamu..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <input type="datetime-local" name="tanggal" class="form-control" value="{{ request('tanggalValue') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                    <th>Kategori</th>
                    <th>Tanggal & Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tamus as $index => $tamu)
                    <tr>
                        <td class="text-center">{{ $tamus->firstItem() + $index }}</td>
                        <td>{{ $tamu->nama }}</td>
                        <td>{{ $tamu->telepon }}</td>
                        <td>{{ $tamu->alamat }}</td>
                        <td>{{ $tamu->keperluan }}</td>
                        <td><span class="badge bg-info text-dark">{{ $tamu->kategori }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($tamu->tanggal_datang)->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailTamu"
                                onclick="tampilkanDetailTamu(
                                    '{{ $tamu->nama }}',
                                    '{{ $tamu->telepon }}',
                                    '{{ $tamu->alamat }}',
                                    '{{ $tamu->keperluan }}',
                                    '{{ $tamu->kategori }}',
                                    '{{ \Carbon\Carbon::parse($tamu->tanggal_datang)->format('d M Y H:i') }}'
                                )">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada data tamu ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $tamus->withQueryString()->links() }}
    </div>
</div>

{{-- Modal Detail Tamu --}}
<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-labelledby="modalDetailTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalDetailTamuLabel"><i class="bi bi-person-lines-fill me-2"></i>Detail Tamu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Nama</dt>
                <dd class="col-sm-8" id="detail-nama">-</dd>

                <dt class="col-sm-4">No. Telepon</dt>
                <dd class="col-sm-8" id="detail-telepon">-</dd>

                <dt class="col-sm-4">Alamat</dt>
                <dd class="col-sm-8" id="detail-alamat">-</dd>

                <dt class="col-sm-4">Keperluan</dt>
                <dd class="col-sm-8" id="detail-keperluan">-</dd>

                <dt class="col-sm-4">Kategori</dt>
                <dd class="col-sm-8" id="detail-kategori">-</dd>

                <dt class="col-sm-4">Tanggal Datang</dt>
                <dd class="col-sm-8" id="detail-tanggal">-</dd>
            </dl>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

{{-- Modal Tambah Data --}}
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-labelledby="modalTambahTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('form.tamu.store') }}" method="POST" class="modal-content shadow border-0">
        @csrf
        <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalTambahTamuLabel"><i class="bi bi-person-plus-fill me-2"></i>Tambah Tamu Baru</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="telepon" class="form-label">No. Telepon</label>
                <input type="tel" name="telepon" class="form-control" pattern="[0-9]*" input-mode="numeric" required>
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
                <label for="tanggal_datang" class="form-label">Tanggal & Jam Datang</label>
                <input type="datetime-local" name="tanggal" class="form-control" required>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
        </div>
    </form>
  </div>
</div>

{{-- Script Detail & Validasi --}}
<script>
    function tampilkanDetailTamu(nama, telepon, alamat, keperluan, kategori, tanggal) {
        document.getElementById('detail-nama').innerText = nama;
        document.getElementById('detail-telepon').innerText = telepon;
        document.getElementById('detail-alamat').innerText = alamat;
        document.getElementById('detail-keperluan').innerText = keperluan;
        document.getElementById('detail-kategori').innerText = kategori;
        document.getElementById('detail-tanggal').innerText = tanggal;
    }

    // Validasi agar input No. Telepon hanya angka
    document.addEventListener('DOMContentLoaded', function () {
        const teleponInput = document.querySelector('input[name="telepon"]');
        teleponInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>

@endsection
