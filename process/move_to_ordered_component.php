<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    try {
        // Fetch the row to move
        $stmt = $conn->prepare("SELECT Type, Name, Model, Quantity FROM ToBeOrderedComponents WHERE idToBeOrderedComponent = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Insert into OrderedComponents table
            $insertStmt = $conn->prepare("INSERT INTO OrderedComponents (Type, Name, Model, Quantity) VALUES (?, ?, ?, ?)");
            $insertStmt->execute([$row['Type'], $row['Name'], $row['Model'], $row['Quantity']]);

            // Delete from ToBeOrderedComponents table
            $deleteStmt = $conn->prepare("DELETE FROM ToBeOrderedComponents WHERE idToBeOrderedComponent = ?");
            $deleteStmt->execute([$id]);

            echo "Row moved successfully!";
        } else {
            echo "Error: Row not found.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
