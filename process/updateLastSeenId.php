<?php
require '../db/db_connect.php';
session_start();

try {
    // Get the highest idClient (latest record)
    $stmt = $conn->query("SELECT MAX(idClient) AS max_id FROM Client");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $row["max_id"]) {
        $_SESSION['last_seen_id'] = $row["max_id"]; // Update session with latest ID
    }

    echo json_encode(["success" => true, "last_seen_id" => $_SESSION['last_seen_id']]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>
