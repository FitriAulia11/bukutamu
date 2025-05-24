<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #111;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 20;
            background: rgba(0, 123, 255, 0.85);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease;
        }
        .navbar-nav .nav-link {
            color: #e0e0e0 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #fff !important;
            text-shadow: 0 0 5px rgba(255,255,255,0.7);
        }

        .image-slider-container {
            position: relative;
            width: 100vw;
            height: 75vh;
            overflow: hidden;
            background: #000;
            margin-top: 56px; /* height navbar */
        }

        .image-slider-container img {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1.2s ease-in-out, transform 6s ease-in-out;
            transform: scale(1);
            z-index: 0;
            filter: brightness(0.7);
        }

        .image-slider-container img.active {
            opacity: 1;
            z-index: 1;
            transform: scale(1.1);
        }

        /* Overlay gelap untuk teks */
        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }

       .welcome-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            color: #fff;
            font-size: clamp(1.2rem, 3vw, 2.5rem);
            font-weight: 700;
            text-align: center;
            text-shadow: 0 3px 8px rgba(0,0,0,0.7);
            animation: fadeInUp 1.5s ease forwards;
            opacity: 0;
        }

        /* Animasi fadeInUp */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Spacer supaya konten di bawah tidak terlalu mepet */
        .content-spacer {
            height: 100px;
            background: #f8f9fa;
            flex-shrink: 0;
        }

        /* Footer styling */
        footer {
            background-color:rgb(15, 69, 150); /* bootstrap primary */
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            flex-shrink: 0;
        }
        footer h5 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        footer p {
            margin: 0.2rem 0;
        }
        footer a {
            color: #ffc107; /* amber */
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container d-flex align-items-center">
        <!-- Logo di sebelah kiri -->
        <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Wikrama" style="width: 40px; height: auto; margin-right: 10px;">
            BukuTamu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
</nav>

<!-- Image Slider -->
<div class="image-slider-container" id="imageSlider">
    <img src="{{ asset('img/wikrama1.jpg') }}" alt="Wikrama 1" class="active" />
    <img src="{{ asset('img/wikrama2.jpg') }}" alt="Wikrama 2" />
    <img src="{{ asset('img/wikrama3.jpg') }}" alt="Wikrama 3" />
    <div class="overlay"></div>
    <div class="welcome-text">
        Selamat Datang di Buku Tamu Digital SMK Wikrama 1 Garut
    </div>
</div>

<!-- Spacer supaya konten di bawah tidak terlalu mepet -->
<div class="content-spacer"></div>


<!-- Footer -->
<footer>
    <h5>Kontak Sekolah</h5>
    <p>Alamat: Jalan Otto Iskandardinata kampung tanjung, RT.003/RW.013, Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151</p>
    <p>Telepon: <a href="tel:+628112232880">0811-2232-880</a></p>
    <p>Email: <a href="mailto:info@smkwikrama1garut.sch.id">info@smkwikrama1garut.sch.id</a></p>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const slider = document.getElementById('imageSlider');
    const slides = slider.querySelectorAll('img');
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(showNextSlide, 5000);
</script>

</body>
</html>
