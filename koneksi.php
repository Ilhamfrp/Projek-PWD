<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "rental_ip";

    $conn = mysqli_connect($host, $user, $password, $db); //buat konek ke db

    if ($conn->connect_error) {
        die('Maaf, koneksi gagal: ' . $conn->connect_error);
    }
?>