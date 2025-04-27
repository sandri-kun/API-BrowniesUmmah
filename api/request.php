<?php
header('Content-Type: application/json');
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil semua data dari request
    $data = $_POST;

    // Periksa apakah ada data yang dikirim
    if (empty($data)) {
        echo json_encode([
            "status" => "error",
            "message" => "Tidak ada data yang dikirim"
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // Kembalikan semua data yang dikirim dalam response
    echo json_encode([
        "status" => "success",
        "message" => "Data diterima",
        "data" => $data
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ], JSON_PRETTY_PRINT);
}
?>
