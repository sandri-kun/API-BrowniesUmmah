<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_POST['id_pelanggan'] ?? null;

    if (!$id_pelanggan) {
        echo json_encode([
            "status" => "error",
            "message" => "ID pelanggan diperlukan"
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // Periksa apakah ada item dalam keranjang untuk ID pelanggan ini
    $sql_check = "SELECT * FROM Keranjang WHERE Id_pelanggan = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $id_pelanggan);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Tidak ada item dalam keranjang untuk ID pelanggan ini"
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // Hapus semua item dari keranjang berdasarkan ID pelanggan
    $sql_delete = "DELETE FROM Keranjang WHERE Id_pelanggan = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("s", $id_pelanggan);
    
    if ($stmt_delete->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Semua item dalam keranjang telah dihapus"
        ], JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menghapus item dalam keranjang"
        ], JSON_PRETTY_PRINT);
    }

    $stmt_check->close();
    $stmt_delete->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method tidak diizinkan"
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
