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
            background: rgba(18, 19, 20, 0.85);
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
            height: 80vh;
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
        @keyframes floatButton {
    0% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
    100% { transform: translateY(0); }
}

.float-animate {
    animation: floatButton 2.5s ease-in-out infinite;
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


<main>
    <div class="image-slider-container" id="imageSlider">
        <img src="{{ asset('img/wikrama1.jpg') }}" alt="Wikrama 1" class="active" />
        <img src="{{ asset('img/foto.jpg') }}" alt="Wikrama 2" />
        <img src="{{ asset('img/wikrama3.jpg') }}" alt="Wikrama 3" />
        <div class="overlay"></div>
        <div class="welcome-text text-center">
            Selamat Datang di Buku Tamu Digital SMK Wikrama 1 Garut
            <br><br>
            <button class="btn btn-warning mt-3 fw-bold float-animate" id="btnMasuk">
                Masuk
            </button>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="popupKonfirmasi" tabindex="-1" aria-labelledby="popupKonfirmasiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-light">
          <div class="modal-header">
            <h5 class="modal-title" id="popupKonfirmasiLabel">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body text-center">
            <p>Apakah Anda sudah pernah datang ke sekolah ini sebelumnya?</p>
            <div class="d-flex justify-content-center gap-3">
              <button class="btn btn-success" id="btnIya" data-bs-dismiss="modal">Iya</button>
              <button class="btn btn-danger" id="btnTidak">Tidak</button>
            </div>
          </div>
        </div>
      </div>
    </div>

{{-- Modal Tambah Data --}}
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-labelledby="modalTambahTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('form.tamu.store') }}" method="POST" class="modal-content shadow border-0">
        @csrf
        <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalTambahTamuLabel"><i class="bi bi-person-plus-fill me-2"></i>Tambah Tamu Baru</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="telepon" class="form-label">No. Telepon</label>
                <input type="tel" name="telepon" class="form-control" pattern="[0-9]*" input-mode="numeric" required>
            </div>
            <div class="col-md-12">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="keperluan" class="form-label">Keperluan</label>
                <input type="text" name="keperluan" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach(['Wali Santri','Tamu Hotel','Orangtua Siswa','Kunjungan Dinas','Calon Siswa','Tokoh Masyarakat','Kunjungan Sekolah'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tanggal_datang" class="form-label">Tanggal & Jam Datang</label>
<input type="datetime-local" name="tanggal_datang" class="form-control" required>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Simpan</button>
        </div>
    </form>
  </div>
</div>

    <!-- About Section -->
    <div class="content" id="about">
      <div class="container py-5">
        <div class="row align-items-center justify-content-center gx-5">
          <div class="col-lg-6 about-text">
            <h3 class="text-primary fw-bold mb-4">Tentang Buku Tamu Digital</h3>
            <p class="text-secondary" style="line-height: 1.7; font-size: 1.1rem;">
              Buku Tamu Digital ini merupakan sistem yang digunakan oleh SMK Wikrama 1 Garut untuk mendata kunjungan tamu secara efisien dan modern.
            </p>
            <p class="text-secondary" style="line-height: 1.7; font-size: 1.1rem;">
              Data yang dikumpulkan digunakan untuk dokumentasi, keamanan, dan peningkatan layanan terhadap pengunjung.
            </p>
          </div>
          <div class="col-lg-5 about-image">
            <img src="{{ asset('img/wikrama1.jpg') }}" alt="Buku Tamu Digital" class="img-fluid rounded-4 shadow-lg" style="min-height: 300px; object-fit: cover; width: 100%;">
          </div>
        </div>
      </div>
    </div>
</main>
  {{-- Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                position: 'center',
                toast: false,
                customClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });
        });
    </script>
    @endif
<footer>
    <h5>Kontak Sekolah</h5>
    <p>Alamat: Jalan Otto Iskandardinata kampung Tanjung, RT.003/RW.013, Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151</p>
    <p>Telepon: <a href="tel:+628112232880">0811-2232-880</a></p>
    <p>Email: <a href="mailto:info@smkwikrama1garut.sch.id">info@smkwikrama1garut.sch.id</a></p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Slider berganti otomatis
    const slider = document.getElementById('imageSlider');
    const slides = slider.querySelectorAll('img');
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(showNextSlide, 5000);

    // Scroll animation untuk About Section
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

    // Pop-up logika
    document.getElementById('btnMasuk').addEventListener('click', () => {
        const popup = new bootstrap.Modal(document.getElementById('popupKonfirmasi'));
        popup.show();
    });

  document.getElementById('btnTidak').addEventListener('click', () => {
    const popup = bootstrap.Modal.getInstance(document.getElementById('popupKonfirmasi'));
    popup.hide();

    // Tampilkan modal tambah tamu setelah popup konfirmasi ditutup
    setTimeout(() => {
        const modalTambah = new bootstrap.Modal(document.getElementById('modalTambahTamu'));
        modalTambah.show();
    }, 400); // beri jeda sedikit agar modal sebelumnya sempat hilang
});


    document.getElementById('btnIya').addEventListener('click', () => {
        alert("Silakan login dari menu 'Masuk' di atas.");
    });
</script>

</body>
</html>
