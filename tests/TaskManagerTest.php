<?php
use PHPUnit\Framework\TestCase;
use Boumilmounir\TestUnitaire\TaskManager; // Ajoute cette ligne

require_once __DIR__ . '/../TaskManager.php';

class TaskManagerTest extends TestCase {
    public function testAddTask() {
        $taskManager = new TaskManager();
        $taskManager->addTask("Faire les courses");
        $this->assertEquals(["Faire les courses"], $taskManager->getTasks());
    }

    public function testRemoveTask() {
        $taskManager = new TaskManager();
        $taskManager->addTask("Faire les courses");
        $taskManager->removeTask(0);
        $this->assertEquals([], $taskManager->getTasks());
    }

public function testGetTasks() {
    $taskManager = new TaskManager();
    $taskManager->addTask("Tâche 1");
    $taskManager->addTask("Tâche 2");
    $this->assertEquals(["Tâche 1", "Tâche 2"], $taskManager->getTasks());
}

public function testGetTask() {
    $taskManager = new TaskManager();
    $taskManager->addTask("Tâche unique");
    $this->assertEquals("Tâche unique", $taskManager->getTask(0));
}

public function testRemoveInvalidIndexThrowsException() {
    $this->expectException(OutOfBoundsException::class);
    $taskManager = new TaskManager();
    $taskManager->removeTask(10); // Suppression d’un index invalide
}

public function testGetInvalidIndexThrowsException() {
    $this->expectException(OutOfBoundsException::class);
    $taskManager = new TaskManager();
    $taskManager->getTask(5); // Récupération d’un index inexistant
}

public function testTaskOrderAfterRemoval() {
    $taskManager = new TaskManager();
    $taskManager->addTask("Tâche 1");
    $taskManager->addTask("Tâche 2");
    $taskManager->addTask("Tâche 3");
    $taskManager->removeTask(1);
    $this->assertEquals(["Tâche 1", "Tâche 3"], $taskManager->getTasks());
}
}