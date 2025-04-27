<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    $sql = "UPDATE Login_Pelanggan SET Password = '$new_password' WHERE Username_Email = '$username'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Password updated successfully",
            "data" => null
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error updating password",
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