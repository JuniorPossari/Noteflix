<?php

    Class UsuarioController extends Controller{

        public function Login(){

            $this->CarregarView('Usuario/Login');

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