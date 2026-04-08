<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "praktik_webpro";

$conn = new mysqli(hostname: $host, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $jurusan = $_POST["jurusan"];

    $sql = "UPDATE data_mahasiswa SET NIM = ?, Nama = ?, Jurusan = ? WHERE id = ?";
    $stmt = $conn->prepare(query: $sql);
    $stmt->bind_param("sssi", $nim, $nama, $jurusan, $id);

    if ($stmt->execute()) {
        header(header: "Location: Webdatabaru.php"); // Redirect ke halaman utama setelah update
        exit();
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>