<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = [
        "id_pelanggan",
        "id_kue",
        "jumlah_kue",
        "tanggal_pengiriman",
        "status_pesanan",
        "total_harga"
    ];

    $missing_fields = [];

    // Cek apakah ada field yang kosong
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    // Jika ada field yang kosong, kirimkan error beserta daftar field yang kurang
    if (!empty($missing_fields)) {
        echo json_encode([
            "status" => "error",
            "message" => "Data tidak lengkap!",
            "missing_fields" => $missing_fields
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // Generate ID Pesanan secara otomatis
    $id_pesanan = uniqid('ORD_'); // Misal: ORD_65f123abcde
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kue = $_POST['id_kue'];
    $jumlah_kue = $_POST['jumlah_kue'];
    $tanggal_pengiriman = $_POST['tanggal_pengiriman'];
    $status_pesanan = $_POST['status_pesanan'];
    $total_harga = $_POST['total_harga'];

    // Simpan data ke dalam tabel Pesanan
    $sql = "INSERT INTO Pesanan (Id_pesanan, Id_pelanggan, Id_kue, Jumlah_kue, Tanggal_Pengiriman, Status_pesanan, Total_harga)
            VALUES ('$id_pesanan', '$id_pelanggan', '$id_kue', '$jumlah_kue', '$tanggal_pengiriman', '$status_pesanan', '$total_harga')";

    if ($conn->query($sql) === TRUE) {
        // Jika pesanan berhasil dimasukkan, hapus semua item di keranjang berdasarkan ID pelanggan
        $sql_delete = "DELETE FROM Keranjang WHERE Id_pelanggan = '$id_pelanggan'";
        if ($conn->query($sql_delete) === TRUE) {
            echo json_encode([
                "status" => "success",
                "message" => "Order added successfully and cart cleared",
                "Id_pesanan" => $id_pesanan, // ID yang baru dibuat
                "Id_pelanggan" => $id_pelanggan,
                "Id_kue" => $id_kue,
                "Jumlah_kue" => $jumlah_kue,
                "Tanggal_Pengiriman" => $tanggal_pengiriman,
                "Status_pesanan" => $status_pesanan,
                "Total_harga" => $total_harga
            ], JSON_PRETTY_PRINT);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Order added but failed to clear cart: " . $conn->error
            ], JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error adding order: " . $conn->error
        ], JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ], JSON_PRETTY_PRINT);
}

$conn->close();
?>
