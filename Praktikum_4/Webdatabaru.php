<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>

    <h2>Daftar Mahasiswa</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'read.php'; ?>
        </tbody>
    </table>

    <br>
    <button onclick="location.href='form_input.html'">Tambah Data</button>
    <button onclick="location.href='form_update.html'">Update Data</button>
    <button onclick="location.href='form_hapus.html'">Hapus Data</button>

</body>
</html>