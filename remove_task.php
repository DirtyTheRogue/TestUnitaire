<?php
session_start();

header("Content-Type: application/json");

// Récupérer les données envoyées
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}
if (isset($data["index"]) && is_numeric($data["index"])) {
    $index = (int) $data["index"];

    if (isset($_SESSION["tasks"][$index])) {
        array_splice($_SESSION["tasks"], $index, 1);
    }
}
echo json_encode(["success" => true, "tasks" => $_SESSION["tasks"]]);
?>
