<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $nomor_telpon = $_POST['nomor_telpon'];
    $alamat = $_POST['alamat'];

    // Pastikan id pelanggan tersedia
    if (empty($id_pelanggan) || empty($nama) || empty($nomor_telpon) || empty($alamat)) {
        echo json_encode([
            "status" => "error",
            "message" => "Semua data harus diisi"
        ]);
        exit();
    }

    // Periksa apakah ID pelanggan ada dalam database
    $sql_check = "SELECT * FROM Pelanggan WHERE Id_pelanggan = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $id_pelanggan);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "ID pelanggan tidak ditemukan"
        ]);
    } else {
        // Update data pelanggan
        $sql_update = "UPDATE Pelanggan SET Nama = ?, Nomor_telpon = ?, Alamat = ? WHERE Id_pelanggan = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssss", $nama, $nomor_telpon, $alamat, $id_pelanggan);

        if ($stmt_update->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Data pelanggan berhasil diperbarui"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal memperbarui data pelanggan"
            ]);
        }
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Metode tidak diizinkan"
    ]);
}

$conn->close();
?>