<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

include '../include/koneksi.php';

$username = $_SESSION['username'];
$query = $conn->query("SELECT * FROM users WHERE nama='$username'");
$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil - SiPiket</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #f5f5f5;
    display: flex;
    justify-content: center;
}

/* CONTAINER */
.container {
    width: 100%;
    max-width: 420px;
    padding: 20px;
}

/* HEADER */
.header {
    text-align: center;
    margin-top: 30px;
}

/* AVATAR */
.avatar {
    width: 90px;
    height: 90px;
    background: #e60000;
    color: white;
    border-radius: 20px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: bold;
    box-shadow: 0 8px 20px rgba(230,0,0,0.3);
}

/* NAMA */
.name {
    margin-top: 15px;
    font-size: 22px;
    font-weight: bold;
    color: #222;
}

.role {
    font-size: 14px;
    color: #777;
}

/* MENU */
.menu {
    margin-top: 30px;
}

/* ITEM */
.menu-item {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    transition: 0.2s;
}

.menu-item:hover {
    transform: translateY(-2px);
}

/* LEFT */
.left {
    display: flex;
    align-items: center;
    gap: 12px;
}

/* ICON */
.icon {
    width: 40px;
    height: 40px;
    background: #f2f2f2;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

/* TEXT */
.text {
    font-size: 15px;
    color: #333;
}

/* LOGOUT */
.logout {
    margin-top: 25px;
}

.logout button {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background: #e60000;
    color: white;
    font-weight: bold;
    font-size: 15px;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(230,0,0,0.3);
}

/* FOOTER */
.footer {
    text-align: center;
    font-size: 12px;
    color: #aaa;
    margin-top: 15px;
}
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="avatar">
            <?php echo strtoupper(substr($data['nama'],0,2)); ?>
        </div>

        <div class="name"><?php echo $data['nama']; ?></div>
        <div class="role">Siswa Kelas X SIJA 2</div>
    </div>

    <!-- MENU -->
    <div class="menu">

        <div class="menu-item">
            <div class="left">
                <div class="icon">👤</div>
                <div class="text">Profil Saya</div>
            </div>
            <div>›</div>
        </div>

        <div class="menu-item">
            <div class="left">
                <div class="icon">🔒</div>
                <div class="text">Keamanan</div>
            </div>
            <div>›</div>
        </div>

        <div class="menu-item">
            <div class="left">
                <div class="icon">❓</div>
                <div class="text">Bantuan</div>
            </div>
            <div>›</div>
        </div>

    </div>

    <!-- LOGOUT -->
    <div class="logout">
        <form action="../logout.php" method="POST">
            <button>Keluar Aplikasi</button>
        </form>
    </div>

    <div class="footer">
        v1.0 Aplikasi SiPiket
    </div>

</div>

</body>
</html>