<?php

namespace Jonas\ToDo\Controller;

class TaskManager
{
    private $taskDAO;

    public function __construct($taskDAO)
    {
        $this->taskDAO = $taskDAO;
    }

    // Implementar métodos auxiliares para o case 'EDITAR' ficar mais legível
}