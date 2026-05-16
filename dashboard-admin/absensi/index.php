<?php
include '../../include/koneksi.php';

// Mengambil data absensi beserta nama user
$query_absensi = mysqli_query($conn, "
    SELECT absensi.*, users.nama 
    FROM absensi 
    JOIN users ON absensi.id_user = users.user_id 
    ORDER BY absensi.tanggal_dan_waktu DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi - SiPiket Admin</title>
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
            <li><a href="../tugas/index.php"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="../laporan/index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-weight: 700; font-size: 26px; color: var(--text-main);">Data Absensi Piket</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Kelola seluruh riwayat kehadiran anggota piket di sini.</p>
            </div>
            <a href="create.php" class="btn-main">
                <i class="fa-solid fa-plus"></i> Tambah Absensi
            </a>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID Absensi</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_absensi)) {
                        echo "<tr>";
                        echo "<td style='color: var(--text-muted); font-weight: 500;'>#" . htmlspecialchars($row['id_absensi']) . "</td>";
                        echo "<td><strong style='color: var(--text-main);'>" . htmlspecialchars($row['nama']) . "</strong></td>";
                        echo "<td style='color: var(--text-main);'>" . date('d M Y - H:i', strtotime($row['tanggal_dan_waktu'])) . "</td>";
                        
                        // Menentukan class badge berdasarkan status di database
                        $status = htmlspecialchars($row['status_absensi'] ?? $row['Status_absensi']);
                        $badge_class = 'badge';
                        if(strtolower($status) == 'hadir') {
                            $badge_class .= ' badge-hadir';
                        } elseif(strtolower($status) == 'izin') {
                            $badge_class .= ' badge-izin';
                        } else {
                            $badge_class .= ' badge-sakit'; // Menggunakan badge-sakit bawaan CSS Anda untuk status absen
                        }
                        
                        echo "<td><span class='$badge_class'>" . ucfirst($status) . "</span></td>";
                        
                        // Tombol Aksi Edit & Hapus (.btn-action dari CSS Master Anda)
                        echo "<td style='text-align: center;'>";
                        echo "<a href='update.php?id=" . $row['id_absensi'] . "' class='btn-action btn-edit' title='Edit Data'><i class='fa-solid fa-pen-to-square'></i></a>";
                        echo "<a href='delete.php?id=" . $row['id_absensi'] . "' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus data absensi ini?\")' title='Hapus Data'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_absensi) == 0) {
                        echo "<tr><td colspan='5' style='text-align:center; color: var(--text-muted); padding: 20px;'>Belum ada data absensi</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>