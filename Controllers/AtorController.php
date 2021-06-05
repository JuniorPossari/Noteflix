<?php

    Class AtorController extends Controller{

        public function Index(){

            $this->CarregarLayout('Ator/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Ator/Cadastrar');

        }

        public function Salvar($dados){

            try{
                $elencoService = new AtorService();

                $result = $elencoService->Salvar($dados);

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