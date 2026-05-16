<?php
include '../../include/koneksi.php';

// PERBAIKAN QUERY: Melakukan JOIN antara tabel tugas dan users untuk mendapatkan nama anggota
$query_tugas = mysqli_query($conn, "
    SELECT tugas.*, users.nama 
    FROM tugas 
    LEFT JOIN users ON tugas.id_user = users.user_id 
    ORDER BY tugas.id_tugas DESC
");

if (!$query_tugas) {
    die("Error Database: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Piket - SiPiket Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
        }
        .badge-bersih {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .badge-masih-kotor {
            background-color: #fff3cd;
            color: #664d03;
        }
        .badge-kotor {
            background-color: #f8d7da;
            color: #842029;
        }
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
            <li><a href="index.php" class="active"><i class="fa-solid fa-tasks"></i> Data Tugas</a></li>
            <li><a href="../laporan/index.php"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-weight: 700; font-size: 26px; color: var(--text-main);">Daftar Tugas Piket</h1>
                <p style="color: var(--text-muted); font-size: 14px;">Pantau area kerja dan status kondisi kebersihan yang ditangani anggota.</p>
            </div>
            <a href="create.php" class="btn-main">
                <i class="fa-solid fa-plus"></i> Tambah Tugas
            </a>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th style="width: 100px;">ID Tugas</th>
                        <th>Nama / Area Tugas</th>
                        <th>Penanggung Jawab</th>
                        <th>Status Kondisi</th>
                        <th>Waktu Update</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_tugas)) {
                        echo "<tr>";
                        echo "<td style='color: var(--text-muted); font-weight: 500;'>#" . htmlspecialchars($row['id_tugas']) . "</td>";
                        echo "<td><strong style='color: var(--text-main);'>" . htmlspecialchars($row['nama_tugas']) . "</strong></td>";
                        
                        // Menampilkan nama anggota dari relasi users.nama
                        $nama_user = !empty($row['nama']) ? htmlspecialchars($row['nama']) : '<em style="color:var(--text-muted);">Belum diplot</em>';
                        echo "<td>" . $nama_user . "</td>";
                        
                        // KUSTOMISASI ENUM: Mengubah data string enum menjadi badge berwarna visual
                        $status_enum = $row['status'];
                        $badge_class = 'badge-kotor';
                        if ($status_enum == 'bersih') {
                            $badge_class = 'badge-bersih';
                        } elseif ($status_enum == 'masih kotor') {
                            $badge_class = 'badge-masih-kotor';
                        }
                        echo "<td><span class='badge " . $badge_class . "'>" . htmlspecialchars($status_enum) . "</span></td>";
                        
                        // Menampilkan waktu otomatis timestamp database
                        echo "<td style='color: var(--text-muted); font-size: 13px;'>" . date('d M Y, H:i', strtotime($row['waktu'])) . "</td>";
                        
                        // Tombol Aksi
                        echo "<td style='text-align: center;'>";
                        echo "<a href='update.php?id=" . $row['id_tugas'] . "' class='btn-action btn-edit' title='Edit Tugas'><i class='fa-solid fa-pen-to-square'></i></a> ";
                        echo "<a href='delate.php?id=" . $row['id_tugas'] . "' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus tugas ini?\")' title='Hapus Tugas'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_tugas) == 0) {
                        echo "<tr><td colspan='6' style='text-align:center; color: var(--text-muted); padding: 20px;'>Belum ada data tugas piket</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>