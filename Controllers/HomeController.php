<?php

    Class HomeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Home/Index');

        }

        public function Filmes(){

            $this->CarregarLayout('Home/Filmes');

        }

        public function ListarFilmes(){

            $this->CarregarView('Home/_ListarFilmes');

        }

        public function Series(){

            $this->CarregarLayout('Home/Series');

        }

        public function ListarSeries(){

            $this->CarregarView('Home/_ListarSeries');

        }

        public function Erro(){

            $this->CarregarView('Home/Erro');

        }

        public function FileCallback(){

            $json = new JsonResult();
            
            $result = $json->Data(true, "Success", "FileCallback success!");

            echo $result;

        }

    }

?>