<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4>Edit Tamu</h4>
    <form action="{{ route('admin.tamu.update', $tamu->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.tamu.form', ['tamu' => $tamu])
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.tamu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
