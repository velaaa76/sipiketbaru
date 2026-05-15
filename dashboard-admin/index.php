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
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
            --success: #2ec4b6;
            --warning: #ff9f1c;
            --danger: #e63946;
            --text-main: #2b2d42;
            --text-muted: #8d99ae;
            --bg-color: #f4f7fe;
            --white: #ffffff;
            --shadow-sm: 0 5px 15px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 25px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 40px rgba(67, 97, 238, 0.15);
            --radius-md: 16px;
            --radius-lg: 24px;
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
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--white);
            box-shadow: var(--shadow-md);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            z-index: 10;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 50px;
            text-align: center;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .sidebar-logo i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 32px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            padding: 15px 20px;
            border-radius: var(--radius-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a i {
            font-size: 20px;
            width: 24px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-lg);
            transform: translateX(5px);
        }

        .sidebar-menu a:hover i, .sidebar-menu a.active i {
            transform: scale(1.1);
        }
        
        .sidebar-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }
        
        .sidebar-menu a:hover::before {
            left: 100%;
        }

        .logout-link {
            margin-top: auto;
        }
        
        .logout-link a {
            background: rgba(230, 57, 70, 0.05);
            color: var(--danger);
        }
        
        .logout-link a:hover {
            background: var(--danger);
            color: var(--white);
            box-shadow: 0 10px 20px rgba(230, 57, 70, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px 50px;
            overflow-y: auto;
            position: relative;
        }
        
        .main-content::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.08) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(0,0,0,0.03);
            animation: fadeInDown 0.8s ease;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--text-main), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            background: var(--white);
            padding: 8px 20px 8px 8px;
            border-radius: 50px;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-profile:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .avatar {
            width: 45px; 
            height: 45px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, var(--primary), var(--secondary)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white; 
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.8s ease backwards;
        }
        
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(255,255,255,0.4), rgba(255,255,255,0));
            border-radius: 0 0 0 100%;
            transition: all 0.5s ease;
            z-index: 0;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .card:hover::after {
            width: 200px;
            height: 200px;
        }

        .card > * {
            position: relative;
            z-index: 1;
        }

        .card-icon {
            width: 65px;
            height: 65px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: var(--white);
        }
        
        .card-1 .card-icon { background: linear-gradient(135deg, var(--primary), #8e94f2); box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3); }
        .card-2 .card-icon { background: linear-gradient(135deg, var(--success), #80ed99); box-shadow: 0 10px 20px rgba(46, 196, 182, 0.3); }
        .card-3 .card-icon { background: linear-gradient(135deg, var(--warning), #ffb703); box-shadow: 0 10px 20px rgba(255, 159, 28, 0.3); }
        .card-4 .card-icon { background: linear-gradient(135deg, var(--danger), #ef233c); box-shadow: 0 10px 20px rgba(230, 57, 70, 0.3); }

        .card-title {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-value {
            font-size: 42px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1;
        }

        /* Recent Table */
        .recent-section {
            background: var(--white);
            padding: 35px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            animation: fadeInUp 0.8s ease backwards;
            animation-delay: 0.5s;
        }

        .recent-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .recent-section h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-main);
            position: relative;
            padding-left: 18px;
        }
        
        .recent-section h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 24px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
            min-width: 600px;
        }

        table th {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0 25px 10px 25px;
            text-align: left;
        }

        table tbody tr {
            background: var(--bg-color);
            transition: all 0.3s ease;
        }
        
        table tbody tr:hover {
            transform: scale(1.01) translateY(-2px);
            box-shadow: var(--shadow-md);
            background: var(--white);
        }

        table td {
            padding: 20px 25px;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-main);
        }
        
        table td:first-child {
            border-radius: 15px 0 0 15px;
            color: var(--primary);
            font-weight: 700;
        }
        
        table td:last-child {
            border-radius: 0 15px 15px 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .dashboard-cards {
                grid-template-columns: repeat(2, 1fr);
            }
            .main-content {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }
            .sidebar-logo {
                margin-bottom: 25px;
            }
            .sidebar-menu {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 15px;
            }
            .sidebar-menu a {
                white-space: nowrap;
            }
            .logout-link {
                margin-top: 0;
            }
            .main-content {
                padding: 20px;
            }
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
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
            <li><a href="#"><i class="fa-solid fa-file-lines"></i> Data Laporan</a></li>
            <li class="logout-link"><a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span>Admin</span>
                <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: var(--text-muted); margin-left: 5px;"></i>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card card-1">
                <div class="card-icon"><i class="fa-solid fa-users"></i></div>
                <div class="card-title">Total Users</div>
                <div class="card-value"><?php echo $total_users; ?></div>
            </div>
            <div class="card card-2">
                <div class="card-icon"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="card-title">Total Jadwal</div>
                <div class="card-value"><?php echo $total_jadwal; ?></div>
            </div>
            <div class="card card-3">
                <div class="card-icon"><i class="fa-solid fa-clipboard-user"></i></div>
                <div class="card-title">Total Absensi</div>
                <div class="card-value"><?php echo $total_absensi; ?></div>
            </div>
            <div class="card card-4">
                <div class="card-icon"><i class="fa-solid fa-file-lines"></i></div>
                <div class="card-title">Total Laporan</div>
                <div class="card-value"><?php echo $total_laporan; ?></div>
            </div>
        </div>

        <div class="recent-section">
            <div class="recent-section-header">
                <h2>User Terbaru</h2>
            </div>
            <div class="table-responsive">
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
                        $query_recent_users = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC LIMIT 5");
                        while($row = mysqli_fetch_assoc($query_recent_users)) {
                            // Extract initials for the avatar
                            $nama = htmlspecialchars($row['nama']);
                            $initials = strtoupper(substr($nama, 0, 1));
                            
                            echo "<tr>";
                            echo "<td>#" . htmlspecialchars($row['user_id']) . "</td>";
                            echo "<td>
                                    <div class='user-info'>
                                        <div class='user-icon'>$initials</div>
                                        <span>$nama</span>
                                    </div>
                                  </td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td><span style='background: rgba(46, 196, 182, 0.1); color: var(--success); padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;'>Aktif</span></td>";
                            echo "</tr>";
                        }
                        if(mysqli_num_rows($query_recent_users) == 0) {
                            echo "<tr><td colspan='4' style='text-align:center;'>Belum ada data user</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>