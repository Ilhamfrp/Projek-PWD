<?php
include 'koneksi.php';
session_start();

$idUser = $_SESSION["id"];

$cekSewa = mysqli_query($conn, "SELECT COUNT(*) as total FROM sewa WHERE idUser = '$idUser'");
$dataSewa = mysqli_fetch_assoc($cekSewa);
$pernahSewa = $dataSewa['total'] > 0;

if (isset($_POST["submit"]) && $pernahSewa) {
    $rating = $_POST["rating"];
    $komentar = $_POST["komentar"];
    $idSewa = $_POST["idSewa"];

    $cekReview = mysqli_query($conn, "SELECT * FROM review WHERE idSewa = '$idSewa' AND idUser = '$idUser'");
    if (mysqli_num_rows($cekReview) > 0) {
        echo "<script>alert('Kamu sudah memberikan review untuk sewa ini.')</script>";
    } else {
        $query = "INSERT INTO review (idUser, idSewa, rating, komentar)
                  VALUES ('$idUser', '$idSewa', '$rating', '$komentar')";
        $q = mysqli_query($conn, $query);

        if ($q) {
            header("Location: review.php");
            exit();
        } else {
            echo "Gagal menambahkan review: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Review</title>
    <style>
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background-color: #0f0f0f;
      color: white; ;
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
      text-decoration: underline;text-decoration: underline;
    }
    h2, h3 {
      margin-top: 30px;
      text-align: center;
    }
    form {
      max-width: 600px;
      margin: 20px auto;
      background-color: #1a1a1a;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(255,255,255,0.05);
    }
    select, textarea, input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      background-color: #222;
      color: white;
    }
    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .review-box {
      background: #1a1a1a;
      border-radius: 8px;
      padding: 1em 1.5em;
      margin: 20px auto;
      box-shadow: 0 2px 8px rgba(255,255,255,0.05);
      max-width: 600px;
    }
    .review-box strong {
      font-size: 1.1em;
    }
    .review-box i {
      font-size: 0.85em;
      color: #999;
    }
    p {
      text-align: center;
      margin-top: 2em;
    }
    </style>
</head>
<body>
<header class="navbar">
  <div><strong>RentalanIP</strong></div>
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
</header>

<h2>Review iPhone Rental</h2>

<?php if ($pernahSewa): ?>
    <h3>Tulis Review Kamu</h3>
    <form action="" method="post">
        <label>Pilih iPhone yang Kamu Sewa:</label>
        <select name="idSewa" required>
          <option value="">-- Pilih iPhone --</option>
          <?php
          $res = mysqli_query($conn, "SELECT s.idSewa, i.nama
                                      FROM sewa s
                                      JOIN iphones i ON s.idIphone = i.idIphone
                                      WHERE s.idUser = '$idUser'");
          while ($row = mysqli_fetch_assoc($res)) {
              echo "<option value='{$row['idSewa']}'>{$row['nama']}</option>";
          }
          ?>
        </select>

        <label>Rating (1–5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label>Komentar:</label>
        <textarea name="komentar" required></textarea>

        <input type="submit" name="submit" value="Kirim Review">
    </form>
<?php else: ?>
    <p><strong>Hanya pengguna yang pernah sewa yang bisa menulis review.</strong></p>
<?php endif; ?>

<hr>

<h3>Semua Review</h3>
<?php
$queryReview = mysqli_query($conn, "
    SELECT r.rating, r.komentar, r.created_at, u.nama, i.nama as iphone
    FROM review r
    JOIN users u ON r.idUser = u.id
    JOIN sewa s ON r.idSewa = s.idSewa
    JOIN iphones i ON s.idIphone = i.idIphone
    ORDER BY r.created_at DESC
");

while ($row = mysqli_fetch_assoc($queryReview)) {
    $stars = str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']);
    echo "<div class='review-box'><strong>{$row['nama']}</strong> - {$row['iphone']}<br>Rating: $stars<br>{$row['komentar']}<br><i>{$row['created_at']}</i></div>";
}
?>
</body>
</html>
