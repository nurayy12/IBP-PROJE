<?php
// Oturumu başlat
require 'functions.php'; // Fonksiyon dosyasını dahil et
check_login(); 
require 'db.php';

if (isset($_GET['delete_rental_id'])) {
    $delete_id = $_GET['delete_rental_id'];

    // Güvenlik: sadece kendi kiralamasını silebilsin
    $stmt = $pdo->prepare("DELETE FROM rentals WHERE id = ? AND user_id = ?");
    $stmt->execute([$delete_id, $user_id]);

    // Silme işleminden sonra tekrar sayfaya yönlendir
    header("Location: rented_vehicles.php");
    exit();
}



$user_id = $_SESSION['user_id']; // Oturumdaki kullanıcının ID'si

$stmt = $pdo->prepare("
    SELECT r.id AS rental_id, v.brand, v.model, v.price, r.rent_date, r.return_date
    FROM rentals r
    JOIN vehicles v ON r.vehicle_id = v.id
    WHERE r.user_id = ?
    ORDER BY r.rent_date DESC
");
$stmt->execute([$user_id]);
$rentals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kiralama Geçmişim</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kiralama Geçmişim</h2>
     <?php if (count($rentals) > 0): ?>
        <?php foreach ($rentals as $rental): ?>
            <div class="vehicle-box">
                <h3><?= htmlspecialchars($rental['brand'] . ' ' . $rental['model']) ?></h3>
                <p><strong>Fiyat:</strong> <?= $rental['price'] ?> ₺</p>
                <p><strong>Kiralanma Tarihi:</strong> <?= $rental['rent_date'] ?></p>
                <p><strong>İade Tarihi:</strong> <?= $rental['return_date'] ?? 'Henüz İade Edilmedi' ?></p>
                <a href="rented_vehicles.php?delete_rental_id=<?= $rental['rental_id'] ?>" 
                onclick="return confirm('Bu kiralamayı silmek istediğinize emin misiniz?');" 
                class="btn-delete">Sil</a>

            
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Henüz kiraladığınız bir araç bulunmamaktadır.</p>
    <?php endif; ?>

    <div style="text-align:center; margin-top:20px;">
        <a href="index.php" class="btn-primary">Ana Sayfaya Dön</a>
    </div>
   
</body>
</html>