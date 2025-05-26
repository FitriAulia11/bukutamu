<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #111;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 20;
            background: rgba(0, 123, 255, 0.85);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
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
            padding-top: 56px;
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

        .content {
            padding: 40px 20px;
            background-color: #fff;
        }

        /* About Section baru */
        .about-text {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.8s ease;
        }
        .about-image {
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.8s ease;
        }

        footer {
            background-color: rgb(13, 35, 79);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        footer p {
            margin: 0.2rem 0;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container d-flex align-items-center">
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

<main>
    <div class="image-slider-container" id="imageSlider">
        <img src="{{ asset('img/wikrama1.jpg') }}" alt="Wikrama 1" class="active" />
        <img src="{{ asset('img/foto.jpg') }}" alt="Wikrama 2" />
        <img src="{{ asset('img/wikrama3.jpg') }}" alt="Wikrama 3" />
        <div class="overlay"></div>
        <div class="welcome-text">
            Selamat Datang di Buku Tamu Digital SMK Wikrama 1 Garut
        </div>
    </div>

    <!-- About Section tanpa card, teks kiri & gambar kanan, animasi -->
    <div class="content" id="about">
      <div class="container py-5">
        <div class="row align-items-center justify-content-center gx-5">
          <!-- Teks kiri -->
          <div class="col-lg-6 about-text">
            <h3 class="text-primary fw-bold mb-4">Tentang Buku Tamu Digital</h3>
            <p class="text-secondary" style="line-height: 1.7; font-size: 1.1rem;">
              Buku Tamu Digital ini merupakan sistem yang digunakan oleh SMK Wikrama 1 Garut untuk mendata kunjungan tamu secara efisien dan modern. Melalui sistem ini, setiap tamu yang datang dapat mengisi data diri, keperluan, serta waktu kunjungan dengan cepat dan mudah.
            </p>
            <p class="text-secondary" style="line-height: 1.7; font-size: 1.1rem;">
              Data yang dikumpulkan digunakan untuk keperluan dokumentasi, keamanan, dan peningkatan layanan sekolah terhadap pengunjung. Sistem ini membantu sekolah dalam mencatat semua aktivitas kunjungan dengan lebih rapi dan terstruktur.
            </p>
            <p class="fw-semibold text-dark mt-3" style="font-size: 1.1rem;">
              <span class="text-primary">Silakan login</span> untuk mengisi data kunjungan Anda sebagai tamu.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary mt-3 px-4">Login Sekarang</a>
          </div>
          <!-- Gambar kanan -->
          <div class="col-lg-5 about-image">
            <img src="{{ asset('img/wikrama1.jpg') }}" alt="Buku Tamu Digital" class="img-fluid rounded-4 shadow-lg" style="min-height: 300px; object-fit: cover; width: 100%;">
          </div>
        </div>
      </div>
    </div>
</main>

<footer>
    <h5>Kontak Sekolah</h5>
    <p>Alamat: Jalan Otto Iskandardinata kampung Tanjung, RT.003/RW.013, Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151</p>
    <p>Telepon: <a href="tel:+628112232880">0811-2232-880</a></p>
    <p>Email: <a href="mailto:info@smkwikrama1garut.sch.id">info@smkwikrama1garut.sch.id</a></p>
</footer>

<!-- Bootstrap JS -->
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

    // Animasi fade + slide on scroll untuk About Section
    function animateAboutSection() {
        const aboutText = document.querySelector('.about-text');
        const aboutImage = document.querySelector('.about-image');
        const triggerPoint = window.innerHeight * 0.85;
        const aboutSectionTop = aboutText.getBoundingClientRect().top;

        if (aboutSectionTop < triggerPoint) {
            aboutText.style.opacity = '1';
            aboutText.style.transform = 'translateX(0)';
            aboutImage.style.opacity = '1';
            aboutImage.style.transform = 'translateX(0)';
            window.removeEventListener('scroll', animateAboutSection);
        }
    }

    window.addEventListener('scroll', animateAboutSection);
    window.addEventListener('load', animateAboutSection);
</script>

</body>
</html>
