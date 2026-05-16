<?php
include '../../include/koneksi.php';

if(isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $hari = $_POST['hari'];

    // Menjalankan query insert ke tabel jadwal
    $query = mysqli_query($conn, "INSERT INTO jadwal (id_user, hari) VALUES ('$id_user', '$hari')");
    
    if($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal menambah data jadwal!');</script>";
    }
}

// Mengambil data user untuk dropdown select nama anggota
$users = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal - SiPiket Admin</title>
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
            <li><a href="index.php" class="active"><i class="fa-regular fa-calendar-check"></i> Jadwal Piket</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Data Users</a></li>
            <li><a href="../absensi/index.php"><i class="fa-solid fa-clipboard-user"></i> Data Absensi</a></li>
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
                <h1 style="font-weight: 700; font-size: 24px; color: var(--text-main);">Tambah Jadwal Piket</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Tentukan hari piket untuk anggota yang dipilih.</p>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Pilih Anggota Piket</label>
                    <select name="id_user" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php while($row = mysqli_fetch_assoc($users)): ?>
                            <option value="<?= $row['user_id'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Hari Piket</label>
                    <select name="hari" class="form-control" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn-main" style="width: 100%; margin-top: 10px;">
                    <i class="fa-solid fa-plus"></i> Simpan Jadwal Piket
                </button>
            </form>
        </div>
    </div>

</body>
</html>