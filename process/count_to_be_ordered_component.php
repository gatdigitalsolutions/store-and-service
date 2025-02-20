<?php
require '../db/db_connect.php';

try {
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM ToBeOrderedComponents");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['total']; // Return the count
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
