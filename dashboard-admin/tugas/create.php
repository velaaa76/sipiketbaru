<?php
include '../../include/koneksi.php';

if(isset($_POST['submit'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"
    INSERT INTO tugas
    VALUES('','$judul','$deskripsi')
    ");

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>

    <link rel="stylesheet" href="../../css/tugas.css">
</head>

<body>

<div class="form-container">

    <h1>Tambah Tugas</h1>

    <form method="POST">

        <input
        type="text"
        name="judul"
        placeholder="Judul tugas"
        required>

        <textarea
        name="deskripsi"
        placeholder="Deskripsi tugas"
        required></textarea>

        <button
        type="submit"
        name="submit">

        Simpan

        </button>

    </form>

</div>

</body>
</html>