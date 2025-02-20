<?php
$host = "localhost";
$dbname = "store_and_service_management";
$username = "root"; // Default XAMPP username
$password = ""; // Leave blank for XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
