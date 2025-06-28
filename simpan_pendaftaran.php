<?php
include('config.php');

$npm     = $_POST['npm'];
$nama    = $_POST['nama'];
$fakultas = $_POST['fakultas'];
$prodi   = $_POST['prodi'];
$alamat  = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
// dan pastikan query INSERT juga menyertakan $no_telp
// Ambil dari form, simpan ke 'no_telp'

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];
$upload = 'uploads/' . $foto;
move_uploaded_file($tmp, $upload);

$query = "INSERT INTO mahasiswa (npm, nama, fakultas, prodi, alamat, no_telp, foto)
          VALUES ('$npm', '$nama', '$fakultas', '$prodi', '$alamat', '$no_telp', '$foto')";

if (mysqli_query($conn, $query)) {
    header("Location: interface_kompresi_kartu.php?page=form&success=1");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>
