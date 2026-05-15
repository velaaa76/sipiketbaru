<?php
include 'include/koneksi.php';

if(isset($_POST['register'])) {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = "admin";

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
    <title>Register SiPiket</title>

    <link rel="stylesheet" href="css/registrasi.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="container">

    <div class="left">

        <div class="content">
            <h1>Gabung SiPiket</h1>

            <p>
                Jadikan piket kelas lebih modern, terstruktur,
                dan menyenangkan bersama SiPiket Smart.
            </p>

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
        </div>

    </div>

    <div class="right">

        <form action="" method="POST" class="form-box">

            <h2>Register</h2>
            <span>Buat akun baru 🚀</span>

            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="register">Daftar</button>

            <p class="bottom-text">
                Sudah punya akun?
                <a href="login.php">Login</a>
            </p>

        </form>

    </div>

</div>

</body>
</html>