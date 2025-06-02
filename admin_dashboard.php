<?php
    session_start();

    // Cek apakah user login dan role-nya admin
    if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Selamat Datang, Admin <?php echo $_SESSION["nama"]; ?>!</h1>

    <ul>
        <li><a href="kelola_iphone.php">Kelola iPhone</a></li>
        <li><a href="kelola_sewa.php">Data Penyewaan</a></li>
        <li><a href="kelola_users.php">Daftar User</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
