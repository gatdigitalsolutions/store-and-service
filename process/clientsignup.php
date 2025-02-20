<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $type = $_POST['service'] ?? ''; // FIXED: Match the form name
    $phone = $_POST['phone'] ?? '';

    if (!empty($name) && !empty($type) && !empty($phone)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Client (Name, ServiceType, PhoneNo) VALUES (?, ?, ?)");
            $stmt->execute([$name, $type, $phone]);
            echo json_encode(["success" => "You have submitted your info successfully!"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Database error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "Invalid input data!"]);
    }
} else {
    echo json_encode(["error" => "Invalid request!"]);
}
?>
