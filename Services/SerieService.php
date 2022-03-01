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

        public function Procurar($query){

            $dados = array();

            $pattern = '%'.$query.'%';

            $cmd = $this->con->prepare('SELECT f.*, d.Nome Criador FROM Serie f INNER JOIN Criador d ON d.Id = f.IdCriador WHERE f.Nome LIKE :pattern ORDER BY f.Nome LIMIT 10');

            $cmd->execute([':pattern' => $pattern]);

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function Listar(){

            $dados = array();

            $cmd = $this->con->query('SELECT f.*, d.Nome Criador FROM Serie f INNER JOIN Criador d ON d.Id = f.IdCriador');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);

            if(isset($_POST['dados'])){

                $serie = $_POST['dados'];
                $serieNome = $serie["Nome"];
                $serieDataInicio = $serie["DataInicio"]; 
                $serieDataFim = $serie["DataFim"]; 
                $serieIdCriador = $serie["IdCriador"];          
                $serieIdAtor = $serie["IdAtor"]; 
                $serieIdGenero = $serie["IdGenero"]; 
                $serieIdPlataforma = $serie["IdPlataforma"]; 
                $serieOrdem = $serie["Ordem"];

                $newdados = $dados;
                foreach($newdados as $key => $row){

                    //Filtra por Nome
                    if($serieNome != ""){
                        if(strpos(strtoupper($row['Nome']), strtoupper($serieNome)) === false){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Data
                    if($serieDataInicio != "" && $serieDataFim != ""){
                        $inicio = implode("-",array_reverse(explode("/", $serieDataInicio)));
                        $fim = implode("-",array_reverse(explode("/", $serieDataFim)));
                        $lancamento = $row['PrimeiroEpisodio'];
                        if($lancamento < $inicio || $lancamento > $fim){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Criador
                    if($serieIdCriador != 0){
                        if($row['IdCriador'] != $serieIdCriador){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Ator
                    if($serieIdAtor != 0){
                        $idsAtores = $this::ObterSerieAtorIds($row['Id']);
                        if(!in_array($serieIdAtor, $idsAtores)){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Genero
                    if($serieIdGenero != 0){
                        $idsGeneros = $this::ObterSerieGeneroIds($row['Id']);
                        if(!in_array($serieIdGenero, $idsGeneros)){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Plataforma
                    if($serieIdPlataforma != 0){
                        $idsPlataformas = $this::ObterSeriePlataformaIds($row['Id']);
                        if(!in_array($serieIdPlataforma, $idsPlataformas)){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                }           

                //Filtra por Ordem
                $nota = array();
                
                foreach ($dados as $key => $row)
                {
                    $nota[$key] = $this::ObterNotaNumerica($row['Id']);
                }

                if(isset($serieOrdem)){
                    if($serieOrdem == 1){
                        array_multisort($nota, SORT_ASC, $dados);
                    }
                    else{
                        array_multisort($nota, SORT_DESC, $dados);
                    }
                }
                else{
                    array_multisort($nota, SORT_DESC, $dados);
                }

            }
            else{

                $nota = array();
                
                foreach ($dados as $key => $row)
                {
                    $nota[$key] = $this::ObterNotaNumerica($row['Id']);
                }
                
                array_multisort($nota, SORT_DESC, $dados);

            }

            //Pega os 100 primeiros do array
            $dados = array_splice($dados, 0, 100);
                                
            //Retorna os dados filtrados                
            return $dados;

        }

        public function ObterTop5Recentes(){

            $dados = array();

            $cmd = $this->con->query('SELECT * FROM Serie ORDER BY PrimeiroEpisodio DESC LIMIT 6');

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }  
            
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

        public function ObterSerieAtores($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT a.* FROM SerieAtor fa INNER JOIN Ator a ON a.Id = fa.IdAtor WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
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

        public function ObterSerieGeneros($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT g.* FROM SerieGenero fg INNER JOIN Genero g ON g.Id = fg.IdGenero WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
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

        public function ObterSeriePlataformas($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT p.* FROM SeriePlataforma fp INNER JOIN Plataforma p ON p.Id = fp.IdPlataforma WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }            
            
            return $dados;

        }

        public function ObterNotaNumerica($id){

            $nota = 0;

            //$cmd = $this->con->prepare('SELECT AVG((Fotografia + Roteiro + TrilhaSonora + EfeitoEspecial + Cenario) / 5) AS Nota FROM SerieNota WHERE IdSerie = :id');
            $cmd = $this->con->prepare('SELECT AVG(Nota) AS Nota FROM SerieNota WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $nota = $dados["Nota"];
            }

            return $nota;
            
        }

        public function ObterNota($id, $tamanho = 'icon-md', $mostrarNumero = false, $mostrarQtd = false){

            $nota = 0;

            //$cmd = $this->con->prepare('SELECT AVG((Fotografia + Roteiro + TrilhaSonora + EfeitoEspecial + Cenario) / 5) AS Nota FROM SerieNota WHERE IdSerie = :id');
            $cmd = $this->con->prepare('SELECT AVG(Nota) AS Nota FROM SerieNota WHERE IdSerie = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $nota = $dados["Nota"];
            }

            $notaicon = "";

            if($nota >= 0 && $nota < 0.5){
                $notaicon = '<i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 0.5 && $nota < 1){
                $notaicon = '<i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 1 && $nota < 1.5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 1.5 && $nota < 2){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 2 && $nota < 2.5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 2.5 && $nota < 3){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 3 && $nota < 3.5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 3.5 && $nota < 4){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 4 && $nota < 4.5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 4.5 && $nota < 5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-half-o '.$tamanho.' text-warning"></i>';
            }
            else if($nota >= 5){
                $notaicon = '<i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star '.$tamanho.' text-warning"></i>';
            }
            else{
                $notaicon = '<i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning mr-1"></i><i class="fa fa-star-o '.$tamanho.' text-warning"></i>';
            }
            
            if($mostrarNumero){
                $notaicon = $notaicon.'<label class="ml-2 font-weight-bolder nota-numerica">'.number_format((float)$nota, 1, '.', '').'</label>';
            }

            if($mostrarQtd){

                $cmd = $this->con->prepare('SELECT COUNT(*) FROM FilmeNota WHERE IdFilme = :id');

                $cmd->bindValue(':id', $id);

                $cmd->execute();

                $rowsNumber = $cmd->fetchColumn(); 

                $notaicon = $notaicon.'<label class="ml-2">('.$rowsNumber.($rowsNumber == 1 ? ' avaliação' : ' avaliações').')</label>';
            }

            return $notaicon;

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

        public function Salvar(){

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
            $serieTrailer = $serie["Trailer"];
            
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
            
            if(!isset($serieTrailer)){
                $serieTrailer = "";
            }

            //Cadastrar serie
            $cmd = $this->con->prepare('INSERT INTO Serie (Nome, PrimeiroEpisodio, NumeroTemporada, DataTermino, IdCriador, Sinopse, Foto) VALUES (:serieNome, :seriePrimeiroEpisodio, :serieNumeroTemporada, :serieDataTermino, :serieIdCriador, :serieSinopse, :serieFoto, :serieTrailer)');

            $cmd->bindValue(':serieNome', strtoupper($serieNome));
            $cmd->bindValue(':seriePrimeiroEpisodio', $seriePrimeiroEpisodio);
            $cmd->bindValue(':serieNumeroTemporada', $serieNumeroTemporada);
            $cmd->bindValue(':serieDataTermino', $serieDataTermino);
            $cmd->bindValue(':serieIdCriador', $serieIdCriador);
            $cmd->bindValue(':serieSinopse', $serieSinopse);
            $cmd->bindValue(':serieFoto', $serieFoto);
            $cmd->bindValue(':serieTrailer', $serieTrailer);

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

        public function SalvarAlteracao(){

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
            $serieTrailer = $serie["Trailer"];
            
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

            if(!isset($serieTrailer)){
                $serieTrailer = "";
            }

            //Alterar serie
            $cmd = $this->con->prepare('UPDATE Serie SET Nome = :serieNome, PrimeiroEpisodio = :seriePrimeiroEpisodio, NumeroTemporada = :serieNumeroTemporada, DataTermino = :serieDataTermino, IdCriador = :serieIdCriador, Sinopse = :serieSinopse, Foto = :serieFoto, Trailer = :serieTrailer WHERE Id = :serieId');

            $cmd->bindValue(':serieNome', strtoupper($serieNome));
            $cmd->bindValue(':seriePrimeiroEpisodio', $seriePrimeiroEpisodio);
            $cmd->bindValue(':serieNumeroTemporada', $serieNumeroTemporada);
            $cmd->bindValue(':serieDataTermino', $serieDataTermino);
            $cmd->bindValue(':serieIdCriador', $serieIdCriador);
            $cmd->bindValue(':serieSinopse', $serieSinopse);
            $cmd->bindValue(':serieFoto', $serieFoto);
            $cmd->bindValue(':serieId', $serieId);
            $cmd->bindValue(':serieTrailer', $serieTrailer);

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
        
        public function Excluir(){

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