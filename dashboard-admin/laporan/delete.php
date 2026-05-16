<?php
include '../../include/koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM laporan WHERE id_laporan = '$id'");
}

header("Location: index.php");
exit;
?>