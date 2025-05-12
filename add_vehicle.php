<?php
// Yöneticiler için araç ekleme sayfası
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require 'db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO vehicles (brand, model, price, available) VALUES (?, ?, ?, 1)");
    if ($stmt->execute([$brand, $model, $price])) {
        $msg = "Araç başarıyla eklendi.";
    } else {
        $msg = "Araç eklenirken hata oluştu.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Araç Ekle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Araç Ekle</h2>
    <?php if ($msg): ?>
        <p style="color:green;"> <?= $msg ?> </p>
    <?php endif; ?>

    <form method="POST">
        <label>Marka:</label>
        <input type="text" name="brand" required><br>
        <label>Model:</label>
        <input type="text" name="model" required><br>
        <label>Fiyat (₺):</label>
        <input type="number" step="0.01" name="price" required><br>
        <button type="submit">Araç Ekle</button>
    </form>
    <p><a href="dashboard.php">Geri Dön</a></p>
</body>
</html>

<!-- Açıklama: Bu sayfa, yeni araçları veritabanına eklemek için kullanılır. Giriş yapan kullanıcılar araç bilgilerini girerek sisteme yeni araç ekleyebilir. -->
