<?php
require '../db/db_connect.php';

try {
    $data = [];

    // Count rows in each table
    $tables = [
        "ToBeOrderedChargers" => "toBeOrdered",
        "OrderedChargers" => "ordered",
        "DeliveredChargers" => "delivered",
        "ToBeOrderedComponents" => "toBeOrderedComponents",
        "OrderedComponents" => "orderedComponents",
        "DeliveredComponents" => "deliveredComponents"
    ];

    foreach ($tables as $table => $key) {
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM $table");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data[$key] = $row['count'];
    }

    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
