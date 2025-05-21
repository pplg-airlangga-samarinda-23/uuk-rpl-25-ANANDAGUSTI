<?php
include '../db/koneksi.php';
$id_bayi = $_GET['id'];
$query = "DELETE FROM bayi WHERE id_bayi = $id_bayi";
mysqli_query($conn, $query);
header("Location: index.php");
?>