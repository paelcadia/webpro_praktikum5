<?php
session_start();

$uploadDir = 'uploads/';
$allowedTypes = ['jpg','jpeg','png'];

if(!isset($_SESSION['produk'])){
    $_SESSION['produk'] = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);

    if($check !== false && in_array($imageFileType, $allowedTypes)){

        // auto increment nama file
        $files = glob($uploadDir . "*.*");
        $highestNumber = 0;

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if (is_numeric($filename) && $filename > $highestNumber) {
                $highestNumber = (int)$filename;
            }
        }

        $newFileName = ($highestNumber + 1) . "." . $imageFileType;
        $targetFile = $uploadDir . $newFileName;

        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)){

            // simpan ke session
            $_SESSION['produk'][] = [
                'nama' => $nama,
                'harga' => $harga,
                'gambar' => $newFileName
            ];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "Upload gagal!";
        }

    } else {
        echo "File tidak valid!";
    }

}
?>