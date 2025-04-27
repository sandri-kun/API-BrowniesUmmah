<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menggunakan null coalescing operator untuk mencegah warning
    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    $nama = $_POST['nama'] ?? null;
    $nomor_telpon = $_POST['nomor_telpon'] ?? null;
    $alamat = $_POST['alamat'] ?? null;

    // Array untuk menyimpan pesan kesalahan
    $errors = [];

    // Memeriksa setiap parameter dan menambahkan pesan kesalahan jika ada yang kosong
    if (empty($id_pelanggan)) {
        $errors[] = "ID pelanggan harus diisi";
    }
    if (empty($nama)) {
        $errors[] = "Nama harus diisi";
    }
    if (empty($nomor_telpon)) {
        $errors[] = "Nomor telepon harus diisi";
    }
    if (empty($alamat)) {
        $errors[] = "Alamat harus diisi";
    }

    // Jika ada error, kembalikan respon dengan pesan kesalahan
    if (!empty($errors)) {
        echo json_encode([
            "status" => "error",
            "message" => implode(", ", $errors)
        ]);
        exit();
    }

    // Periksa apakah ID pelanggan ada dalam database
    $sql_check = "SELECT * FROM Admin WHERE Id_admin = ?";
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
        $sql_update = "UPDATE Admin SET Nama = ?, Nomor_telpon = ?, Alamat = ? WHERE Id_admin = ?";
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
