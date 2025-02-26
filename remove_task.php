<?php
session_start();

header("Content-Type: application/json");

// Récupérer les données envoyées
$data = json_decode(file_get_contents("php://input"), true);

// Vérifier que la session contient des tâches
if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}

// Vérifier que l'index est bien fourni et valide
if (isset($data["index"]) && is_numeric($data["index"])) {
    $index = (int) $data["index"];

    if (isset($_SESSION["tasks"][$index])) {
        array_splice($_SESSION["tasks"], $index, 1);
    }
}

// Retourner la liste des tâches mise à jour
echo json_encode(["success" => true, "tasks" => $_SESSION["tasks"]]);
?>
