<?php
require '../db/db_connect.php'; // Ensure this path is correct

$stmt = $conn->prepare("SELECT idToBeOrdered, Model, Quantity FROM ToBeOrderedChargers");
$stmt->execute();

$output = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output .= "<tr>
                    <td>{$row['Model']}</td>
                    <td>{$row['Quantity']}</td>
                    <td><input type='checkbox' class='confirmCheckbox' data-id='{$row['idToBeOrdered']}'></td>
                </tr>";
}

echo $output;
?>
