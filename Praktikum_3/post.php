<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Sederhana</title>
</head>
<body>
    <h2>Form Input</h2>
    <form action="post" action="">
        Nama : <input type="text" name="name" required><br><br>
        Email : <input type="email" name="email" required><br><br>
        <input type="submit" value="Kirim">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] ==  "POST") {
        $name = htmlspecialchars($_GET['name']);
        $email = htmlspecialchars($_GET['email']);
        echo "<h3>Data yang Dikirim : </h3>";
        echo "Nama : " . $name . "<br>";
        echo "Email : " . $email;
    }
    ?>
</body>
</html>