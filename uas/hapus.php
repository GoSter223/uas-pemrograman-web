<?php 
include 'koneksi.php';
$email = $_GET['password'];
mysqli_query($koneksi, "DELETE FROM akun WHERE email='$email'") or die(mysqli_error());

header("location:anggota.php?pesan=hapus")
 ?>