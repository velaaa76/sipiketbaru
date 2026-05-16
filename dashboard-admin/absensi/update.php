<?php
include '../../include/koneksi.php';

$id = $_GET['id'];
$query_data = mysqli_query($conn, "SELECT * FROM absensi WHERE id_absensi = '$id'");
$data = mysqli_fetch_assoc($query_data);

if(isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $tanggal_dan_waktu = $_POST['tanggal_dan_waktu'];
    $status_absensi = $_POST['status_absensi'];

    $query = mysqli_query($conn, "UPDATE absensi SET id_user='$id_user', tanggal_dan_waktu='$tanggal_dan_waktu', status_absensi='$status_absensi' WHERE id_absensi='$id'");
    
    if($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}

$users = mysqli_query($conn, "SELECT * FROM users");
// Format datetime-local membutuhkan format YYYY-MM-DDThh:mm
$formatted_datetime = date('Y-m-d\\TH:i', strtotime($data['tanggal_dan_waktu']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi - SiPiket Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fa-solid fa-shield-heart"></i>
            SiPiket
        </div>
        <ul class="sidebar-menu">
            <li><a href="../index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="../jadwal/index.php"><i class="fa-regular fa-calendar-check"></i> Jadwal Piket</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Data Users</a></li>
            <li><a href="index.php" class="active"><i class="fa-solid fa-clipboard-user"></i> Data Absensi</a></li>
            <li><a href="#"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="index.php" style="text-decoration: none; color: var(--maroon-vibrant); font-weight: 600; display: inline-block; margin-bottom: 20px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>

        <div class="form-section" style="max-width: 600px; margin: 0 auto;">
            <div class="header" style="margin-bottom: 25px;">
                <h1 style="font-weight: 700; font-size: 24px; color: var(--text-main);">Edit Data Absensi</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Perbarui data kehadiran atau status anggota piket yang dipilih.</p>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Pilih Anggota Piket</label>
                    <select name="id_user" class="form-control" required>
                        <?php while($row = mysqli_fetch_assoc($users)): ?>
                            <option value="<?= $row['user_id'] ?>" <?= ($row['user_id'] == $data['id_user']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['nama']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal & Waktu</label>
                    <input type="datetime-local" name="tanggal_dan_waktu" class="form-control" value="<?= $formatted_datetime ?>" required>
                </div>

                <div class="form-group">
                    <label>Status Absensi</label>
                    <?php $status_db = strtolower($data['status_absensi'] ?? $data['Status_absensi'] ?? ''); ?>
                    <select name="status_absensi" class="form-control" required>
                        <option value="hadir" <?= ($status_db == 'hadir') ? 'selected' : '' ?>>Hadir</option>
                        <option value="izin" <?= ($status_db == 'izin') ? 'selected' : '' ?>>Izin</option>
                        <option value="absen" <?= ($status_db == 'absen') ? 'selected' : '' ?>>Absen</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn-main" style="width: 100%; margin-top: 10px;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

</body>
</html>