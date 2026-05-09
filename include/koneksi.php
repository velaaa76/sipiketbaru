<?php
$host = "localhost";
$user = "root"; // username database Anda
$pass = ""; // password database Anda
$db = "sipiket"; // nama database Anda
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi database gagal: " .
mysqli_connect_error());
}
?>

