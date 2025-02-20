<?php
require '../db/db_connect.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$stmt = $conn->prepare("SELECT idToBeOrderedComponent, Type, Name, Model, Quantity FROM ToBeOrderedComponents;");
$stmt->execute();

$output = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = isset($row['idToBeOrderedComponent']) ? $row['idToBeOrderedComponent'] : '';

    $output .= "<tr>
                    <td>{$row['Type']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Model']}</td>
                    <td>{$row['Quantity']}</td>
                    <td><input type='checkbox' class='confirmCheckbox' data-id='{$id}'></td>
                </tr>";
}
echo $output;
?>
