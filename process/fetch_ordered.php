<?php
require '../db/db_connect.php';

$stmt = $conn->prepare("SELECT idOrdered, Model, Quantity FROM OrderedChargers");
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$rows) {
    echo "<tr><td colspan='3' style='text-align: center;'>No data found</td></tr>";
} else {
    $output = "";
    foreach ($rows as $row) {
        $output .= "<tr id='row_{$row['idOrdered']}'>
                        <td>{$row['Model']}</td>
                        <td>{$row['Quantity']}</td>
                        <td><input type='checkbox' class='confirmCheckbox' data-id='{$row['idOrdered']}'></td>
                    </tr>";
    }
    echo $output;
}
?>