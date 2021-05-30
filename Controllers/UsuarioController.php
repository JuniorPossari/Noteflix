<?php

    Class UsuarioController extends Controller{

        public function Login(){

            $this->CarregarView('Usuario/Login');

        }

        public function SalvarUsuario($dados){

            $json = new JsonResult();
            $result = array();

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(isset($username) && isset($email) && isset($password) && isset($cpassword))
            {                

                $passwordhash = password_hash($password, PASSWORD_DEFAULT);

                $result = $json->Data(true, "Sucesso", "Seu usuário foi cadastrado com sucesso!");
                
            }
            else{

                $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar seu usuário!");

            }

            header('Content-Type: application/json');
            echo $result;

        }

    }

?>