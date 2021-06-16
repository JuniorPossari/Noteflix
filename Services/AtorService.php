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
            $atorFoto = $_POST['atorFoto'];

            if(!isset($atorNome)){
                return $result;
            }

            $existeAtor = $this::VerificarSeAtorExiste($atorNome);

            if($existeAtor){
                $result = $json->Data(false, "Aviso", "Desculpe, esse ator já foi cadastrado!");
                return $result;
            }

            if(!isset($atorFoto)){
                $atorFoto = "";
            }

            if($atorFoto != ""){
                $atorFoto = base64_decode($atorFoto);
            }            

            $cmd = $this->con->prepare('INSERT INTO Ator (Nome, Foto) VALUES (:atorNome, :atorFoto)');

            $cmd->bindValue(':atorNome', strtoupper($atorNome));
            $cmd->bindValue(':atorFoto', $atorFoto);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Ator cadastrado com sucesso!");
            }

            return $result;

        }
        
        public function BuscarFoto($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível encontrar a foto desse ator!");

            $IdElement = $_POST['idElement'];

            if(!isset($IdElement)){
                return $result;
            }                

            $cmd = $this->con->prepare('SELECT Foto FROM Ator WHERE Id = :id AND Foto IS NOT NULL');

            $cmd->bindValue(':id', $IdElement);

            $sucesso = $cmd->execute();

            if($sucesso && $cmd->rowCount() > 0){

                $fotoArray = array();
                $url = null;

                $usuario = $cmd->fetch(PDO::FETCH_ASSOC);

                if(!isset($usuario)){
                    return $result;
                }

                if($usuario["Foto"] != null || $usuario["Foto"] != ""){
                    $url = base64_encode($usuario["Foto"]);
                    $fotoArray = array("url"=>$url, "name"=>"Foto.jpg", "size"=>strlen($usuario["Foto"]));
                }                
                
                $result = $json->Data(true, "Sucesso", "A foto do ator foi encontrada!", $fotoArray);

            }

            return $result;

        }

        public function SalvarAlteracao($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse ator!");

            $atorId = $_POST['atorId'];
            $atorNome = $_POST['atorNome'];
            $atorFoto = $_POST['atorFoto'];

            if(!isset($atorId) || !isset($atorNome)){
                return $result;
            }   
            
            if(!isset($atorFoto)){
                $atorFoto = "";
            }

            if($atorFoto != ""){
                $atorFoto = base64_decode($atorFoto);
            }

            $cmd = $this->con->prepare('UPDATE Ator SET Nome = :atorNome, Foto = :atorFoto WHERE Id = :atorId');

            $cmd->bindValue(':atorId', $atorId);
            $cmd->bindValue(':atorNome', strtoupper($atorNome));
            $cmd->bindValue(':atorFoto', $atorFoto);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Ator alterado com sucesso!");
            }

            return $result;

        }
        
        public function Excluir($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse ator!");

            $id = $_POST['id'];

            $cmd = $this->con->prepare('DELETE FROM Ator WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Ator excluido com sucesso!");
            }

            return $result;

        }

    }

?>