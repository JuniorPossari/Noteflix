<?php

    Class HomeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Home/Index');

        }

        public function Gerenciamento(){

            
                $this->CarregarLayout('Home/Gerenciamento');
                     

        }

    }

?>