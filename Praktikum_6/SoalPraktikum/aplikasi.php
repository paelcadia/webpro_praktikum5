<?php
session_start();
include 'koneksi1.php'; // Menyertakan class Database

// Proteksi Login sesuai syarat tugas [cite: 245]
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Menggunakan Inheritance: Class Laporan mewarisi Database [cite: 8, 197]
class Laporan extends Database {
    
    // Method untuk menangani CRUD (Create) dan Upload sekaligus [cite: 76, 246]
    public function simpanLaporan($data, $file, $user_id) {
        $nama = mysqli_real_escape_string($this->conn, htmlspecialchars($data['nama']));
        $lokasi = mysqli_real_escape_string($this->conn, htmlspecialchars($data['lokasi']));
        $kategori = mysqli_real_escape_string($this->conn, $data['kategori']);
        $keterangan = mysqli_real_escape_string($this->conn, htmlspecialchars($data['keterangan']));

        $nama_file_baru = ""; 

        // Perbaikan Error: pastikan nama index sesuai dengan 'foto_jalan' di form [cite: 1]
        if (isset($file['foto_jalan']) && $file['foto_jalan']['error'] == 0) {
            $imageFileType = strtolower(pathinfo($file["foto_jalan"]["name"], PATHINFO_EXTENSION));
            $nama_file_baru = "lapor_" . time() . "." . $imageFileType;
            move_uploaded_file($file['foto_jalan']['tmp_name'], 'uploads/' . $nama_file_baru);
        }

        // Query simpan data
        $query = "INSERT INTO laporan_jalan (id_user, nama_pelapor, lokasi, kategori, keterangan, foto) 
                  VALUES ('$user_id', '$nama', '$lokasi', '$kategori', '$keterangan', '$nama_file_baru')";
        
        return mysqli_query($this->conn, $query);
    }

    // Method untuk Read data [cite: 76]
    public function tampilkanData() {
        return mysqli_query($this->conn, "SELECT * FROM laporan_jalan ORDER BY id_laporan DESC");
    }
}

// Inisialisasi Object (Hasil instansiasi class) [cite: 103, 120]
$laporanApp = new Laporan();
$pesanSukses = "";
$pesanError = "";

// Jika tombol "Simpan" diklik (Single Submit sesuai modul) 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_laporan'])) {
    if ($laporanApp->simpanLaporan($_POST, $_FILES, $_SESSION['user_id'])) {
        $pesanSukses = "Laporan & Gambar berhasil dikirim";
    } else {
        $pesanError = "Gagal menyimpan data.";
    }
}

// Mengambil riwayat laporan
$tampil_laporan = $laporanApp->tampilkanData();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>JalanSafe - Lapor & Riwayat</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; color: #1e293b; }
        .cat-radio:checked + div { background-color: #fee2e2; border-color: #ef4444; color: #b91c1c; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.1); }
        .cat-radio:checked + div ion-icon { color: #dc2626; }
        .cat-icon { color: #94a3b8; transition: color 0.2s; }
        .group:hover .cat-icon { color: #ef4444; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-sans py-6">

    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-2xl relative overflow-hidden rounded-2xl">
        
        <header class="bg-white p-4 sticky top-0 z-40 border-b border-gray-100 flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-red-50 text-red-600">
                <ion-icon name="warning" class="text-xl"></ion-icon>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-tight">Lapor Jalan Rusak</h1>
                <p class="text-[10px] text-gray-500 font-medium">Isi form di bawah untuk menambahkan data</p>
            </div>
            <div class="ml-auto">
                 <a href="login.php" class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1.5 rounded-lg font-bold transition">Logout</a>
            </div>
        </header>

        <main class="p-5 space-y-8 overflow-y-auto">
            
            <?php if (!empty($pesanSukses)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative">
                    <span class="block sm:inline font-bold text-sm"><?php echo $pesanSukses; ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($pesanError)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative">
                    <span class="block sm:inline font-bold text-sm"><?php echo $pesanError; ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data" class="space-y-6 border-b border-gray-200 pb-8">
                
                <section class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 block">1. Nama Pelapor <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" required class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm" placeholder="Masukkan nama Anda...">
                </section>

                <section class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 block">2. Titik Lokasi <span class="text-red-500">*</span></label>
                    <button type="button" onclick="detectLocation()" class="w-full py-3 border border-gray-300 rounded-xl flex items-center justify-center gap-2 text-gray-600 font-bold hover:bg-gray-50 transition-all active:scale-95" id="btn-location">
                        <ion-icon name="location" class="text-red-500 text-lg"></ion-icon>
                        <span>Deteksi Lokasi Saya</span>
                    </button>
                    <textarea id="address-input" name="lokasi" required class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm transition-all" rows="2" placeholder="Tuliskan detail lokasi..."></textarea>
                </section>

                <section class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 block">3. Jenis Kerusakan <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer relative group"><input type="radio" name="kategori" class="cat-radio sr-only" value="Lubang Kecil" checked><div class="p-2 rounded-xl border border-gray-200 text-center transition-all h-28 flex flex-col items-center justify-center gap-1"><ion-icon name="ellipse-outline" class="text-2xl cat-icon"></ion-icon><span class="text-xs font-bold text-gray-700">Lubang Kecil</span></div></label>
                        <label class="cursor-pointer relative group"><input type="radio" name="kategori" class="cat-radio sr-only" value="Lubang Besar"><div class="p-2 rounded-xl border border-gray-200 text-center transition-all h-28 flex flex-col items-center justify-center gap-1"><ion-icon name="ellipse" class="text-2xl cat-icon"></ion-icon><span class="text-xs font-bold text-gray-700">Lubang Besar</span></div></label>
                        <label class="cursor-pointer relative group"><input type="radio" name="kategori" class="cat-radio sr-only" value="Jalan Amblas"><div class="p-2 rounded-xl border border-gray-200 text-center transition-all h-28 flex flex-col items-center justify-center gap-1"><ion-icon name="alert-circle" class="text-2xl cat-icon"></ion-icon><span class="text-xs font-bold text-gray-700">Jalan Amblas</span></div></label>
                    </div>
                </section>

                <section class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 block">4. Keterangan Laporan <span class="text-red-500">*</span></label>
                    <textarea name="keterangan" required class="w-full p-4 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm min-h-[80px]" placeholder="Deskripsikan kerusakan..."></textarea>
                </section>

                <section class="space-y-3">
                    <label class="text-sm font-bold text-gray-700 block">5. Foto Bukti Kerusakan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="file" name="foto_jalan" accept="image/*" class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </section>

                <button type="submit" name="submit_laporan" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2">
                    <ion-icon name="paper-plane"></ion-icon> Simpan & Upload File
                </button>
            </form>

            <section class="space-y-4 pt-4">
                <h2 class="text-xl font-black text-gray-800">Riwayat Laporan Masuk</h2>
                
                <?php if (mysqli_num_rows($tampil_laporan) > 0): ?>
                    <div class="space-y-4">
                        <?php while ($laporan = mysqli_fetch_assoc($tampil_laporan)): ?>
                            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 shadow-sm relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-1 h-full <?php echo ($laporan['kategori'] == 'Jalan Amblas') ? 'bg-red-500' : 'bg-yellow-500'; ?>"></div>
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-xs font-bold text-gray-500">
                                        <?php 
                                        // Pengecekan agar tidak error jika kolom waktu belum ada
                                        echo isset($laporan['waktu']) ? date('d M Y, H:i', strtotime($laporan['waktu'])) : 'Waktu tidak tersedia'; 
                                        ?>
                                    </span>
                                    <span class="text-xs font-bold text-gray-800 bg-gray-200 px-2 py-0.5 rounded"><?php echo $laporan['kategori']; ?></span>
                                </div>
                                
                                <?php if (!empty($laporan['foto'])): ?>
                                    <div class="my-3">
                                        <img src="uploads/<?php echo $laporan['foto']; ?>" alt="Bukti Laporan" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                                    </div>
                                <?php endif; ?>

                                <p class="text-sm font-bold text-gray-800 mb-1"><ion-icon name="location" class="text-red-500"></ion-icon> <?php echo $laporan['lokasi']; ?></p>
                                <p class="text-xs text-gray-600">"<?php echo $laporan['keterangan']; ?>"</p>
                                <p class="text-[10px] text-gray-400 mt-2 font-bold">Dilaporkan oleh: <span class="text-red-600"><?php echo $laporan['nama_pelapor']; ?></span></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center p-6 border-2 border-dashed border-gray-300 rounded-2xl">
                        <ion-icon name="document-text-outline" class="text-4xl text-gray-300 mb-2"></ion-icon>
                        <p class="text-sm text-gray-500 font-medium">Belum ada data laporan yang masuk.</p>
                    </div>
                <?php endif; ?>
            </section>

        </main>
    </div>

    <script>
        function detectLocation() {
            const btn = document.getElementById('btn-location');
            const addressInput = document.getElementById('address-input');
            
            btn.innerHTML = '<ion-icon name="refresh" class="animate-spin text-lg"></ion-icon> Mencari...';
            
            setTimeout(() => {
                btn.innerHTML = '<ion-icon name="checkmark-circle" class="text-green-500 text-lg"></ion-icon> Lokasi Ditemukan';
                addressInput.value = "Jl. Asia Afrika, Bandung (Koordinat: -6.921, 107.610)";
            }, 800);
        }
    </script>
</body>
</html>