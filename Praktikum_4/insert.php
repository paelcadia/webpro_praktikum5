<?php
$host = "localhost"; 
$username = "root"; 
$password = "";
$database = "praktik_webpro";

$conn = new mysqli(hostname: $host, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nim = $_POST["nim"];
            $nama = $_POST["nama"];
            $jurusan = $_POST["jurusan"];

            $sql = "INSERT INTO data_mahasiswa (NIM, Nama, Jurusan) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nim, $nama, $jurusan);

        if ($stmt->execute()) {
            echo "<p>Data berhasil ditambahkan</p>";
            header("Location: Webdatabaru.php");
            exit();
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }  
    $stmt->close();
    }
}
$conn->close();
?>