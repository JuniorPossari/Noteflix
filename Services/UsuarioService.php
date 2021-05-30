<?php

    require_once 'ConexaoService.php';

    Class UsuarioService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Usuario');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Usuario WHERE Id = :id');

            $cmd->bindValue(':id',$id);

            $cmd->execute();

            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            
            return $dados;

        }

    }

?>