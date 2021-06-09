<?php

    Class FilmeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Filme/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Filme/Cadastrar');

        }

        public function Alterar($id){

            $filmeService = new FilmeService();

            $dados = $filmeService->ObterPorId($id);

            $this->CarregarLayout('Filme/Alterar', $dados);

        }

        public function Visualizar($id){

            $filmeService = new FilmeService();

            $dados = $filmeService->ObterPorId($id);

            $this->CarregarLayout('Filme/Visualizar', $dados);

        }

        public function Salvar($dados){

            try{
                $filmeService = new FilmeService();

                $result = $filmeService->Salvar($dados);

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
                $filmeService = new FilmeService();

                $result = $filmeService->BuscarFoto($dados);

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
                $filmeService = new FilmeService();

                $result = $filmeService->SalvarAlteracao($dados);

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
                $filmeService = new FilmeService();

                $result = $filmeService->Excluir($dados);

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