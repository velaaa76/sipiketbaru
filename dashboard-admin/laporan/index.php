<?php
include '../../include/koneksi.php';

// PERBAIKAN QUERY: Menghubungkan tabel laporan ke tabel users menggunakan kolom 'user_id' yang benar
$query_laporan = mysqli_query($conn, "
    SELECT laporan.*, users.nama 
    FROM laporan 
    LEFT JOIN users ON laporan.id_user = users.user_id
    ORDER BY laporan.id_laporan DESC
");

if (!$query_laporan) {
    die("Error Query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan - SiPiket Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-acc { background-color: #d1e7dd; color: #0f5132; }
        .status-wait { background-color: #fff3cd; color: #664d03; }
        .status-reject { background-color: #f8d7da; color: #842029; }
    </style>
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
            <li><a href="../absensi/index.php"><i class="fa-solid fa-clipboard-user"></i> Data Absensi</a></li>
            <li><a href="../tugas/index.php"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-weight: 700; font-size: 26px; color: var(--text-main);">Laporan Kegiatan Piket</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Pantau dan kelola seluruh catatan laporan situasi dari anggota piket.</p>
            </div>
            <a href="create.php" class="btn-main">
                <i class="fa-solid fa-plus"></i> Buat Laporan
            </a>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID LAPORAN</th>
                        <th>NAMA PELAPOR</th>
                        <th>ISI LAPORAN / CATATAN</th>
                        <th>STATUS</th> <th>TANGGAL KEJADIAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_laporan)) {
                        echo "<tr>";
                        echo "<td style='color: var(--text-muted); font-weight: 500;'>#" . htmlspecialchars($row['id_laporan']) . "</td>";
                        echo "<td><strong style='color: var(--text-main);'>" . htmlspecialchars($row['nama'] ?? 'Budi') . "</strong></td>";
                        echo "<td>" . htmlspecialchars($row['isi_laporan']) . "</td>";
                        
                        // Membaca Nilai Enum 'Status_laporan' dari Database Anda
                        $status = $row['Status_laporan'] ?? 'wait';
                        $badge_class = 'status-wait';
                        
                        if ($status == 'acc') {
                            $badge_class = 'status-acc';
                        } elseif ($status == 'reject') {
                            $badge_class = 'status-reject';
                        }
                        
                        // Menampilkan Badge Enum
                        echo "<td><span class='badge-status " . $badge_class . "'>" . htmlspecialchars($status) . "</span></td>";
                        
                        // Menampilkan Tanggal Kejadian sesuai kolom database asli Anda
                        echo "<td style='color: var(--text-muted);'>" . date('d M Y', strtotime($row['tanggal_dan_waktu'])) . "</td>";
                        
                        echo "<td>";
                        echo "<a href='update.php?id=" . $row['id_laporan'] . "' class='btn-action btn-edit'><i class='fa-solid fa-pen-to-square'></i></a> ";
                        echo "<a href='delete.php?id=" . $row['id_laporan'] . "' class='btn-action btn-delete' onclick='return confirm(\"Hapus laporan?\")'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_laporan) == 0) {
                        echo "<tr><td colspan='6' style='text-align:center; color: var(--text-muted); padding: 20px;'>Belum ada catatan laporan piket</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>