<?php

    Class UsuarioController extends Controller{

        public function Login(){

            $this->CarregarView('Usuario/Login');

        }

        public function Entrar($dados){

            $usuarioService = new UsuarioService();

            $result = $usuarioService->Entrar($dados);

            header('Content-Type: application/json');

            echo $result;

        }

        public function Sair(){

            session_unset();
		    session_destroy();
            header("location:/Noteflix/");

        }

        public function SalvarUsuario($dados){

            $usuarioService = new UsuarioService();

            $result = $usuarioService->Salvar($dados);

            header('Content-Type: application/json');

            echo $result;

        }

    }

?>