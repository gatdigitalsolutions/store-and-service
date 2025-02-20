<?php
require '../db/db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Get the selected record ID

    try {
        // ✅ Step 1: Fetch record from ToBeOrderedChargers
        $stmt = $conn->prepare("SELECT idToBeOrdered, Type, Name, Model, Quantity FROM ToBeOrderedChargers WHERE idToBeOrdered = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // ✅ Step 2: Insert into OrderedChargers (including Type, Name, and Model)
            $stmt = $conn->prepare("INSERT INTO OrderedChargers (ToBeOrdered_idToBeOrdered, Type, Name, Model, Quantity) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $record['idToBeOrdered'],
                $record['Type'],
                $record['Name'],
                $record['Model'],
                $record['Quantity']
            ]);

            if ($stmt->rowCount() > 0) {
                // ✅ Step 3: Delete from ToBeOrderedChargers **only if insertion was successful**
                $stmt = $conn->prepare("DELETE FROM ToBeOrderedChargers WHERE idToBeOrdered = ?");
                $stmt->execute([$id]);

                echo "✅ Successfully moved to OrderedChargers!";
            } else {
                echo "❌ Failed to insert into OrderedChargers.";
            }
        } else {
            echo "❌ Record not found!";
        }
    } catch (PDOException $e) {
        echo "❌ SQL Error: " . $e->getMessage();
    }
}
?>
