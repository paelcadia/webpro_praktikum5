<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<title>Registrasi - Pasar Cerdas</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    body{
    font-family:Inter,sans-serif;
    }
</style>

</head>

<body class="min-h-screen flex items-center justify-center bg-blue-100">

    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md">

        <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">
        Registrasi Akun
        </h1>

        <form action="process_register.php" method="POST" class="space-y-5">

            <div>
                <label>Nomor Handphone</label>
                <input
                type="text"
                name="phone"
                class="w-full border p-3 rounded-xl"
                required>
            </div>

            <div>
                <label>Password</label>
                <input
                type="password"
                name="password"
                class="w-full border p-3 rounded-xl"
                required>
            </div>

            <button
            class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold">
            Daftar
            </button>

        </form>

        <div class="text-center mt-6 text-sm">
            Sudah punya akun?
            <a href="login.php" class="text-blue-600 font-bold">
            Login
            </a>
        </div>

    </div>

</body>

</html>