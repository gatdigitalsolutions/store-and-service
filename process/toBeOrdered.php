<?php
require '../db/db_connect.php';
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

if ($action === "fetch") {
    // Fetch all items
    $result = $conn->query("SELECT * FROM ToBeOrderedChargers");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode($items);
} elseif ($action === "add") {
    // Add a new item
    $data = json_decode(file_get_contents("php://input"), true);
    $model = $conn->real_escape_string($data['model']);
    $quantity = (int) $data['quantity'];

    $query = "INSERT INTO ToBeOrderedChargers (Model, Quantity) VALUES ('$model', $quantity)";
    if ($conn->query($query) === TRUE) {
        $id = $conn->insert_id;
        echo json_encode(["success" => true, "item" => ["idToBeOrdered" => $id, "Model" => $model, "Quantity" => $quantity]]);
    } else {
        echo json_encode(["success" => false]);
    }
} elseif ($action === "confirm") {
    // Move an item to OrderedChargers
    $data = json_decode(file_get_contents("php://input"), true);
    $idToBeOrdered = (int) $data['idToBeOrdered'];
    $quantity = (int) $data['quantity'];

    $query = "INSERT INTO OrderedChargers (ToBeOrdered_idToBeOrdered, Quantity) VALUES ($idToBeOrdered, $quantity)";
    if ($conn->query($query) === TRUE) {
        $conn->query("DELETE FROM ToBeOrderedChargers WHERE idToBeOrdered = $idToBeOrdered");
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}

$conn->close();
?>
