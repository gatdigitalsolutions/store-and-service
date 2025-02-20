<?php
require '../db/db_connect.php';

try {
    $stmt = $conn->prepare("SELECT Model, Quantity FROM DeliveredChargers");
    $stmt->execute();

    $output = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $output .= "<tr>
                        <td>{$row['Model']}</td>
                        <td>{$row['Quantity']}</td>
                    </tr>";
    }

    echo $output;
} catch (PDOException $e) {
    echo "Error fetching delivered items: " . $e->getMessage();
}
?>
