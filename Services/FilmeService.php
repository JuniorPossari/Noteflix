<?php

    require_once 'ConexaoService.php';

    Class FilmeService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Filme ORDER BY Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Filme WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function Salvar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse filme!");

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(!isset($username) || !isset($email) || !isset($password) || !isset($cpassword)){
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Filme (Filme, Email, Senha, Ativo, DataCadastro, EmailConfirmado) VALUES (:username, :email, :senha, :ativo, :dataCadastro, :emailConfirmado)');

            $cmd->bindValue(':username', $username);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':senha', $passwordhash);
            $cmd->bindValue(':ativo', 1);
            $cmd->bindValue(':dataCadastro', 'CURRENT_TIMESTAMP');
            $cmd->bindValue(':emailConfirmado', 0);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme cadastrado com sucesso!");
            }

            return $result;

        }

        public function Alterar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse filme!");

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(!isset($username) || !isset($email) || !isset($password) || !isset($cpassword)){
                return $result;
            }

            $cmd = $this->con->prepare('INSERT INTO Filme (Filme, Email, Senha, Ativo, DataCadastro, EmailConfirmado) VALUES (:username, :email, :senha, :ativo, :dataCadastro, :emailConfirmado)');

            $cmd->bindValue(':username', $username);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':senha', $passwordhash);
            $cmd->bindValue(':ativo', 1);
            $cmd->bindValue(':dataCadastro', 'CURRENT_TIMESTAMP');
            $cmd->bindValue(':emailConfirmado', 0);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme alterado com sucesso!");
            }

            return $result;

        }

        public function Excluir($id){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse filme!");

            $cmd = $this->con->prepare('DELETE Filme WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $sucesso = $cmd->execute();
            
            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme excluído com sucesso!");
            }

            return $result;

        }

    }

?>