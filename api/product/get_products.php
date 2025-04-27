<?php
header('Content-Type: application/json');
include '../../db_connect.php';

$kategori = $_GET['kategori'] ?? ''; // Ambil kategori dari query string (GET)

if (empty($kategori)) {
    echo json_encode([
        "status" => "error",
        "message" => "Kategori harus diisi"
    ]);
    exit();
}

// Validasi kategori hanya boleh "all", "wet", atau "dry"
$kategori_list = ["all", "wet", "dry"];
if (!in_array(strtolower($kategori), $kategori_list)) {
    echo json_encode([
        "status" => "error",
        "message" => "Kategori tidak valid. Gunakan 'all', 'wet', atau 'dry'"
    ]);
    exit();
}

// Buat query SQL
if ($kategori === "all") {
    $sql = "SELECT * FROM Kue"; // Ambil semua produk jika kategori "all"
} else {
    $sql = "SELECT * FROM Kue WHERE Kategori = ?";
}

$stmt = $conn->prepare($sql);

if ($kategori !== "all") {
    $stmt->bind_param("s", $kategori);
}

$stmt->execute();
$result = $stmt->get_result();

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
        "message" => "No products found"
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
