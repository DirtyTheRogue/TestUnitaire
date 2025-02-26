<?php
session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}

if (!empty($data["task"])) {
    $_SESSION["tasks"][] = $data["task"];
}

echo json_encode(["success" => true, "tasks" => $_SESSION["tasks"]]);
?>
