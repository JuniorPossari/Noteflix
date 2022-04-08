<?php

    require_once 'ConexaoService.php';

    Class FilmeService{

        private $con;

        public function __construct(){
            $this->con = ConexaoService::ObterConexao();
        }

        public function ObterTodos(){

            $dados = array();

            $cmd = $this->con->query('SELECT f.*, d.Nome Diretor FROM Filme f INNER JOIN Diretor d ON d.Id = f.IdDiretor ORDER BY f.Nome');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            
            return $dados;

        }

        public function Procurar($query){

            $dados = array();

            $pattern = '%'.$query.'%';

            $cmd = $this->con->prepare('SELECT f.*, d.Nome Diretor FROM Filme f INNER JOIN Diretor d ON d.Id = f.IdDiretor WHERE f.Nome LIKE :pattern ORDER BY f.Nome LIMIT 10');

            $cmd->execute([':pattern' => $pattern]);

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function Listar(){

            $dados = array();

            $cmd = $this->con->query('SELECT f.*, d.Nome Diretor FROM Filme f INNER JOIN Diretor d ON d.Id = f.IdDiretor');

            $dados = $cmd->fetchall(PDO::FETCH_ASSOC);

            if(isset($_POST['dados'])){

                $filme = $_POST['dados'];
                $filmeNome = $filme["Nome"];
                $filmeDataInicio = $filme["DataInicio"]; 
                $filmeDataFim = $filme["DataFim"]; 
                $filmeIdDiretor = $filme["IdDiretor"];          
                $filmeIdAtor = $filme["IdAtor"]; 
                $filmeIdGenero = $filme["IdGenero"]; 
                $filmeIdPlataforma = $filme["IdPlataforma"]; 
                $filmeOrdem = $filme["Ordem"];

                $newdados = $dados;
                foreach($newdados as $key => $row){

                    //Filtra por Nome
                    if($filmeNome != ""){
                        if(strpos(strtoupper($row['Nome']), strtoupper($filmeNome)) === false){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Data
                    if($filmeDataInicio != "" && $filmeDataFim != ""){
                        $inicio = implode("-",array_reverse(explode("/", $filmeDataInicio)));
                        $fim = implode("-",array_reverse(explode("/", $filmeDataFim)));
                        $lancamento = $row['DataLancamento'];
                        if($lancamento < $inicio || $lancamento > $fim){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Diretor
                    if($filmeIdDiretor != 0){
                        if($row['IdDiretor'] != $filmeIdDiretor){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Ator
                    if($filmeIdAtor != 0){
                        $idsAtores = $this::ObterFilmeAtorIds($row['Id']);
                        if(!in_array($filmeIdAtor, $idsAtores)){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Genero
                    if($filmeIdGenero != 0){
                        $idsGeneros = $this::ObterFilmeGeneroIds($row['Id']);
                        if(!in_array($filmeIdGenero, $idsGeneros)){
                            unset($dados[$key]);
                            continue;
                        }
                    }

                    //Filtra por Plataforma
                    if($filmeIdPlataforma != 0){
                        $idsPlataformas = $this::ObterFilmePlataformaIds($row['Id']);
                        if(!in_array($filmeIdPlataforma, $idsPlataformas)){
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

                if(isset($filmeOrdem)){
                    if($filmeOrdem == 1){
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

            $cmd = $this->con->query('SELECT * FROM Filme ORDER BY DataLancamento DESC LIMIT 6');

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }  
            
            return $dados;

        }

        public function ObterPorId($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM Filme WHERE Id = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            }
            
            return $dados;

        }

        public function ObterFilmeAtorIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdAtor FROM FilmeAtor WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterFilmeAtores($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT a.* FROM FilmeAtor fa INNER JOIN Ator a ON a.Id = fa.IdAtor WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }            
            
            return $dados;

        }

        public function ObterFilmeGeneroIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdGenero FROM FilmeGenero WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterFilmeGeneros($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT g.* FROM FilmeGenero fg INNER JOIN Genero g ON g.Id = fg.IdGenero WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }            
            
            return $dados;

        }

        public function ObterFilmePlataformaIds($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT IdPlataforma FROM FilmePlataforma WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_COLUMN);
            }            
            
            return $dados;

        }

        public function ObterFilmePlataformas($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT p.* FROM FilmePlataforma fp INNER JOIN Plataforma p ON p.Id = fp.IdPlataforma WHERE IdFilme = :id');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }            
            
            return $dados;

        }

        public function VerificarSeUsuarioTemNota($idFilme, $idUsuario){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT Nota FROM FilmeNota WHERE IdFilme = :idFilme AND IdUsuario = :idUsuario');

            $cmd->bindValue(':idFilme', $idFilme);
            $cmd->bindValue(':idUsuario', $idUsuario);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $nota = $dados["Nota"];
            }

            return $nota > 0;
            
        }

        public function SalvarNota(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao tentar salvar sua avaliação!");

            $dados = $_POST['dados'];
            $idFilme = $dados["IdFilme"];
            $nota = $dados["Nota"];
            $observacao = $dados["Observacao"];             

            if(!isset($dados) || !isset($_SESSION['2A66DC91515A4715850091B6F9035AAE']) || !isset($idFilme) || !isset($nota)){
                return $result;
            }

            if($nota == "0.0"){
                $result = $json->Data(false, "Aviso", "É necessário selecionar uma nota!");
                return $result;
            }

            if($nota != "0.5" && $nota != "1.0" && $nota != "1.5" && $nota != "2.0" && $nota != "2.5" && $nota != "3.0" && $nota != "3.5" && $nota != "4.0" && $nota != "4.5" && $nota != "5.0"){
                $result = $json->Data(false, "Aviso", "Desculpe, não é possível salvar essa nota!");
                return $result;
            }

            $idUsuario = $_SESSION['2A66DC91515A4715850091B6F9035AAE'];

            if(!isset($observacao)){
                $result = $json->Data(false, "Aviso", "É necessário deixar uma observação sobre o filme!");
                return $result;
            }

            $temNota = $this->VerificarSeUsuarioTemNota($idFilme, $idUsuario);

            if($temNota){

                $cmd = $this->con->prepare('UPDATE FilmeNota SET Nota = :nota, Observacao = :observacao WHERE IdUsuario = :idUsuario AND IdFilme = :idFilme');

                $cmd->bindValue(':idUsuario', $idUsuario);
                $cmd->bindValue(':idFilme', $idFilme);
                $cmd->bindValue(':nota', $nota);
                $cmd->bindValue(':observacao', $observacao);

                $sucesso = $cmd->execute(); 

                if($sucesso){
                    $result = $json->Data(true, "Sucesso", "Sua avaliação foi alterada com sucesso!");
                }

            }
            else{

                $cmd = $this->con->prepare('INSERT INTO FilmeNota (IdUsuario, IdFilme, Nota, Observacao) VALUES (:idUsuario, :idFilme, :nota, :observacao)');

                $cmd->bindValue(':idUsuario', $idUsuario);
                $cmd->bindValue(':idFilme', $idFilme);
                $cmd->bindValue(':nota', $nota);
                $cmd->bindValue(':observacao', $observacao);

                $sucesso = $cmd->execute(); 

                if($sucesso){
                    $result = $json->Data(true, "Sucesso", "Sua avaliação foi salva com sucesso!");
                }

            }

            return $result;

        }

        public function ExcluirNota(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível remover sua avaliação!");

            $idFilme = $_POST['id'];

            $idUsuario = $_SESSION['2A66DC91515A4715850091B6F9035AAE'];

            $cmd = $this->con->prepare('DELETE FROM FilmeNota WHERE IdFilme = :idFilme AND IdUsuario = :idUsuario');

            $cmd->bindValue(':idFilme', $idFilme);
            $cmd->bindValue(':idUsuario', $idUsuario);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Sua avaliação foi removida com sucesso!");
            }

            return $result;

        }

        public function ObterFilmeNotas($id){

            $dados = array();

            $cmd = $this->con->prepare('SELECT * FROM FilmeNota WHERE IdFilme = :id ORDER BY Data DESC');

            $cmd->bindValue(':id', $id);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
            }            
            
            return $dados;

        }

        public function ObterNotaUsuario($id, $idUsuario, $tamanho = 'icon-md', $mostrarNumero = false, $mostrarQtd = false){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT Nota FROM FilmeNota WHERE IdFilme = :idFilme AND IdUsuario = :idUsuario');

            $cmd->bindValue(':idFilme', $id);
            $cmd->bindValue(':idUsuario', $idUsuario);

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

        public function ObterNotaNumericaUsuario($idFilme, $idUsuario){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT Nota FROM FilmeNota WHERE IdFilme = :idFilme AND IdUsuario = :idUsuario');

            $cmd->bindValue(':idFilme', $idFilme);
            $cmd->bindValue(':idUsuario', $idUsuario);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $nota = $dados["Nota"];
            }

            return $nota;
            
        }

        public function ObterObservacaoUsuario($idFilme, $idUsuario){

            $obs = "";

            $cmd = $this->con->prepare('SELECT Observacao FROM FilmeNota WHERE IdFilme = :idFilme AND IdUsuario = :idUsuario');

            $cmd->bindValue(':idFilme', $idFilme);
            $cmd->bindValue(':idUsuario', $idUsuario);

            $cmd->execute();

            if($cmd->rowCount() > 0){
                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                $obs = $dados["Observacao"];
            }

            return $obs;
            
        }

        public function ObterNotaNumerica($id){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT AVG(Nota) AS Nota FROM FilmeNota WHERE IdFilme = :id');

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

            $cmd = $this->con->prepare('SELECT AVG(Nota) AS Nota FROM FilmeNota WHERE IdFilme = :id');

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

        public function VerificarSeFilmeExiste($filmeNome){

            $cmd = $this->con->prepare('SELECT Nome FROM Filme WHERE Nome = :filmeNome');

            $cmd->bindValue(':filmeNome', $filmeNome);

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
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível cadastrar esse filme!");

            $filme = $_POST['dados'];
            $filmeId = 0;
            $filmeNome = $filme["Nome"];
            $filmeDuracao = $filme["Duracao"];
            $filmeDataLancamento = $filme["DataLancamento"];  
            $filmeIdDiretor = $filme["IdDiretor"];          
            $filmeSinopse = $filme["Sinopse"];
            $filmeFoto = $filme["Foto"];
            $filmeTrailer = $filme["Trailer"];
            
            //Arrays que vão ser gravados em outras tabelas
            $filmeAtores = $filme["Elenco"];
            $filmeGeneros = $filme["Genero"];
            $filmePlataformas = array();
            if(isset($filme["Plataforma"])){
                $filmePlataformas = $filme["Plataforma"]; 
            }                       

            if(!isset($filme) || !isset($filmeNome) || !isset($filmeDuracao) || !isset($filmeDataLancamento) || !isset($filmeIdDiretor) || !isset($filmeSinopse) || !isset($filmeFoto) || !isset($filmeAtores) || !isset($filmeGeneros) || count($filmeAtores) == 0 || count($filmeGeneros) == 0){
                return $result;
            }

            $existeFilme = $this::VerificarSeFilmeExiste($filmeNome);

            if($existeFilme){
                $result = $json->Data(false, "Aviso", "Desculpe, esse filme já foi cadastrado!");
                return $result;
            }

            if(!isset($filmeFoto)){
                $filmeFoto = "";
            }

            if($filmeFoto != ""){
                $filmeFoto = base64_decode($filmeFoto);
            }
            
            if(!isset($filmeTrailer)){
                $filmeTrailer = "";
            }

            $filmeDataLancamento = implode("-",array_reverse(explode("/", $filmeDataLancamento)));

            //Cadastrar filme
            $cmd = $this->con->prepare('INSERT INTO Filme (Nome, Duracao, DataLancamento, IdDiretor, Sinopse, Foto, Trailer) VALUES (:filmeNome, :filmeDuracao, :filmeDataLancamento, :filmeIdDiretor, :filmeSinopse, :filmeFoto, :filmeTrailer)');

            $cmd->bindValue(':filmeNome', strtoupper($filmeNome));
            $cmd->bindValue(':filmeDuracao', $filmeDuracao);
            $cmd->bindValue(':filmeDataLancamento', $filmeDataLancamento);
            $cmd->bindValue(':filmeIdDiretor', $filmeIdDiretor);
            $cmd->bindValue(':filmeSinopse', $filmeSinopse);
            $cmd->bindValue(':filmeFoto', $filmeFoto);
            $cmd->bindValue(':filmeTrailer', $filmeTrailer);

            $sucesso = $cmd->execute();            

            if($sucesso){
                $filmeId = $this->con->lastInsertId();
            }

            //Cadastrar atores do filme
            if($sucesso){

                foreach($filmeAtores as $atorId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmeAtor (IdFilme, IdAtor) VALUES (:filmeId, :atorId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':atorId', $atorId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        break;
                    }                   

                }                

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM FilmeAtor WHERE IdFilme = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Filme WHERE Id = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar os atores do filme!");     
                    
                    return $result;

                }

            }

            //Cadastrar generos do filme
            if($sucesso){

                foreach($filmeGeneros as $generoId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmeGenero (IdFilme, IdGenero) VALUES (:filmeId, :generoId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':generoId', $generoId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        break;
                    }                   

                } 

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM FilmeGenero WHERE IdFilme = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Filme WHERE Id = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar os gêneros do filme!");    
                    
                    return $result;

                }

            }

            //Cadastrar plataformas do filme
            if($sucesso && isset($filmePlataformas) && count($filmePlataformas) > 0){

                foreach($filmePlataformas as $plataformaId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmePlataforma (IdFilme, IdPlataforma) VALUES (:filmeId, :plataformaId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':plataformaId', $plataformaId);                
    
                        $sucesso = $cmd->execute();

                    }
                    else{
                        break;
                    }                  

                } 

                if(!$sucesso){

                    $cmd = $this->con->prepare('DELETE FROM FilmePlataforma WHERE IdFilme = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $cmd = $this->con->prepare('DELETE FROM Filme WHERE Id = :filmeId');

                    $cmd->bindValue(':filmeId', $filmeId);

                    $sucesso = $cmd->execute();

                    $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao cadastrar as plataformas do filme!");      
                    
                    return $result;

                }

            }            

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme cadastrado com sucesso!");
            }

            return $result;

        }

        public function SalvarAlteracao(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível alterar esse filme!");

            $filme = $_POST['dados'];
            $filmeId = $filme["Id"];
            $filmeNome = $filme["Nome"];
            $filmeDuracao = $filme["Duracao"];
            $filmeDataLancamento = $filme["DataLancamento"];  
            $filmeIdDiretor = $filme["IdDiretor"];          
            $filmeSinopse = $filme["Sinopse"];
            $filmeFoto = $filme["Foto"];
            $filmeTrailer = $filme["Trailer"];
            
            //Arrays que vão ser gravados em outras tabelas
            $filmeAtores = $filme["Elenco"];
            $filmeGeneros = $filme["Genero"];
            $filmePlataformas = array();
            if(isset($filme["Plataforma"])){
                $filmePlataformas = $filme["Plataforma"]; 
            }                       

            if(!isset($filme) || !isset($filmeNome) || !isset($filmeDuracao) || !isset($filmeDataLancamento) || !isset($filmeIdDiretor) || !isset($filmeSinopse) || !isset($filmeFoto) || !isset($filmeAtores) || !isset($filmeGeneros) || count($filmeAtores) == 0 || count($filmeGeneros) == 0){
                return $result;
            }

            if(!isset($filmeFoto)){
                $filmeFoto = "";
            }

            if($filmeFoto != ""){
                $filmeFoto = base64_decode($filmeFoto);
            }  
            
            if(!isset($filmeTrailer)){
                $filmeTrailer = "";
            }

            $filmeDataLancamento = implode("-",array_reverse(explode("/", $filmeDataLancamento)));

            //Alterar filme
            $cmd = $this->con->prepare('UPDATE Filme SET Nome = :filmeNome, Duracao = :filmeDuracao, DataLancamento = :filmeDataLancamento, IdDiretor = :filmeIdDiretor, Sinopse = :filmeSinopse, Foto = :filmeFoto, Trailer = :filmeTrailer WHERE Id = :filmeId');

            $cmd->bindValue(':filmeNome', strtoupper($filmeNome));
            $cmd->bindValue(':filmeDuracao', $filmeDuracao);
            $cmd->bindValue(':filmeDataLancamento', $filmeDataLancamento);
            $cmd->bindValue(':filmeIdDiretor', $filmeIdDiretor);
            $cmd->bindValue(':filmeSinopse', $filmeSinopse);
            $cmd->bindValue(':filmeFoto', $filmeFoto);
            $cmd->bindValue(':filmeId', $filmeId);
            $cmd->bindValue(':filmeTrailer', $filmeTrailer);

            $sucesso = $cmd->execute();

            //Alterar atores do filme
            if($sucesso){

                $cmd = $this->con->prepare('DELETE FROM FilmeAtor WHERE IdFilme = :filmeId');

                $cmd->bindValue(':filmeId', $filmeId);

                $sucesso = $cmd->execute();

                foreach($filmeAtores as $atorId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmeAtor (IdFilme, IdAtor) VALUES (:filmeId, :atorId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':atorId', $atorId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar os atores do filme!");
                        break;
                    }                   

                }

            }

            //Alterar generos do filme
            if($sucesso){

                $cmd = $this->con->prepare('DELETE FROM FilmeGenero WHERE IdFilme = :filmeId');

                $cmd->bindValue(':filmeId', $filmeId);

                $sucesso = $cmd->execute();

                foreach($filmeGeneros as $generoId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmeGenero (IdFilme, IdGenero) VALUES (:filmeId, :generoId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':generoId', $generoId);                
    
                        $sucesso = $cmd->execute();

                    } 
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar os gêneros do filme!");
                        break;
                    }                   

                }

            }

            //Alterar plataformas do filme
            if($sucesso && isset($filmePlataformas) && count($filmePlataformas) > 0){

                $cmd = $this->con->prepare('DELETE FROM FilmePlataforma WHERE IdFilme = :filmeId');

                $cmd->bindValue(':filmeId', $filmeId);

                $sucesso = $cmd->execute();

                foreach($filmePlataformas as $plataformaId){

                    if($sucesso){

                        $cmd = $this->con->prepare('INSERT INTO FilmePlataforma (IdFilme, IdPlataforma) VALUES (:filmeId, :plataformaId)');

                        $cmd->bindValue(':filmeId', $filmeId);
                        $cmd->bindValue(':plataformaId', $plataformaId);                
    
                        $sucesso = $cmd->execute();

                    }
                    else{
                        $result = $json->Data(false, "Aviso", "Desculpe, houve um erro ao alterar as plataformas do filme!");
                        break;
                    }                  

                }

            }            

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme alterado com sucesso!");
            }

            return $result;

        }
        
        public function BuscarFoto($dados){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível encontrar a foto desse filme!");

            $IdElement = $_POST['idElement'];

            if(!isset($IdElement)){
                return $result;
            }                

            $cmd = $this->con->prepare('SELECT Foto FROM Filme WHERE Id = :id AND Foto IS NOT NULL');

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
                
                $result = $json->Data(true, "Sucesso", "A foto do filme foi encontrada!", $fotoArray);

            }

            return $result;

        }
        
        public function Excluir(){

            $json = new JsonResult();
            $result = $json->Data(false, "Aviso", "Desculpe, não foi possível excluir esse filme!");

            $filmeId = $_POST['id'];

            //Excluir ator do filme
            $cmd = $this->con->prepare('DELETE FROM FilmeAtor WHERE IdFilme = :filmeId');

            $cmd->bindValue(':filmeId', $filmeId);

            $sucesso = $cmd->execute();

            //Excluir genero do filme
            $cmd = $this->con->prepare('DELETE FROM FilmeGenero WHERE IdFilme = :filmeId');

            $cmd->bindValue(':filmeId', $filmeId);

            $sucesso = $cmd->execute();

            //Excluir plaaforma do filme
            $cmd = $this->con->prepare('DELETE FROM FilmePlataforma WHERE IdFilme = :filmeId');

            $cmd->bindValue(':filmeId', $filmeId);

            $sucesso = $cmd->execute();

            //Excluir filme
            $cmd = $this->con->prepare('DELETE FROM Filme WHERE Id = :filmeId');

            $cmd->bindValue(':filmeId', $filmeId);

            $sucesso = $cmd->execute();

            if($sucesso){
                $result = $json->Data(true, "Sucesso", "Filme excluido com sucesso!");
            }

            return $result;

        }

    }

?>