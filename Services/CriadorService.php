<?php

    require_once 'ConexaoService.php';

    Class CriadorService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Criador ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Criador WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }        

        public function VerificarSeCriadorExiste($criadorNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Criador WHERE Nome = :criadorNome');

            $cmd->bindValue(':criadorNome', $criadorNome);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }        

        public function Salvar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse criador!");

            $criadorNome = $_POST['criadorNome'];

            if(!isset($criadorNome)){
                return $result;
            }

            $existeCriador = $this::VerificarSeCriadorExiste($criadorNome);

            if($existeCriador){
                $result = $json->Data(false, "Aviso", "Desculpe, esse criador já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Criador (Nome) VALUES (:criadorNome)');

            $cmd->bindValue(':criadorNome', strtoupper($criadorNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Criador cadastrado com sucesso!");
            }

            return $result;

        }
        
        public function SalvarAlteracao($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse criador!");

            $criadorId = $_POST['criadorId'];
            $criadorNome = $_POST['criadorNome'];

            if(!isset($criadorId) || !isset($criadorNome)){
                return $result;
            }            

            $cmd = $this->con->prepare('UPDATE Criador SET Nome = :criadorNome WHERE Id = :criadorId');

            $cmd->bindValue(':criadorId', $criadorId);
            $cmd->bindValue(':criadorNome', strtoupper($criadorNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Criador alterado com sucesso!");
            }

            return $result;

        }
        
        public function Excluir($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse criador!");

            $id = $_POST['id'];

            $cmd = $this->con->prepare('DELETE FROM Criador WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Criador excluido com sucesso!");
            }

            return $result;

        }

    }

?>