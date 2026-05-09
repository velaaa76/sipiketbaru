<?php
session_start();
include 'include/koneksi.php';

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['user'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");

    if (mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['nama'];

        header("Location: dashboard.php");
        exit;
    }

    echo "<script>alert('Login gagal');</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SiPiket</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/loginbaru.css">

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- BACKGROUND -->
    <div class="bg-circle circle1"></div>
    <div class="bg-circle circle2"></div>

    <!-- LOGIN BOX -->
    <div class="login-container">

        <!-- LEFT -->
        <div class="login-left">

            <div class="logo">

                <i class="fa-solid fa-shield-heart"></i>

                <h1>Si<span>Piket</span></h1>

            </div>

            <h2>
                Sistem Piket Modern Untuk Sekolah
            </h2>

            <p>
                Kelola jadwal piket, tugas harian,
                dan laporan kelas dengan lebih mudah,
                cepat, dan terstruktur.
            </p>

        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <form action="" method="POST">

                <h2>Login</h2>

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

                    Login

                </button>

                <!-- REGISTER -->
                <p class="bottom-text">

                    Belum punya akun?
                    <a href="registerbaru.php">Daftar</a>

                </p>

            </form>

        </div>

    </div>

</body>
</html>