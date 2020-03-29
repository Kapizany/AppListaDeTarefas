<?php

    //Operacoes de CRUD
    class TarefaService {
        
        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao,Tarefa $tarefa){
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir(){ //Create
            $query = 'insert into tb_tarefas(tarefa) values(:tarefa);';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa',$this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        public function recuperar(){ //Read
            $query = 'SELECT tf.id, tf.tarefa, ts.status from tb_tarefas as tf ';
            $query = $query .'INNER JOIN tb_status ts on ts.id = tf.id_status;';
            //$query = 'Select id,id_status,tarefa from tb_tarefas';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar(){// Update
            $query = '
            UPDATE tb_tarefas
            SET tarefa = :tarefa
            where id = :id
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa',$this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id',$this->tarefa->__get('id'));
            return $stmt->execute();
        }

        public function remover(){ // Delete

            $query = '
            Delete from tb_tarefas
            where id = :id
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id',$this->tarefa->__get('id'));
            $stmt->execute();
        }

        public function marcarRealizada(){
            $query = '
            UPDATE tb_tarefas
            SET id_status = :id_status
            where id = :id
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status',$this->tarefa->__get('id_status'));
            $stmt->bindValue(':id',$this->tarefa->__get('id'));
            return $stmt->execute();
        }

        public function restaurar(){
            $query = '
            UPDATE tb_tarefas
            SET id_status = :id_status
            where id = :id
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status',$this->tarefa->__get('id_status'));
            $stmt->bindValue(':id',$this->tarefa->__get('id'));
            return $stmt->execute();
        }

        public function pendentes(){ //Read
            $query = 'SELECT tf.id, tf.tarefa, ts.status from tb_tarefas as tf 
                        INNER JOIN tb_status ts on ts.id = tf.id_status
                        WHERE tf.id_status = 1';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

?>