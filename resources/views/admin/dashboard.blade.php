<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #000;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            font-size: 16px;
            font-weight: 500;
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

        /* Main Content */
        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: calc(100% - 220px);
            min-height: 100vh;
        }

        .card-box {
            padding: 30px;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-yellow {
            background-color: #ffc107;
            color: #212529;
        }

        .card-icon {
            font-size: 2.5rem;
        }

        .card-box h5 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card-box h2 {
            font-size: 32px;
            font-weight: bold;
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

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="text-center text-lg-start mb-5">
        <h2 class="fw-bold text-primary mb-2">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
        </h2>
        <p class="fs-5 text-muted mb-0">
            Selamat datang, <strong class="text-dark">{{ Auth::user()->name }}</strong>! 👋 Semoga harimu menyenangkan.
        </p>
    </div>

    <!-- Statistik Cards -->
    <div class="row">
        <!-- Total Pengguna -->
        <div class="col-md-6 mb-4">
            <a href="{{ url('/admin/pengguna') }}" class="text-decoration-none">
                <div class="card-box gradient-green text-center hover-card shadow">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="text-white mb-1">Total Pengguna</h5>
                    <h2 class="text-white">{{ $totalPengguna }}</h2>
                </div>
            </a>
        </div>

        <!-- Total Tamu -->
        <div class="col-md-6 mb-4">
            <a href="{{ url('/admin/form-input') }}" class="text-decoration-none">
                <div class="card-box gradient-yellow text-center hover-card shadow">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h5 class="text-dark mb-1">Total Tamu</h5>
                    <h2 class="text-dark">{{ $totalTamu }}</h2>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
.main-content {
    padding: 2rem;
}

.card-box {
    padding: 30px 20px;
    border-radius: 12px;
    transition: all 0.3s ease-in-out;
}

.hover-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.gradient-green {
    background: linear-gradient(135deg, #28a745, #218838);
    color: #fff;
}

.gradient-yellow {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}

.icon-circle {
    width: 60px;
    height: 60px;
    line-height: 60px;
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
    font-size: 28px;
    border-radius: 50%;
    margin: 0 auto;
}

@media (max-width: 767px) {
    .icon-circle {
        width: 50px;
        height: 50px;
        font-size: 24px;
    }

    .card-box {
        padding: 25px 15px;
    }
}
</style>
