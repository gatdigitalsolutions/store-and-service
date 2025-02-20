<?php
require '../db/db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$stmt = $conn->prepare("SELECT idClient, Name, PhoneNo, ServiceType FROM Client;");
$stmt->execute();

$output = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = isset($row['idClient']) ? $row['idClient'] : '';

    $output .= "<tr>
                    <td>{$row['Name']}</td>
                    <td>{$row['PhoneNo']}</td>
                    <td>{$row['ServiceType']}</td>
                    <td><input type='checkbox' class='deliveryCheckbox' data-id='{$id}'></td>
                </tr>";
}
echo $output;
?>
