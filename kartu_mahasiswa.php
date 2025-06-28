<?php
include('config.php');

// Ambil data mahasiswa berdasarkan NPM dari parameter GET
$npm = $_GET['npm'] ?? '';

$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm = '$npm'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Kartu Mahasiswa</title>
  <style>
    .kartu {
      width: 350px;
      border: 2px solid black;
      padding: 20px;
      font-family: Arial;
    }
    .judul {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
    }
    .isi {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="kartu">
    <div class="judul">Kartu Mahasiswa</div>
    <div class="isi">
      <p><strong>NPM:</strong> <?= $data['npm'] ?></p>
      <p><strong>Nama:</strong> <?= $data['nama'] ?></p>
      <p><strong>Fakultas:</strong> <?= $data['fakultas'] ?></p>
      <p><strong>Prodi:</strong> <?= $data['prodi'] ?></p>
      <p><strong>Alamat:</strong> <?= $data['alamat'] ?></p>
      <p><strong>Telepon:</strong> <?= $data['telepon'] ?></p>
    </div>
  </div>
</body>
</html>
