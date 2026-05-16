<?php
include '../../include/koneksi.php';

// Mengambil data user untuk pilihan dropdown Pelapor
$query_users = mysqli_query($conn, "SELECT * FROM users ORDER BY nama ASC");

if(isset($_POST['submit'])){
    $id_user = $_POST['id_user'];
    $isi_laporan = $_POST['isi_laporan'];
    $status_laporan = $_POST['Status_laporan'];
    
    // Default id_absensi agar tidak melanggar constraint database (sesuai tipe int)
    $id_absensi = 1; 

    // INSERT data ke tabel laporan sesuai struktur database asli Anda
    $query_insert = mysqli_query($conn, "
        INSERT INTO laporan (id_user, isi_laporan, id_absensi, Status_laporan) 
        VALUES ('$id_user', '$isi_laporan', '$id_absensi', '$status_laporan')
    ");

    if($query_insert) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan laporan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Laporan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="form-container">
    <h1>Tambah Laporan</h1>

    <form method="POST">
        <select name="id_user" required>
            <option value="">-- Pilih Nama Pelapor --</option>
            <?php while($user = mysqli_fetch_assoc($query_users)) { ?>
                <option value="<?= $user['user_id']; ?>"><?= htmlspecialchars($user['nama']); ?></option>
            <?php } ?>
        </select>

        <textarea name="isi_laporan" placeholder="Isi laporan / catatan" required></textarea>

        <select name="Status_laporan" required>
            <option value="wait">WAIT</option>
            <option value="acc">ACC</option>
            <option value="reject">REJECT</option>
        </select>

        <button type="submit" name="submit">Simpan</button>
    </form>
</div>

</body>
</html>