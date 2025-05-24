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
      SELECT s.tglMulai, s.tglSelesai, i.hargaPerHari, i.nama, p.metode, p.tanggalBayar, p.status
      FROM sewa s
      JOIN iphones i ON s.idIphone = i.idIphone
      LEFT JOIN payment p ON p.idSewa = s.idSewa
      WHERE s.idSewa = $idSewa
  ");

  $data = mysqli_fetch_assoc($q);

  if (!$data) {
      echo "Data sewa tidak ditemukan.";
      exit;
  }

  $tglMulai = new DateTime($data['tglMulai']);
  $tglSelesai = new DateTime($data['tglSelesai']);
  $lamaSewa = $tglMulai->diff($tglSelesai)->days;
  $totalHarga = $lamaSewa * $data['hargaPerHari'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bayar.css">
  <title>Pembayaran - RentalanIP</title>
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


<section class="section">
  <h2>Bayar untuk: <?= $data['nama'] ?></h2>
  <p>Lama sewa: <strong><?= $lamaSewa ?> hari</strong></p>
  <p>Total yang harus dibayar: <strong>Rp <?= number_format($totalHarga, 0, ',', '.') ?></strong></p>

  <?php if (empty($data['metode'])) : ?>
    <form action="" method="POST">
      <input type="hidden" name="idSewa" value="<?= $idSewa ?>">
      <input type="hidden" name="jumlah" value="<?= $totalHarga ?>">

      <label for="metode">Metode Pembayaran:</label>
      <select name="metode" required>
        <option value="">-- Pilih Metode --</option>
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="COD">Bayar di Tempat (COD)</option>
      </select>

      <button type="submit" class="btn-sewa">Kirim Pembayaran</button>
    </form>
  <?php else : ?>
    <div class="result">
      <p><strong>Transaksi Tercatat</strong></p>
      <p>Nama iPhone: <?= $data['nama'] ?></p>
      <p>Total: Rp <?= number_format($totalHarga, 0, ',', '.') ?></p>
      <p>Metode: <?= $data['metode'] ?></p>
      <p>Tanggal: <?= $data['tanggalBayar'] ?></p>
    </div>
  <?php endif; ?>

</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> RentalanIP. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// proses langsung di file yang sama
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSewa = $_POST["idSewa"];
    $jumlah = $_POST["jumlah"];
    $metode = $_POST["metode"];
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO payment (idSewa, tanggalBayar, jumlah, metode)
              VALUES ('$idSewa', '$tanggal', '$jumlah', '$metode')";

         
    $getIphone = mysqli_query($conn, "
    SELECT idIphone FROM sewa WHERE idSewa = '$idSewa'");
    $iphoneRow = mysqli_fetch_assoc($getIphone);
    $idIphone = $iphoneRow['idIphone'];

// Kurangi stok 
    mysqli_query($conn, "
    UPDATE iphones SET stok = stok - 1 WHERE idIphone = '$idIphone' AND stok > 0");


    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='bayar.php?idSewa=$idSewa';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan pembayaran.');</script>";
    }
}
?>
