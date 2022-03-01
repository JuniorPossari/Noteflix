<?php   

    Class ConexaoService{

        private static $instancia;

        private function __construct(){}                                                    

        public static function ObterConexao(){

            if(!isset(self::$instancia)){

                $prod = false; //ALTERE PARA TRUE ANTES DE PUBLICAR

                if($prod){ //PRODUCTION

                    $appsettings = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Noteflix/appsettings.json'), true);
                    $constr = $appsettings['ConnectionStrings'];

                    $dbname = $constr['DBName'];
                    $host = $constr['Host'];
                    $user = $constr['User'];
                    $password = $constr['Password'];
                    $options = array(
                        PDO::MYSQL_ATTR_SSL_CA => '/path/to/ssl-cert.pem',
                        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    );

                    try{
                        self::$instancia = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $password, $options);
                    }
                    catch (Exception $e){
                        require 'Views/Home/ErroConexao.php';
                        exit;
                    }

                }
                else{ //DEVELOPMENT

                    $dbname = 'noteflix';
                    $host = 'localhost';
                    $user = 'root';
                    $password = '';

                    try{
                        self::$instancia = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $password);
                    }
                    catch (Exception $e){
                        require 'Views/Home/ErroConexao.php';
                        exit;
                    }

                }
                

            }  
            
            return self::$instancia;

        }

    }

?>