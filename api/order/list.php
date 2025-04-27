<?php
header('Content-Type: application/json');
include '../../db_connect.php';

// Periksa apakah id_pelanggan ada, jika tidak, beri nilai default null
$id_pelanggan = $_GET['id_pelanggan'] ?? null;

if (!$id_pelanggan) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing id_pelanggan",
        "data" => []
    ]);
    exit;
}

$sql = "SELECT * FROM Pesanan WHERE Id_pelanggan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_pelanggan);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

if (count($orders) > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Orders retrieved successfully",
        "data" => $orders
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No orders found",
        "data" => []
    ]);
}

$stmt->close();
$conn->close();
?>
