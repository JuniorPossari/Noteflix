<?php

    Class Core{

        private $user;

        public function __construct(){
            $this->user = $_SESSION['2A66DC91515A4715850091B6F9035AAE'] ?? null;
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

            $caminho = '/Noteflix/Controllers/'.$controller.'.php';

            if(!file_exists($caminho) && !method_exists($controller, $metodo)){
                $controller = 'HomeController';
                $metodo = 'Erro';
            }
            else{

                $m = new ReflectionMethod($controller, $metodo);
                $metodoParametros = $m->getParameters();

                if(empty($metodoParametros) && !empty($parametros)) {

                    if($parametros[0] != ''){
                        $controller = 'HomeController';
                        $metodo = 'Erro';
                        $parametros = array();
                    }
                    
                }

            }            

            if(!$this->user){
                $pg_permission = ['HomeController', 'UsuarioController'];

                if(!isset($controller) || !in_array($controller, $pg_permission)){
                    $controller = 'UsuarioController';
                    $metodo = 'Login';
                }
            }
            else{
                //Verificar se é admin e configurar as paginas que não são permitidas

                $usuarioService = new UsuarioService();
                $cargoService = new CargoService();

                $isAuthenticated = $usuarioService->VerificarSeUsuarioEstaLogado();
                $isAdmin = false;

                if($isAuthenticated){
                    $idUsuario = $usuarioService->ObterIdUsuarioLogado();
                    $isAdmin = $cargoService->VerificarCargoDoUsuario($idUsuario, "Administrador");
                }

                if(!$isAdmin){

                    $pg_permission = ['HomeController', 'UsuarioController'];

                    if(!isset($controller) || !in_array($controller, $pg_permission)){
                        $controller = 'HomeController';
                        $metodo = 'Erro';
                    }

                }

            }
            

            $c = new $controller;

            call_user_func_array(array($c,$metodo), $parametros);

        }

    }

?>