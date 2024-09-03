<?php
require '../koneksi/db.php';
require '../vendor/autoload.php'; // Pastikan path ke autoload benar

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Konfigurasi JWT
$secret_key = "YOUR_SECRET_KEY"; // Ganti dengan secret key yang kuat
$algorithm = 'HS256';

// Ambil token dari header Authorization
$headers = apache_request_headers();
$auth_header = $headers['Authorization'] ?? '';
$bearer_token = str_replace('Bearer ', '', $auth_header);

// Validasi token
if (empty($bearer_token)) {
    echo json_encode(array("message" => "Authorization header not found"));
    exit;
}

try {
    // Verifikasi token
    $decoded = JWT::decode($bearer_token, new Key($secret_key, $algorithm));
    
    // Kirim respons
    echo json_encode(array(
        "message" => "Access granted",
        "data" => $decoded
    ));
} catch (Exception $e) {
    echo json_encode(array("message" => "Invalid token"));
}

// Tutup koneksi
$conn->close();
?>
