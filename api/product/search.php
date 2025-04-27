<?php
header('Content-Type: application/json');
include '../../db_connect.php';

$search = $_GET['search'];
$sql = "SELECT * FROM Kue WHERE Nama_kue LIKE '%$search%'";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "message" => "Products found",
        "data" => $products
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No products found",
        "data" => []
    ]);
}
$conn->close();
?>