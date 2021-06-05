<?php

    Class DiretorController extends Controller{

        public function Index(){

            $this->CarregarLayout('Diretor/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Diretor/Cadastrar');

        }

        public function Alterar($id){

            $diretorService = new DiretorService();

            $dados = $diretorService->ObterPorId($id);

            $this->CarregarLayout('Diretor/Alterar', $dados);

        }

        public function Visualizar($id){

            $diretorService = new DiretorService();

            $dados = $diretorService->ObterPorId($id);

            $this->CarregarLayout('Diretor/Visualizar', $dados);

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

        public function Excluir($dados){

            try{
                $diretorService = new DiretorService();

                $result = $diretorService->Excluir($dados);

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