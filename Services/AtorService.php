<?php

    require_once 'ConexaoService.php';

    Class AtorService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Ator ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Ator WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }        

        public function VerificarSeAtorExiste($atorNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Ator WHERE Nome = :atorNome');

            $cmd->bindValue(':atorNome', $atorNome);

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
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse ator!");

            $atorNome = $_POST['atorNome'];

            if(!isset($atorNome)){
                return $result;
            }

            $existeAtor = $this::VerificarSeAtorExiste($atorNome);

            if($existeAtor){
                $result = $json->Data(false, "Aviso", "Desculpe, esse ator já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Ator (Nome) VALUES (:atorNome)');

            $cmd->bindValue(':atorNome', $atorNome);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Ator cadastrado com sucesso!");
            }

            return $result;

        }       

    }

?>