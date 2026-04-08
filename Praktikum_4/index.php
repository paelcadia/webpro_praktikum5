<?php 
// Konfirgurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "praktik_webpro";

// Membuat koneksi
$conn = new mysqli(hostname: $host, username: $username, password: $password, database: $database);

// Cek koneksi
if($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi ke database berhasil!";
}

// Tutup koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    $nim = "12345678";
    $nama = "Budi Santoso";
    $jurusan = "Teknik Informatika";

    $sql = "INSERT INTO data_mahasiswa (NIM, Nama, Jurusan) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nim, $nama, $jurusan);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan";
    } else {
        echo $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>