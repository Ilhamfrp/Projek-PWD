<?php
include "koneksi.php";

if(isset($_POST["register"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $alamat = $_POST["phone"];
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    //cek apakah password dan konfirmasi password sama
    if($password != $password2){
        echo "<script>
            alert('input password tidak sesuai')
        </script>";
    } else {
        //misalnya bener kita masukin ke database

        //enkripsi
        $password = password_hash($password, PASSWORD_DEFAULT);

        //masukin ke database
        $query = "INSERT INTO users (nama, alamat, phone, username, password, role) VALUES ('$nama', '$alamat', '$phone', '$username', '$password', 'user')";
        $q = mysqli_query($conn, $query);

        if($q){
            echo "<script>
            alert('Pembuatan akun berhasil!')
            </script>";
            header("Location: login.php");
        } else {
            echo "<script>
            alert('Pembuatan akun gagal.')
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Daftar Akun</title>
</head>
<body>
    <div class="register-container">
        <form action="" method="post">
            <h1>Registrasi Akun</h1> <br>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id=nama> <br>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id=alamat> <br>

            <label for="alamat">No. HP</label>
            <input type="text" name="nohp" id=nohp> <br>

            <label for="username">Username</label>
            <input type="text" name="username" id=username> <br>

            <label for="password">Password</label>
            <input type="password" name="password" id=password> <br>

            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id=password2> <br>

            <input type="submit" value="register" name="register">
        </form>
    </div>
</body>
</html>
