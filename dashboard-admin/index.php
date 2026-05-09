<?php
include '../koneksi.php';

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

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.02);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .card-title {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 10px;
            font-weight: 500;
        }

        .card-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
        }

        /* Recent Table */
        .recent-section {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-sm);
        }

        .recent-section h2 {
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
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
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="jadwal/read.php">Jadwal Piket</a></li>
            <li><a href="#">Data Users</a></li>
            <li><a href="absensi/index.php">Data Absensi</a></li>
            <li><a href="#">Data Laporan</a></li>
            <li style="margin-top: auto;"><a href="../index.php" style="color: var(--primary);">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <div class="user-profile">
                <span>Admin</span>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-title">Total Users</div>
                <div class="card-value"><?php echo $total_users; ?></div>
            </div>
            <div class="card">
                <div class="card-title">Total Jadwal</div>
                <div class="card-value"><?php echo $total_jadwal; ?></div>
            </div>
            <div class="card">
                <div class="card-title">Total Absensi</div>
                <div class="card-value"><?php echo $total_absensi; ?></div>
            </div>
            <div class="card">
                <div class="card-title">Total Laporan</div>
                <div class="card-value"><?php echo $total_laporan; ?></div>
            </div>
        </div>

        <div class="recent-section">
            <h2>User Terbaru</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_recent_users = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC LIMIT 5");
                    while($row = mysqli_fetch_assoc($query_recent_users)) {
                        echo "<tr>";
                        echo "<td>#" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "</tr>";
                    }
                    if(mysqli_num_rows($query_recent_users) == 0) {
                        echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data user</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>