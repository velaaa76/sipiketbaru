<?php
include 'include/koneksi.php';

if(isset($_POST['register'])) {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = "user";

    // cek email sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        $query = mysqli_query($conn, "INSERT INTO users (nama, email, password, role)
        VALUES ('$nama','$email','$password','$role')");

        if($query){
            echo "<script>
                alert('Registrasi berhasil!');
                window.location='login.php';
            </script>";
        } else {
            echo "<script>alert('Registrasi gagal');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | SiPiket</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/registerbaru.css">

    <!-- GOOGLE FONT -->
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
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>

    <!-- CONTAINER -->
    <div class="container">

        <!-- LEFT -->
        <div class="left">

            <div class="overlay"></div>

            <div class="content">

                <div class="logo">

                    <i class="fa-solid fa-shield-heart"></i>

                    <h1>Si<span>Piket</span></h1>

                </div>

                <h2>
                    Mulai Kelola Piket Dengan Lebih Modern
                </h2>

                <p>
                    Daftarkan akun baru dan nikmati sistem
                    piket sekolah yang lebih rapi, efisien,
                    dan mudah digunakan.
                </p>

                <div class="info-box">

                    <div class="box">

                        <h3>120+</h3>
                        <span>Siswa Aktif</span>

                    </div>

                    <div class="box">

                        <h3>24/7</h3>
                        <span>Akses Sistem</span>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="right">

            <form action="" method="POST">

                <h2>Register</h2>

                <!-- NAMA -->
                <div class="input-group">

                    <label>Nama Lengkap</label>

                    <div class="input-box">

                        <i class="fa-solid fa-user"></i>

                        <input
                            type="text"
                            name="nama"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                    </div>

                </div>

                <!-- EMAIL -->
                <div class="input-group">

                    <label>Email</label>

                    <div class="input-box">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="input-group">

                    <label>Password</label>

                    <div class="input-box">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                    </div>

                </div>

                <!-- BUTTON -->
                <button type="submit">

                    Daftar Sekarang

                </button>

                <!-- LOGIN -->
                <p class="bottom-text">

                    Sudah punya akun?
                    <a href="loginbaru.php">Login</a>

                </p>

            </form>

        </div>

    </div>

</body>
</html>