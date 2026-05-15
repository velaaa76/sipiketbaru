<?php
include '.../../include/koneksi.php';

$id = $_GET['id'];
$query_data = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = '$id'");
$data = mysqli_fetch_assoc($query_data);

if(isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $tanggal_dan_waktu = $_POST['tanggal_dan_waktu'];

    $query = mysqli_query($conn, "UPDATE jadwal SET id_user='$id_user', tanggal_dan_waktu='$tanggal_dan_waktu' WHERE id_jadwal='$id'");
    
    if($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}

$users = mysqli_query($conn, "SELECT * FROM users");
$formatted_datetime = date('Y-m-d\TH:i', strtotime($data['tanggal_dan_waktu']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal - SiPiket Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e63946;
            --primary-dark: #d62828;
            --text-main: #1d3557;
            --text-muted: #457b9d;
            --bg-color: #f8f9fa;
            --white: #ffffff;
            --shadow-md: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-main); display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: var(--white); box-shadow: var(--shadow-md); padding: 20px; display: flex; flex-direction: column; }
        .sidebar-logo { font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 40px; text-align: center; }
        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .sidebar-menu a { text-decoration: none; color: var(--text-muted); font-weight: 500; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease; display: block; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(230, 57, 70, 0.1); color: var(--primary); }
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        .header { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid rgba(0,0,0,0.05); }
        .header h1 { font-size: 28px; font-weight: 600; }
        .form-section { background: var(--white); padding: 30px; border-radius: 15px; box-shadow: var(--shadow-md); max-width: 600px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-main); }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; transition: border 0.3s; }
        .form-group input:focus, .form-group select:focus { border-color: var(--primary); }
        .btn-submit { background: var(--primary); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: var(--primary-dark); }
        .btn-back { display: inline-block; margin-bottom: 20px; color: var(--text-muted); text-decoration: none; font-weight: 500; }
        .btn-back:hover { color: var(--primary); }
        @media (max-width: 768px) { body { flex-direction: column; } .sidebar { width: 100%; padding: 15px; } }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">SiPiket Admin</div>
        <ul class="sidebar-menu">
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="index.php" class="active">Jadwal Piket</a></li>
            <li><a href="#">Data Users</a></li>
            <li><a href="../absensi/index.php">Data Absensi</a></li>
            <li><a href="#">Data Laporan</a></li>
            <li style="margin-top: auto;"><a href="../../index.php" style="color: var(--primary);">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <a href="index.php" class="btn-back">← Kembali</a>
        <div class="header">
            <h1>Edit Jadwal Piket</h1>
        </div>
        <div class="form-section">
            <form method="POST">
                <div class="form-group">
                    <label>Pilih User</label>
                    <select name="id_user" required>
                        <?php while($row = mysqli_fetch_assoc($users)): ?>
                            <option value="<?= $row['user_id'] ?>" <?= ($row['user_id'] == $data['id_user']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['nama']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal & Waktu</label>
                    <input type="datetime-local" name="tanggal_dan_waktu" value="<?= $formatted_datetime ?>" required>
                </div>
                <button type="submit" name="submit" class="btn-submit">Update Jadwal</button>
            </form>
        </div>
    </div>
</body>
</html>
