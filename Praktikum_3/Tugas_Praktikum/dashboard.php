<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: login.php");
}

if(!isset($_SESSION['produk'])){
$_SESSION['produk'] = [];
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard Pasar Cerdas</title>
<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-blue-100 min-h-screen p-10">

    <h1 class="text-3xl font-bold text-blue-700 mb-6">
    Dashboard Pasar Cerdas
    </h1>

    <a href="logout.php" class="text-red-500">Logout</a>

    <div class="grid grid-cols-2 gap-10 mt-8">


        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-bold mb-4">
            Tambah Produk
            </h2>

            <form action="process_create.php" method="POST">

                <label>Nama Produk</label>
                <input
                type="text"
                name="nama"
                class="w-full border p-2 mb-3 rounded"
                required>

                <label>Harga</label>
                <input
                type="text"
                name="harga"
                class="w-full border p-2 mb-3 rounded"
                required>

                <button
                class="bg-blue-600 text-white px-4 py-2 rounded">
                Tambah
                </button>

            </form>

        </div>

        <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-bold mb-4">
        Daftar Produk
        </h2>

    <?php

    if(count($_SESSION['produk']) == 0){
    echo "Belum ada produk.";
    } else {
    foreach($_SESSION['produk'] as $p){
    echo "<p><b>".$p['nama']."</b> - Rp ".$p['harga']."</p>";
        }
    }
    ?>

    </div>

</div>

</body>
</html>