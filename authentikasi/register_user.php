<?php
require '../koneksi/db.php';

// Ambil input JSON dari body permintaan
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Periksa jika data JSON valid
if (!is_array($data)) {
    echo json_encode(array("message" => "Invalid JSON data"));
    exit;
}

// Mendapatkan data dari JSON
$full_name = $data['full_name'] ?? '';
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';
$email = $data['email'] ?? '';

// Validasi input
if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
    echo json_encode(array("message" => "All fields are required"));
    exit;
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data ke tabel
$sql = "INSERT INTO tb_login (full_name,email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(array("message" => "Prepare failed: " . $conn->error));
    exit;
}

$stmt->bind_param("ssss", $full_name,$email, $username, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(array("message" => "User registered successfully"));
} else {
    echo json_encode(array("message" => "Error: User registration failed. " . $stmt->error));
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
