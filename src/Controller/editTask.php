<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Jonas\ToDo\Dao\TasksDAO;
use Jonas\ToDo\Model\Connection;
use Jonas\ToDo\Model\Tasks;

$conn = Connection::createConnection();
$tasksDAO = new TasksDAO($conn);


$task = new Tasks(
    'Compras',
    'comprar: arroz',
    'ativa');
$task->setId(1);

$tasksDAO->update($task);