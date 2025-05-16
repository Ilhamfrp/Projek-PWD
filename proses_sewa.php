<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET['id'])) {
    echo "ID iPhone tidak valid.";
    exit;
}

$idIphone = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM iphones WHERE idIphone = $idIphone");
$iphone = mysqli_fetch_assoc($result);

if (!$iphone) {
    echo "Produk tidak ditemukan.";
    exit;
}

// FORM
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUser = $_SESSION["id"];
    $tglMulai = $_POST["tglMulai"];
    $tglSelesai = $_POST["tglSelesai"];

    $start = new DateTime($tglMulai);
    $end = new DateTime($tglSelesai);
    $lamaSewa = $start->diff($end)->days;

    if ($lamaSewa < 1) {
        echo "<script>alert('Tanggal tidak valid!');</script>";
    } else {
        $hargaPerHari = $iphone["hargaPerHari"];
        $totalHarga = $hargaPerHari * $lamaSewa;

        $query = "INSERT INTO sewa (idUser, idIphone, tglMulai, tglSelesai, totalHarga, status)
                  VALUES ('$idUser', '$idIphone', '$tglMulai', '$tglSelesai', '$totalHarga', 'pending')";

        if (mysqli_query($conn, $query)) {
            $idSewa = mysqli_insert_id($conn); 
            header("Location: bayar.php?idSewa=$idSewa");
            exit;
        } else {
            echo "<script>alert('Gagal menyewa.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Sewa - <?= $iphone['nama'] ?></title>
  <link rel="stylesheet" href="style_sewa.css">
</head>
<body>

<header class="navbar">
  <div><strong>RentalanIP</strong></div>
</header>

<section class="section">
  <h2>Form Penyewaan: <?= $iphone['nama'] ?></h2>
  <p>Harga: Rp <?= number_format($iphone['hargaPerHari'], 0, ',', '.') ?> / hari</p>

  <form method="POST">
    <label for="tglMulai">Tanggal Mulai:</label><br>
    <input type="date" name="tglMulai" required><br><br>

    <label for="tglSelesai">Tanggal Selesai:</label><br>
    <input type="date" name="tglSelesai" required><br><br>

    <button type="submit" class="btn-sewa">Lanjutkan ke Pembayaran</button>
  </form>
</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> iRentID. All rights reserved.</p>
</footer>

</body>
</html>

