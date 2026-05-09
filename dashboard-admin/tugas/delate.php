<?php
include '../../koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM tugas WHERE id_tugas = '$id'");
}
header("Location: index.php");
exit;
?>
