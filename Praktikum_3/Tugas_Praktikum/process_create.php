<?php
session_start();

$nama = $_POST['nama'];
$harga = $_POST['harga'];

$data = [
"nama"=>$nama,
"harga"=>$harga
];

$_SESSION['produk'][] = $data;

header("Location: dashboard.php");
?>