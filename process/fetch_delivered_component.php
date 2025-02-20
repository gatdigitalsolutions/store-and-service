<?php
require '../db/db_connect.php'; // Ensure this file initializes PDO properly

try {
    $query = "SELECT type, name, model, quantity FROM DeliveredComponents";
    $stmt = $conn->prepare($query); // Use PDO prepared statement
    $stmt->execute();
    $deliveredItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($deliveredItems as $row) {
        echo "<tr>
                <td>{$row['type']}</td>
                <td>{$row['name']}</td>
                <td>{$row['model']}</td>
                <td>{$row['quantity']}</td>
              </tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
