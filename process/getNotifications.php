<?php
require '../db/db_connect.php';
session_start();

header('Content-Type: application/json');

// If session value is not set, default to 0
if (!isset($_SESSION['last_seen_id'])) {
    $_SESSION['last_seen_id'] = 0;
}

$lastSeenId = $_SESSION['last_seen_id'];

try {
    // Count only rows where idClient > lastSeenId
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM Client WHERE idClient > :lastSeenId");
    $stmt->execute(['lastSeenId' => $lastSeenId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(["count" => (int)$row["count"]]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>
