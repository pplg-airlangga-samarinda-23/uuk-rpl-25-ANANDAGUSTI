<?php
session_start();
include 'db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: kader/index.php");
        }
    } else {
        echo "Login gagal! Username, password, atau role salah. <a href='index.php'>Kembali</a>";
    }
}
?>