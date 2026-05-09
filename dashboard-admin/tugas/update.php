<?php
include '../../include/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM tugas WHERE id_tugas='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])){
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    mysqli_query($conn,"UPDATE tugas SET judul='$judul',deskripsi='$deskripsi' WHERE id_tugas='$id'");
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>

    <link rel="stylesheet" href="../../css/tugasadmin.css">
</head>

<body>
<div class="form-container">

    <h1>Edit Tugas</h1>

    <form method="POST">

        <input
        type="text"
        name="judul"
        value="<?= $d['judul'] ?>"
        required>

        <textarea
        name="deskripsi"
        required><?= $d['deskripsi'] ?></textarea>

        <button
        type="submit"
        name="submit">

        Update

        </button>

    </form>

</div>

</body>
</html>