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
    SELECT s.totalHarga, i.nama, p.metode, p.tanggalBayar, p.status
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
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran - RentalanIP</title>
  <style>
    body {
      background-color: #0f0f0f;
      color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
    }
  .navbar {
      background-color: #000;
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .navbar a {
      color: white;
      margin: 0 1em;
      text-decoration: none;
      font-weight: bold;
    }
    .navbar a:hover {
      text-decoration: underline;
    }
    .section {
      padding: 4em 2em;
      max-width: 600px;
      margin: auto;
      background-color: #1a1a1a;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(255,255,255,0.05);
    }
    .section h2 {
      font-size: 1.8em;
      margin-bottom: 1em;
    }
    .section p {
      margin-bottom: 1.5em;
    }
    label, select {
      display: block;
      margin-bottom: 1em;
      font-size: 0.95em;
    }
    select {
      width: 100%;
      padding: 0.5em;
      border-radius: 6px;
      border: none;
    }
    .btn-sewa {
      background-color: #007bff;
      color: white;
      padding: 0.6em 1.2em;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      text-decoration: none;
    }
    .btn-sewa:hover {
      background-color: #0056b3;
    }
    .result {
      margin-top: 2em;
      padding: 1em;
      background-color: #2a2a2a;
      border-radius: 8px;
      font-size: 0.95em;
    }
    .footer {
      background-color: #000;
      color: white;
      padding: 2em;
      text-align: center;
      margin-top: 3em;
    }
  </style>
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
  <h2>Bayar untuk: <?= $data['nama'] ?></h2>
  <p>Total yang harus dibayar: <strong>Rp <?= number_format($data['totalHarga'], 0, ',', '.') ?></strong></p>

  <?php if (empty($data['metode'])) : ?>
    <form action="" method="POST">
      <input type="hidden" name="idSewa" value="<?= $idSewa ?>">
      <input type="hidden" name="jumlah" value="<?= $data['totalHarga'] ?>">

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
      <p>Total: Rp <?= number_format($data['totalHarga'], 0, ',', '.') ?></p>
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
