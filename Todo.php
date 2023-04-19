<?php
class Todo extends Conn{
    public object $conn;
    public array $formData;

    public int $id;
    public string $status;
    public string $data;



    public function list():array
    {
        $this->conn = $this->connectDb();
        $query_todo = "SELECT id, data, tarefa, status FROM tarefas ORDER BY id DESC LIMIT 40";
        $result_todo = $this->conn->prepare($query_todo);
        $result_todo->execute();
        $retorno = $result_todo->fetchAll();
        //var_dump($retorno);
        return $retorno;
    }


    public function listStatus():array
    {
        
        $this->conn = $this->connectDb();
        $query_todo= "SELECT `id`, `data`, `tarefa`, `created`, `status` FROM `tarefas` WHERE data LIKE = data='%:data%" ;
        $result_todo = $this->conn->prepare($query_todo);
        $result_todo->bindParam(':data', $this->data);
        $result_todo->execute();
        $value = $result_todo->fetch();
        return $value;
    }


    public function create(): bool
    {
        //var_dump($this->formData);
        $this->conn = $this->connectDb();
        $query_todo = "INSERT INTO tarefas (data, tarefa, created) VALUES (:data, :tarefa, NOW())";
        $add_todo = $this->conn->prepare($query_todo);
        $add_todo->bindParam(':data', $this->formData['data']);
        $add_todo->bindParam(':tarefa', $this->formData['tarefa']);
        $add_todo->execute();

        if ($add_todo->rowCount()) {
            return true;
        } else {
            return false;
        }
    }


    public function view()
    {
        $this->conn = $this->connectDb();
        $query_todo= "SELECT id, data, tarefa, status, created
                        FROM tarefas
                        WHERE id =:id
                        LIMIT 1";
        $result_todo = $this->conn->prepare($query_todo);
        $result_todo->bindParam(':id', $this->id);
        $result_todo->execute();
        $value = $result_todo->fetch();
        return $value;
    }









    public function edit() : bool
    {
        $this->conn = $this->connectDb();
        $query_todo = "UPDATE tarefas SET data=:data, status=:status, tarefa=:tarefa 
                    WHERE id=:id";
        $edit_todo = $this->conn->prepare($query_todo);
        $edit_todo->bindParam(':data', $this->formData['data']);
        $edit_todo->bindParam(':tarefa', $this->formData['tarefa']);
        $edit_todo->bindParam(':status', $this->formData['status']);
        $edit_todo->bindParam(':id', $this->formData['id']);
        $edit_todo->execute();

        if($edit_todo->rowCount()){
            return true;
        }else{
            return false;
        }
    }


    public function delete(): bool
    {
        $this->conn = $this->connectDb();
        $query_todo = "DELETE FROM tarefas WHERE id=:id LIMIT 1";
        $delete_todo = $this->conn->prepare($query_todo);
        $delete_todo->bindParam(':id', $this->id);
        $value  = $delete_todo->execute();
        return $value;
    }
    
}