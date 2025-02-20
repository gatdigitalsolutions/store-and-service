<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'] ?? '';
    $name = $_POST['name'] ?? '';
    $model = $_POST['model'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    if (!empty($type) && !empty($name) && !empty($model) && $quantity > 0) {
        try {
            $stmt = $conn->prepare("INSERT INTO ToBeOrderedComponents (Type, Name, Model, Quantity) VALUES (?, ?, ?, ?)");
            $stmt->execute([$type, $name, $model, $quantity]);
            echo "Item added successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid input data!";
    }
} else {
    echo "Invalid request!";
}
?>
