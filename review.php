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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="review.css">
    <title>Halaman Review</title>
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