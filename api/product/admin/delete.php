<?php
header('Content-Type: application/json');
include '../../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memastikan input Id_kue ada
    $Id_kue = $_POST['Id_kue'];

    // Query untuk menghapus data berdasarkan Id_kue
    $sql = "DELETE FROM Kue WHERE Id_kue = '$Id_kue'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Item deleted successfully",
            "data" => null
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error deleting data",
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
