<?php

namespace Jonas\ToDo\Dao;

use Jonas\ToDo\Model\Tasks;
use PDO;

class TasksDAO
{
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    // Inserir
    public function insert(Tasks $tasks)
    {
        $sql = 'INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $tasks->getTitle());
        $stmt->bindValue(2, $tasks->getDescription());
        $stmt->bindValue(3, $tasks->getStatus());
        $stmt->execute();
    }

    // Buscar
    public function readByID(int $id): array
    {
        $sql = "SELECT * FROM tasks WHERE id = $id";
        $stmt = $this->conn->query($sql);

        return $this->toPoo($stmt);
    }
    public function read(): array
    {
        $sql = "SELECT * FROM tasks;";
        $stmt = $this->conn->query($sql);

        return $this->toPoo($stmt);
    }

    public function toPoo(\PDOStatement $stmt): array
    {
        $allData = $stmt->fetchAll();
        $taskList = [];

        foreach ($allData as $data){
            $task = new Tasks(
                $data['title'],
                $data['description'],
                $data['status']
            );
            $task->setId($data['id']);
            $taskList[] = $task;
        }
        return $taskList;
    }

    // Editar
    public function update(Tasks $tasks): bool
    {
        $sql = "UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $tasks->getTitle());
        $stmt->bindValue(2, $tasks->getDescription());
        $stmt->bindValue(3, $tasks->getStatus());
        $stmt->bindValue(4, $tasks->getId());

        return $stmt->execute();
    }
    
    // Deletar
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
}
