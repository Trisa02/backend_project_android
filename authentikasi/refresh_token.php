<?php
require '../koneksi/db.php';
require '../vendor/autoload.php'; // Pastikan path ke autoload benar

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Konfigurasi JWT
$secret_key = "YOUR_SECRET_KEY"; // Ganti dengan secret key yang kuat
$refresh_secret_key = "YOUR_REFRESH_SECRET_KEY"; // Secret key untuk refresh token
$algorithm = 'HS256';

// Ambil input JSON dari body permintaan
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Periksa jika data JSON valid
if (!is_array($data)) {
    echo json_encode(array("message" => "Invalid JSON data"));
    exit;
}

// Mendapatkan data dari JSON
$refresh_token = $data['refresh_token'] ?? '';

// Validasi input
if (empty($refresh_token)) {
    echo json_encode(array("message" => "Refresh token is required"));
    exit;
}

try {
    // Verifikasi refresh token
    $decoded = JWT::decode($refresh_token, new Key($refresh_secret_key, $algorithm));

    // Buat token akses baru
    $payload = array(
        "iss" => "http://example.com",
        "aud" => "http://example.com",
        "iat" => time(),
        "exp" => time() + 3600, // Token berlaku 1 jam
        "data" => array(
            "id" => $decoded->data->id,
            "username" => $decoded->data->username
        )
    );

    $jwt = JWT::encode($payload, $secret_key, $algorithm);

    // Kirim respons
    echo json_encode(array(
        "message" => "Token refreshed successfully",
        "token" => $jwt
    ));
} catch (Exception $e) {
    echo json_encode(array("message" => "Invalid refresh token"));
}

// Tutup koneksi
$conn->close();
?>
