<?php

    Class HomeController extends Controller{

        public function Index(){

            $usuarioService = new UsuarioService();
            $dados = $usuarioService->ObterPorId(1);


            $this->CarregarLayout('Home/Index', $dados);

        }

    }

?>