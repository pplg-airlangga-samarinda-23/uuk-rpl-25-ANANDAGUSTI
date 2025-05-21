<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kader') {
    header("Location: ../index.php");
    exit();
}

include '../db/koneksi.php';
$id_bayi = $_GET['id_bayi'];
$bayi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_anak FROM bayi WHERE id_bayi = $id_bayi"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];

    $query = "INSERT INTO pertumbuhan (id_bayi, tanggal, berat_badan, tinggi_badan) VALUES ($id_bayi, '$tanggal', $berat_badan, $tinggi_badan)";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah data pertumbuhan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Catat Pertumbuhan - Posyandu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Catat Pertumbuhan untuk <?php echo $bayi['nama_anak']; ?></h2>
        <form action="catat_pertumbuhan.php?id_bayi=<?php echo $id_bayi; ?>" method="POST">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>Berat Badan (kg)</label>
                <input type="number" step="0.1" name="berat_badan" required>
            </div>
            <div class="form-group">
                <label>Tinggi Badan (cm)</label>
                <input type="number" step="0.1" name="tinggi_badan" required>
            </div>
            <div class="button-group">
                <a href="index.php" class="btn btn-back">Kembali</a>
                <button type="submit" class="btn btn-confirm">Konfirmasi</button>
            </div>
        </form>
    </div>
</body>
</html>