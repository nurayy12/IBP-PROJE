<?php
// Oturumu sonlandırır ve giriş sayfasına yönlendirir.
session_start();
session_destroy();
header("Location: index.php");
exit();

// Açıklama: Kullanıcının oturumunu kapatır ve index.php sayfasına yönlendirir.
