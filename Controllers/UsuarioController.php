<?php

    Class UsuarioController extends Controller{

        public function Login(){

            $this->CarregarView('Usuario/Login');

        }

        public function RedefinirSenha($token){

            if(!isset($token)){
                header("location:/Noteflix/Home/Erro");
            }

            if($_SESSION['489F6CB951564E4CBF5E3452FAFAB1DE'] != $token){
                header("location:/Noteflix/Home/Erro");
            }

            $email = $_SESSION['EDC9BBAB7D5E46159D6C839B90361D88'];

            if(!isset($email)){
                header("location:/Noteflix/Home/Erro");
            }

            $dados = array('Token' => $token);
            
            $this->CarregarView('Usuario/RedefinirSenha', $dados);

        }

        public function Entrar(){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->Entrar();

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }

        public function EsqueciMinhaSenha(){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->EsqueciMinhaSenha();

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }  
        
        public function FinalizarRedefinicaoSenha(){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->FinalizarRedefinicaoSenha();

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->Data(false, "Aviso", $e->getMessage());

                echo $result;

            }

        }

        public function Sair(){

            session_unset();
		    session_destroy();
            header("location:/Noteflix/");

        }

        public function SalvarUsuario(){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->Salvar();

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function AlterarFoto(){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->AlterarFoto();

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }
            

        }

    }

?>