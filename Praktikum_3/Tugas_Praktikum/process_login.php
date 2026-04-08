<?php
session_start();

$phone = $_POST['phone'];
$password = $_POST['password'];

$valid_phone = "08123456789";
$valid_password = "admin";

if($phone == $valid_phone && $password == $valid_password){

$_SESSION['login'] = true;

header("Location: dashboard.php");

}else{

echo "Login gagal. Nomor HP atau password salah.";
echo "<br><a href='login.php'>Kembali</a>";

}
?>