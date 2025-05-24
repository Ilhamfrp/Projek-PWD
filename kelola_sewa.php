<?php
session_start();
include 'koneksi.php';

// Cek login & role admin
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

// Proses ACC atau Tolak
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $idSewa = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi === 'acc') {
        mysqli_query($conn, "UPDATE sewa SET status='approved' WHERE idSewa = $idSewa");
    } elseif ($aksi === 'tolak') {
        mysqli_query($conn, "UPDATE sewa SET status='rejected' WHERE idSewa = $idSewa");
    }

    header("Location: kelola_sewa.php");
    exit;
}

// Ambil semua data sewa
$result = mysqli_query($conn, "SELECT sewa.*, users.nama AS namaUser, iphones.nama AS namaIphone FROM sewa 
JOIN users ON sewa.idUser = users.id 
JOIN iphones ON sewa.idIphone = iphones.idIphone
ORDER BY sewa.idSewa DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kelola_sewa.css">
    <title>Kelola Sewa</title>
</head>
<body>
    <h1>Data Penyewaan</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama User</th>
            <th>iPhone</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['namaUser'] ?></td>
            <td><?= $row['namaIphone'] ?></td>
            <td><?= $row['tglMulai'] ?></td>
            <td><?= $row['tglSelesai'] ?></td>
            <td>Rp <?= number_format($row['totalHarga'], 0, ',', '.') ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if ($row['status'] == 'pending') : ?>
                    <a href="?aksi=acc&id=<?= $row['idSewa'] ?>">✔ Setujui</a> | 
                    <a href="?aksi=tolak&id=<?= $row['idSewa'] ?>" onclick="return confirm('Tolak penyewaan ini?')">✖ Tolak</a>
                <?php elseif ($row['status'] == 'approved') : ?>
                    <em>✔ Disetujui</em>
                <?php elseif ($row['status'] == 'rejected') : ?>
                    <em>✖ Ditolak</em>
                <?php elseif ($row['status'] == 'returned') : ?>
                    <em>📦 Sudah Dikembalikan</em>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">← Kembali ke Dashboard</a>
</body>
</html>
