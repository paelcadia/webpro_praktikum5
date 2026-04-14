<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "webpro"; // Sesuaikan nama DB-mu

$conn = mysqli_connect($host, $user, $pass, $db);

$pesanPemberitahuan = "";
$registrasiSukses = false;
$dataTerkirim = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, htmlspecialchars(stripslashes(trim($_POST["nama"]))));
    $email = mysqli_real_escape_string($conn, htmlspecialchars(stripslashes(trim($_POST["email"]))));
    $password = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    if (empty($nama) || empty($email) || empty($password)) {
        $pesanPemberitahuan = "<div class='mb-4 p-3 bg-red-100 text-red-600 text-sm font-bold rounded-xl text-center'>Semua kolom wajib diisi.</div>";
    } elseif ($password !== $konfirmasi) {
        $pesanPemberitahuan = "<div class='mb-4 p-3 bg-red-100 text-red-600 text-sm font-bold rounded-xl text-center'>Konfirmasi sandi tidak sesuai.</div>";
    } else {
        // PERBAIKAN 1: Nama tabel diubah jadi pengguna_jalansafe
        $cekEmail = mysqli_query($conn, "SELECT email FROM pengguna_jalansafe WHERE email = '$email'");
        
        if (mysqli_num_rows($cekEmail) > 0) {
            $pesanPemberitahuan = "<div class='mb-4 p-3 bg-red-100 text-red-600 text-sm font-bold rounded-xl text-center'>Email sudah terdaftar.</div>";
        } else {
            // PERBAIKAN 2: Definisi $passwordHash (agar tidak Undefined Variable)
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            // PERBAIKAN 3: Nama tabel di INSERT INTO juga harus pengguna_jalansafe
            $query = "INSERT INTO pengguna_jalansafe (nama, email, password) VALUES ('$nama', '$email', '$passwordHash')";
            
            // Pastikan urutan dan nama kolom sesuai dengan di phpMyAdmin kamu
            $query = "INSERT INTO pengguna_jalansafe (username, email, password) VALUES ('$nama', '$email', '$passwordHash')";
            if (mysqli_query($conn, $query)) {
                $registrasiSukses = true;
                $dataTerkirim = ['nama' => $nama, 'email' => $email];
                } else {
                    
                            die("Gagal simpan ke database: " . mysqli_error($conn));
                    }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - JalanSafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 h-screen w-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md relative overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600 relative overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, white 2px, transparent 2px); background-size: 20px 20px;"></div>
            <div class="text-center text-white z-10">
                <h2 class="text-3xl font-bold tracking-tight">JalanSafe</h2>
                <p class="text-blue-100 text-sm">Pendaftaran Akun Baru</p>
            </div>
        </div>
        
        <div class="p-8">
            
            <?php if ($registrasiSukses): ?>
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <ion-icon name="checkmark-circle" class="text-4xl text-green-500"></ion-icon>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Registrasi Berhasil!</h3>
                    <p class="text-sm text-gray-500 mt-1">Sistem menerima data melalui metode POST:</p>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-6 text-left">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Data yang Dikirim</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span class="text-sm text-gray-500">Nama</span>
                            <span class="text-sm font-bold text-gray-800"><?php echo $dataTerkirim['nama']; ?></span>
                        </div>
                        <div class="flex justify-between pt-1">
                            <span class="text-sm text-gray-500">Email</span>
                            <span class="text-sm font-bold text-gray-800"><?php echo $dataTerkirim['email']; ?></span>
                        </div>
                        <div class="flex justify-between pt-1">
                            <span class="text-sm text-gray-500">Password</span>
                            <span class="text-sm font-bold text-gray-800">********</span>
                        </div>
                    </div>
                </div>

                <a href="login.php" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all active:scale-95">
                    Lanjut ke Halaman Masuk
                </a>

            <?php else: ?>
                <?php echo $pesanPemberitahuan; ?>

                <form method="POST" action="" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-900 uppercase mb-1 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <ion-icon name="person" class="absolute left-3 top-3.5 text-gray-400"></ion-icon>
                            <input type="text" name="nama" required class="w-full pl-10 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="Nama Anda">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-900 uppercase mb-1 ml-1">Email</label>
                        <div class="relative">
                            <ion-icon name="mail" class="absolute left-3 top-3.5 text-gray-400"></ion-icon>
                            <input type="email" name="email" required class="w-full pl-10 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="nama@email.com">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="password" name="password" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="Password">
                        <input type="password" name="konfirmasi" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="Konfirmasi">
                    </div>
                    
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-green-500/30 transition-all transform active:scale-95 mt-4">DAFTAR SEKARANG</button>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="login.php" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">Sudah punya akun? Masuk di sini</a>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>