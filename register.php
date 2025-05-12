<?php
// Kullanıcı kayıt işlemlerini gerçekleştirir.
require 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        $msg = "Başarıyla kayıt oldunuz. Giriş yapabilirsiniz.";
    } else {
        $msg = "Kayıt başarısız. Bu e-posta zaten kayıtlı olabilir.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Ad Soyad" required><br>
        <input type="email" name="email" placeholder="E-posta" required><br>
        <input type="password" name="password" placeholder="Şifre" required><br>
        <button type="submit">Kayıt Ol</button>
    </form>
    <p style="color:green;">
        <?= $msg ?>
    </p>
    <p>Hesabınız varsa <a href="index.php">Giriş yapın</a></p>
</body>
</html>

<!-- Açıklama: Bu dosya kullanıcıdan ad, e-posta ve şifre alır. Şifreyi hashleyerek veritabanına ekler. Başarılıysa kullanıcıya mesaj gösterir. -->
