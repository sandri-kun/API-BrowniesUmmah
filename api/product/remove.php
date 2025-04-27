<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_keranjang = $_POST['id_keranjang'];

    $sql = "DELETE FROM Keranjang WHERE Id_keranjang = '$id_keranjang'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Item removed from wishlist",
            "data" => null
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error removing from wishlist",
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