<?php
include "koneksi.php";
session_start();

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    //1. ambil data dari tabel
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1){ //mysqli_num_rows => melihat brp data yg diambil dr $result
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        };
    }

    echo "<script>
            alert('username/password salah cuy!')
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <h1>Login Akun</h1>
            <label for="username">Username</label> <br>
            <input type="text" name="username" id=username> <br>
            <label for="password">Password</label> <br>
            <input type="password" name="password" id=password> <br>

            <input type="submit" value="login" name="login">
        </form>

        <div>
            Belum punya akun? <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
