<?php 
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Simpan sebagai teks biasa
    $nama = $_POST['nama'];
    $nomor_telpon = $_POST['nomor_telpon'];
    $alamat = $_POST['alamat'];

    // Cek apakah username sudah ada
    $sql_check = "SELECT * FROM Login_Pelanggan WHERE Username_Email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Username sudah ada"
        ]);
    } else {
        // Insert ke tabel Login_Pelanggan
        $sql_login = "INSERT INTO Login_Pelanggan (Username_Email, Password) VALUES (?, ?)";
        $stmt_login = $conn->prepare($sql_login);
        $stmt_login->bind_param("ss", $username, $password);

        if ($stmt_login->execute()) {
            $id_pelanggan = uniqid(); // ID pelanggan unik
            $sql_pelanggan = "INSERT INTO Pelanggan (Id_pelanggan, Nama, Email, Nomor_telpon, Alamat) 
                              VALUES (?, ?, ?, ?, ?)";
            $stmt_pelanggan = $conn->prepare($sql_pelanggan);
            $stmt_pelanggan->bind_param("sssss", $id_pelanggan, $nama, $username, $nomor_telpon, $alamat);

            if ($stmt_pelanggan->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Registrasi berhasil",
                    "Id_pelanggan" => $id_pelanggan,
                    "Nama" => $nama,
                    "Email" => $username,
                    "Nomor_telpon" => $nomor_telpon,
                    "Alamat" => $alamat
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menyimpan data pelanggan"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal menyimpan data login"
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