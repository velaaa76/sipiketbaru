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


// Ambil data jadwal khusus untuk user yang login
$query_jadwal = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_user = '$user_id' ORDER BY tanggal_dan_waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Piket - SiPiket</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .table-container {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #f4f4f4;
            color: #333;
        }
        tbody tr:hover {
            background: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <div class="logo">
            <h1>SiPiket</h1>
        </div>

        <ul class="menu">
            <a href="index.php" style="text-decoration: none; color: inherit;">
                <li><i class="fa-solid fa-house"></i> Dashboard</li>
            </a>
            <a href="jadwal.php" style="text-decoration: none; color: inherit;">
                <li class="active"><i class="fa-solid fa-calendar"></i> Jadwal Piket</li>
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
            <h1>Jadwal Piket Saya 📅</h1>
            <p>Berikut adalah jadwal piket kebersihan Anda.</p>
        </div>


    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal & Waktu Piket</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($query_jadwal) > 0) {
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query_jadwal)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        
                        // Menampilkan tanggal & waktu
                        if (isset($row['tanggal_dan_waktu'])) {
                            echo "<td><strong>" . date('d F Y', strtotime($row['tanggal_dan_waktu'])) . "</strong> pada pukul " . date('H:i', strtotime($row['tanggal_dan_waktu'])) . "</td>";
                        } else {
                            echo "<td>Data tidak tersedia</td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' style='text-align:center; color:gray; padding: 20px;'>Anda belum memiliki jadwal piket.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
