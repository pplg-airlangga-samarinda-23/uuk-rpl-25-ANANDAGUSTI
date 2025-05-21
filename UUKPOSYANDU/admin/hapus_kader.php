<?php
include '../db/koneksi.php';
$id_kader = $_GET['id'];
$query = "DELETE FROM kader WHERE id_kader = $id_kader";
mysqli_query($conn, $query);
header("Location: index.php");
?>