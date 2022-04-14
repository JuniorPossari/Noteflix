<?php

    require_once 'ConexaoService.php';

    Class GeneroService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Genero ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Genero WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }        

        public function VerificarSeGeneroExiste($generoNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Genero WHERE Nome = :generoNome');

            $cmd->bindValue(':generoNome', $generoNome);

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
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse gênero!");

            $generoNome = $_POST['generoNome'];

            if(!isset($generoNome)){
                return $result;
            }

            $existeGenero = $this::VerificarSeGeneroExiste($generoNome);

            if($existeGenero){
                $result = $json->Data(false, "Aviso", "Desculpe, esse gênero já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Genero (Nome) VALUES (:generoNome)');

            $cmd->bindValue(':generoNome', mb_strtoupper($generoNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero cadastrado com sucesso!");
            }

            return $result;

        } 
        
        public function SalvarAlteracao(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse gênero!");

            $generoId = $_POST['generoId'];
            $generoNome = $_POST['generoNome'];

            if(!isset($generoId) || !isset($generoNome)){
                return $result;
            }            

            $cmd = $this->con->prepare('UPDATE Genero SET Nome = :generoNome WHERE Id = :generoId');

            $cmd->bindValue(':generoId', $generoId);
            $cmd->bindValue(':generoNome', mb_strtoupper($generoNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero alterado com sucesso!");
            }

            return $result;

        }
        
        public function Excluir(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse gênero!");

            $id = $_POST['id'];

            $cmd = $this->con->prepare('DELETE FROM Genero WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero excluido com sucesso!");
            }

            return $result;

        }

    }

?>