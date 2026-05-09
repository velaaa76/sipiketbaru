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
