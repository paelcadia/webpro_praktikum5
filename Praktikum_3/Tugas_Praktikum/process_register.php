<?php
session_start();

$phone = $_POST['phone'];
$password = $_POST['password'];

/* SIMPAN SEMENTARA DI SESSION */

$_SESSION['phone'] = $phone;
$_SESSION['password'] = $password;

echo "Registrasi berhasil!";
echo "<br><a href='login.php'>Login sekarang</a>";
?>