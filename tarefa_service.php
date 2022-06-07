<?php

//CRUD - Create, Read, Update, Delete...

class TarefaService {
    private $conexao;
    private $tarefa;

    //construtor:
    public function __construct(Conexao $conexao, Tarefa $tarefa) {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    // metodo de incersão de tarefa
    public function inserir() {
        $query = 'INSERT INTO tb_tarefa(tarefa) VALUES(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    //metodo de listar todas as tarefas:
    public function recuperar() {
        $query = '
               SELECT t.id, t.tarefa, t.data_cadastro, s.status
                    FROM tb_tarefa as t
               LEFT JOIN tb_status as s on (t.id_status = s.id)';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //metodo que lista apenas as tarefas pendentes:
    public function recuperarTarefasPendentes() {
        $query = '
        SELECT t.id, t.tarefa, t.data_cadastro, s.status
             FROM tb_tarefa as t
        LEFT JOIN tb_status as s on (t.id_status = s.id)
        WHERE t.id_status = :id_status';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function marcarRealizada(){
        $query = "UPDATE tb_tarefa SET id_status = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get("id_status"));
        $stmt->bindValue(2, $this->tarefa->__get("id"));
        return $stmt->execute();
    }
    public function removerTarefa(){
        $query = "DELETE FROM tb_tarefa WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get("id"));
        return $stmt->execute();
    }
    public function atualizarTarefa(){
        $query = "UPDATE tb_tarefa SET id_status = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get("tarefa"));
        $stmt->bindValue(2, $this->tarefa->__get("id"));
        return $stmt->execute();
    }

}

?>