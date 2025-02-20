<?php
require '../db/db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Get the selected record ID

    try {
        // Fetch record from OrderedChargers
        $stmt = $conn->prepare("SELECT idOrdered, Model, Name, Quantity FROM OrderedChargers WHERE idOrdered = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Insert into DeliveredChargers
            $stmt = $conn->prepare("INSERT INTO DeliveredChargers (Ordered_idOrdered, Model, Name, Quantity) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $record['idOrdered'],
                $record['Model'],
                $record['Name'],
                $record['Quantity']
            ]);

            if ($stmt->rowCount() > 0) {
                // Delete from OrderedChargers
                $stmt = $conn->prepare("DELETE FROM OrderedChargers WHERE idOrdered = ?");
                $stmt->execute([$id]);

                echo "✅ Moved successfully!";
            } else {
                echo "❌ Insert failed!";
            }
        } else {
            echo "❌ Record not found!";
        }
    } catch (PDOException $e) {
        echo "❌ SQL Error: " . $e->getMessage();
    }
}
?>
