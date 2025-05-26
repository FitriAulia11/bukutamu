@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow border-0 rounded">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h4 class="mb-0 flex-grow-1">Detail Data Tamu</h4>
            <i class="bi bi-person-lines-fill fs-4"></i> {{-- butuh Bootstrap Icons --}}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <dl class="row">
                <dt class="col-sm-4 fw-semibold text-secondary">Nama</dt>
                <dd class="col-sm-8 fs-5">{{ $tamu->nama }}</dd>

                <dt class="col-sm-4 fw-semibold text-secondary">No. Telepon</dt>
                <dd class="col-sm-8 fs-5">{{ $tamu->telepon }}</dd>

                <dt class="col-sm-4 fw-semibold text-secondary">Tanggal & Jam Datang</dt>
                <dd class="col-sm-8 fs-5">{{ \Carbon\Carbon::parse($tamu->tanggal_datang)->format('d M Y H:i') }}</dd>

                <dt class="col-sm-4 fw-semibold text-secondary">Alamat</dt>
                <dd class="col-sm-8 fs-5">{{ $tamu->alamat }}</dd>

                <dt class="col-sm-4 fw-semibold text-secondary">Keperluan</dt>
                <dd class="col-sm-8 fs-5">{{ $tamu->keperluan }}</dd>

                <dt class="col-sm-4 fw-semibold text-secondary">Kategori</dt>
                <dd class="col-sm-8 fs-5">{{ $tamu->kategori }}</dd>
            </dl>

           <a href="{{ route('tamu.index') }}" class="btn btn-outline-primary mt-4 w-100 fw-semibold">
    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Tamu
</a>
        </div>
    </div>
</div>
@endsection
