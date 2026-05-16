<?php
include '../../include/koneksi.php';

// Mengambil data jadwal piket beserta nama user dan hari
// Silakan sesuaikan nama kolom jika di database Anda berbeda
$query_jadwal = mysqli_query($conn, "
    SELECT jadwal.*, users.nama 
    FROM jadwal 
    JOIN users ON jadwal.id_user = users.user_id 
    ORDER BY FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket - SiPiket Admin</title>
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
            <li><a href="../tugas/index.php"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="../laporan/index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-weight: 700; font-size: 26px; color: var(--text-main);">Jadwal Piket Anggota</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Atur dan pantau pembagian hari piket seluruh anggota.</p>
            </div>
            <a href="create.php" class="btn-main">
                <i class="fa-solid fa-plus"></i> Tambah Jadwal
            </a>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID Jadwal</th>
                        <th>Nama Anggota</th>
                        <th>Hari Piket</th>
                        <th>ID Tugas</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_jadwal)) {
                        echo "<tr>";
                        echo "<td style='color: var(--text-muted); font-weight: 500;'>#" . htmlspecialchars($row['id_jadwal']) . "</td>";
                        echo "<td><strong style='color: var(--text-main);'>" . htmlspecialchars($row['nama']) . "</strong></td>";
                        
                        // Menampilkan Hari dengan styling teks yang rapi
                        echo "<td><span style='font-weight: 500; color: var(--maroon-vibrant);'><i class='fa-regular fa-clock' style='margin-right: 5px; font-size: 13px;'></i> " . htmlspecialchars($row['hari']) . "</span></td>";
                        
                        // Tombol Aksi Edit & Hapus (.btn-action dari CSS Master Anda)
                        echo "<td style='text-align: center;'>";
                        echo "<a href='update.php?id=" . $row['id_jadwal'] . "' class='btn-action btn-edit' title='Edit Jadwal'><i class='fa-solid fa-pen-to-square'></i></a>";
                        echo "<a href='delete.php?id=" . $row['id_jadwal'] . "' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus jadwal piket untuk anggota ini?\")' title='Hapus Jadwal'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_jadwal) == 0) {
                        echo "<tr><td colspan='5' style='text-align:center; color: var(--text-muted); padding: 20px;'>Belum ada data jadwal piket</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>