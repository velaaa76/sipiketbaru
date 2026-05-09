<?php
session_start();
include '../include/koneksi.php';

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];

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
    <link rel="stylesheet" href="../css/login.css">

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
    <div class="blur blur1"></div>
    <div class="blur blur2"></div>

    <!-- LOGIN CARD -->
    <div class="login-card">

        <!-- LOGO -->
        <div class="logo">

            <i class="fa-solid fa-shield-heart"></i>

            <h1>Si<span>Piket</span></h1>

        </div>

        <!-- TITLE -->
        <h2>Selamat Datang</h2>

        <p class="subtitle">
            Login untuk melanjutkan ke sistem SiPiket
        </p>

        <!-- FORM -->
        <form action="" method="POST">

            <!-- EMAIL -->
            <div class="input-box">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    required
                >

            </div>

            <!-- PASSWORD -->
            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <!-- BUTTON -->
            <button type="submit">

                Login

            </button>

        </form>

        <!-- REGISTER -->
        <p class="bottom">

            Belum punya akun?
            <a href="register.php">Daftar</a>

        </p>

    </div>

</body>
</html>