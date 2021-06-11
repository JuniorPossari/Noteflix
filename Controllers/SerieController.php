<?php

    Class SerieController extends Controller{

        public function Index(){

            $this->CarregarLayout('Serie/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Serie/Cadastrar');

        }

        public function Alterar($id){

            $serieService = new SerieService();

            $dados = $serieService->ObterPorId($id);

            $this->CarregarLayout('Serie/Alterar', $dados);

        }

        public function Visualizar($id){

            $serieService = new SerieService();

            $dados = $serieService->ObterPorId($id);

            $this->CarregarLayout('Serie/Visualizar', $dados);

        }

        public function Salvar($dados){

            try{
                $serieService = new SerieService();

                $result = $serieService->Salvar($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }

        public function BuscarFoto($dados){

            try{
                $serieService = new SerieService();

                $result = $serieService->BuscarFoto($dados);

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
                $serieService = new SerieService();

                $result = $serieService->SalvarAlteracao($dados);

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        public function Excluir($dados){

            try{
                $serieService = new SerieService();

                $result = $serieService->Excluir($dados);

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