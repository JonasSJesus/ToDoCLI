<?php

namespace Jonas\ToDo\Model;

use PDO;

class Connection
{
    public static function createConnection(): PDO
    {
        $host = 'localhost:3306';
        $dbname = 'todolist';
        $user = 'root';
        $password = 'jonassj7';

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    }
}
