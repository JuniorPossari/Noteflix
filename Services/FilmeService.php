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

        public function ObterNota($id, $tamanho = 'icon-md'){

            $nota = 0;

            $cmd = $this->con->prepare('SELECT AVG((Fotografia + Roteiro + TrilhaSonora + EfeitoEspecial + Cenario) / 5) AS Nota FROM NotaFilme WHERE IdFilme = :id');

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

        public function Salvar($dados){

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

            $filmeDataLancamento = implode("-",array_reverse(explode("/", $filmeDataLancamento)));

            //Cadastrar filme
            $cmd = $this->con->prepare('INSERT INTO Filme (Nome, Duracao, DataLancamento, IdDiretor, Sinopse, Foto) VALUES (:filmeNome, :filmeDuracao, :filmeDataLancamento, :filmeIdDiretor, :filmeSinopse, :filmeFoto)');

            $cmd->bindValue(':filmeNome', $filmeNome);
            $cmd->bindValue(':filmeDuracao', $filmeDuracao);
            $cmd->bindValue(':filmeDataLancamento', $filmeDataLancamento);
            $cmd->bindValue(':filmeIdDiretor', $filmeIdDiretor);
            $cmd->bindValue(':filmeSinopse', $filmeSinopse);
            $cmd->bindValue(':filmeFoto', $filmeFoto);

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

        public function SalvarAlteracao($dados){

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

            $filmeDataLancamento = implode("-",array_reverse(explode("/", $filmeDataLancamento)));

            //Alterar filme
            $cmd = $this->con->prepare('UPDATE Filme SET Nome = :filmeNome, Duracao = :filmeDuracao, DataLancamento = :filmeDataLancamento, IdDiretor = :filmeIdDiretor, Sinopse = :filmeSinopse, Foto = :filmeFoto WHERE Id = :filmeId');

            $cmd->bindValue(':filmeNome', $filmeNome);
            $cmd->bindValue(':filmeDuracao', $filmeDuracao);
            $cmd->bindValue(':filmeDataLancamento', $filmeDataLancamento);
            $cmd->bindValue(':filmeIdDiretor', $filmeIdDiretor);
            $cmd->bindValue(':filmeSinopse', $filmeSinopse);
            $cmd->bindValue(':filmeFoto', $filmeFoto);
            $cmd->bindValue(':filmeId', $filmeId);

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
        
        public function Excluir($dados){

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