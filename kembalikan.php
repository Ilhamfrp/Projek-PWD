<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['idSewa'])) {
    echo "ID sewa tidak valid.";
    exit;
}

$idSewa = $_GET['idSewa'];
$idUser = $_SESSION["id"];

$cek = mysqli_query($conn, "SELECT * FROM sewa WHERE idSewa = $idSewa AND idUser = $idUser");
if (mysqli_num_rows($cek) == 0) {
    echo "Data tidak ditemukan atau bukan milik Anda.";
    exit;
}

mysqli_query($conn, "UPDATE sewa SET status = 'returned' WHERE idSewa = $idSewa");
header("Location: riwayat_pesanan.php");
exit;
?>
