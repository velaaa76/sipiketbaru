<?php
session_start();

// cek login
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
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
        <h2>SiPiket</h2>

        <ul>
            <li class="active"><i class="fa-solid fa-house"></i> Dashboard</li>
            <li><i class="fa-solid fa-calendar"></i> Jadwal Piket</li>
            <li><i class="fa-solid fa-list-check"></i> Tugas</li>
            <li><i class="fa-solid fa-user"></i> Profile</li>
        </ul>
    </div>

    <div class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </div>

</div>

<div class="main-content">
<div class="topbar">
        <div>
            <h1>Halo, Bilqis 👋</h1>
            <p>Semangat menjaga kebersihan kelas hari ini!</p>
        </div>

        <div class="profile-mini">
            <div class="circle">B</div>
        </div>
    </div>

    <div class="hero-card">
        <div>
            <h2>Misi Kebersihan Menantimu!</h2>
            <p>Kerjakan tugas piketmu dan bantu kelas tetap bersih serta nyaman.</p>
            <button>Mulai Tugas Hari Ini</button>
        </div>

        <img src="https://cdn-icons-png.flaticon.com/512/3588/3588658.png" alt="cleaning">
    </div>

    <div class="info-grid">

        <div class="card red">
            <i class="fa-solid fa-list-check"></i>
            <h3>Total Tugas</h3>
            <span>12</span>
        </div>
        <div class="card blue">
            <i class="fa-solid fa-circle-check"></i>
            <h3>Tugas Selesai</h3>
            <span>8</span>
        </div>

        <div class="card yellow">
            <i class="fa-solid fa-users"></i>
            <h3>Petugas Hari Ini</h3>
            <span>4 Orang</span>
        </div>

    </div>

    <div class="bottom-grid">

        <div class="jadwal-box">
            <div class="title">
                <h2>Petugas Piket Senin</h2>
                <span>Hari Ini</span>
            </div>

            <div class="anggota">
                <div class="nama">Bilqis Shelien</div>
                <div class="nama">Vela</div>
                <div class="nama">Pasha</div>
                <div class="nama">Jojo</div>
            </div>
        </div>

        <div class="progress-box">
            <h2>Progress Kebersihan</h2>

            <div class="progress-bar">
                <div class="progress"></div>
            </div>

            <p>75% tugas sudah selesai</p>
        </div>

    </div>

</div>

</body>
</html>