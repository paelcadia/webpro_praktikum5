<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
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

    <h1 class="text-3xl font-bold text-blue-700 mb-2">
        Dashboard Pasar Cerdas
    </h1>

    <p class="text-gray-600 mb-4">
        Kelola produk & retribusi pasar digital (PASCER)
    </p>

    <a href="logout.php" class="text-red-500 font-semibold">Logout</a>

    <div class="grid grid-cols-2 gap-10 mt-8">

        <!-- FORM TAMBAH PRODUK -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-bold mb-4 text-blue-700">
                Tambah Produk
            </h2>

            <form action="process_create.php" method="POST" enctype="multipart/form-data">

                <label class="block mb-1">Nama Produk</label>
                <input type="text" name="nama"
                    class="w-full border p-2 mb-3 rounded"
                    placeholder="Contoh: Beras Premium"
                    required>

                <label class="block mb-1">Harga</label>
                <input type="number" name="harga"
                    class="w-full border p-2 mb-3 rounded"
                    placeholder="Contoh: 15000"
                    required>

                <label class="block mb-1">Gambar Produk</label>
                <input type="file" name="gambar"
                    class="w-full mb-4"
                    accept="image/*"
                    required>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                    Tambah Produk
                </button>

            </form>

        </div>

        <!-- LIST PRODUK -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-bold mb-4 text-blue-700">
                Daftar Produk
            </h2>

            <?php
            if(count($_SESSION['produk']) == 0){
                echo "<p class='text-gray-500'>Belum ada produk.</p>";
            } else {
                foreach($_SESSION['produk'] as $p){
                    echo "
                    <div class='mb-5 border-b pb-3'>
                        <img src='uploads/".$p['gambar']."' class='w-24 h-24 object-cover mb-2 rounded shadow'>
                        <p class='font-bold'>".$p['nama']."</p>
                        <p class='text-green-600'>Rp ".$p['harga']."</p>
                    </div>
                    ";
                }
            }
            ?>

        </div>

    </div>

</body>
</html>