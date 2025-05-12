<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Canlı Araç Listesi</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('ajax_get_vehicles.php')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById("vehicle-list");
                    if (data.length === 0) {
                        list.innerHTML = "Mevcut araç yok.";
                    } else {
                        data.forEach(vehicle => {
                            const item = document.createElement("div");
                            item.classList.add("vehicle-box");
                            item.innerHTML = `<strong>${vehicle.brand}</strong> - ${vehicle.model} (${vehicle.price}₺)`;
                            list.appendChild(item);
                        });
                    }
                });
        });
    </script>
    <style>
        .vehicle-box {
            background: white;
            padding: 10px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h2>Mevcut Araçlar (AJAX)</h2>
    <div id="vehicle-list">Yükleniyor...</div>
    <p><a href="dashboard.php">Geri Dön</a></p>
</body>
</html>

<!-- Açıklama: Bu sayfa, AJAX ile mevcut araçları canlı olarak listeler. Sayfa yenilenmeden veri yüklenir. -->
