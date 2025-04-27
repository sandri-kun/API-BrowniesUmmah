<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan ID Keranjang diberikan
    if (!isset($_POST['id_keranjang'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Id_keranjang is required"
        ], JSON_PRETTY_PRINT);
        exit();
    }

    $id_keranjang = $_POST['id_keranjang'];

    // Query DELETE
    $sql = "DELETE FROM Keranjang WHERE Id_keranjang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_keranjang);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "Item deleted successfully"
        ], JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Item not found or failed to delete"
        ], JSON_PRETTY_PRINT);
    }

    $stmt->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
