<?php

    Class HomeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Home/Index');

        }

        public function Filmes(){

            $this->CarregarLayout('Home/Filmes');

        }

        public function Series(){

            $this->CarregarLayout('Home/Series');

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