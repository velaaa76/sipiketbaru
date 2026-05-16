<?php
include '../include/koneksi.php';

// Mengambil data ringkasan dari database
$query_users = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$total_users = mysqli_fetch_assoc($query_users)['total'] ?? 0;

$query_jadwal = mysqli_query($conn, "SELECT COUNT(*) as total FROM jadwal");
$total_jadwal = mysqli_fetch_assoc($query_jadwal)['total'] ?? 0;

$query_absensi = mysqli_query($conn, "SELECT COUNT(*) as total FROM absensi");
$total_absensi = mysqli_fetch_assoc($query_absensi)['total'] ?? 0;

$query_laporan = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan");
$total_laporan = mysqli_fetch_assoc($query_laporan)['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SiPiket</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fa-solid fa-shield-heart"></i>
            SiPiket
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="jadwal/index.php"><i class="fa-regular fa-calendar-check"></i> Jadwal Piket</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Data Users</a></li>
            <li><a href="absensi/index.php"><i class="fa-solid fa-clipboard-user"></i> Data Absensi</a></li>
            <li><a href="tugas/index.php"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="laporan/index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1 style="font-weight: 700; font-size: 26px;">Dashboard Overview</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Selamat datang kembali di panel kendali sistem.</p>
            </div>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span style="font-weight: 500; font-size: 14px;">Admin</span>
                <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: var(--text-muted); margin-left: 5px;"></i>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-info">
                    <div class="stat-title">Total Users</div>
                    <div class="stat-value"><?= $total_users; ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="stat-info">
                    <div class="stat-title">Total Jadwal</div>
                    <div class="stat-value"><?= $total_jadwal; ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-clipboard-user"></i></div>
                <div class="stat-info">
                    <div class="stat-title">Total Absensi</div>
                    <div class="stat-value"><?= $total_absensi; ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-file-lines"></i></div>
                <div class="stat-info">
                    <div class="stat-title">Total Laporan</div>
                    <div class="stat-value"><?= $total_laporan; ?></div>
                </div>
            </div>
        </div>

        <div class="table-section">
            <div style="margin-bottom: 15px;">
                <h2 style="font-size: 18px; font-weight: 700;">User Terbaru</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Info User</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_recent_users = mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 5");
                    
                    if (!$query_recent_users) {
                        $query_recent_users = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC LIMIT 5");
                    }

                    while($row = mysqli_fetch_assoc($query_recent_users)) {
                        $nama = htmlspecialchars($row['nama']);
                        $initials = strtoupper(substr($nama, 0, 1));
                        
                        $display_id = $row['id_user'] ?? $row['user_id'] ?? 0;
                        
                        echo "<tr>";
                        echo "<td style='color: var(--text-muted); font-weight: 500;'>#" . htmlspecialchars($display_id) . "</td>";
                        echo "<td>
                                <div class='user-info'>
                                    <div class='user-icon'>$initials</div>
                                    <span style='font-weight: 600; color: var(--text-main);'>$nama</span>
                                </div>
                            </td>";
                        echo "<td style='color: var(--text-main);'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td><span class='badge badge-hadir'>Aktif</span></td>";
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_recent_users) == 0) {
                        echo "<tr><td colspan='4' style='text-align:center; color: var(--text-muted);'>Belum ada data user</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>