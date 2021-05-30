<?php

    Class Controller{

        public $dados;

        public function __construct(){
            $this->dados = array();
        }

        public function CarregarLayout($nomeView, $dadosModel = array()){
            extract($dadosModel);
            require 'Views/LayoutMetronic.php';
        }

        public function CarregarView($nomeView, $dadosModel = array()){
            extract($dadosModel);
            require 'Views/'.$nomeView.'.php';
        }

    }

?>