<?php

    Class DiretorController extends Controller{

        public function Index(){

            $this->CarregarLayout('Diretor/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Diretor/Cadastrar');

        }

        public function Salvar($dados){

            try{
                $diretorService = new DiretorService();

                $result = $diretorService->Salvar($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

    }

?>