<?php
include 'koneksi.php';
session_start();

// Simulasi idUser dari session login
$idUser = $_SESSION["id"];

// Cek apakah user pernah sewa
$cekSewa = mysqli_query($conn, "SELECT COUNT(*) as total FROM sewa WHERE idUser = '$idUser'");
$dataSewa = mysqli_fetch_assoc($cekSewa);
$pernahSewa = $dataSewa['total'] > 0;

// Proses tambah review
if (isset($_POST["submit"]) && $pernahSewa) {
    $rating = $_POST["rating"];
    $komentar = $_POST["komentar"];
    $idSewa = $_POST["idSewa"]; // bisa pakai id sewa terakhir atau dropdown

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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Review</title>
</head>
<body>
    <h2>Review iPhone Rental</h2>

    <?php if ($pernahSewa): ?>
        <h3>Tulis Review Kamu</h3>
        <form action="" method="post">
            <label>Rating (1–5):</label><br>
            <input type="number" name="rating" min="1" max="5" required><br>

            <label>Komentar:</label><br>
            <textarea name="komentar" required></textarea><br>

            <input type="hidden" name="idSewa" value="1"> <!-- bisa ambil dari id sewa terakhir -->

            <br><input type="submit" name="submit" value="Kirim Review">
        </form>
    <?php else: ?>
        <p><strong>Hanya pengguna yang pernah sewa yang bisa menulis review.</strong></p>
    <?php endif; ?>

    <hr>

    <h3>Semua Review</h3>
    <?php
    $queryReview = mysqli_query($conn, "
        SELECT r.rating, r.komentar, r.created_at, u.nama
        FROM review r
        JOIN users u ON r.idUser = u.id
        ORDER BY r.created_at DESC
    ");

    while ($row = mysqli_fetch_assoc($queryReview)) {
        echo "<p><strong>{$row['nama']}</strong> ({$row['rating']}/5): {$row['komentar']}<br><i>{$row['created_at']}</i></p><hr>";
    }
    ?>
</body>
</html>