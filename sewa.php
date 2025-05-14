<?php
    include 'koneksi.php';
    session_start();

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    //ngambil dr table
    $query = mysqli_query($conn, "SELECT * FROM users");

    $query = mysqli_query($conn, "SELECT * FROM iphones");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>iRentID - Pilih iPhone</title>
  <link rel="stylesheet" href="style_sewa.css">
</head>
<body>
  <<header class="navbar">
    <div><strong>RentalanIP</strong></div>
    <div>
      <a href="sewa.php">Rent Now</a>
      <a href="review.php">Review</a>
      <a href="register.php">Sign Up</a>
      <a href="login.php">Login</a>
    </div>
  </header>
  <section class="section">
    <h2>Pilih iPhone yang Ingin Kamu Sewa</h2>
    <div class="grid">
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <div class="card">
          <img src="images/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>">
          <h3><?php echo $row['nama']; ?></h3>
          <p>Rp <?php echo number_format($row['hargaPerHari'], 0, ',', '.'); ?> / hari</p>

          <a href="#" class="btn-sewa">Sewa Sekarang</a>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <footer class="footer">
    <p>&copy; <?= date('Y') ?> iRentID. All rights reserved.</p>
  </footer>
</body>
</html>
