<?php

    require_once 'ConexaoService.php';

    Class ElencoService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Elenco ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Elenco WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }        

        public function VerificarSeElencoExiste($ElencoNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Elenco WHERE Nome = :elencoNome');

            $cmd->bindValue(':elencoNome', $elencoNome);

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

            $elencoNome = $_POST['elencoNome'];

            if(!isset($elencoNome)){
                return $result;
            }

            $existeElenco = $this::VerificarSeElencoExiste($elencoNome);

            if($existeElenco){
                $result = $json->Data(false, "Aviso", "Desculpe, esse ator já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Elenco (Nome) VALUES (:elencoNome)');

            $cmd->bindValue(':elencoNome', $elencoNome);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Ator cadastrado com sucesso!");
            }

            return $result;

        }       

    }

?>