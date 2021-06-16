<?php

    require_once 'ConexaoService.php';

    Class SerieService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT s.*, c.Nome Criador FROM Serie s INNER JOIN Criador c ON c.Id = s.IdCriador ORDER BY s.Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Serie WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function ObterSerieAtorIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdAtor FROM SerieAtor WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterSerieGeneroIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdGenero FROM SerieGenero WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterSeriePlataformaIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdPlataforma FROM SeriePlataforma WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterNota($id, $tamanho = 'icon-md'){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT AVG((Fotografia + Roteiro + TrilhaSonora + EfeitoEspecial + Cenario) / 5) AS Nota FROM NotaSerie WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $nota = $dados["Nota"];
            }

            if($nota >= 0 && $nota < 0.5){
                return '<i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 0.5 && $nota < 1){
                return '<i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 1 && $nota < 1.5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 1.5 && $nota < 2){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 2 && $nota < 2.5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 2.5 && $nota < 3){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 3 && $nota < 3.5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 3.5 && $nota < 4){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 4 && $nota < 4.5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 4.5 && $nota < 5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning"></i>';
            }

            if($nota >= 5){
                return '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning"></i>';
            }
            
            return '<i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';

        }

        public function VerificarSeSerieExiste($serieNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Serie WHERE Nome = :serieNome');

            $cmd->bindValue(':serieNome', $serieNome);

            $cmd->execute();

            $total = $cmd->rowCount(); 

            if($total > 0){
                return true;
            }
            else{
                return false;
            }

        }

        public function Salvar($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar essa série!");

            $serie = $_POST['dados'];
            $serieId = 0;
            $serieNome = $serie["Nome"];
            $seriePrimeiroEpisodio = $serie["PrimeiroEpisodio"];
            $serieNumeroTemporada = $serie["NumeroTemporada"];
            $serieDataTermino = $serie["DataTermino"];  
            $serieIdCriador = $serie["IdCriador"];          
            $serieSinopse = $serie["Sinopse"];
            $serieFoto = $serie["Foto"];
            
            //Arrays que vão ser gravados em outras tabelas
            $serieAtores = $serie["Elenco"];
            $serieGeneros = $serie["Genero"];
            $seriePlataformas = array();
            if(isset($serie["Plataforma"])){
                $seriePlataformas = $serie["Plataforma"]; 
            }                       

            if(!isset($serie) || !isset($serieNome) || !isset($seriePrimeiroEpisodio) || !isset($serieNumeroTemporada) || !isset($serieIdCriador) || !isset($serieSinopse) || !isset($serieFoto) || !isset($serieAtores) || !isset($serieGeneros) || count($serieAtores) == 0 || count($serieGeneros) == 0){
                return $result;
            }

            $existeSerie = $this::VerificarSeSerieExiste($serieNome);

            if($existeSerie){
                $result = $json->Data(false, "Aviso", "Desculpe, essa série já foi cadastrada!");
                return $result;
            }

            if(!isset($serieFoto)){
                $serieFoto = "";
            }

            if($serieFoto != ""){
                $serieFoto = base64_decode($serieFoto);
            }            

            $seriePrimeiroEpisodio = implode("-",array_reverse(explode("/", $seriePrimeiroEpisodio)));

            if(isset($serieDataTermino) && $serieDataTermino != ""){
                $serieDataTermino = implode("-",array_reverse(explode("/", $serieDataTermino)));
            }
            else{
                $serieDataTermino = 'NULL';
            }            

            //Cadastrar serie
            $cmd = $this->con->prepare('INSERT INTO Serie (Nome, PrimeiroEpisodio, NumeroTemporada, DataTermino, IdCriador, Sinopse, Foto) VALUES (:serieNome, :seriePrimeiroEpisodio, :serieNumeroTemporada, :serieDataTermino, :serieIdCriador, :serieSinopse, :serieFoto)');

            $cmd->bindValue(':serieNome', $serieNome);
            $cmd->bindValue(':seriePrimeiroEpisodio', $seriePrimeiroEpisodio);
            $cmd->bindValue(':serieNumeroTemporada', $serieNumeroTemporada);
            $cmd->bindValue(':serieDataTermino', $serieDataTermino);
            $cmd->bindValue(':serieIdCriador', $serieIdCriador);
            $cmd->bindValue(':serieSinopse', $serieSinopse);
            $cmd->bindValue(':serieFoto', $serieFoto);

            $sucesso = $cmd->execute();            

            if($sucesso){
                $serieId = $this->con->lastInsertId();
            }

            //Cadastrar atores do serie
            if($sucesso){

                foreach($serieAtores as $atorId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SerieAtor (IdSerie, IdAtor) VALUES (:serieId, :atorId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':atorId', $atorId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        break;
                    }                   

                }                

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM SerieAtor WHERE IdSerie = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Serie WHERE Id = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar os atores da série!");     
                    
                    return $result;

                }

            }

            //Cadastrar generos do serie
            if($sucesso){

                foreach($serieGeneros as $generoId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SerieGenero (IdSerie, IdGenero) VALUES (:serieId, :generoId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':generoId', $generoId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        break;
                    }                   

                } 

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM SerieGenero WHERE IdSerie = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Serie WHERE Id = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar os gêneros da série!");    
                    
                    return $result;

                }

            }

            //Cadastrar plataformas do serie
            if($sucesso && isset($seriePlataformas) && count($seriePlataformas) > 0){

                foreach($seriePlataformas as $plataformaId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SeriePlataforma (IdSerie, IdPlataforma) VALUES (:serieId, :plataformaId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':plataformaId', $plataformaId);                
    
                        $sucesso = $cmd->execute();

                    }
                    else{
                        break;
                    }                  

                } 

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM SeriePlataforma WHERE IdSerie = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Serie WHERE Id = :serieId');

                    $cmd->bindValue(':serieId', $serieId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar as plataformas da série!");      
                    
                    return $result;

                }

            }            

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Série cadastrada com sucesso!");
            }

            return $result;

        }

        public function SalvarAlteracao($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar essa série!");

            $serie = $_POST['dados'];
            $serieId = $serie["Id"];
            $serieNome = $serie["Nome"];
            $seriePrimeiroEpisodio = $serie["PrimeiroEpisodio"];
            $serieNumeroTemporada = $serie["NumeroTemporada"];
            $serieDataTermino = $serie["DataTermino"];  
            $serieIdCriador = $serie["IdCriador"];          
            $serieSinopse = $serie["Sinopse"];
            $serieFoto = $serie["Foto"];
            
            //Arrays que vão ser gravados em outras tabelas
            $serieAtores = $serie["Elenco"];
            $serieGeneros = $serie["Genero"];
            $seriePlataformas = array();
            if(isset($serie["Plataforma"])){
                $seriePlataformas = $serie["Plataforma"]; 
            }                       

            if(!isset($serie) || !isset($serieNome) || !isset($seriePrimeiroEpisodio) || !isset($serieNumeroTemporada) || !isset($serieIdCriador) || !isset($serieSinopse) || !isset($serieFoto) || !isset($serieAtores) || !isset($serieGeneros) || count($serieAtores) == 0 || count($serieGeneros) == 0){
                return $result;
            }

            if(!isset($serieFoto)){
                $serieFoto = "";
            }

            if($serieFoto != ""){
                $serieFoto = base64_decode($serieFoto);
            }            

            $seriePrimeiroEpisodio = implode("-",array_reverse(explode("/", $seriePrimeiroEpisodio)));

            if(isset($serieDataTermino) && $serieDataTermino != ""){
                $serieDataTermino = implode("-",array_reverse(explode("/", $serieDataTermino)));
            }
            else{
                $serieDataTermino = 'NULL';
            } 

            //Alterar serie
            $cmd = $this->con->prepare('UPDATE Serie SET Nome = :serieNome, PrimeiroEpisodio = :seriePrimeiroEpisodio, NumeroTemporada = :serieNumeroTemporada, DataTermino = :serieDataTermino, IdCriador = :serieIdCriador, Sinopse = :serieSinopse, Foto = :serieFoto WHERE Id = :serieId');

            $cmd->bindValue(':serieNome', $serieNome);
            $cmd->bindValue(':seriePrimeiroEpisodio', $seriePrimeiroEpisodio);
            $cmd->bindValue(':serieNumeroTemporada', $serieNumeroTemporada);
            $cmd->bindValue(':serieDataTermino', $serieDataTermino);
            $cmd->bindValue(':serieIdCriador', $serieIdCriador);
            $cmd->bindValue(':serieSinopse', $serieSinopse);
            $cmd->bindValue(':serieFoto', $serieFoto);
            $cmd->bindValue(':serieId', $serieId);

            $sucesso = $cmd->execute();

            //Alterar atores do serie
            if($sucesso){

                $cmd = $this->con->prepare('DELETE FROM SerieAtor WHERE IdSerie = :serieId');

                $cmd->bindValue(':serieId', $serieId);

                $sucesso = $cmd->execute();

                foreach($serieAtores as $atorId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SerieAtor (IdSerie, IdAtor) VALUES (:serieId, :atorId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':atorId', $atorId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar os atores da série!");
                        break;
                    }                   

                }

            }

            //Alterar generos do serie
            if($sucesso){

                $cmd = $this->con->prepare('DELETE FROM SerieGenero WHERE IdSerie = :serieId');

                $cmd->bindValue(':serieId', $serieId);

                $sucesso = $cmd->execute();

                foreach($serieGeneros as $generoId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SerieGenero (IdSerie, IdGenero) VALUES (:serieId, :generoId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':generoId', $generoId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar os gêneros da série!");
                        break;
                    }                   

                }

            }

            //Alterar plataformas do serie
            if($sucesso && isset($seriePlataformas) && count($seriePlataformas) > 0){

                $cmd = $this->con->prepare('DELETE FROM SeriePlataforma WHERE IdSerie = :serieId');

                $cmd->bindValue(':serieId', $serieId);

                $sucesso = $cmd->execute();

                foreach($seriePlataformas as $plataformaId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO SeriePlataforma (IdSerie, IdPlataforma) VALUES (:serieId, :plataformaId)');

                        $cmd->bindValue(':serieId', $serieId);
                        $cmd->bindValue(':plataformaId', $plataformaId);                
    
                        $sucesso = $cmd->execute();

                    }
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar as plataformas da série!");
                        break;
                    }                  

                }

            }            

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Série alterada com sucesso!");
            }

            return $result;

        }
        
        public function BuscarFoto($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível encontrar a foto dessa série!");

            $IdElement = $_POST['idElement'];

            if(!isset($IdElement)){
                return $result;
            }                

            $cmd = $this->con->prepare('SELECT Foto FROM Serie WHERE Id = :id AND Foto IS NOT NULL');

            $cmd->bindValue(':id', $IdElement);

            $sucesso = $cmd->execute();

            if($sucesso && $cmd->rowCount() > 0){

                $fotoArray = array();
                $url = null;

                $usuario = $cmd->fetch(PDO::FETCH_ASSOC);

                if(!isset($usuario)){
                    return $result;
                }

                if($usuario["Foto"] != null || $usuario["Foto"] != ""){
                    $url = base64_encode($usuario["Foto"]);
                    $fotoArray = array("url"=>$url, "name"=>"Foto.jpg", "size"=>strlen($usuario["Foto"]));
                }                
                
                $result = $json->Data(true, "Sucesso", "A foto da série foi encontrada!", $fotoArray);

            }

            return $result;

        }
        
        public function Excluir($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir essa série!");

            $serieId = $_POST['id'];

            //Excluir ator do serie
            $cmd = $this->con->prepare('DELETE FROM SerieAtor WHERE IdSerie = :serieId');

            $cmd->bindValue(':serieId', $serieId);

            $sucesso = $cmd->execute();

            //Excluir genero do serie
            $cmd = $this->con->prepare('DELETE FROM SerieGenero WHERE IdSerie = :serieId');

            $cmd->bindValue(':serieId', $serieId);

            $sucesso = $cmd->execute();

            //Excluir plaaforma do serie
            $cmd = $this->con->prepare('DELETE FROM SeriePlataforma WHERE IdSerie = :serieId');

            $cmd->bindValue(':serieId', $serieId);

            $sucesso = $cmd->execute();

            //Excluir serie
            $cmd = $this->con->prepare('DELETE FROM Serie WHERE Id = :serieId');

            $cmd->bindValue(':serieId', $serieId);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Série excluida com sucesso!");
            }

            return $result;

        }

    }

?>