<?php
header('Content-Type: application/json');
include '../../db_connect.php';

$sql = "SELECT * FROM Pesanan";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "message" => "Products retrieved successfully",
        "products" => $products
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No products found",
        "products" => []
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
