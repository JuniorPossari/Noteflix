<?php

    Class AtorController extends Controller{

        public function Index(){

            $this->CarregarLayout('Ator/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Ator/Cadastrar');

        }

        public function Alterar($id){

            $atorService = new AtorService();

            $dados = $atorService->ObterPorId($id);

            $this->CarregarLayout('Ator/Alterar', $dados);

        }

        public function Visualizar($id){

            $atorService = new AtorService();

            $dados = $atorService->ObterPorId($id);

            $this->CarregarLayout('Ator/Visualizar', $dados);

        }

        public function Salvar(){

            try{
                $atorService = new AtorService();

                $result = $atorService->Salvar();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function BuscarFoto(){

            try{
                $atorService = new AtorService();

                $result = $atorService->BuscarFoto();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function SalvarAlteracao(){

            try{
                $atorService = new AtorService();

                $result = $atorService->SalvarAlteracao();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function Excluir(){

            try{
                $atorService = new AtorService();

                $result = $atorService->Excluir();

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