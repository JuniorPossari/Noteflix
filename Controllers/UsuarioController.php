<?php

    Class UsuarioController extends Controller{

        public function Login(){

            $this->CarregarView('Usuario/Login');

        }

        public function Entrar($dados){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->Entrar($dados);

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

        public function SalvarUsuario($dados){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->Salvar($dados);

                header('Content-Type: application/json');

                echo $result;

            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function AlterarFoto($dados){

            try{

                $usuarioService = new UsuarioService();

                $result = $usuarioService->AlterarFoto($dados);

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