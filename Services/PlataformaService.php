<?php

    require_once 'ConexaoService.php';

    Class PlataformaService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Plataforma ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Plataforma WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }        

        public function VerificarSePlataformaExiste($plataformaNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Plataforma WHERE Nome = :plataformaNome');

            $cmd->bindValue(':plataformaNome', $plataformaNome);

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
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse plataforma!");

            $plataformaNome = $_POST['plataformaNome'];

            if(!isset($plataformaNome)){
                return $result;
            }

            $existePlataforma = $this::VerificarSePlataformaExiste($plataformaNome);

            if($existePlataforma){
                $result = $json->Data(false, "Aviso", "Desculpe, esse plataforma já foi cadastrado!");
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Plataforma (Nome) VALUES (:plataformaNome)');

            $cmd->bindValue(':plataformaNome', strtoupper($plataformaNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero cadastrado com sucesso!");
            }

            return $result;

        } 
        
        public function SalvarAlteracao($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse plataforma!");

            $plataformaId = $_POST['plataformaId'];
            $plataformaNome = $_POST['plataformaNome'];

            if(!isset($plataformaId) || !isset($plataformaNome)){
                return $result;
            }            

            $cmd = $this->con->prepare('UPDATE Plataforma SET Nome = :plataformaNome WHERE Id = :plataformaId');

            $cmd->bindValue(':plataformaId', $plataformaId);
            $cmd->bindValue(':plataformaNome', strtoupper($plataformaNome));

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero alterado com sucesso!");
            }

            return $result;

        }
        
        public function Excluir($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse plataforma!");

            $id = $_POST['id'];

            $cmd = $this->con->prepare('DELETE FROM Plataforma WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Gênero excluido com sucesso!");
            }

            return $result;

        }

    }

?>