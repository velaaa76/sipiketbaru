<?php
include '../../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM absensi WHERE id_absensi = '$id'");
}

header("Location: index.php");
exit;
?>
