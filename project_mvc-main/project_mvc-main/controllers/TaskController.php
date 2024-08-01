<?php

include_once 'models/Task.php';

class TaskController {
    private $db;
    private $task;

    public function __construct($db) {
        $this->db = $db;
        $this->task = new Task($db);
    }

    // Método para criar um novo usuário
    public function create($task, $prazo) {
        $this->task->task = $task;
        $this->task->prazo = $prazo;

        if($this->task->create()) {
            return "Usuário criado.";
        } else {
            return "Não foi possível criar usuário.";
        }
    }
    // Método para obter detalhes de um usuário pelo ID
    public function readOne($id) {
        $this->task->id = $id;
        $this->task->readOne();

        if($this->task->task != null) {
            // Cria um array associativo com os detalhes do usuário
            $user_arr = array(
                "id" => $this->task->id,
                "task" => $this->task->task,
                "prazo" => $this->task->prazo
            );
            return $user_arr;
        } else {
            return "Usuário não localizado.";
        }
    }

    // Método para atualizar os dados de um usuário
    public function update($id, $task, $prazo) {
        $this->task->id = $id;
        $this->task->task = $task;
        $this->task->prazo = $prazo;

        if($this->task->update()) {
            return "Usuário atualizado.";
        } else {
            return "Não foi possível atualizar o usuário.";
        }
    }

    // Método para excluir um usuário pelo ID
    public function delete($id) {
        $this->task->id = $id;

        if($this->task->delete()) {
            return "Usuário foi excluído.";
        } else {
            return "Nao foi possível excluir usuário.";
        }
    }
    public function index() {
        return $this->readAll();
    }
    
    // Método para listar todos os usuários (exemplo adicional)
    public function readAll() {
        $query = "SELECT id, task, prazo FROM " . $this->task->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;
    }
}
?>
