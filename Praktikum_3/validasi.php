<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Sederhana dengan Validasi</title>
</head>
<body>
    <h2>Form Input</h2>
    <form action="post" action="">
        Nama: <input type="text" name="name" value="<?php echo $name; ?>" required>
        <span style="color: red;">* <?php echo $nameErr; ?></span>
        <br><br>
        
        Email: <input type="email" name="email" value="<?php echo $email; ?>" required>
        <span style="color: red;">* <?php echo $emailErr; ?></span>
        <br><br>
        
        Password: <input type="password" name="password" value="<?php echo $password; ?>" required>
        <span style="color: red;">* <?php echo $passwordErr; ?></span>
        <br><br>

        <input type="submit" value="Kirim">
    </form>
</body>
</html>

<?php
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)))
    }

    if (isset($_POST["name"])) {
        $name = test_input($_POST["name"]);
        if (empty($name)) {
            $nameErr = "Nama harus diisi";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Hanya huruf dan spasi yang diperbolehkan";
        }
    } 

    if (isset($_POST["email"])) {
        $email = test_input($_POST["email"]);
        if (empty($email)) {
            $emailErr = "Email harus diisi";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }

    if (isset($_POST["password"])) {
        $password = test_input($_POST["password"]);
        if (empty($password)) {
            $passwordErr = "Password harus diisi";
        } elseif (!preg_match("/[\W]/", $password))) {
            $passwordErr = "Password harus mengandung minimal 1 karakter spesial (!@#$%^&*)";
        }
    }

    if (!$nameErr && !$emailErr && !$passwordErr) {
        echo "<h3>Data yang dikirim : </h3>";
        echo "Nama : " . $name . "<br>";
        echo "Email : " . $email;
    }
}
?>