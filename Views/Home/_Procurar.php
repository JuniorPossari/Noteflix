<div class="row mb-3">
    <div class="col-md-12 text-left"><h6 class="font-weight-bolder text-primary">FILMES</h6></div>    
</div>

<?php

    $filmeService = new FilmeService();

    $filmes = $filmeService->Procurar($query);

    if (!empty($filmes) && count($filmes) > 0) {
        
        foreach ($filmes as $filme) {

            $idFilme = $filme["Id"];
            $nomeFilme = $filme["Nome"];
            $diretorFilme = $filme["Diretor"];
            $fotoFilme = base64_encode($filme["Foto"]);
    
            ?> 
            
                <div class="row procurar-linha align-items-center mb-2" style="height: 70px;">
    
                    <div class="col-md-3 d-flex justify-content-center">
    
                        <img style="height: 60px; width: auto;" src="data:image/jpeg;base64,<?php echo $fotoFilme; ?>">                        
                        
                    </div>
    
                    <div class="col-md-9 text-left">
                        <div class="mb-2">
                            <a href="/Noteflix/Home/Filme/<?php echo $idFilme; ?>"><div class="font-weight-bold text-dark titulo-hover d-inline p-0 m-0"><?php echo $nomeFilme; ?></div></a>                                        
                        </div>                                         
    
                        <div class="mb-2">
                            <?php echo $diretorFilme; ?>
                        </div>
                                                                        
                    </div>
                
                </div>
            <?php
        }

    }
    else{

        ?> 
            
            <div class="row procurar-linha align-items-center mb-2" style="height: 70px;">

                <div class="col-md-12 d-flex justify-content-center">Nenhum filme foi encontrado</div>
            
            </div>

        <?php

    }

?>

<div class="row mt-3 mb-3">
    <div class="col-md-12 text-left"><h6 class="font-weight-bolder text-primary">SÉRIES</h6></div>    
</div>

<?php

    $serieService = new SerieService();

    $series = $serieService->Procurar($query); 
    
    if (!empty($series) && count($series) > 0) {
        
        foreach ($series as $serie) {

            $idSerie = $serie["Id"];
            $nomeSerie = $serie["Nome"];
            $criadorSerie = $serie["Criador"];
            $fotoSerie = base64_encode($serie["Foto"]);
    
            ?> 
            
                <div class="row procurar-linha align-items-center mb-2" style="height: 70px;">
    
                    <div class="col-md-3 d-flex justify-content-center">
    
                        <img style="height: 60px; width: auto;" src="data:image/jpeg;base64,<?php echo $fotoSerie; ?>">                        
                        
                    </div>
    
                    <div class="col-md-9 text-left">
                        <div class="mb-2">
                            <a href="/Noteflix/Home/Serie/<?php echo $idSerie; ?>"><div class="font-weight-bold text-dark titulo-hover d-inline p-0 m-0"><?php echo $nomeSerie; ?></div></a>                                        
                        </div>                                         
    
                        <div class="mb-2">
                            <?php echo $criadorSerie; ?>
                        </div>
                                                                        
                    </div>
                
                </div>

            <?php
        }

    }
    else{

        ?> 
            
            <div class="row procurar-linha align-items-center mb-2" style="height: 70px;">

                <div class="col-md-12 d-flex justify-content-center">Nenhuma série foi encontrada</div>
            
            </div>

        <?php

    }

    

?>

              
            
                    
               