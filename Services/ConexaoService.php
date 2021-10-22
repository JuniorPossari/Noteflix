<?php   

    Class ConexaoService{

        private static $instancia;

        private function __construct(){}                                                    

        public static function ObterConexao(){

            if(!isset(self::$instancia)){

                $prod = false;

                if($prod){

                    $appsettings = new AppSettings();

                    $dbname = $appsettings->GetDBName();
                    $host = $appsettings->GetHost();
                    $user = $appsettings->GetUser();
                    $password = $appsettings->GetPassword();
                    $options = $appsettings->GetOptions();

                    try{
                        self::$instancia = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $password, $options);
                    }
                    catch (Exception $e){
                        echo 'Erro: '.$e;
                    }

                }
                else{

                    $dbname = 'id17053183_noteflixbd';
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
                

            }  
            
            return self::$instancia;

        }

    }

?>