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
    $ID = $_POST["ID"];

    $sql = "DELETE FROM data_mahasiswa WHERE ID =? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

    if ($stmt->execute()) {
        header(header: "Location: Webdatabaru.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
