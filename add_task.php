<?php
session_start();

header("Content-Type: application/json");

// Récupérer les données envoyées
$data = json_decode(file_get_contents("php://input"), true);

// Vérifier que les tâches existent en session
if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [];
}

// Vérifier que la tâche envoyée n'est pas vide
if (!empty($data["task"])) {
    $_SESSION["tasks"][] = $data["task"];
}

// Retourner la liste des tâches mise à jour
echo json_encode(["success" => true, "tasks" => $_SESSION["tasks"]]);
?>
