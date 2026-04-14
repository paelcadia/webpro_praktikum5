<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pasar Cerdas - Login</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'app-blue': '#0060AF',
                        'app-light': '#E5F3FF',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .btn-shadow {
            box-shadow: 0 4px 15px rgba(0, 96, 175, 0.4);
        }

        .full-viewport {
            min-height: 100vh;
        }
    </style>
</head>

<body class="full-viewport flex items-center justify-center bg-app-light p-4">

<div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8 sm:p-10">
        
<div class="text-center mb-10">

<h1 class="text-3xl font-extrabold text-app-blue">Selamat Datang</h1>

<p class="text-gray-500 mt-2">
Masuk untuk mengakses Pasar Cerdas Kabupaten Bandung.
</p>

</div>

<!-- FORM LOGIN -->

<form action="process_login.php" method="POST" class="space-y-6">
            
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Nomor Handphone
</label>

<input 
type="tel" 
name="phone"
placeholder="Contoh: 0812XXXXXXXX"
class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-app-blue focus:border-app-blue transition duration-150"
required
maxlength="14"
>
</div>

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Kata Sandi
</label>

<div class="relative">

<input 
type="password" 
name="password"
id="password"
placeholder="Masukkan kata sandi Anda"
class="w-full px-4 py-3 border border-gray-300 rounded-xl pr-12 focus:ring-app-blue focus:border-app-blue transition duration-150"
required
>

<button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-app-blue transition duration-150">
<i class="ph-fill ph-eye-slash text-xl"></i>
</button>

</div>
</div>

<div class="flex justify-end text-sm">
<a href="#" class="font-medium text-app-blue hover:text-blue-700">
Lupa Kata Sandi?
</a>
</div>

<button 
type="submit"
class="w-full bg-app-blue text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition duration-300 btn-shadow flex items-center justify-center"
>
Masuk
</button>

</form>

<div class="mt-8 text-center text-sm text-gray-600">
Belum punya akun? 
<a href="register.php" class="font-bold text-app-blue hover:text-blue-700">
Daftar Sekarang
</a>
</div>

</div>

<script>

const passwordField = document.getElementById('password');
const toggleButton = document.getElementById('togglePassword');
const toggleIcon = toggleButton.querySelector('i');

toggleButton.addEventListener('click', () => {

const isPassword = passwordField.type === 'password';

passwordField.type = isPassword ? 'text' : 'password';

toggleIcon.className = isPassword
? 'ph-fill ph-eye text-xl'
: 'ph-fill ph-eye-slash text-xl';

});

</script>

</body>
</html>