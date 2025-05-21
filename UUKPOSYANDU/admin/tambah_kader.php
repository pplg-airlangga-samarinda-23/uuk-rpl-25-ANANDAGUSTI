<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

include '../db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kader = $_POST['nama_kader'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $query_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'kader')";
    if (mysqli_query($conn, $query_user)) {
        $id_user = mysqli_insert_id($conn);
        $query_kader = "INSERT INTO kader (nama_kader, alamat, telepon, id_user) VALUES ('$nama_kader', '$alamat', '$telepon', $id_user)";
        if (mysqli_query($conn, $query_kader)) {
            header("Location: index.php");
        } else {
            echo "Gagal menambah data kader.";
        }
    } else {
        echo "Gagal menambah data user.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kader - Posyandu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Kader Baru</h2>
        <form action="tambah_kader.php" method="POST">
            <div class="form-group">
                <label>Nama Kader</label>
                <input type="text" name="nama_kader" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat">
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="button-group">
                <a href="index.php" class="btn btn-back">Kembali</a>
                <button type="submit" class="btn btn-confirm">Konfirmasi</button>
            </div>
        </form>
    </div>
</body>
</html>