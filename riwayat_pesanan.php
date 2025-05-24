<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$idUser = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT sewa.*, iphones.nama AS namaIphone 
    FROM sewa 
    JOIN iphones ON sewa.idIphone = iphones.idIphone 
    WHERE sewa.idUser = $idUser
    ORDER BY sewa.tglMulai DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="riwayat_pesanan.css">
    <title>Riwayat Penyewaan Saya</title>
</head>
<body>
<div class="navbar">
    <div><strong>Rentalan IP</strong></div>
    <div>
      <a href="index.php">Home</a>
      <a href="review.php">Review</a>
      <?php
        if (isset($_SESSION["login"])) {
        echo "Halo, " . $_SESSION["nama"] . " | ";
        echo '<a href="logout.php">Logout</a>';
        if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
            echo ' | <a href="admin_dashboard.php">Dashboard Admin</a>';
        }
        } else {
            echo '<a href="register.php">Sign Up</a> | <a href="login.php">Login</a>';
        }
    ?>
    </div>
</div>

    <h1>Riwayat Penyewaan Anda</h1>

    <table>
        <tr>
            <th>iPhone</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['namaIphone'] ?></td>
                <td><?= $row['tglMulai'] ?></td>
                <td><?= $row['tglSelesai'] ?></td>
                <td>Rp <?= number_format($row['totalHarga'], 0, ',', '.') ?></td>
                <td class="status-<?= strtolower($row['status']) ?>">
                    <?php 
                    switch ($row['status']) {
                        case 'pending':
                            echo "⏳ Menunggu Persetujuan";
                            break;
                        case 'approved':
                            echo "✔ Disetujui Admin<br>";
                            echo "<a href='kembalikan.php?idSewa={$row['idSewa']}' onclick='return confirm(\"Yakin ingin mengembalikan iPhone?\")'>Kembalikan</a>";
                            break;
                        case 'rejected':
                            echo "❌ Ditolak Admin";
                            break;
                        case 'returned':
                            echo "📦 Sudah Dikembalikan";
                            break;
                        default:
                            echo $row['status'];
                            break;
                    }
                    ?>
                </td>


            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>