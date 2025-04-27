<?php
header('Content-Type: application/json');
include '../../db_connect.php';

// Ambil data dari POST
$id_pesanan = isset($_POST['Id_pesanan']) ? $_POST['Id_pesanan'] : null;
$status_pesanan = isset($_POST['Status_pesanan']) ? $_POST['Status_pesanan'] : null;

// Validasi input
if (!$id_pesanan || !$status_pesanan) {
    echo json_encode([
        "status" => "error",
        "message" => "Parameter tidak lengkap"
    ], JSON_PRETTY_PRINT);
    exit();
}

// Lakukan update status
$sql = "UPDATE Pesanan SET Status_pesanan = ? WHERE Id_pesanan = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $status_pesanan, $id_pesanan);
    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Status pesanan berhasil diperbarui"
        ], JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal memperbarui status"
        ], JSON_PRETTY_PRINT);
    }
    $stmt->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal mempersiapkan statement"
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
