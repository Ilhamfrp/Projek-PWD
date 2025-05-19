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
    label {
      display: block;
      margin-top: 1em;
      font-size: 0.95em;
    }
    input[type="date"] {
      width: 100%;
      padding: 0.6em;
      margin-top: 0.5em;
      border: none;
      border-radius: 6px;
      font-size: 0.95em;
    }
    .btn-sewa {
      margin-top: 1.5em;
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
  <h2>Form Penyewaan: <?= $iphone['nama'] ?></h2>
  <p>Harga: Rp <?= number_format($iphone['hargaPerHari'], 0, ',', '.') ?> / hari</p>

  <form method="POST">
    <label for="tglMulai">Tanggal Mulai:</label>
    <input type="date" name="tglMulai" required>

    <label for="tglSelesai">Tanggal Selesai:</label>
    <input type="date" name="tglSelesai" required>

    <button type="submit" class="btn-sewa">Lanjutkan ke Pembayaran</button>
  </form>
</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> RentalanIP. All rights reserved.</p>
</footer>

</body>
</html>
