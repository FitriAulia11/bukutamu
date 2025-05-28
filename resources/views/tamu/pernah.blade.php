@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Data Tamu yang Sudah Pernah Berkunjung</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Keperluan</th>
                <th>Kategori</th>
                <th>Tanggal Datang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tamus as $tamu)
            <tr>
                <td>{{ $tamu->nama }}</td>
                <td>{{ $tamu->telepon }}</td>
                <td>{{ $tamu->alamat }}</td>
                <td>{{ $tamu->keperluan }}</td>
                <td>{{ $tamu->kategori }}</td>
                <td>{{ $tamu->tanggal_datang }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
