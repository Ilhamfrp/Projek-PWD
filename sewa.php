<?php
    include 'koneksi.php';
    session_start();

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    //ngambil dr table
    $query = mysqli_query($conn, "SELECT * FROM users");
?>
