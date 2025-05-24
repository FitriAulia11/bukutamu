<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .image-hover-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            height: 400px;
            border-radius: 0.75rem; /* rounded-xl */
            overflow: hidden;
            cursor: pointer;
        }

        .image-hover-container img {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.75rem;
            transition: opacity 0.6s ease-in-out;
            opacity: 0;
            z-index: 0;
        }

        /* Default: show first image */
        .image-hover-container img:nth-child(1) {
            opacity: 1;
            position: relative;
            z-index: 1;
        }

        /* On hover: first image disappear */
        .image-hover-container:hover img:nth-child(1) {
            opacity: 0;
            position: absolute;
            z-index: 0;
        }

        /* On hover: show second image */
        .image-hover-container:hover img:nth-child(2) {
            opacity: 1;
            position: relative;
            z-index: 1;
            animation: fadeToggle 3s infinite;
        }

        /* On hover: show third image with delay */
        .image-hover-container:hover img:nth-child(3) {
            opacity: 0;
            position: absolute;
            z-index: 0;
            animation: fadeToggleReverse 3s infinite;
            animation-delay: 1.5s;
        }

        @keyframes fadeToggle {
            0%, 50% { opacity: 1; }
            50.01%, 100% { opacity: 0; }
        }

        @keyframes fadeToggleReverse {
            0%, 50% { opacity: 0; }
            50.01%, 100% { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold text-blue-700">BukuTamu</div>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold transition duration-300">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold transition duration-300">Register</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="text-center max-w-3xl space-y-8">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Selamat Datang di Laravel</h1>
            <p class="text-gray-600 text-lg mb-8">
                Mulailah membangun aplikasi webmu dengan cepat dan mudah menggunakan Laravel. Hover pada gambar untuk melihat foto berganti!
            </p>

            <!-- Gambar hover -->
            <div class="image-hover-container mx-auto">
<img src="{{ asset('img/wikrama.jpg') }}" alt="Wikrama" />
<img src="{{ asset('img/wikrama.jpg') }}" alt="Wikrama" />

            </div>
        </div>
    </main>

</body>
</html>
