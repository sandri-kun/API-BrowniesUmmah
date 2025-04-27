<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generate Id_keranjang otomatis (kombinasi waktu + string unik)
    $id_keranjang = uniqid('KRN_');

    // Ambil data dari request
    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    $id_kue = $_POST['id_kue'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $kategori = $_POST['kategori'] ?? null;
    $jumlah_pesanan = $_POST['jumlah_pesanan'] ?? null;
    $harga = $_POST['harga'] ?? null;
    $deskripsi = $_POST['deskripsi'] ?? null;
    $gambar = $_POST['gambar'] ?? null;

    // Validasi data tidak boleh kosong
    if (!$id_pelanggan || !$id_kue || !$nama || !$kategori || !$jumlah_pesanan || !$harga || !$deskripsi || !$gambar) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required fields"
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // SQL untuk insert dengan Id_kue
    $sql = "INSERT INTO Keranjang (Id_keranjang, Id_pelanggan, Id_kue, Nama, Kategori, Jumlah_pesanan, Harga, Deskripsi, Gambar)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissss", $id_keranjang, $id_pelanggan, $id_kue, $nama, $kategori, $jumlah_pesanan, $harga, $deskripsi, $gambar);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Item added to cart successfully",
            "Id_keranjang" => $id_keranjang,
            "Id_pelanggan" => $id_pelanggan,
            "Id_kue" => $id_kue
        ], JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to add item to cart"
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
