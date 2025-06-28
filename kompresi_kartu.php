<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);
ini_set('display_errors', 1);
include('config.php');

// Validasi NPM
if (!isset($_POST['npm']) || empty($_POST['npm'])) {
    exit("NPM tidak ditemukan.");
}

$npm = mysqli_real_escape_string($conn, $_POST['npm']);
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm = '$npm'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    exit("Data mahasiswa tidak ditemukan.");
}

$foto_nama = $data['foto'];
$foto_path = "uploads/" . $foto_nama;

if (!file_exists($foto_path)) {
    exit("Foto tidak ditemukan: $foto_path");
}

$output_folder = "compressed";
if (!is_dir($output_folder)) {
    mkdir($output_folder, 0777, true);
}

$width = 850;
$height = 500;
$font_path = __DIR__ . "/fonts/Tinos-Bold.ttf";

if (!file_exists($font_path)) {
    exit("Font Tinos-Bold tidak ditemukan. Harap letakkan Tinos-Bold.ttf di folder fonts/");
}

$image = imagecreatetruecolor($width, $height);

// Gradasi latar belakang horizontal (kiri ke kanan)
for ($x = 0; $x < $width; $x++) {
    $r = 171 + (($x / $width) * (52 - 171));
    $g = 229 + (($x / $width) * (152 - 229));
    $b = 249 + (($x / $width) * (219 - 249));
    $color = imagecolorallocate($image, intval($r), intval($g), intval($b));
    imageline($image, $x, 0, $x, $height, $color);
}

$white = imagecolorallocate($image, 255, 255, 255);

// Watermark tengah transparan (25% opacity)
$bg_logo_path = 'UNIKA.png';
if (file_exists($bg_logo_path)) {
    $bg_logo = imagecreatefrompng($bg_logo_path);
    imagealphablending($image, true);
    imagesavealpha($image, true);

    $logo_w = 400;
    $logo_h = 400;

    $tmp = imagecreatetruecolor($logo_w, $logo_h);
    imagealphablending($tmp, false);
    imagesavealpha($tmp, true);
    $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
    imagefill($tmp, 0, 0, $transparent);
    imagecopyresampled($tmp, $bg_logo, 0, 0, 0, 0, $logo_w, $logo_h, imagesx($bg_logo), imagesy($bg_logo));

    // Set opacity 25%
    for ($x = 0; $x < $logo_w; $x++) {
        for ($y = 0; $y < $logo_h; $y++) {
            $rgba = imagecolorat($tmp, $x, $y);
            $alpha = ($rgba & 0x7F000000) >> 24;
            $new_alpha = min(127, intval($alpha + (127 - $alpha) * 0.75));
            $rgb = $rgba & 0xFFFFFF;
            $new_color = imagecolorallocatealpha(
                $tmp,
                ($rgb >> 16) & 0xFF,
                ($rgb >> 8) & 0xFF,
                $rgb & 0xFF,
                $new_alpha
            );
            imagesetpixel($tmp, $x, $y, $new_color);
        }
    }

    $pos_x = intval(($width - $logo_w) / 2);
    $pos_y = intval(($height - $logo_h) / 2);
    imagecopy($image, $tmp, $pos_x, $pos_y, 0, 0, $logo_w, $logo_h);
    imagedestroy($tmp);
    imagedestroy($bg_logo);
}

// Logo kecil pojok kiri atas
$logo_path = 'UNIKA.png';
if (file_exists($logo_path)) {
    $logo = imagecreatefrompng($logo_path);
    imagecopyresampled($image, $logo, 30, 10, 0, 0, 100, 100, imagesx($logo), imagesy($logo));
    imagedestroy($logo);
}

// Fungsi teks tengah
function title_center($img, $font, $size, $y, $color, $text) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = intval((imagesx($img) - $text_width) / 2);
    imagettftext($img, $size, 0, $x, intval($y), $color, $font, $text);
}

// Judul kartu
$title1 = "Perpustakaan";
$title2 = "Universitas Katolik Santo Thomas";
title_center($image, $font_path, 28, 40, $white, $title1);
title_center($image, $font_path, 26, 80, $white, $title2);

// Foto mahasiswa
$foto = null;
$ext = strtolower(pathinfo($foto_path, PATHINFO_EXTENSION));
switch ($ext) {
    case 'jpg':
    case 'jpeg':
        $foto = imagecreatefromjpeg($foto_path);
        break;
    case 'png':
        $foto = imagecreatefrompng($foto_path);
        break;
    case 'webp':
        $foto = imagecreatefromwebp($foto_path);
        break;
    default:
        exit("Format foto tidak didukung.");
}

if ($foto) {
    $foto_width = 180;
    $foto_height = 240;
    imagecopyresampled($image, $foto, 80, 180, 0, 0, $foto_width, $foto_height, imagesx($foto), imagesy($foto));
}

// Data mahasiswa
$nama     = $data['nama']     ?? '-';
$prodi    = $data['prodi']    ?? '-';
$fakultas = $data['fakultas'] ?? '-';
$alamat   = $data['alamat']   ?? '-';
$no_telp  = $data['no_telp']  ?? '-';

$x_text = 300;
$y_text = 200;
$line_height = 40;

imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "NPM           : " . $data['npm']); $y_text += $line_height;
imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "Nama          : " . $nama); $y_text += $line_height;
imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "Program Studi : " . $prodi); $y_text += $line_height;
imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "Fakultas      : " . $fakultas); $y_text += $line_height;
imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "Alamat        : " . $alamat); $y_text += $line_height;
imagettftext($image, 18, 0, $x_text, $y_text, $white, $font_path, "No. Telepon   : " . $no_telp);

// Simpan gambar
$nama_file = "kartu_perpustakaan_" . $data['npm'] . ".jpg";
$output_path = $output_folder . "/" . $nama_file;
imagejpeg($image, $output_path, 50);

// Hitung kompresi
$original_size = filesize($foto_path);
$compressed_size = filesize($output_path);
$compression_percentage = ($original_size > 0)
    ? round((1 - ($compressed_size / $original_size)) * 100, 2)
    : 0;

function formatSize($bytes) {
    return round($bytes / 1024, 2) . ' KB';
}

// Bersihkan
imagedestroy($image);
if ($foto) imagedestroy($foto);

// CSS Tambahan
echo "<style>
    body {
        background: linear-gradient(to right, #e0f7fa, #fff);
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-top: 30px;
    }
    p {
        text-align: center;
        font-size: 16px;
        color: #333;
    }
    .card-preview {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    img {
        max-width: 50%;
        height: auto;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        border-radius: 12px;
        border: 4px solid #3498db;
    }
    .info-box {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px 30px;
        margin: 30px auto;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
        color: #333;
    }
    .info-box h3 {
        margin-top: 0;
        color: #2980b9;
        border-bottom: 2px solid #2980b9;
        padding-bottom: 5px;
    }
    .info-box p {
        margin: 10px 0;
        font-size: 15px;
    }
    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
        color: #0077cc;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    a:hover {
        color: #005fa3;
    }
</style>";

// Tampilkan hasil
echo "<h2>Kartu perpustakaan berhasil dibuat & disimpan!</h2>";
echo "<p>Lokasi file: <code>$output_path</code></p>";
echo "<div class='card-preview'><img src='$output_path' alt='Kartu Perpustakaan'></div>";
echo "<div class='info-box'>
    <h3>Informasi Kompresi:</h3>
    <p><strong>Ukuran Asli:</strong> " . formatSize($original_size) . "</p>
    <p><strong>Ukuran Setelah Kompresi:</strong> " . formatSize($compressed_size) . "</p>
    <p><strong>Persentase Kompresi:</strong> $compression_percentage%</p>
</div>";
echo "<a href='interface_kompresi_kartu.php?page=kartu&npm=$npm'>← Kembali ke kartu</a>";
?>
