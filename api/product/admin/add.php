<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memastikan semua input tersedia, kecuali Id_kue karena akan di-generate
    $Nama_kue = $_POST['Nama_kue'];
    $Harga = $_POST['Harga'];
    $Kategori = $_POST['Kategori'];
    $Deskripsi = $_POST['Deskripsi'];
    $Gambar = $_POST['Gambar'];

    // Dapatkan id terakhir dari database
    $result = $conn->query("SELECT Id_kue FROM Kue ORDER BY Id_kue DESC LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_id = intval(substr($row['Id_kue'], 1)); // Ambil angka setelah 'K'
        $new_id = 'K' . str_pad($last_id + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $new_id = 'K001'; // Jika tidak ada data, mulai dari K001
    }

    // Simpan data ke database
    $sql = "INSERT INTO Kue (Id_kue, Nama_kue, Harga, Kategori, Deskripsi, Gambar) 
            VALUES ('$new_id', '$Nama_kue', '$Harga', '$Kategori', '$Deskripsi', '$Gambar')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Item added successfully",
            "data" => [
                "Id_kue" => $new_id,
                "Nama_kue" => $Nama_kue,
                "Harga" => $Harga,
                "Kategori" => $Kategori,
                "Deskripsi" => $Deskripsi,
                "Gambar" => $Gambar
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error adding data",
            "data" => null
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed",
        "data" => null
    ]);
}

$conn->close();
?>