<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery with Maps</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map {
      height: 300px;
    }
  </style>
</head>
<body>

<?php
// Simulasi data foto
$photo = array(
    'image' => 'path/to/your/photo.jpg',
    'address' => 'Jalan Contoh No. 123, Kota Contoh',
    'latitude' => -6.2088,
    'longitude' => 106.8456,
    'timestamp' => '2024-01-26 12:34:56'
);
?>

<img src="<?php echo $photo['image']; ?>" alt="Photo">

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  // Menyiapkan peta
  var map = L.map('map').setView([<?php echo $photo['latitude']; ?>, <?php echo $photo['longitude']; ?>], 13);

  // Menambahkan peta OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Menambahkan marker pada peta
  L.marker([<?php echo $photo['latitude']; ?>, <?php echo $photo['longitude']; ?>]).addTo(map);

  // Menambahkan informasi alamat di bawah foto
  var addressElement = document.createElement('p');
  addressElement.textContent = '<?php echo $photo['address']; ?>';
  document.body.appendChild(addressElement);

  // Menambahkan informasi waktu di bawah foto
  var timestampElement = document.createElement('p');
  timestampElement.textContent = 'Taken at: <?php echo $photo['timestamp']; ?>';
  document.body.appendChild(timestampElement);
</script>

</body>
</html>
