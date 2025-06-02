<?php
    session_start();
    include "koneksi.php";

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        // ambil data dari tabel
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        if (mysqli_num_rows($result) == 1){ //mysqli_num_rows => melihat brp data yg diambil dr $result
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["nama"] = $row["nama"];
                $_SESSION["role"] = $row["role"];
                
                // Arahkan sesuai role
                if ($row["role"] == "admin") {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: sewa.php");
                }
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
            <h1>Login Akun</h1> <br>
            <label for="username">Username</label>
            <input type="text" name="username" id=username placeholder="Masukkan username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id=password placeholder="Masukkan password" required> <br><br>

            <input type="submit" value="login" name="login">
        </form> <br>

        <div>
            Belum punya akun? <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
