<?php

    Class FilmeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Filme/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Filme/Cadastrar');

        }

    }

?>