<?php
include '../../include/koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id'");
}

header("Location: index.php");
exit;
?>
