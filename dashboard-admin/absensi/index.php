<?php
include '../../koneksi.php';

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
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e63946;
            --primary-dark: #d62828;
            --secondary: #f1faee;
            --text-main: #1d3557;
            --text-muted: #457b9d;
            --bg-color: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 15px 35px rgba(230, 57, 70, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: var(--white);
            box-shadow: var(--shadow-md);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: block;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        /* Table Section */
        .table-section {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        table th {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 14px;
        }

        table td {
            font-size: 15px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-hadir {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }
        
        .badge-izin {
            background: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }

        .badge-sakit {
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary);
        }

        .img-preview {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #eee;
        }

        .btn-tambah {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .btn-tambah:hover {
            background: var(--primary-dark);
        }

        .btn-action {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
            margin-right: 5px;
            transition: opacity 0.3s;
        }

        .btn-action:hover {
            opacity: 0.8;
        }

        .btn-edit { background: #3498db; }
        .btn-delete { background: #e74c3c; }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                padding: 15px;
            }
            .sidebar-menu {
                flex-direction: row;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">SiPiket Admin</div>
        <ul class="sidebar-menu">
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="../jadwal/read.php">Jadwal Piket</a></li>
            <li><a href="#">Data Users</a></li>
            <li><a href="index.php" class="active">Data Absensi</a></li>
            <li><a href="#">Data Laporan</a></li>
            <li style="margin-top: auto;"><a href="../../index.php" style="color: var(--primary);">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Data Absensi</h1>
            <div class="user-profile">
                <span>Admin</span>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>
            </div>
        </div>

        <a href="create.php" class="btn-tambah">+ Tambah Absensi</a>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_absensi)) {
                        echo "<tr>";
                        echo "<td>#" . htmlspecialchars($row['id_absensi']) . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['nama']) . "</strong></td>";
                        echo "<td>" . date('d M Y - H:i', strtotime($row['tanggal_dan_waktu'])) . "</td>";
                        
                        $status = htmlspecialchars($row['status_absensi'] ?? $row['Status_absensi']); // support both cases just in case
                        $badge_class = 'badge';
                        if(strtolower($status) == 'hadir') {
                            $badge_class .= ' badge-hadir';
                        } elseif(strtolower($status) == 'izin') {
                            $badge_class .= ' badge-izin';
                        } else {
                            $badge_class .= ' badge-sakit'; // untuk absen
                        }
                        
                        echo "<td><span class='$badge_class'>" . ucfirst($status) . "</span></td>";
                        
                        echo "<td>";
                        echo "<a href='update.php?id=" . $row['id_absensi'] . "' class='btn-action btn-edit'>Edit</a>";
                        echo "<a href='delete.php?id=" . $row['id_absensi'] . "' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_absensi) == 0) {
                        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data absensi</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
