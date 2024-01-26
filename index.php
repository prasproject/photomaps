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
      margin-top: 20px;
    }
  </style>
</head>
<body>

<input type="file" accept="image/*" id="fileInput" style="display: none;">
<button onclick="openFileInput()">Pilih Foto</button>

<!-- Kontainer untuk menampilkan foto -->
<div id="photo" style="display: none;">
  <img src="" alt="Photo" id="photoImage">
</div>

<div id="map"></div>

<p id="address"></p>
<p id="timestamp"></p>

<button id="downloadButton" style="display: none;" onclick="downloadImage()">Unduh Foto</button>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/image-conversion/dist/browser.js"></script>
<script>
  function openFileInput() {
    // Membuka file input ketika tombol "Pilih Foto" diklik
    document.getElementById('fileInput').click();
  }

  // Event listener untuk menangkap perubahan pada file input
  document.getElementById('fileInput').addEventListener('change', handleFileSelect);

  function handleFileSelect(event) {
    var file = event.target.files[0];

    if (file) {
      // Menampilkan foto yang dipilih
      var photoElement = document.getElementById('photo');
      var photoImage = document.getElementById('photoImage');
      photoImage.src = URL.createObjectURL(file);
      photoElement.style.display = 'block';

      // Menampilkan tombol "Unduh"
      document.getElementById('downloadButton').style.display = 'block';

      // Simpan file ke sessionStorage untuk digunakan saat pengguna mengunggah
      sessionStorage.setItem('selectedFile', JSON.stringify(file));
    }
  }

  function downloadImage() {
    // Mendapatkan file yang disimpan di sessionStorage
    var file = JSON.parse(sessionStorage.getItem('selectedFile'));

    if (file) {
      // Mengonversi dan mengunduh gambar sebagai file .jpg
      const options = {
        quality: 0.8,
        mimeType: 'image/jpeg',
      };

      convertImage(file, options)
        .then((result) => {
          // Buat objek Blob dari hasil konversi
          var blob = new Blob([result], { type: 'image/jpeg' });

          // Membuat URL objek Blob
          var url = URL.createObjectURL(blob);

          // Membuat elemen <a> untuk mengunduh
          var a = document.createElement('a');
          a.href = url;
          a.download = 'converted_image.jpg';

          // Menjalankan klik pada elemen <a>
          a.click();

          // Membersihkan URL objek Blob
          URL.revokeObjectURL(url);
        })
        .catch((error) => {
          console.error('Error converting image:', error);
        });
    }
  }
</script>

</body>
</html>
