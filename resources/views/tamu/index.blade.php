@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Data Tamu</h3>

    {{-- Search dan Filter --}}
    <form method="GET" action="{{ route('tamu.index') }}" class="row g-3 mb-4">
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
                            <a href="{{ route('user.show', $tamu->id) }}" class="btn btn-sm btn-info">Detail</a>
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

    {{-- Tombol Tambah --}}
    <a href="{{ route('form.tamu.create') }}" class="btn btn-outline-primary mt-4 w-100 fw-semibold">
        <i class="bi bi-plus-lg me-2"></i> Tambah Data Baru
    </a>
</div>
@endsection
