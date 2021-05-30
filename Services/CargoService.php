<?php

    require_once 'ConexaoService.php';

    Class CargoService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Cargo');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterCargosDoUsuario($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT c.Nome FROM UsuarioCargo uc INNER JOIN Cargo c ON uc.IdCargo = c.Id WHERE uc.IdUsuario = :id');

            $cmd->bindValue(':id',$id);

            $cmd->execute();

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function VerificarCargoDoUsuario($idUsuario, $nomeCargo){

            $cmd = $this->con->prepare('SELECT c.Nome FROM UsuarioCargo uc INNER JOIN Cargo c ON uc.IdCargo = c.Id WHERE uc.IdUsuario = :idUsuario AND c.Nome = :nomeCargo');

            $cmd->bindValue(':idUsuario',$idUsuario);
            $cmd->bindValue(':nomeCargo',$nomeCargo);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }

    }

?>