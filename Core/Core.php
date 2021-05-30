<?php

    Class Core{

        private $user;

        public function __construct(){
            $this->user = $_SESSION['usr'] ?? null;
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

            if($this->user){
                $pg_permission = ['HomeController', 'UsuarioController'];

                if(!isset($controller) || !in_array($controller, $pg_permission)){
                    $controller = 'HomeController';
                    $metodo = 'Index';
                }

            }
            else{
                $pg_permission = ['HomeController', 'UsuarioController'];

                if(!isset($controller) || !in_array($controller, $pg_permission)){
                    $controller = 'UsuarioController';
                    $metodo = 'Login';
                }
            }

            $c = new $controller;

            call_user_func_array(array($c,$metodo), $parametros);

        }

    }

?>