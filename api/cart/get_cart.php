<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ], JSON_PRETTY_PRINT);
    exit();
}

// Pastikan id_pelanggan ada di parameter GET
if (!isset($_GET['id_pelanggan'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Id_pelanggan is required"
    ], JSON_PRETTY_PRINT);
    exit();
}

$id_pelanggan = $_GET['id_pelanggan'];

$sql = "SELECT Id_keranjang, Nama, Kategori, Jumlah_pesanan, Harga, Deskripsi, Gambar, Id_pelanggan
        FROM Keranjang WHERE Id_pelanggan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_pelanggan);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = [
        "Id_keranjang" => $row["Id_keranjang"],
        "Nama" => $row["Nama"],
        "Kategori" => $row["Kategori"],
        "Jumlah_pesanan" => (int) $row["Jumlah_pesanan"],
        "Harga" => (float) $row["Harga"],
        "Deskripsi" => $row["Deskripsi"],
        "Gambar" => $row["Gambar"],
        "Id_pelanggan" => $row["Id_pelanggan"]
    ];
}

echo json_encode([
    "status" => "success",
    "message" => count($cartItems) > 0 ? "Cart items retrieved" : "No items in cart",
    "data" => $cartItems
], JSON_PRETTY_PRINT);

$stmt->close();
$conn->close();
?>
