<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pesanan = $_POST['id_pesanan'];

    $sql = "DELETE FROM Pesanan WHERE Id_pesanan = '$id_pesanan'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Order removed successfully",
            "data" => null
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error removing order",
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