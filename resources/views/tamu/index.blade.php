@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-start mb-4">
        <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahTamu">
            <i class="bi bi-plus-lg me-2"></i> Tambah Data Baru
        </button>
    </div>

    {{-- Search dan Filter --}}
    <form method="GET" action="{{ route('tamu.index') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Cari nama tamu..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <input type="datetime-local" name="tanggal" class="form-control" value="{{ request('tanggalValue') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    {{-- Tabel Data Tamu --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                    <th>Kategori</th>
                    <th>Tanggal & Jam Datang</th>
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
                            <button class="btn btn-sm btn-info"
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
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data tamu ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $tamus->withQueryString()->links() }}
    </div>
</div>

<!-- Modal Detail Tamu -->
<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-labelledby="modalDetailTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="modalDetailTamuLabel">Detail Tamu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <dl class="row">
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Data Baru -->
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-labelledby="modalTambahTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('form.tamu.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title fw-bold" id="modalTambahTamuLabel">Tambah Data Tamu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
            <div class="col-md-6">
                <label for="tanggal_datang" class="form-label">Tanggal & Jam Datang</label>
                <input type="datetime-local" name="tanggal" class="form-control" required>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>

<!-- Script Show Detail -->
<script>
    function tampilkanDetailTamu(nama, telepon, alamat, keperluan, kategori, tanggal) {
        document.getElementById('detail-nama').innerText = nama;
        document.getElementById('detail-telepon').innerText = telepon;
        document.getElementById('detail-alamat').innerText = alamat;
        document.getElementById('detail-keperluan').innerText = keperluan;
        document.getElementById('detail-kategori').innerText = kategori;
        document.getElementById('detail-tanggal').innerText = tanggal;
    }
</script>
@endsection
