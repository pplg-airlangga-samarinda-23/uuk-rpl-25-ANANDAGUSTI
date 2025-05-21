<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kader') {
    header("Location: ../index.php");
    exit();
}

include '../db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_anak = $_POST['nama_anak'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $berat_badan = $_POST['berat_badan'];
    $id_kader = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_kader FROM kader WHERE id_user = {$_SESSION['id_user']}"))['id_kader'];

    $query_bayi = "INSERT INTO bayi (nama_anak, jenis_kelamin, alamat, umur, id_kader) VALUES ('$nama_anak', '$jenis_kelamin', '$alamat', 0, $id_kader)";
    if (mysqli_query($conn, $query_bayi)) {
        $id_bayi = mysqli_insert_id($conn);
        $query_pertumbuhan = "INSERT INTO pertumbuhan (id_bayi, tanggal, berat_badan, tinggi_badan) VALUES ($id_bayi, CURDATE(), $berat_badan, $tinggi_badan)";
        mysqli_query($conn, $query_pertumbuhan);
        header("Location: index.php");
    } else {
        echo "Gagal menambah data bayi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data Bayi - Posyandu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Input Data Bayi</h2>
        <form action="tambah_bayi.php" method="POST">
            <div class="form-group">
                <label>nama bayi</label>
                <input type="text" name="nama_anak" required>
            </div>
            <div class="form-group">
                <label>alamat</label>
                <input type="text" name="alamat">
            </div>
            <div class="form-group">
                <label>jenis kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>tinggi badan</label>
                <input type="number" step="0.1" name="tinggi_badan" required>
            </div>
            <div class="form-group">
                <label>berat badan</label>
                <input type="number" step="0.1" name="berat_badan" required>
            </div>
            <div class="button-group">
                <a href="index.php" class="btn btn-back">Kembali</a>
                <button type="submit" class="btn btn-confirm">Konfirmasi</button>
            </div>
        </form>
    </div>
</body>
</html>