<?php

    require_once 'ConexaoService.php';

    Class DiretorService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Diretor ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Diretor WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        } 
        
        public function ObterNomePorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT Nome FROM Diretor WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados['Nome'];

        }   

        public function VerificarSeDiretorExiste($diretorNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Diretor WHERE Nome = :diretorNome');

            $cmd->bindValue(':diretorNome', $diretorNome);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }        

        public function Salvar(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse diretor!");

            $diretorNome = $_POST['diretorNome'];

            if(!isset($diretorNome)){
                return $result;
            }

            $existeDiretor = $this::VerificarSeDiretorExiste($diretorNome);

            if($existeDiretor){
                $result = $json->Data(false, "Aviso", "Desculpe, esse diretor já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Diretor (Nome) VALUES (:diretorNome)');

            $cmd->bindValue(':diretorNome', mb_strtoupper($diretorNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Diretor cadastrado com sucesso!");
            }

            return $result;

        } 
        
        public function SalvarAlteracao(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse diretor!");

            $diretorId = $_POST['diretorId'];
            $diretorNome = $_POST['diretorNome'];

            if(!isset($diretorId) || !isset($diretorNome)){
                return $result;
            }            

            $cmd = $this->con->prepare('UPDATE Diretor SET Nome = :diretorNome WHERE Id = :diretorId');

            $cmd->bindValue(':diretorId', $diretorId);
            $cmd->bindValue(':diretorNome', mb_strtoupper($diretorNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Diretor alterado com sucesso!");
            }

            return $result;

        }
        
        public function Excluir(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse diretor!");

            $id = $_POST['id'];

            $cmd = $this->con->prepare('DELETE FROM Diretor WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Diretor excluido com sucesso!");
            }

            return $result;

        }

    }

?>