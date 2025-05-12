<?php
// Giriş yapan kullanıcılar için karşılama sayfası.
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kontrol Paneli</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Hoş geldiniz, <?= $_SESSION['name'] ?>!</h1>
    <p><a href="rentals.php">Araç Kiralama</a> | <a href="logout.php">Çıkış Yap</a></p>
    <p><a href="rented_vehicles.php" class="btn-primary">Kiralama Geçmişim</a></p>
   
</body>
</html>

<!-- Açıklama: Giriş yapan kullanıcıya hoş geldiniz mesajı ve yönlendirme bağlantıları gösterilir. -->
