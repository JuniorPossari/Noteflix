<?php

    Class Core{

        public function __construct(){
            $this->run();
        }

        public function run(){

            $parametros = array();

            if(isset($_GET['pag'])){
                $url = $_GET['pag'];
            }

            if(!empty($url)){

                $url = explode('/', $url);
                $controller = $url[0].'Controller';
                array_shift($url);

                if(isset($url[0]) && !empty($url[0])){
                    $metodo = $url[0];
                    array_shift($url);
                }
                else{
                    $metodo = 'Index';
                }

                if(count($url) > 0){
                    $parametros = $url;
                }

            }
            else{
                $controller = 'HomeController';
                $metodo = 'Index';
            }

            $caminho = 'Noteflix/Controllers/'.$controller.'.php';

            if(!file_exists($caminho) && !method_exists($controller, $metodo)){
                $controller = 'HomeController';
                $metodo = 'Index';
            }

            $c = new $controller;

            call_user_func_array(array($c,$metodo), $parametros);

        }

    }

?>