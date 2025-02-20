<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    try {
        // Fetch the row to move
        $stmt = $conn->prepare("SELECT Type, Name, Model, Quantity FROM OrderedComponents WHERE idOrderedComponent = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Insert into DeliveredComponents table
            $insertStmt = $conn->prepare("INSERT INTO DeliveredComponents (Type, Name, Model, Quantity) VALUES (?, ?, ?, ?)");
            $insertStmt->execute([$row['Type'], $row['Name'], $row['Model'], $row['Quantity']]);

            // Delete from OrderedComponents table
            $deleteStmt = $conn->prepare("DELETE FROM OrderedComponents WHERE idOrderedComponent = ?");
            $deleteStmt->execute([$id]);

            echo "Item moved to DeliveredComponents!";
        } else {
            echo "Error: Item not found.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
