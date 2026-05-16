<?php
include '../../include/koneksi.php';

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data laporan lama untuk diletakkan ke dalam form default value
$data = mysqli_query($conn, "SELECT * FROM laporan WHERE id_laporan='$id'");
$d = mysqli_fetch_array($data);

if(!$d) {
    header("Location: index.php");
    exit;
}

// Ambil list nama user untuk dropdown pelapor
$query_users = mysqli_query($conn, "SELECT * FROM users ORDER BY nama ASC");

if(isset($_POST['submit'])){
    $id_user = $_POST['id_user'];
    $isi_laporan = $_POST['isi_laporan'];
    $status_laporan = $_POST['Status_laporan']; 

    // Melakukan update records berdasarkan ID Laporan terkait
    $query_update = mysqli_query($conn, "
        UPDATE laporan SET 
        id_user='$id_user', 
        isi_laporan='$isi_laporan', 
        Status_laporan='$status_laporan' 
        WHERE id_laporan='$id'
    ");

    if($query_update) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui laporan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Laporan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="form-container">
    <h1>Edit Laporan</h1>

    <form method="POST">
        <select name="id_user" required>
            <?php while($user = mysqli_fetch_assoc($query_users)) { ?>
                <option value="<?= $user['user_id']; ?>" <?= ($d['id_user'] == $user['user_id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($user['nama']); ?>
                </option>
            <?php } ?>
        </select>

        <textarea name="isi_laporan" required><?= htmlspecialchars($d['isi_laporan']); ?></textarea>

        <select name="Status_laporan" required>
            <option value="wait" <?= ($d['Status_laporan'] == 'wait') ? 'selected' : ''; ?>>WAIT</option>
            <option value="acc" <?= ($d['Status_laporan'] == 'acc') ? 'selected' : ''; ?>>ACC</option>
            <option value="reject" <?= ($d['Status_laporan'] == 'reject') ? 'selected' : ''; ?>>REJECT</option>
        </select>

        <button type="submit" name="submit">Update</button>
    </form>
</div>

</body>
</html>