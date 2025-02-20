<?php
require '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize input

    try {
        $stmt = $conn->prepare("DELETE FROM Client WHERE idClient = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo "success";
        } else {
            echo "Error: Client not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
?>
