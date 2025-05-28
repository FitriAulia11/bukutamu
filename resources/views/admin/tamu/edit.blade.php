<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #000;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            z-index: 1050;
        }

        .sidebar.hide {
            margin-left: -220px;
        }

        .sidebar h4 {
            font-size: 22px;
            margin-bottom: 30px;
            text-align: center;
            color: #ffc107;
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: #fff;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #ffc107;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #ffc107;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 1px solid #e5e5e5;
        }
        .form-label {
            font-weight: 500;
        }
        .btn {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ url('/admin/form-input') }}"><i class="bi bi-ui-checks-grid"></i> Form Input</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<!-- Content -->
<div class="content">
    <div class="container">
        <div class="mx-auto" style="max-width: 720px;">
            <div class="card">
               <div class="card-header text-center text-primary">
    <i class="bi bi-pencil-square me-2"></i> Edit Data Tamu
</div>

                <div class="card-body">
                    <form action="{{ route('admin.tamu.update', $tamu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.tamu.form', ['tamu' => $tamu])

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.tamu.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save2 me-1"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
