<?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION["login"]) || $_SESSION["role"] != "admin") {
        header("Location: login.php");
        exit;
    }

    // Tambah iPhone
    if (isset($_POST['tambah'])) {
        $nama = $_POST['nama'];
        $model = $_POST['model'];
        $warna = $_POST['warna'];
        $storage = $_POST['storage'];
        $hargaPerHari = $_POST['hargaPerHari'];
        $stok = $_POST['stok'];
        $gambar = $_POST['gambar'];

        $query = "INSERT INTO iphone (nama, model, warna, storage, hargaPerHari, stok, gambar) 
                VALUES ('$nama', '$model', '$warna', '$storage', '$hargaPerHari', '$stok', '$gambar')";
        mysqli_query($conn, $query);
    }

    // Hapus iPhone
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        mysqli_query($conn, "DELETE FROM iphone WHERE idIphone = $id");
        header("Location: admin_iphone.php");
        exit;
    }

    // Edit iPhone
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $model = $_POST['model'];
        $warna = $_POST['warna'];
        $storage = $_POST['storage'];
        $hargaPerHari = $_POST['hargaPerHari'];
        $stok = $_POST['stok'];
        $gambar = $_POST['gambar'];

        $query = "UPDATE iphones SET nama='$nama', model='$model', warna='$warna', storage='$storage', 
                hargaPerHari='$hargaPerHari', stok='$stok', gambar='$gambar' WHERE idIphone = $id";
        mysqli_query($conn, $query);
        header("Location: kelola_iphone.php");
        exit;
    }

    // Ambil data iPhone
    $iphones = mysqli_query($conn, "SELECT * FROM iphones");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kelola_iphone.css">
    <title>Kelola iPhone - Admin</title>
</head>
<body>
    <h2>Daftar iPhone</h2>
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Model</th><th>Warna</th><th>Storage</th><th>Harga Sewa/Hari</th><th>Stok</th><th>Gambar</th><th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($iphones)) : ?>
        <tr>
            <td><?= $row['idIphone'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['model'] ?></td>
            <td><?= $row['warna'] ?></td>
            <td><?= $row['storage'] ?></td>
            <td><?= $row['hargaPerHari'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><img src="<?= $row['gambar'] ?>" alt="Gambar iPhone" width="100"></td>            <td>
                <form style="display:inline;" method="POST">
                    <input type="hidden" name="id" value="<?= $row['idIphone'] ?>">
                    <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
                    <input type="text" name="model" value="<?= $row['model'] ?>" required>
                    <input type="text" name="warna" value="<?= $row['warna'] ?>" required>
                    <input type="text" name="storage" value="<?= $row['storage'] ?>" required>
                    <input type="number" name="hargaPerHari" value="<?= $row['hargaPerHari'] ?>" required>
                    <input type="number" name="stok" value="<?= $row['stok'] ?>" required>
                    <input type="text" name="gambar" value="<?= $row['gambar'] ?>" required>
                    <button type="submit" name="edit">Update</button>
                </form>
                <a href="?hapus=<?= $row['idIphone'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Tambah iPhone Baru</h3>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama iPhone" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="text" name="warna" placeholder="Warna" required>
        <input type="text" name="storage" placeholder="Storage" required>
        <input type="number" name="hargaPerHari" placeholder="Harga Sewa/Hari" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="text" name="gambar" placeholder="Link gambar" required>
        <button type="submit" name="tambah">Tambah</button>
    </form><br>
    <a href="admin_dashboard.php">← Kembali ke Dashboard</a>
</body>
</html>
