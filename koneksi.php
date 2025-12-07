<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika menggunakan XAMPP default
$db   = "absensi_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>