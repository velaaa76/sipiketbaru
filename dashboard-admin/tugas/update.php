<?php
include '../../include/koneksi.php';

$id = $_GET['id'];

// Mengambil data tugas lama
$data = mysqli_query($conn, "SELECT * FROM tugas WHERE id_tugas='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])){
    $nama_tugas = $_POST['nama_tugas'];
    $status = $_POST['status'];
    $id_user = $_POST['id_user'];

    // SINKRONISASI: Query update berdasarkan struktur tabel tugas asli
    $query_update = mysqli_query($conn, "
        UPDATE tugas 
        SET nama_tugas='$nama_tugas', status='$status', id_user='$id_user' 
        WHERE id_tugas='$id'
    ");
    
    if($query_update) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui tugas: " . mysqli_error($conn) . "');</script>";
    }
}

// Mengambil data anggota untuk dropdown
$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas - SiPiket Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo"><i class="fa-solid fa-shield-heart"></i> SiPiket</div>
        <ul class="sidebar-menu">
            <li><a href="../index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="../jadwal/index.php"><i class="fa-regular fa-calendar-check"></i> Jadwal Piket</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Data Users</a></li>
            <li><a href="../absensi/index.php"><i class="fa-solid fa-clipboard-user"></i> Data Absensi</a></li>
            <li><a href="index.php" class="active"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="../laporan/index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="index.php" style="text-decoration: none; color: var(--maroon-vibrant); font-weight: 600; display: inline-block; margin-bottom: 20px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>

        <div class="form-section" style="max-width: 600px; margin: 0 auto;">
            <div class="header" style="margin-bottom: 25px;">
                <h1 style="font-weight: 700; font-size: 24px; color: var(--text-main);">Edit Data Tugas</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Perbarui deskripsi area kerja atau status kebersihan piket.</p>
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>Nama / Area Tugas</label>
                    <input type="text" name="nama_tugas" class="form-control" value="<?= htmlspecialchars($d['nama_tugas']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Penanggung Jawab (Anggota)</label>
                    <select name="id_user" class="form-control" required>
                        <?php while($row = mysqli_fetch_assoc($users)): ?>
                            <option value="<?= $row['user_id'] ?>" <?= ($row['user_id'] == $d['id_user']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['nama']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status Kondisi</label>
                    <select name="status" class="form-control" required>
                        <option value="kotor" <?= ($d['status'] == 'kotor') ? 'selected' : '' ?>>Kotor</option>
                        <option value="masih kotor" <?= ($d['status'] == 'masih kotor') ? 'selected' : '' ?>>Masih Kotor</option>
                        <option value="bersih" <?= ($d['status'] == 'bersih') ? 'selected' : '' ?>>Bersih</option>
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