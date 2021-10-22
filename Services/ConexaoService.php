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
                        echo '<center><div style="margin-top: 400px; font-size: 50px; font-family: Arial; font-weight: bold;">Desculpe! O servidor está fora do ar :(</div></center>';
                        exit;
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
                        echo '<center><div style="margin-top: 400px; font-size: 50px; font-family: Arial; font-weight: bold;">Desculpe! O servidor está fora do ar :(</div></center>';
                        exit;
                    }

                }
                

            }  
            
            return self::$instancia;

        }

    }

?>