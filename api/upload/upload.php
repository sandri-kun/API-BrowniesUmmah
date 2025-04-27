<?php
header('Content-Type: application/json'); // Set header JSON untuk respons API

$target_dir = "public_html/api/assets/"; // Folder tujuan
$uploadOk = 1;
$response = ["status" => "error", "message" => "Unknown error occurred."];

// Pastikan folder tujuan ada, jika tidak buat
if (!file_exists($target_dir) && !mkdir($target_dir, 0777, true)) {
    $response["message"] = "Failed to create upload directory.";
    echo json_encode($response);
    exit;
}

// Periksa apakah ada file yang diunggah
if (!isset($_FILES["bill"]) || $_FILES["bill"]["error"] != 0) {
    $response["message"] = "No file was uploaded or an error occurred.";
    echo json_encode($response);
    exit;
}

// Ambil informasi file
$filename = pathinfo($_FILES["bill"]["name"], PATHINFO_FILENAME);
$filename = preg_replace("/[^a-zA-Z0-9_-]/", "", $filename); // Sanitasi nama file
$imageFileType = strtolower(pathinfo($_FILES["bill"]["name"], PATHINFO_EXTENSION));

// Menggunakan format tanggal dan detik untuk nama file
$timestamp = date("Y-m-d_H-i-s");
$target_file = $target_dir . $filename . "_" . $timestamp . "." . $imageFileType; // Nama file berdasarkan tanggal dan detik

// Validasi ukuran file (Maksimal 10MB)
if ($_FILES["bill"]["size"] > 10 * 1024 * 1024) { // 10MB
    $response["message"] = "File size exceeds 10MB limit.";
    echo json_encode($response);
    exit;
}

// Validasi format file (hanya gambar: JPG, JPEG, PNG, GIF)
$allowed_types = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowed_types)) {
    $response["message"] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
    echo json_encode($response);
    exit;
}

// Validasi apakah file benar-benar gambar
$check = getimagesize($_FILES["bill"]["tmp_name"]);
if ($check === false) {
    $response["message"] = "Uploaded file is not a valid image.";
    echo json_encode($response);
    exit;
}

// Pindahkan file ke folder tujuan
if (move_uploaded_file($_FILES["bill"]["tmp_name"], $target_file)) {
    $response["status"] = "success";
    $response["message"] = "File successfully uploaded.";
    $response["file_url"] = $target_file;
} else {
    $response["message"] = "Error occurred while uploading the file.";
}

echo json_encode($response);
?>
