<?php   

    $dsn = "mysql:host=localhost;dbname=noticias";
    $usuario = "root";
    $senha = "";

    try{

        $conexao = new PDO($dsn, $usuario, $senha);
    } 
    catch (PDOException $e){
        
        echo 'ERRO'. $e ->getCode() . "Mensagem: " . $e -> getMessage();
    }

?>