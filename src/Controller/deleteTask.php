<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Jonas\ToDo\Dao\TasksDAO;
use Jonas\ToDo\Model\Connection;
use Jonas\ToDo\Model\Tasks;

$conn = Connection::createConnection();
$taskDAO = new TasksDAO($conn);

$taskDAO->delete(1);