<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_keranjang = $_POST['id_keranjang'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $jumlah_pesanan = $_POST['jumlah_pesanan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['gambar'];

    $sql = "INSERT INTO Keranjang (Id_keranjang, Nama, Kategori, Jumlah_pesanan, Harga, Deskripsi, Gambar) 
            VALUES ('$id_keranjang', '$nama', '$kategori', '$jumlah_pesanan', '$harga', '$deskripsi', '$gambar')";
    if ($conn->query($sql) === TRUE) {
        $wishlist_item = ["Id_keranjang" => $id_keranjang, "Nama" => $nama, "Kategori" => $kategori, 
                          "Jumlah_pesanan" => $jumlah_pesanan, "Harga" => $harga, "Deskripsi" => $deskripsi, 
                          "Gambar" => $gambar];
        echo json_encode([
            "status" => "success",
            "message" => "Item added to wishlist",
            "data" => $wishlist_item
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error adding to wishlist",
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