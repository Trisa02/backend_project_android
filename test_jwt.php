<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

// Secret key
$secret_key = "YOUR_SECRET_KEY";

// Payload data
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => time(),
    "exp" => time() + 3600,
    "data" => array(
        "id" => 1,
        "name" => "John Doe"
    )
);

// Encode JWT
$jwt = JWT::encode($payload, $secret_key, 'HS256');
echo "JWT: " . $jwt . "\n";

// Decode JWT
try {
    $decoded = JWT::decode($jwt, $secret_key, ['HS256']); // Gunakan array untuk algoritma
    print_r($decoded);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
