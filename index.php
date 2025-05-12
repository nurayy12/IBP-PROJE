<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
require 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "Giriş başarısız. Lütfen bilgileri kontrol edin.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="E-posta" required><br>
        <input type="password" name="password" placeholder="Şifre" required><br>
        <button type="submit">Giriş</button>
    </form>
    <p style="color:red;">
        <?= $msg ?>
    </p>
    <p>Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
</body>
</html>
