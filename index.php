<?php
session_start();
require_once 'TaskManager.php';

$taskManager = new Boumilmounir\TestUnitaire\TaskManager();

// Vérifier si la session contient déjà des tâches
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

foreach ($_SESSION['tasks'] as $task) {
    if (is_string($task)) { // Vérifie que ce n'est pas un array
        $taskManager->addTask($task);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const taskInput = document.getElementById("taskInput");
            const addTaskButton = document.getElementById("addTaskButton");

            // Ajouter une tâche
            addTaskButton.addEventListener("click", function () {
                const taskValue = taskInput.value.trim();
                if (taskValue === "") return; // Empêcher d'ajouter une tâche vide

                fetch("add_task.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ task: taskValue })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTaskList(data.tasks);
                        taskInput.value = ""; // Réinitialiser l'input
                    }
                });
            });

            // Supprimer une tâche
            document.addEventListener("click", function (event) {
                if (event.target.classList.contains("deleteTaskButton")) {
                    const index = event.target.dataset.index;

                    fetch("remove_task.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ index: index })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateTaskList(data.tasks);
                        }
                    });
                }
            });

            // Mettre à jour la liste des tâches (évite le rechargement de la page)
            function updateTaskList(tasks) {
                const taskList = document.getElementById("taskList");
                taskList.innerHTML = ""; // Effacer l'ancienne liste
                tasks.forEach((task, index) => {
                    const li = document.createElement("li");
                    li.innerHTML = `${task} <button class="deleteTaskButton" data-index="${index}">Supprimer</button>`;
                    taskList.appendChild(li);
                });
            }
        });
    </script>
    <style>
        body { font-family: Arial, sans-serif; background: #222; color: white; padding: 20px; }
        h1 { text-align: center; }
        input, button { padding: 10px; margin: 5px; }
        ul { list-style-type: none; padding: 0; }
        li { background: #333; padding: 10px; margin: 5px; display: flex; justify-content: space-between; }
        .deleteTaskButton { background: red; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Gestion des Tâches</h1>
    <input type="text" id="taskInput" placeholder="Ajouter une tâche">
    <button id="addTaskButton">Ajouter</button>

    <ul id="taskList">
        <?php foreach ($_SESSION['tasks'] as $index => $task) : ?>
            <li>
                <?= htmlspecialchars($task) ?>
                <button class="deleteTaskButton" data-index="<?= $index ?>">Supprimer</button>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
