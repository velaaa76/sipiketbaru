<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/landing.css">
    <title>SiPiket</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- BACKGROUND -->
    <div class="bg-circle circle1"></div>
    <div class="bg-circle circle2"></div>
    <div class="bg-circle circle3"></div>

    <!-- NAVBAR -->
    <header class="navbar">

        <div class="logo">
            Si<span>Piket</span>
        </div>

        <nav class="nav-links">
            <a href="#home">Home</a>
            <a href="#fitur">Fitur</a>
            <a href="#developer">Developer</a>
            <a href="loginbaru.php" class="login-btn">
                Login
            </a>
        </nav>

    </header>

    <!-- HERO -->
    <section class="hero" id="home">

        <div class="hero-left">

            <h1>
                Piket Sekolah
                Kini Lebih
                <span>Mudah & Modern</span>
            </h1>

            <p>
                SiPiket membantu siswa dan wali kelas mengatur kegiatan
                piket menjadi lebih disiplin, terstruktur, modern,
                dan efisien dalam satu platform digital.
            </p>

            <div class="hero-button">

                <a href="user/loginbaru.php" class="btn-primary">
                    Mulai Sekarang
                </a>

                <a href="#fitur" class="btn-secondary">
                    Lihat Fitur
                </a>

            </div>

            <div class="hero-info">
            </div>

        </div>

        <div class="hero-right">

            <div class="dashboard-card">

                <div class="top-card">

                    <div class="top-circle red"></div>
                    <div class="top-circle yellow"></div>
                    <div class="top-circle green"></div>

                </div>

                <img src="img/dashboard.png">

            </div>

        </div>

    </section>

    <!-- FEATURES -->
    <section class="features" id="fitur">

        <div class="section-title">

            <span>FITUR UNGGULAN</span>

            <h2>
                Semua Yang Dibutuhkan
                Dalam Kegiatan Piket
            </h2>

        </div>

        <div class="feature-grid">

            <!-- CARD -->
            <div class="card">
                <div class="icon-box">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <h3>Jadwal Piket</h3>
                <p>
                    Atur jadwal piket otomatis dengan sistem yang lebih tertata.
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <div class="icon-box">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3>Tugas Harian</h3>
                <p>
                    Checklist tugas harian agar semua pekerjaan terselesaikan.
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <div class="icon-box">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <h3>Absensi </h3>
                <p>
                    Sistem absensi modern menggunakan bukti foto kegiatan.
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <div class="icon-box">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <h3>Laporan</h3>
                <p>
                    Pantau laporan kegiatan piket dengan cepat dan mudah.
                </p>
            </div>
        </div>

    </section>

    <!-- ABOUT -->
    <section class="about" id="developer">

        <div class="about-container">

            <div class="about-image">
                <img src="img/foto-sipiket.jpeg">
            </div>

            <div class="about-text">
                <span>DEVELOPER</span>
                <h2>
                    Dibuat Untuk Membantu
                    Kegiatan Piket Sekolah
                </h2>
                <p>
                    SiPiket dikembangkan untuk membantu siswa dan wali kelas
                    dalam mengelola kegiatan piket dengan lebih disiplin,
                    efisien, modern, dan mudah dipantau.
                </p>
                <div class="developer-box">
                    <h3>Bilqis Sheliem Novela</h3>
                    <p>XSIJA2 • Developer SiPiket</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <h2>SiPiket</h2>
        <p>
            Solusi modern untuk kegiatan piket sekolah.
        </p>
        <div class="line"></div>
        <span>
            © 2026 SiPiket • All Rights Reserved
        </span>
    </footer>

</body>

</html>