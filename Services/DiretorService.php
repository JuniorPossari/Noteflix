<?php

    require_once 'ConexaoService.php';

    Class DiretorService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Diretor');

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

        public function Salvar($dados){

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

            $cmd->bindValue(':diretorNome', $diretorNome);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Diretor cadastrado com sucesso!");
            }

            return $result;

        }       

    }

?>