<?php

    Class CriadorController extends Controller{

        public function Index(){

            $this->CarregarLayout('Criador/Index');

        }

        public function Cadastrar(){

            $this->CarregarLayout('Criador/Cadastrar');

        }

        public function Alterar($id){

            $criadorService = new CriadorService();

            $dados = $criadorService->ObterPorId($id);

            $this->CarregarLayout('Criador/Alterar', $dados);

        }

        public function Visualizar($id){

            $criadorService = new CriadorService();

            $dados = $criadorService->ObterPorId($id);

            $this->CarregarLayout('Criador/Visualizar', $dados);

        }

        public function Salvar(){

            try{
                $criadorService = new CriadorService();

                $result = $criadorService->Salvar();

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
                $criadorService = new CriadorService();

                $result = $criadorService->SalvarAlteracao();

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
                $criadorService = new CriadorService();

                $result = $criadorService->Excluir();

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