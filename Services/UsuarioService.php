<?php

    require_once 'ConexaoService.php';

    Class UsuarioService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Usuario');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Usuario WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function ObterIdPorEmail($email){

            $dados = array();

            $cmd = $this->con->prepare('SELECT Id FROM Usuario WHERE Email = :email');

            $cmd->bindValue(':email', $email);

            $cmd->execute();

            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            
            return $dados['Id'];

        }

        public function VerificarSeUsuarioExiste($username){

            $cmd = $this->con->prepare('SELECT Usuario FROM Usuario WHERE Usuario = :username');

            $cmd->bindValue(':username', $username);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }

        public function VerificarSeEmailExiste($email){

            $cmd = $this->con->prepare('SELECT Email FROM Usuario WHERE Email = :email');

            $cmd->bindValue(':email', $email);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }

        public function Entrar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível acessar sua conta, tente novamente!");
            
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!isset($email) || !isset($password)){
                return $result;
            }
            
            $existeEmail = $this::VerificarSeEmailExiste($email);

            if(!$existeEmail){
                $result = $json->Data(false, "Aviso", "Email ou senha incorretos!");
                return $result;
            }

            $sucesso = $this::VerificarCredenciais($email, $password);

            if(!$sucesso){
                $result = $json->Data(false, "Aviso", "Email ou senha incorretos!");
                return $result;
            }
            
            $idUsuario = $this::ObterIdPorEmail($email);

            $_SESSION['usr'] = $idUsuario;

            $result = $json->Data(true, "Sucesso", "Você foi conectado com sucesso!");            

            return $result;

        }

        public function VerificarCredenciais($email, $password){

            $cmd = $this->con->prepare('SELECT Email, Senha FROM Usuario WHERE Email = :email');

            $cmd->bindValue(':email', $email);

            $sucesso = $cmd->execute();

            if(!$sucesso){
                return false;
            }

            $usuario = $cmd->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $usuario['Senha'])){
                return true;
            }
            
            return false;

        }

        public function Salvar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar seu usuário!");

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(!isset($username) || !isset($email) || !isset($password) || !isset($cpassword)){
                return $result;
            }
                           
            if($password != $cpassword){
                $result = $json->Data(false, "Aviso", "A senha não confere com a confirmação de senha, confira e tente novamente!");
                return $result;
            }

            $existeUsuario = $this::VerificarSeUsuarioExiste($username);

            if($existeUsuario){
                $result = $json->Data(false, "Aviso", "Desculpe, esse nome de usuário já existe!");
                return $result;
            }

            $existeEmail = $this::VerificarSeEmailExiste($email);

            if($existeEmail){
                $result = $json->Data(false, "Aviso", "Esse email já está cadastrado!");
                return $result;
            }

            $passwordhash = password_hash($password, PASSWORD_DEFAULT);

            $cmd = $this->con->prepare('INSERT INTO Usuario (Usuario, Email, Senha, Ativo, DataCadastro, EmailConfirmado) VALUES (:username, :email, :senha, :ativo, :dataCadastro, :emailConfirmado)');

            $cmd->bindValue(':username', $username);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':senha', $passwordhash);
            $cmd->bindValue(':ativo', 1);
            $cmd->bindValue(':dataCadastro', 'CURRENT_TIMESTAMP');
            $cmd->bindValue(':emailConfirmado', 0);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Sua conta foi cadastrada com sucesso!");
            }

            return $result;

        }

    }

?>