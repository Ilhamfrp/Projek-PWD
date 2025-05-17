<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['idSewa'])) {
    echo "ID sewa tidak valid.";
    exit;
}

$idSewa = $_GET['idSewa'];


$q = mysqli_query($conn, "
    SELECT s.totalHarga, i.nama 
    FROM sewa s
    JOIN iphones i ON s.idIphone = i.idIphone
    WHERE s.idSewa = $idSewa
");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "Data sewa tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran - RentalanIP</title>
  <link rel="stylesheet" href="style_sewa.css">
</head>
<body>

<header class="navbar">
  <div><strong>RentalanIP</strong></div>
</header>

<section class="section">
  <h2>Bayar untuk: <?= $data['nama'] ?></h2>
  <p>Total yang harus dibayar: <strong>Rp <?= number_format($data['totalHarga'], 0, ',', '.') ?></strong></p>

  <form action="proses_pembayaran.php" method="POST">
    <input type="hidden" name="idSewa" value="<?= $idSewa ?>">
    <input type="hidden" name="jumlah" value="<?= $data['totalHarga'] ?>">

    <label for="metode">Metode Pembayaran:</label>
    <select name="metode" required>
      <option value="">-- Pilih Metode --</option>
      <option value="Transfer Bank">Transfer Bank</option>
      <option value="COD">Bayar di Tempat (COD)</option>
    </select><br><br>

    <button type="submit" class="btn-sewa">Kirim Pembayaran</button>
  </form>
</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> RentalanIP. All rights reserved.</p>
</footer>

</body>
</html>
