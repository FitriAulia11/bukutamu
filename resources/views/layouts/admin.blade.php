<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('style')
</head>
<body>

<!-- Sidebar -->
<div class="d-flex">
    <div class="sidebar p-3 bg-dark text-white" style="width: 240px; height: 100vh; position: fixed;">
        <h4 class="text-center">Admin Panel</h4>
        <a href="/admin/dashboard" class="d-block text-decoration-none text-white py-2">🏠 Dashboard</a>
        <a href="/admin/users" class="d-block text-decoration-none text-white py-2">👥 Kelola Pengguna</a>
        <a href="/admin/forms" class="d-block text-decoration-none text-white py-2">📝 Lihat Form</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-link text-white text-decoration-none p-0">🚪 Logout</button>
        </form>
    </div>

    <!-- Content -->
    <div class="flex-grow-1" style="margin-left: 240px;">
        <nav class="navbar bg-white border-bottom">
            <div class="container-fluid justify-content-between">
                <a class="navbar-brand">Dashboard Admin</a>
                <div class="me-3">
                    {{ Auth::user()->name }}
                </div>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('script')
</body>
</html>
