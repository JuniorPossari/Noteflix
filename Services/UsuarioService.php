<?php

    require_once 'ConexaoService.php';

    Class UsuarioService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Usuario ORDER BY Nome');

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

        public function ObterIdUsuarioLogado(){
            
            return $_SESSION['2A66DC91515A4715850091B6F9035AAE'];

        }

        public function ObterPorEmail($email){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Usuario WHERE Email = :email');

            $cmd->bindValue(':email', $email);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function EsqueciMinhaSenha(){            

            $json = new JsonResult();
            $result = $json->Data(true, "Sucesso", "Caso você possua uma conta, enviamos um email para redefinir sua senha!");
                        
            $email = $_POST['email'];

            if(!isset($email)){
                return $result;
            }
            
            $existeEmail = $this::VerificarSeEmailExiste($email);

            if(!$existeEmail){
                return $result;
            }
            
            $emailService = new EmailService();

            $usuario =  $this::ObterPorEmail($email);
            $assunto = 'Redefinição de senha';
            $mensagem = $emailService->GetEmailBody('RedefinirSenha');
            
            $token = bin2hex(random_bytes(20));
            $site = 'https://'.$_SERVER['SERVER_NAME'].'/Noteflix';
            $url = $site.'/Usuario/RedefinirSenha/'.$token;

            $_SESSION['EDC9BBAB7D5E46159D6C839B90361D88'] = $email;
            $_SESSION['489F6CB951564E4CBF5E3452FAFAB1DE'] = $token;

            $mensagem = str_replace("{{NOME}}", $usuario['Nome'], $mensagem);
            $mensagem = str_replace("{{SITE}}", $site, $mensagem);
            $mensagem = str_replace("{{URL}}", $url, $mensagem);            

            $enviado = $emailService->SendEmail($usuario, $assunto, $mensagem);

            if(!$enviado){
                $result = $json->Data(false, "Aviso", "Desculpe, não foi possível enviar o email para redefinir sua senha!");
            }

            return $result;

        }

        public function FinalizarRedefinicaoSenha(){            

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível redefinir sua senha!");
            
            $token = $_POST['token'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(!isset($token) || !isset($password) || !isset($cpassword)){
                return $result;
            }
                           
            if($password != $cpassword){
                $result = $json->Data(false, "Aviso", "A senha não confere com a confirmação de senha, confira e tente novamente!");
                return $result;
            }

            if($_SESSION['489F6CB951564E4CBF5E3452FAFAB1DE'] != $token){
                $result = $json->Data(false, "Aviso", "O token informado é inválido ou expirou!");
                return $result;
            }

            $email = $_SESSION['EDC9BBAB7D5E46159D6C839B90361D88'];

            if(!isset($email)){
                return $result;
            }

            $passwordhash = password_hash($password, PASSWORD_DEFAULT);

            $cmd = $this->con->prepare('UPDATE Usuario SET Senha = :senha WHERE Email = :email');

            $cmd->bindValue(':senha', $passwordhash);
            $cmd->bindValue(':email', $email);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Senha senha foi redefinida com sucesso!"); 
                session_unset();
		        session_destroy();
            }            

            return $result;

        }

        public function VerificarSeUsuarioEstaLogado(){

            $logado = false;

            if (isset($_SESSION['2A66DC91515A4715850091B6F9035AAE'])) {                
        
                $idUsuario = $_SESSION['2A66DC91515A4715850091B6F9035AAE'];
        
                $user = $this->ObterPorId($idUsuario);
        
                if(isset($user)){
        
                    extract($user);
        
                    if(isset($Id)){
        
                        $logado = true;                       
        
                    }
        
                }        
                
            }

            // if(!$logado){
            //     session_unset();
            //     session_destroy();
            // }

            return $logado;

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

            $cmd = $this->con->prepare('SELECT Nome FROM Usuario WHERE Nome = :username');

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

        public function Entrar(){

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

            $_SESSION['2A66DC91515A4715850091B6F9035AAE'] = $idUsuario;

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

        public function Salvar(){

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

            $cmd = $this->con->prepare('INSERT INTO Usuario (Nome, Email, Senha, Ativo, DataCadastro, EmailConfirmado, TelefoneConfirmado) VALUES (:username, :email, :senha, :ativo, CURRENT_TIMESTAMP(), :emailConfirmado, :telefoneConfirmado)');

            $cmd->bindValue(':username', $username);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':senha', $passwordhash);
            $cmd->bindValue(':ativo', 1);
            $cmd->bindValue(':emailConfirmado', 0);
            $cmd->bindValue(':telefoneConfirmado', 0);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Sua conta foi cadastrada com sucesso!");
            }

            return $result;

        }

        public function AlterarFoto(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar sua foto!");
            
            $idUsuario = $_POST['idUsuario'];
            $foto64 = $_POST['foto64'];

            if(!isset($idUsuario)){
                return $result;
            }

            if(isset($foto64) && $foto64 != ""){
                $foto64 = base64_decode($foto64);
            }

            if($foto64 == ""){
                $result = $json->Data(false, "Aviso", "Desculpe, não foi possível remover sua foto!");
            }

            $cmd = $this->con->prepare('UPDATE Usuario SET Foto = :foto64 WHERE Id = :idUsuario');

            $cmd->bindValue(':idUsuario', $idUsuario);
            $cmd->bindValue(':foto64', $foto64 != "" ? $foto64 : '' );

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", $foto64 != "" ? "Sua foto foi alterada com sucesso!" : "Sua foto foi removida com sucesso!");
            }

            return $result;

        }

        public function TemPermissaoDeAdministrador(){

            $isAdmin = false;

            if (isset($_SESSION['2A66DC91515A4715850091B6F9035AAE'])) {
                
                $cargoService = new CargoService();
        
                $idUsuario = $_SESSION['2A66DC91515A4715850091B6F9035AAE'];
        
                $user = $this->ObterPorId($idUsuario);
        
                if(isset($user)){
        
                    extract($user);
        
                    if(isset($Id)){
        
                        $isAdmin = $cargoService->VerificarCargoDoUsuario($Id, "Administrador");
        
                    }
        
                }        
                
            }

            return $isAdmin;

        }

    }

?>