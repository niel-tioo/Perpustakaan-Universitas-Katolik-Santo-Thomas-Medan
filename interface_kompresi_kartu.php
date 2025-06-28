<?php
$page = $_GET['page'] ?? 'form';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kartu Perpustakaan - RLE</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #d0f0ff, #ffffff);
  margin: 0;
  padding: 0;
  }

    nav {
      background-color:rgb(3, 129, 255);
      padding: 15px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    nav a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
    }

    nav a:hover {
      color: #f39c12;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color:rgb(0, 157, 255);
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    form input, form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #bdc3c7;
      border-radius: 6px;
    }

    button {
      background-color: #2980b9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }

    button:hover {
      background-color: #1e6fa1;
    }

    .card {
      background: #f9f9f9;
      border-left: 5px solid #2980b9;
      padding: 15px;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    .card a {
      text-decoration: none;
      color: #2980b9;
      font-weight: bold;
    }

    .kartu {
      background: linear-gradient(to right,rgb(171, 229, 249), #3498db);
      color: white;
      border-radius: 16px;
      padding: 30px;
      width: 100%;
      max-width: 600px;
      margin: 30px auto;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      position: relative;
      overflow: hidden;
    }

    .kartu::after {
      content: '';
      background: url('UNIKA.png') no-repeat center center;
      background-size: 300px;
      opacity: 0.5;
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
    }

    .judul-kartu {
      font-weight: bold;
      font-size: 24px;
      margin-bottom: 25px;
      color: #fff;
      position: relative;
      z-index: 1;
      text-align: center;
    }

    .judul-kartu img {
      position: absolute;
      top: -10px;
      left: 0;
      width: 65px;
      height: 70px;
    }

    .konten-kartu {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 1;
    }

    .konten-kartu img {
      width: 120px;
      height: 160px;
      object-fit: cover;
      border-radius: 10px;
      border: 3px solid #fff;
      box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }

    .data {
      flex-grow: 1;
    }

    .data-item {
      margin-bottom: 10px;
      font-size: 16px;
    }

    .data-item b {
      width: 130px;
      display: inline-block;
      color:rgb(255, 255, 255);
    }

    @media screen and (max-width: 600px) {
      .konten-kartu {
        flex-direction: column;
      }

      .container {
        width: 95%;
        padding: 15px;
      }

      form input, form select, button {
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

<nav>
  <a href="?page=form">Form Pendaftaran</a>
  <a href="?page=dashboard">Dashboard Admin</a>
  <a href="?page=kartu&npm=12345">Contoh Kartu</a>
  <a href="#" onclick="document.getElementById('modalHelp').style.display='block'">Help</a>
</nav>

<div class="container">
<?php if ($page === 'form'): ?>
  <h2>Form Pendaftaran Mahasiswa</h2>
  <form action="simpan_pendaftaran.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <label>NPM:</label>
    <input type="text" name="npm" required>

    <label>Nama Lengkap:</label>
    <input type="text" name="nama" required>

    <label>Fakultas:</label>
    <select name="fakultas" required>
      <option value="">-- Pilih Fakultas --</option>
      <option value="Ilmu Komputer">Ilmu Komputer</option>
      <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
      <option value="Ilmu dan Budaya">Ilmu dan Budaya</option>
      <option value="Teknik">Teknik</option>
      <option value="Hukum">Hukum</option>
      <option value="Pertanian">Pertanian</option>
      <option value="Keguruan & Ilmu Pendidikan">Keguruan & Ilmu Pendidikan</option>
      <option value="Filsafat">Filsafat</option>
    </select>

    <label>Program Studi:</label>
    <select name="prodi" required>
      <option value="">-- Pilih Program Studi --</option>
      <option value="Sistem Informasi">Sistem Informasi</option>
      <option value="Teknik Informatika">Teknik Informatika</option>
      <option value="Sains Data">Sains Data</option>
      <option value="Manajemen">Manajemen</option>
      <option value="Akuntansi">Akuntansi</option>
      <option value="Sastra Inggris">Sastra Inggris</option>
      <option value="Sastra Indonesia">Sastra Indonesia</option>
      <option value="Teknik Sipil">Teknik Sipil</option>
      <option value="Arsitektur">Arsitektur</option>
      <option value="Ilmu Hukum">Ilmu Hukum</option>
      <option value="Agroteknologi">Agroteknologi</option>
      <option value="Agribisnis">Agribisnis</option>
      <option value="Pendidikan Guru Sekolah Dasar">Pendidikan Guru Sekolah Dasar</option>
      <option value="Pendidikan Bahasa Indonesia">Pendidikan Bahasa Indonesia</option>
      <option value="Pendidikan Matematika">Pendidikan Matematika</option>
    </select>

    <label>Alamat:</label>
    <input type="text" name="alamat" required>

    <label>No Telepon:</label>
    <input type="tel" name="no_telp" required>

    <label>Upload Foto (jpg/png):</label>
    <input type="file" name="foto" id="foto" accept="image/png, image/jpeg" required>
    <div style="margin-top:10px;">
    <img id="preview" src="#" alt="Preview Foto" style="display:none; width:120px; height:160px; border:2px solid #ccc; border-radius:5px; object-fit:cover;">
    </div>
    <button type="submit">Daftar</button>
  </form>
<?php elseif ($page === 'dashboard'): ?>
  <h2>Data Mahasiswa Terdaftar</h2>
  <?php
    include('config.php');
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<b>NPM:</b> {$row['npm']}<br>";
        echo "<b>Nama:</b> {$row['nama']}<br>";
        echo "<a href='interface_kompresi_kartu.php?page=kartu&npm={$row['npm']}'>Buat Kartu</a>";
        echo "</div>";
    }
  ?>
<?php elseif ($page === 'kartu' && isset($_GET['npm'])): ?>
  <?php
    include('config.php');
    $npm = $_GET['npm'];
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='$npm'");
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
  ?>
  <div class="kartu">
    <div class="judul-kartu">
      <img src="UNIKA.png" alt="Logo Universitas">
      <div>Perpustakaan<br>Universitas Katolik Santo Thomas</div>
    </div>
    <div class="konten-kartu">
      <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Mahasiswa">
      <div class="data">
        <div class="data-item"><b>NPM</b>: <?= htmlspecialchars($data['npm']) ?></div>
        <div class="data-item"><b>Nama</b>: <?= htmlspecialchars($data['nama']) ?></div>
        <div class="data-item"><b>Program Studi</b>: <?= htmlspecialchars($data['prodi']) ?></div>
        <div class="data-item"><b>Fakultas</b>: <?= htmlspecialchars($data['fakultas']) ?></div>
        <div class="data-item"><b>Alamat</b>: <?= htmlspecialchars($data['alamat']) ?></div>
        <div class="data-item"><b>No. Telepon</b>: <?= htmlspecialchars($data['no_telp']) ?></div>
      </div>
    </div>
  </div>
  <form action="kompresi_kartu.php" method="post" style="text-align: center;">
    <input type="hidden" name="npm" value="<?= htmlspecialchars($data['npm']) ?>">
    <button type="submit">Kompresi & Simpan</button>
  </form>
  <?php } else {
    echo "<p style='color:red;'>Data tidak ditemukan untuk NPM tersebut.</p>";
  } ?>
<?php else: ?>
  <p>Halaman tidak ditemukan.</p>
<?php endif; ?>
</div>

<script>
  const fotoInput = document.getElementById('foto');
  const preview = document.getElementById('preview');

  fotoInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = '#';
      preview.style.display = 'none';
    }
  });

  const urlParams = new URLSearchParams(window.location.search);
  const success = urlParams.get('success');
  if (success === '1') {
    alert('Pendaftaran berhasil!');
  }
</script>

<div id="modalHelp" style="
  display:none;
  position:fixed;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background:rgba(0,0,0,0.5);
  z-index:999;
  overflow:auto;
">
  <div style="
    background:white;
    width:90%;
    max-width:700px;
    margin:60px auto;
    padding:30px;
    border-radius:10px;
    position:relative;
    font-family:'Poppins', sans-serif;
    color:#2c3e50;
    max-height:90vh;
    overflow-y:auto;
  ">
    <span onclick="document.getElementById('modalHelp').style.display='none'" style="position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer;">&times;</span>
    <h3 style="margin-top:0; color:#2980b9;">📘 Tentang Program & Algoritma</h3>

    <p><strong>🔍 Apa itu Run Length Encoding (RLE)?</strong></p>
    <p>
      Run Length Encoding (RLE) adalah salah satu teknik kompresi data paling sederhana dan efisien untuk data yang memiliki banyak pengulangan.
      RLE bekerja dengan cara menggantikan urutan karakter yang sama dan berulang secara berturut-turut dengan satu karakter dan jumlah kemunculannya.
      Teknik ini sangat cocok digunakan pada data gambar atau teks yang memiliki pola berulang seperti warna solid atau karakter berurutan.
    </p>
    <p>
      Sebagai contoh, string: <code>AAAAABBBBCCCCCD</code> akan dikompresi menjadi <code>5A4B5C1D</code>. 
      Hal ini menghemat ruang penyimpanan karena kita hanya menyimpan jumlah dan jenis karakter, bukan seluruh karakter satu per satu.
    </p>

    <p><strong>⚙️ Alur Kerja Algoritma RLE:</strong></p>
    <ol>
      <li>Membaca data dari awal hingga akhir secara berurutan.</li>
      <li>Ketika ditemukan karakter pertama, algoritma akan mulai menghitung berapa kali karakter itu muncul secara berturut-turut.</li>
      <li>Begitu karakter berubah, algoritma mencatat jumlah pengulangan karakter sebelumnya dan karakter tersebut.</li>
      <li>Langkah ini diulang hingga semua karakter dalam data selesai diproses.</li>
      <li>Hasil akhirnya adalah deretan angka dan karakter, yang menunjukkan berapa kali masing-masing karakter muncul secara berurutan.</li>
    </ol>
    <p>
      Proses ini tidak hanya mempercepat pengiriman data dan efisiensi penyimpanan, tetapi juga mudah untuk didekode ulang kembali menjadi bentuk aslinya.
    </p>

    <hr style="margin: 25px 0;">

    <p><strong>👤 Data Penulis Program:</strong></p>
    <ul style="line-height: 1.8;">
      <li><b>1. Daniel Silaban</b> — Universitas Katolik Santo Thomas Medan</li>
      <li><b>2. Cantriya Simbolon</b> — Universitas Katolik Santo Thomas Medan</li>
      <li><b>3. Paulina Gorat</b> — Universitas Katolik Santo Thomas Medan</li>
      <li><b>4. Gracia Simatupang</b> — Universitas Katolik Santo Thomas Medan</li>
    </ul>
  </div>
</div>

<script>
  window.onclick = function(event) {
    const modal = document.getElementById('modalHelp');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>


</body>
</html>
