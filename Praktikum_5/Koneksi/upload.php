<?php

$uploadDir = 'uploads/';
$allowedTypes = ['jpg', 'jpeg', 'png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["fileToUpload"])) {

    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

    // FIX: tambahkan ini
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false && in_array($imageFileType, $allowedTypes)) {

        $files = glob($uploadDir . "*.*");
        $highestNumber = 0;

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if (is_numeric($filename) && $filename > $highestNumber) {
                $highestNumber = (int) $filename;
            }
        }

        $newFileName = ($highestNumber + 1) . "." . $imageFileType;
        $targetFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Upload berhasil: " . $newFileName;
        } else {
            echo "Gagal upload!";
        }

    } else {
        echo "File bukan gambar valid.";
    }

} else {
    echo "Tidak ada file dikirim.";
}

?>