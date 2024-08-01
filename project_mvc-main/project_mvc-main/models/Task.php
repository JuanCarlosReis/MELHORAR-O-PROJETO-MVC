 <?php

class Task {
    private $conn;
    public $table_name = "tasks";

    public $id;
    public $task;
    public $prazo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create - Criar um novo usuário
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (task, prazo) VALUES (:task, :prazo)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->task = htmlspecialchars(strip_tags($this->task));
        $this->prazo = htmlspecialchars(strip_tags($this->prazo));

        // Bind parameters
        $stmt->bindParam(':task', $this->task);
        $stmt->bindParam(':prazo', $this->prazo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Read - Obter detalhes de um usuário pelo ID
    public function readOne() {
        $query = "SELECT task, prazo FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->task = $row['task'];
        $this->prazo = $row['prazo'];
    }

    // Update - Atualizar os dados de um usuário
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET task = :task, prazo = :prazo WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->task = htmlspecialchars(strip_tags($this->task));
        $this->prazo = htmlspecialchars(strip_tags($this->prazo));

        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':task', $this->task);
        $stmt->bindParam(':prazo', $this->prazo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete - Excluir um usuário pelo ID
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>