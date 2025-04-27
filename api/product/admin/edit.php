<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memastikan semua input ada
    $Id_kue = $_POST['Id_kue'];
    $Nama_kue = $_POST['Nama_kue'];
    $Harga = $_POST['Harga'];
    $Kategori = $_POST['Kategori'];
    $Deskripsi = $_POST['Deskripsi'];
    $Gambar = $_POST['Gambar'];

    // Query untuk memperbarui data berdasarkan Id_kue
    $sql = "UPDATE Kue SET 
            Nama_kue = '$Nama_kue',
            Harga = '$Harga',
            Kategori = '$Kategori',
            Deskripsi = '$Deskripsi',
            Gambar = '$Gambar'
            WHERE Id_kue = '$Id_kue'";

    if ($conn->query($sql) === TRUE) {
        $update_item = [
            "Id_kue" => $Id_kue,
            "Nama_kue" => $Nama_kue,
            "Harga" => $Harga,
            "Kategori" => $Kategori,
            "Deskripsi" => $Deskripsi,
            "Gambar" => $Gambar
        ];
        echo json_encode([
            "status" => "success",
            "message" => "Item updated successfully",
            "data" => $update_item
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error updating data",
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
