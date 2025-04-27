<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Username dan password harus diisi"
        ]);
        exit();
    }

    // Validasi login admin
    $stmt = $conn->prepare("SELECT * FROM Login_Admin WHERE Username_Email = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data admin dari tabel Admin
        $stmt_admin = $conn->prepare("SELECT * FROM Admin WHERE Email = ?");
        $stmt_admin->bind_param("s", $username);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows > 0) {
            $admin = $result_admin->fetch_assoc();

            $response = [
                "status" => "success",
                "message" => "Login berhasil"
            ] + $admin;

            echo json_encode($response);
        } else {
            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "Data admin tidak ditemukan"
            ]);
        }
    } else {
        http_response_code(401);
        echo json_encode([
            "status" => "error",
            "message" => "Username atau password salah"
        ]);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Metode tidak diizinkan"
    ]);
}

$conn->close();
?>
