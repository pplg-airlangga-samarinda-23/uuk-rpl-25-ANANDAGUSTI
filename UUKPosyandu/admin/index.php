<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

include '../db/koneksi.php';
$query = "SELECT * FROM kader";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Posyandu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-dashboard">
        <h2>Dashboard Admin</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Kader</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                $no = 1;
                while ($kader = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $kader['nama_kader']; ?></td>
                    <td><?php echo $kader['alamat'] ?? '-'; ?></td>
                    <td><?php echo $kader['telepon'] ?? '-'; ?></td>
                    <td class="action-buttons">
                        <a href="hapus_kader.php?id=<?php echo $kader['id_kader']; ?>" class="btn btn-back" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="button-left">
            <a href="../logout.php" class="btn btn-logout">Logout</a>
            <a href="tambah_kader.php" class="btn btn-navy">Tambah Kader</a>
        </div>
    </div>
</body>
</html>