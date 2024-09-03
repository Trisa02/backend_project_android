<?php
require '../koneksi/db.php';
require '../vendor/autoload.php'; // Pastikan path ke autoload benar

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Konfigurasi JWT
$secret_key = "YOUR_SECRET_KEY"; // Ganti dengan secret key yang kuat
$refresh_secret_key = "YOUR_REFRESH_SECRET_KEY"; // Secret key untuk refresh token
$algorithm = 'HS256'; // Algoritma yang digunakan untuk encoding

// Ambil input JSON dari body permintaan
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Periksa jika data JSON valid
if (!is_array($data)) {
    echo json_encode(array("message" => "Invalid JSON data"));
    exit;
}

// Mendapatkan data dari JSON
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Validasi input
if (empty($username) || empty($password)) {
    echo json_encode(array("message" => "All fields are required"));
    exit;
}

// Cek pengguna di database
$sql = "SELECT id,password,username,full_name,email FROM tb_login WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(array("message" => "Invalid username or password"));
    exit;
}

$user = $result->fetch_assoc();

// Verifikasi password
if (!password_verify($password, $user['password'])) {
    echo json_encode(array("message" => "Invalid username or password"));
    exit;
}

// Buat token JWT dan refresh token
$payload = array(
    "iss" => "http://example.com",
    "aud" => "http://example.com",
    "iat" => time(),
    "exp" => time() + 3600, // Token berlaku 1 jam
    "data" => array(
        "id" => $user['id'],
        "username" => $username
    )
);

$refresh_payload = array(
    "iss" => "http://example.com",
    "aud" => "http://example.com",
    "iat" => time(),
    "exp" => time() + 1209600, // Refresh token berlaku 2 minggu
    "data" => array(
        "id" => $user['id'],
        "username" => $username
    )
);

$jwt = JWT::encode($payload, $secret_key, $algorithm);
$refresh_token = JWT::encode($refresh_payload, $refresh_secret_key, $algorithm);

// Tampilkan token di log
error_log("JWT: " . $jwt);
error_log("Refresh Token: " . $refresh_token);
error_log("User Data: " . print_r($user, true));

// Kirim respons
echo json_encode(array(
    "message" => "Login successful",
    "token" => $jwt,
    "refresh_token" => $refresh_token,
    "user" => array(
        "id" => $user['id'],
        "username" => $user['username'],
        "full_name" => $user['full_name'],
        "email" => $user['email']
    )
));

// Tutup koneksi
$stmt->close();
$conn->close();
?>
