<!DOCTYPE html>
<html>
<head>
    <title>Data Tamu - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4>Data Tamu (Admin)</h4>

    <a href="{{ route('admin.tamu.create') }}" class="btn btn-primary mb-3">Tambah Data Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="row g-3 mb-3">
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

    <table class="table table-bordered">
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
                <tr><td colspan="8" class="text-center">Tidak ada data ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $tamus->withQueryString()->links() }}
</div>
</body>
</html>
