<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Posyandu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login Admin</h2>
        <form action="login.php" method="POST">
            <input type="hidden" name="role" value="admin">
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
                <button type="submit" class="btn btn-admin">Masuk</button>
            </div>
        </form>
    </div>
</body>
</html>