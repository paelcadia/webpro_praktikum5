<?php
session_start();
include 'koneksi1.php';

$db = new Database(); // Membuat objek dari class Database
$conn = $db->conn;

$pesanError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Kita cari user berdasarkan email di tabel pengguna_jalansafe
    $query = "SELECT * FROM pengguna_jalansafe WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password yang di-hash dari database
        if (password_verify($password, $row['password'])) {
            // Jika cocok, set session dan pindah ke dashboard
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id']; // Mengambil kolom username
            header("Location: aplikasi.php");
            exit;
        } else {
            $pesanError = "Kata sandi salah!";
        }
    } else {
        $pesanError = "Email tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - JalanSafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 h-screen w-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md relative overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold tracking-tight">JalanSafe</h2>
                <p class="text-blue-100 text-sm">Masuk ke Akun Anda</p>
            </div>
        </div>
        
        <div class="p-8">
            <?php if ($pesanError): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-600 text-sm font-bold rounded-xl text-center">
                    <?php echo $pesanError; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-900 uppercase mb-1 ml-1">Email</label>
                    <div class="relative">
                        <ion-icon name="mail" class="absolute left-3 top-3.5 text-gray-400"></ion-icon>
                        <input type="email" name="email" required class="w-full pl-10 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="nama@email.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-900 uppercase mb-1 ml-1">Password</label>
                    <div class="relative">
                        <ion-icon name="lock-closed" class="absolute left-3 top-3.5 text-gray-400"></ion-icon>
                        <input type="password" name="password" required class="w-full pl-10 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm text-gray-900" placeholder="••••••••">
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all transform active:scale-95 mt-4">MASUK</button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="regis.php" class="text-xs font-bold text-blue-600 hover:text-blue-800">Belum punya akun? Daftar di sini</a>
            </div>
        </div>
    </div>

</body>
</html>