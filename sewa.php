<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM iphones");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>RentalanIP - Pilih iPhone</title>
  <link rel="stylesheet" href="style_sewa.css">
</head>
<body>

 <div class="navbar">
    <div><strong>Rentalan IP</strong></div>
    <div>
      <a href="index.php">Home</a>
      <a href="sewa.php">Rent Now</a>
      <a href="review.php">Review</a>
      <a href="register.php">Sign Up</a>
      <a href="login.php">Login</a>
    </div>
  </div>

<section class="section">
  <h2>Pilih iPhone yang Ingin Kamu Sewa</h2>
  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <div class="card">
        <img src="images/<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>">
        <h3><?= $row['nama'] ?></h3>
        <p>Rp <?= number_format($row['hargaPerHari'], 0, ',', '.') ?> / hari</p>
        <div class="info">Storage: <?= $row['storage'] ?><br>color: <?= $row['warna'] ?></div>
        <a href="proses_sewa.php?id=<?= $row['idIphone'] ?>" class="btn-sewa">Sewa Sekarang</a>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> RentalanIP. All rights reserved.</p>
</footer>

</body>
</html>
