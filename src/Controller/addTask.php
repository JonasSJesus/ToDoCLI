<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Jonas\ToDo\Dao\TasksDAO;
use Jonas\ToDo\Model\Connection;
use Jonas\ToDo\Model\Tasks;

$conn = Connection::createConnection();
$tasks = new Tasks('Compras', 'comprar: arroz, feijao, carne, batata', 'ativa');
$tasksDAO = new TasksDAO($conn);

$tasksDAO->insert($tasks);