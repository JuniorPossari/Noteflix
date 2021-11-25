<table class="d-none datatable-altura table-hover" id="kt_datatable">
    <thead>
        <tr>                        
            <th data-title="">
                series
            </th>                                              
        </tr>
    </thead>
    <tbody>

        <?php

            $serieService = new SerieService();

            $series = $serieService->Listar();                    

            foreach ($series as $serie) {

                $idSerie = $serie["Id"];
                $nomeSerie = $serie["Nome"];
                $ntemporadaSerie = $serie["NumeroTemporada"];
                $lancamentoSerie = implode("/",array_reverse(explode("-", $serie["PrimeiroEpisodio"])));
                $criadorSerie = $serie["Criador"];
                $fotoSerie = base64_encode($serie["Foto"]);
                $notaSerie = $serieService->ObterNota($idSerie, "icon-xl", true);
                $sinopseSerie = $serie["Sinopse"];
                $trailerSerie = $serie["Trailer"];

                $atores = $serieService->ObterSerieAtores($idSerie);
                $generos = $serieService->ObterSerieGeneros($idSerie);
                $plataformas = $serieService->ObterSeriePlataformas($idSerie);

                ?>
                    <tr>                                   
                        <td>
                            
                            <div class="row align-items-center" style="height: 440px;">

                                <div class="col-md-5">

                                    <a href="javascript:;"  class="previa btnAbrirModalTrailer" data-embed="<?php echo $trailerSerie; ?>" data-toggle="modal" data-target="#modalTrailer">
                                        <img class="foto-fixa" src="data:image/jpeg;base64,<?php echo $fotoSerie; ?>">
                                        <h2 class="slide-name">
                                            <span class="d-block">
                                                <i class="fas fa-play-circle fa-3x"></i>
                                            </span>
                                        </h2>
                                    </a>
                                    
                                </div>

                                <div class="col-md-7 text-left">
                                    <div class="form-group">
                                        <a href="/Noteflix/Home/Serie/<?php echo $idSerie; ?>"><h2 class="font-weight-bold text-dark serie-nome d-inline p-0 m-0"><?php echo $nomeSerie; ?></h2></a>                                        
                                    </div>

                                    <div class="form-group">
                                        <h3><?php echo $lancamentoSerie; ?></h3>
                                    </div>   
                                    
                                    <div class="form-group">
                                        <h5><b class="text-secondary">Temporadas: </b><?php echo $ntemporadaSerie; ?></h5>
                                    </div>

                                    <div class="form-group">
                                        <h5><b class="text-secondary">Criado por: </b><?php echo $criadorSerie; ?></h5>
                                    </div>

                                    <div class="form-group">
                                        <h5>
                                            <b class="text-secondary">Elenco: </b>
                                            <?php
                                                $i = 1;
                                                foreach ($atores as $ator) {

                                                    $idAtor = $ator["Id"];
                                                    $nomeAtor = $ator["Nome"];

                                                    echo $nomeAtor;

                                                    if($i < count($atores)){
                                                        echo ', ';
                                                    }

                                                    $i = $i + 1;
                                                }
                                            ?>
                                        </h5>
                                    </div>

                                    <div class="form-group d-flex align-items-center">
                                        <?php
                                            foreach ($generos as $genero) {

                                                $idGenero = $genero["Id"];
                                                $nomeGenero = $genero["Nome"];
                
                                                echo '<h4 class="bg-light-dark p-1 mr-2 mb-0" style="border-radius: 5px;">'.$nomeGenero.'</h4>';
                                            }
                                        ?>                                                    
                                    </div>                                    

                                    <div class="form-group"><?php echo $notaSerie; ?></div>

                                    <div class="d-flex align-items-center <?php if(count($plataformas) > 0) echo 'form-group'; ?>">
                                        <?php
                                            foreach ($plataformas as $plataforma) {

                                                $idPlataforma = $plataforma["Id"];
                
                                                echo '<img class="mr-2" src="/Noteflix/Content/img/plataformas/'. $idPlataforma .'.png" />';                                        
                                            }
                                        ?>                                                    
                                    </div>

                                    <div class="form-group"><?php if(strlen($sinopseSerie) > 400){ echo substr($sinopseSerie, 0, 400).'...'; }else{ echo $sinopseSerie; } ?></div>
                                                                                    
                                </div>
                            
                            </div>
                            
                        </td>
                    </tr>
                <?php
            }

        ?>         

    </tbody>
</table>

              
            
                    
               