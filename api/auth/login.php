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

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM Login_Pelanggan WHERE Username_Email = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt_pelanggan = $conn->prepare("SELECT * FROM Pelanggan WHERE Email = ?");
        $stmt_pelanggan->bind_param("s", $username);
        $stmt_pelanggan->execute();
        $result_pelanggan = $stmt_pelanggan->get_result();

        if ($result_pelanggan->num_rows > 0) {
            $pelanggan = $result_pelanggan->fetch_assoc();

            // Format JSON sesuai dengan permintaan
            $response = [
                "status" => "success",
                "message" => "Login berhasil"
            ] + $pelanggan; // Gabungkan array pelanggan langsung ke response

            echo json_encode($response);
        } else {
            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "Data pelanggan tidak ditemukan"
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