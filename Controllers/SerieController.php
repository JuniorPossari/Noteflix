<?php

    Class SerieController extends Controller{

        public function Index(){

            $this->CarregarLayout('Serie/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Serie/Cadastrar');

        }

    }

?>