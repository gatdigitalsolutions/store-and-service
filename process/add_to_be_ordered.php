<?php
require '../db/db_connect.php'; // Ensure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['model'];
    $quantity = $_POST['quantity'];

    try {
        $stmt = $conn->prepare("INSERT INTO tobeorderedchargers (Model, Quantity) VALUES (?, ?)");
        $stmt->execute([$model, $quantity]);
        echo "Record added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
