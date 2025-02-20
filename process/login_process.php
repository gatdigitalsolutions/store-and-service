<?php
session_start();
require '../db/db_connect.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);

    try {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM Admin WHERE Username = ? AND Role = ?");
        $stmt->execute([$username, $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Passkey'])) {
            $_SESSION['user_id'] = $user['idAdmin'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Role'];

            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid credentials."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
