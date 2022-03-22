<?php

    Class HomeController extends Controller{

        public function Index(){

            $this->CarregarLayout('Home/Index');

        }

        public function Procurar($query){

            $dados = array('query' => $query);

            $this->CarregarView('Home/_Procurar', $dados);

        }

        public function Erro(){

            $this->CarregarView('Home/Erro');

        }

        public function FileCallback(){

            $json = new JsonResult();
            
            $result = $json->Data(true, "Success", "FileCallback success!");

            echo $result;

        }

        //Noteflix

        public function Time(){

            $this->CarregarLayout('Home/Time');

        }

        //Filme

        public function Filmes(){

            $this->CarregarLayout('Home/Filmes');

        }

        public function ListarFilmes(){

            $this->CarregarView('Home/_ListarFilmes');

        }

        public function Filme($id){

            $filmeService = new FilmeService();

            $dados = $filmeService->ObterPorId($id);

            $this->CarregarLayout('Home/Filme', $dados);

        }

        public function ListarAvaliacoesFilme($id){

            $dados = array('idFilme' => $id);

            $this->CarregarView('Home/_ListarAvaliacoesFilme', $dados);

        }

        public function ObterConteudoNotaFilme($id){

            $dados = array('idFilme' => $id);

            $this->CarregarView('Home/_ObterConteudoNotaFilme', $dados);

        }

        public function ObterConteudoNotaGeralFilme($id){

            $dados = array('idFilme' => $id);

            $this->CarregarView('Home/_ObterConteudoNotaGeralFilme', $dados);

        }

        public function SalvarNotaFilme(){

            try{
                $filmeService = new FilmeService();

                $result = $filmeService->SalvarNota();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }

        public function ExcluirNotaFilme(){

            try{
                $filmeService = new FilmeService();

                $result = $filmeService->ExcluirNota();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError();

                echo $result;

            }

        }

        //Série

        public function Series(){

            $this->CarregarLayout('Home/Series');

        }

        public function ListarSeries(){

            $this->CarregarView('Home/_ListarSeries');

        }

        public function Serie($id){

            $serieService = new SerieService();

            $dados = $serieService->ObterPorId($id);

            $this->CarregarLayout('Home/Serie', $dados);

        }

        public function ListarAvaliacoesSerie($id){

            $dados = array('idSerie' => $id);

            $this->CarregarView('Home/_ListarAvaliacoesSerie', $dados);

        }

        public function ObterConteudoNotaSerie($id){

            $dados = array('idSerie' => $id);

            $this->CarregarView('Home/_ObterConteudoNotaSerie', $dados);

        }

        public function ObterConteudoNotaGeralSerie($id){

            $dados = array('idSerie' => $id);

            $this->CarregarView('Home/_ObterConteudoNotaGeralSerie', $dados);

        }

        public function SalvarNotaSerie(){

            try{
                $serieService = new SerieService();

                $result = $serieService->SalvarNota();

                header('Content-Type: application/json');

                echo $result;
            }
            catch(Exception $e){

                $json = new JsonResult();

                $result = $json->DataError($e->getMessage());

                echo $result;

            }

        }

        public function ExcluirNotaSerie(){

            try{
                $serieService = new SerieService();

                $result = $serieService->ExcluirNota();

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