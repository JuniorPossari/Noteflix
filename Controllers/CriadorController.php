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

        public function Salvar($dados){

            try{
                $criadorService = new CriadorService();

                $result = $criadorService->Salvar($dados);

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
                $criadorService = new CriadorService();

                $result = $criadorService->SalvarAlteracao($dados);

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
                $criadorService = new CriadorService();

                $result = $criadorService->Excluir($dados);

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