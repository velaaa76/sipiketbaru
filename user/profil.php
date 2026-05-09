<?php
session_start();
include '../include/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "
    SELECT * FROM users
    WHERE id_user = '$id_user'
");

$data = mysqli_fetch_array($query);

$nama  = $data['nama'];
$email = $data['email'];
$role  = $data['role'];
$foto  = $data['foto'];
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Profile | SiPiket</title>

    <!-- CSS -->
    <link rel="stylesheet"
    href="../css/profile.css">

    <!-- FONT -->
    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <!-- BACKGROUND -->
    <div class="blur blur1"></div>
    <div class="blur blur2"></div>



    <div class="container">

        <!-- SIDEBAR -->
        <div class="sidebar">

            <div class="logo">

                <i class="fa-solid fa-shield-heart"></i>

                <h2>SiPiket</h2>

            </div>



            <div class="menu">

                <a href="#">

                    <i class="fa-solid fa-house"></i>

                    Dashboard

                </a>

                <a href="#">

                    <i class="fa-solid fa-list-check"></i>

                    Tugas

                </a>

                <a href="#">

                    <i class="fa-solid fa-calendar"></i>

                    Jadwal

                </a>

                <a href="#" class="active">

                    <i class="fa-solid fa-user"></i>

                    Profile

                </a>

            </div>

        </div>



        <!-- CONTENT -->
        <div class="content">

            <div class="topbar">

                <h1>Profile Saya</h1>

            </div>



            <div class="profile-card">

                <!-- FOTO -->
                <div class="profile-image">

                    <img
                    src="../img/foto-sipiket.jpeg"
                    alt="Profile">

                </div>



                <!-- INFO -->
                <div class="profile-info">

                    <h2>
                        <?= $nama; ?>
                    </h2>

                    <p class="role">
                        <?= $role; ?>
                    </p>



                    <div class="info-box">

                        <div class="item">

                            <span>Email</span>

                            <h4>
                                <?= $email; ?>
                            </h4>

                        </div>



                        <div class="item">

                            <span>Status</span>

                            <h4>Aktif</h4>

                        </div>

                    </div>



                    <button>

                        <i class="fa-solid fa-pen"></i>

                        Edit Profile

                    </button>

                </div>

            </div>

        </div>

    </div>

</body>
</html>