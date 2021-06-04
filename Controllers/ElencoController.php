<?php

    Class ElencoController extends Controller{

        public function Index(){

            $this->CarregarLayout('Elenco/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Elenco/Cadastrar');

        }

        public function Salvar($dados){

            try{
                $elencoService = new ElencoService();

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