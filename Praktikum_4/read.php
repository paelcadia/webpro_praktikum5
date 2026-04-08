<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "praktik_webpro";

$conn = new mysqli(hostname: $host, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM data_mahasiswa";
$result = $conn->query(query: $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['NIM']}</td>
                <td>{$row['Nama']}</td>
                <td>{$row['Jurusan']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
}

$conn->close();
?>