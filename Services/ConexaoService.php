<?php   

    Class ConexaoService{

        private static $instancia;

        private function __construct(){}                                                    

        public static function ObterConexao(){

            if(!isset(self::$instancia)){

                $dbname = 'noteflixbd';
                $host = 'localhost';
                $user = 'root';
                $password = '';

                try{
                    self::$instancia = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $password);
                }
                catch (Exception $e){
                    echo 'Erro: '.$e;
                }

            }  
            
            return self::$instancia;

        }

    }

?>