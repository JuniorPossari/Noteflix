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

        public function Salvar($dados){

            try{
                $atorService = new AtorService();

                $result = $atorService->Salvar($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function BuscarFoto($dados){

            try{
                $atorService = new AtorService();

                $result = $atorService->BuscarFoto($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function SalvarAlteracao($dados){

            try{
                $atorService = new AtorService();

                $result = $atorService->SalvarAlteracao($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }

        public function Excluir($dados){

            try{
                $atorService = new AtorService();

                $result = $atorService->Excluir($dados);

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