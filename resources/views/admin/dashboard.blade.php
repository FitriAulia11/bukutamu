<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            display: flex;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 20px;
            width: 250px;
            min-height: 100vh;
            position: fixed;
        }

        .sidebar h4 {
            color: white;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a, .sidebar button.logout-link-button {
            display: block;
            color: white;
            padding: 10px 0;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .sidebar a:hover,
        .sidebar button.logout-link-button:hover {
            color: #ffc107;
        }

        .sidebar i {
            margin-right: 8px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            background-color: #f8f9fa;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .card-box {
            padding: 30px;
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-yellow {
            background-color: #ffc107;
            color: #343a40;
        }

        .card-icon {
            font-size: 2.5rem;
        }

        .card-box h5, .card-box h2 {
            margin: 0;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="{{ url('/admin/dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ url('/admin/jumlah-tamu') }}"><i class="bi bi-bar-chart-line-fill"></i> Jumlah Tamu</a>
    <a href="{{ url('/admin/form-input') }}"><i class="bi bi-ui-checks-grid"></i> Form Input</a>
    <a href="{{ url('/admin/pengguna') }}"><i class="bi bi-people-fill"></i> Pengguna</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="logout-link-button">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2 class="mb-4">Dashboard Admin</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card-box bg-green text-center">
                <div class="card-icon mb-2"><i class="bi bi-people-fill"></i></div>
                <h5>Total Pengguna</h5>
                <h2>{{ $totalPengguna }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-box bg-yellow text-center">
                <div class="card-icon mb-2"><i class="bi bi-journal-text"></i></div>
                <h5>Total Tamu</h5>
                <h2>{{ $totalTamu }}</h2>
            </div>
        </div>
    </div>
</div>

</body>
</html>
