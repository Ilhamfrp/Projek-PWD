<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION["login"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit;
}

// Hapus user
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header("Location: kelola_users.php");
    exit;
}

// Ubah role user
if (isset($_POST['ubah_role'])) {
    $id = $_POST['id'];
    $role = $_POST['role'];
    mysqli_query($conn, "UPDATE users SET role = '$role' WHERE id = $id");
    header("Location: kelola_users.php");
    exit;
}

// Ambil data user
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data User</title>
    <link rel="stylesheet" href="kelola_users.css">
</head>
<body>
    <h1>Kelola Data User</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['nama'] ?></td>
            <td><?= $user['alamat'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td>
                <form class="inline" method="POST">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <select name="role">
                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>user</option>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
                    </select>
                    <button type="submit" name="ubah_role">Ubah</button>
                </form>
            </td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="?hapus=<?= $user['id'] ?>" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table><br>
    <a href="admin_dashboard.php">← Kembali ke Dashboard</a>
</body>
</html>