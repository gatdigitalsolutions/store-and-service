<?php
session_start();
require '../db/db_connect.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($role) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM Admin WHERE Username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "Username already exists."]);
            exit;
        }

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO Admin (Role, Username, Passkey) VALUES (?, ?, ?)");
        $stmt->execute([$role, $username, $hashedPassword]);

        echo json_encode(["status" => "success", "message" => "Signup successful!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
