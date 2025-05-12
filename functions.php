<?php
// Oturum başlatılmamışsa başlat
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kullanıcı doğrulaması
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: rented_vehicles.php");
        exit();
    }
}
?>
