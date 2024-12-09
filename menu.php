<?php
require_once __DIR__ . '/vendor/autoload.php';

use Jonas\ToDo\Dao\TasksDAO;
use Jonas\ToDo\Model\Connection;
use Jonas\ToDo\Model\Tasks;

$conn = Connection::createConnection();
$taskDAO = new TasksDAO($conn);


do {
    echo "------------------------------------------ \n ";
    print("Opções: 
       1 = buscar tudo;
       2 = inserir;
       3 = editar;
       4 = deletar;
       5 = sair;
------------------------------------------ \n");

    $opcao = readline('Escolha uma opção: ');

    switch ($opcao) {
        case 1:
            $tasks = $taskDAO->read();

            foreach ($tasks as $task) {
                echo "------------------------------------------ \n ";
                echo "id: " . $task->getId() . "\n";
                echo "titulo: " . $task->getTitle() . "\n";
                echo "descrição: " . $task->getDescription() . "\n";
                echo "status: " . $task->getStatus() . "\n";
            }
            break;

        case 2:
            $titulo = readline("titulo: ");
            $descricao = readline("descricao: ");
            $status = readline("status: ");

            $task = new Tasks($titulo, $descricao, $status);

            $taskDAO->insert($task);
            break;

        case 3:
            $id = readline("Insira um id para editar: ");
            $task = $taskDAO->readByID($id);

            echo "a task com id $id é: \n";
            echo "id: " . $task[0]->getId() . "\n";
            echo "titulo: " . $task[0]->getTitle() . "\n";
            echo "descrição: " . $task[0]->getDescription() . "\n";
            echo "status: " . $task[0]->getStatus() . "\n";

            $confirmação = readline("quer mesmo mudar essa task? ");

            if ($confirmação == "sim") {
                echo "insira os novos dados: \n";

                $titulo = readline("titulo: ");
                $descricao = readline("descricao: ");
                $status = readline("status: ");

                $task2 = new Tasks($titulo, $descricao, $status);
                $task2->setId($id);

                $taskDAO->update($task2);
                echo "\n";
                print("edição feita com sucesso! aqui está a nova task: \n");

                $task = $taskDAO->readByID($id);
                echo "a task com id $id é: \n";
                echo "id: " . $task[0]->getId() . "\n";
                echo "titulo: " . $task[0]->getTitle() . "\n";
                echo "descrição: " . $task[0]->getDescription() . "\n";
                echo "status: " . $task[0]->getStatus() . "\n";

            }
            break;

        case 4:
            $id = readline("Insira o Id para deletar: ");
            $confirmacao = strtolower(readline("Tem certeza que deseja excluir este item? (sim/não): "));

            if ($confirmacao !== 'sim') {
                echo "ok, encerrando a operação. \n";
                break;
            }

            if ($taskDAO->delete($id) === True) {
                echo "$id deletado com sucesso! \n";
            }
            break;
    }
} while ($opcao != 5);