<?php
$conn = new mysqli("localhost", "root", "", "db_location");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>