<?php
// AJAX ile mevcut araçları JSON olarak getirir
require 'db.php';

$vehicles = $pdo->query("SELECT * FROM vehicles WHERE available = 1")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($vehicles);

/* Açıklama: Bu dosya, AJAX çağrısıyla mevcut araçları JSON formatında döndürür. */
