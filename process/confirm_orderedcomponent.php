<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        // Fetch the item to be confirmed
        $stmt = $conn->prepare("SELECT * FROM ToBeOrderedComponents WHERE idToBeOrderedComponent = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Insert into OrderedComponents table
            $stmt = $conn->prepare("INSERT INTO OrderedComponents (ToBeOrderedComponent_idToBeOrderedComponent, Model, Name, Quantity) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id, $item['Model'], $item['Name'], $item['Quantity']]);

            // Delete from ToBeOrderedComponents table
            $stmt = $conn->prepare("DELETE FROM ToBeOrderedComponents WHERE idToBeOrderedComponent = ?");
            $stmt->execute([$id]);

            echo "Order confirmed successfully!";
        } else {
            echo "Item not found!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>