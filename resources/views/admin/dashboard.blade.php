<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f8f9fa;
        }

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

        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: calc(100% - 220px);
            min-height: 100vh;
        }

        .card-box {
            padding: 30px 20px;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .hover-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
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

        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
        }

        .card {
            border: none;
            border-radius: 16px;
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

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
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

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="mb-5">
        <h2 class="fw-bold text-primary d-flex align-items-center gap-2">
            <i class="bi bi-speedometer2 fs-2"></i> Dashboard Admin
        </h2>
        <p class="fs-5 text-secondary">
            Selamat datang, <strong class="text-dark">{{ Auth::user()->name }}</strong>! 👋 Semoga harimu menyenangkan.
        </p>
    </div>

    <!-- Total Tamu Bulan Ini -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card gradient-yellow text-center shadow-sm p-4 hover-card">
                <div class="icon-circle mb-3">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5 class="fw-bold mb-1">Total Tamu Bulan Ini</h5>
                <h2 class="fw-bold">{{ $totalTamu }}</h2>
            </div>
        </div>
    </div>

<!-- Grafik Jumlah Tamu -->
<div class="card shadow p-4 mt-4 bg-white rounded-4 hover-card border-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-bar-chart-line-fill me-2 text-warning"></i> Grafik Jumlah Tamu (Tiap Bulan)
        </h4>
    </div>
    <hr class="mb-4">

    <div class="chart-container" style="height: 420px;">
        <canvas id="grafikTamu"></canvas>
    </div>
</div>


<script>
    const ctx = document.getElementById('grafikTamu').getContext('2d');

    // Buat gradient untuk batang
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(255, 193, 7, 0.9)');
    gradient.addColorStop(1, 'rgba(255, 193, 7, 0.4)');

    const grafikTamu = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!}, // Januari s/d bulan sekarang
            datasets: [{
                label: 'Jumlah Tamu',
                data: {!! json_encode($data) !!},  // Data sesuai bulan
                backgroundColor: gradient,
                borderColor: '#ffc107',
                borderWidth: 2,
                borderRadius: 8,
                barThickness: 40,
                maxBarThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#6c757d',
                        font: {
                            size: 14,
                            weight: '600'
                        }
                    },
                    grid: {
                        color: '#e9ecef',
                        borderDash: [5, 5],
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Tamu',
                        color: '#495057',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    ticks: {
                        color: '#495057',
                        font: {
                            size: 14,
                            weight: '600'
                        },
                        maxRotation: 45,
                        minRotation: 45,
                        autoSkip: true,
                        maxTicksLimit: 12
                    },
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Bulan',
                        color: '#495057',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#212529',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#ffc107',
                    titleColor: '#212529',
                    bodyColor: '#212529',
                    padding: 10,
                    borderColor: '#e0a800',
                    borderWidth: 1,
                    cornerRadius: 6,
                    displayColors: false,
                    callbacks: {
                        label: context => `Jumlah: ${context.parsed.y}`
                    }
                }
            }
        }
    });
</script>
