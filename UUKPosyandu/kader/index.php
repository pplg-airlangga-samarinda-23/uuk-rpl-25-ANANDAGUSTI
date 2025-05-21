<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kader') {
    header("Location: ../index.php");
    exit();
}

include '../db/koneksi.php';
$query = "SELECT b.*, p.tinggi_badan, p.berat_badan 
          FROM bayi b 
          LEFT JOIN pertumbuhan p ON b.id_bayi = p.id_bayi 
          WHERE b.id_kader = (SELECT id_kader FROM kader WHERE id_user = {$_SESSION['id_user']}) 
          ORDER BY p.tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Kader - Posyandu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-dashboard">
        <h2>Dashboard Kader</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>No</th>
                    <th>nama bayi</th>
                    <th>alamat</th>
                    <th>jenis kelamin</th>
                    <th>tinggi badan</th>
                    <th>berat badan</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                $no = 1;
                while ($bayi = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $bayi['nama_anak']; ?></td>
                    <td><?php echo $bayi['alamat']; ?></td>
                    <td><?php echo $bayi['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?php echo $bayi['tinggi_badan'] ?? '-'; ?> cm</td>
                    <td><?php echo $bayi['berat_badan'] ?? '-'; ?> kg</td>
                    <td class="action-buttons">
                        <a href="catat_pertumbuhan.php?id_bayi=<?php echo $bayi['id_bayi']; ?>" class="btn btn-confirm">Tambah Pertumbuhan</a>
                        <a href="hapus_bayi.php?id=<?php echo $bayi['id_bayi']; ?>" class="btn btn-back" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="button-left">
            <a href="../logout.php" class="btn btn-logout">Logout</a>
            <a href="tambah_bayi.php" class="btn btn-back">tambah data</a>
        </div>
    </div>
</body>
</html>