<?php
include "koneksi.php";

if(isset($_POST["register"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $phone = $_POST["phone"];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="register.css">
    <title>Daftar Akun</title>
</head>

<body>
<div class="container register-container" style="max-width: 900px; margin-top: 50px;">
    <h1 class="text-center">Registrasi Akun</h1>
    <p class="text-center">Silakan masukkan data Anda</p>

    <form action="" method="post" class="row g-3">
        <div class="col-md-6">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama">
        </div>

        <div class="col-md-6">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
        </div>

        <div class="col-md-6">
            <label for="phone">No. HP</label>
            <input type="text" class="form-control" name="phone" id="phone">
        </div>

        <div class="col-md-6">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>

        <div class="col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="col-md-6">
            <label for="password2">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password2" id="password2">
        </div>

        <div class="col-12 text-center mt-3">
            <input type="submit" class="btn btn-primary" value="Register" name="register">
        </div>
    </form>
</div>


</body>
</html>
