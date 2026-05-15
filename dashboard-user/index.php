<?php
session_start();
include '../include/koneksi.php';

// cek login & role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$initials = strtoupper(substr($username, 0, 1));

// 1. Total Tugas
$query_total_tugas = mysqli_query($conn, "SELECT COUNT(*) as total FROM tugas_users WHERE id_user = '$user_id'");
$total_tugas = mysqli_fetch_assoc($query_total_tugas)['total'] ?? 0;

// 2. Tugas Selesai
$query_tugas_selesai = mysqli_query($conn, "SELECT COUNT(*) as total FROM tugas_users WHERE id_user = '$user_id' AND LOWER(status) = 'selesai'");
$tugas_selesai = mysqli_fetch_assoc($query_tugas_selesai)['total'] ?? 0;

// 3. Petugas Hari Ini (Semua user yang jadwalnya hari ini)
$query_petugas = mysqli_query($conn, "
    SELECT users.nama 
    FROM jadwal 
    JOIN users ON jadwal.id_user = users.user_id 
    WHERE DATE(jadwal.tanggal_dan_waktu) = CURDATE()
");
$petugas_hari_ini = [];
while ($row = mysqli_fetch_assoc($query_petugas)) {
    $petugas_hari_ini[] = $row['nama'];
}
$jumlah_petugas = count($petugas_hari_ini);

// 4. Hitung Progress
$progress_percentage = ($total_tugas > 0) ? round(($tugas_selesai / $total_tugas) * 100) : 0;

// Hari Ini
$hari_ini_indo = date('l');
$hari_terjemahan = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
];
$nama_hari_ini = $hari_terjemahan[$hari_ini_indo];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SiPiket</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="sidebar">

    <div>
        <div class="logo">
            <h1>SiPiket</h1>
        </div>

        <ul class="menu">
            <a href="index.php" style="text-decoration: none; color: inherit;">
                <li class="active"><i class="fa-solid fa-house"></i> Dashboard</li>
            </a>
            <a href="jadwal.php" style="text-decoration: none; color: inherit;">
                <li><i class="fa-solid fa-calendar"></i> Jadwal Piket</li>
            </a>
            <a href="#" style="text-decoration: none; color: inherit;">
                <li><i class="fa-solid fa-list-check"></i> Tugas</li>
            </a>
            <a href="#" style="text-decoration: none; color: inherit;">
                <li><i class="fa-solid fa-user"></i> Profile</li>
            </a>
        </ul>
    </div>

    <div class="logout">
        <a href="../login.php" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

</div>

<div class="main">
    <div class="topbar">
        <div>
            <h1>Halo, <?php echo htmlspecialchars($username); ?> 👋</h1>
            <p>Semangat menjaga kebersihan kelas hari ini!</p>
        </div>

        <div class="profile">
            <?php echo $initials; ?>
        </div>
    </div>

    <div class="hero">
        <div class="hero-text">
            <h2>Misi Kebersihan Menantimu!</h2>
            <p>Kerjakan tugas piketmu dan bantu kelas tetap bersih serta nyaman.</p>
            <button>Mulai Tugas Hari Ini</button>
        </div>

        <img src="https://cdn-icons-png.flaticon.com/512/3588/3588658.png" alt="cleaning">
    </div>

    <div class="cards">

        <div class="card red">
            <i class="fa-solid fa-list-check"></i>
            <h3>Total Tugas</h3>
            <span><?php echo $total_tugas; ?></span>
        </div>
        <div class="card blue">
            <i class="fa-solid fa-circle-check"></i>
            <h3>Tugas Selesai</h3>
            <span><?php echo $tugas_selesai; ?></span>
        </div>

        <div class="card orange">
            <i class="fa-solid fa-users"></i>
            <h3>Petugas Hari Ini</h3>
            <span><?php echo $jumlah_petugas; ?> Orang</span>
        </div>

    </div>

    <div class="bottom">

        <div class="jadwal">
            <div class="title">
                <h2>Petugas Piket <?php echo $nama_hari_ini; ?></h2>
                <p style="color: gray; margin-top: -15px; margin-bottom: 20px;">Hari Ini</p>
            </div>

            <div class="anggota">
                <?php
                if ($jumlah_petugas > 0) {
                    foreach ($petugas_hari_ini as $petugas) {
                        echo '<div class="nama">' . htmlspecialchars($petugas) . '</div>';
                    }
                } else {
                    echo '<div class="nama" style="color: gray;">Tidak ada petugas hari ini</div>';
                }
                ?>
            </div>
        </div>

        <div class="progress-box">
            <h2>Progress Kebersihan</h2>

            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $progress_percentage; ?>%;"></div>
            </div>

            <p><?php echo $progress_percentage; ?>% tugas sudah selesai</p>
        </div>

    </div>

</div>

</body>
</html>