<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Dianggap sebagai email
    $password = $_POST['password']; // Disimpan sebagai teks biasa (catatan: sebaiknya hash!)
    $nama = $_POST['nama'];
    $nomor_telpon = $_POST['nomor_telpon'];
    $alamat = $_POST['alamat'];

    // Cek apakah username (email) sudah digunakan
    $sql_check = "SELECT * FROM Login_Admin WHERE Username_Email = ?";
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
        // Insert ke tabel Login_Admin
        $sql_login = "INSERT INTO Login_Admin (Username_Email, Password) VALUES (?, ?)";
        $stmt_login = $conn->prepare($sql_login);
        $stmt_login->bind_param("ss", $username, $password);

        if ($stmt_login->execute()) {
            // Dapatkan ID admin terakhir yang di-generate
            $id_admin = $conn->insert_id;

            // Insert ke tabel Admin
            $sql_admin = "INSERT INTO Admin (Id_admin, Nama, Email, Nomor_telpon, Alamat)
                          VALUES (?, ?, ?, ?, ?)";
            $stmt_admin = $conn->prepare($sql_admin);
            $stmt_admin->bind_param("issss", $id_admin, $nama, $username, $nomor_telpon, $alamat);

            if ($stmt_admin->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Registrasi admin berhasil",
                    "Id_admin" => $id_admin,
                    "Nama" => $nama,
                    "Email" => $username,
                    "Nomor_telpon" => $nomor_telpon,
                    "Alamat" => $alamat
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menyimpan data admin"
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
