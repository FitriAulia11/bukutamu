<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 1rem;
        }
        .sidebar .logo {
            font-size: 1.5rem;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .sidebar a {
            color: #ced4da;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .navbar {
            margin-left: 240px;
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
        .content {
            margin-left: 240px;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
   <div class="sidebar">
    <div class="logo">User Panel</div>
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/profile">📝 Isi Data</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-2 px-3">
        @csrf
        <button type="submit" class="btn btn-link text-decoration-none text-white p-0">🚪 Logout</button>
    </form>
</div>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid justify-content-between">
            <a class="navbar-brand ms-3" href="#">Dashboard</a>
            <div class="d-flex align-items-center me-3">
                <span class="fw-semibold">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <h2 class="mb-3">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Ini adalah halaman dashboard user. Gunakan menu di sebelah kiri untuk navigasi.</p>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
