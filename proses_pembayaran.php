<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSewa = $_POST["idSewa"];
    $jumlah = $_POST["jumlah"];
    $metode = $_POST["metode"];
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO payment (idSewa, tanggalBayar, jumlah, metode, status)
              VALUES ('$idSewa', '$tanggal', '$jumlah', '$metode', 'pending')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pembayaran tercatat! Silakan tunggu konfirmasi admin.'); </script>";
    } else {
        echo "<script>alert('Gagal menyimpan pembayaran.'); window.location='bayar.php?idSewa=$idSewa';</script>";
    }
}
?>
