<table class="d-none datatable-altura table-hover" id="kt_datatable">
    <thead>
        <tr>                        
            <th data-title="">
                filmes
            </th>                                              
        </tr>
    </thead>
    <tbody>

        <?php

            $filmeService = new FilmeService();

            $filmes = $filmeService->Listar();                    

            foreach ($filmes as $filme) {

                $idFilme = $filme["Id"];
                $nomeFilme = $filme["Nome"];
                $duracaoFilme = $filme["Duracao"];
                $horasFilme = explode(":", $duracaoFilme)[0]."h";
                $minutosFilme = explode(":", $duracaoFilme)[1]."min";
                $lancamentoFilme = implode("/",array_reverse(explode("-", $filme["DataLancamento"])));
                $diretorFilme = $filme["Diretor"];
                $fotoFilme = base64_encode($filme["Foto"]);
                $notaFilme = $filmeService->ObterNota($idFilme, "icon-xl");
                $sinopseFilme = $filme["Sinopse"];

                $atores = $filmeService->ObterFilmeAtores($idFilme);
                $generos = $filmeService->ObterFilmeGeneros($idFilme);
                $plataformas = $filmeService->ObterFilmePlataformas($idFilme);

                ?>
                    <tr>                                   
                        <td>
                            
                            <div class="row align-items-center" style="height: 440px;">

                                <div class="col-md-5">

                                    <a class="previa" href="/Noteflix/Home/Filme/<?php echo $idFilme; ?>">
                                        <img class="foto-fixa" src="data:image/jpeg;base64,<?php echo $fotoFilme; ?>">
                                        <h2 class="slide-name"><?php echo $nomeFilme; ?>
                                            <span class="d-block">
                                                <?php echo $notaFilme; ?>
                                            </span>
                                        </h2>
                                    </a>
                                    
                                </div>

                                <div class="col-md-7 text-left">
                                    <div class="form-group">
                                        <h2 class="font-weight-bold"><?php echo $nomeFilme; ?></h2>
                                    </div>

                                    <div class="form-group">
                                        <h3><?php echo $lancamentoFilme; ?> - <?php echo $horasFilme . " " . $minutosFilme; ?></h3>
                                    </div>                                                

                                    <div class="form-group">
                                        <h5><b class="text-secondary">Direção: </b><?php echo $diretorFilme; ?></h5>
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

                                    <div class="d-flex align-items-center <?php if(count($plataformas) > 0) echo 'form-group'; ?>">
                                        <?php
                                            foreach ($plataformas as $plataforma) {

                                                $idPlataforma = $plataforma["Id"];
                                                $nomePlataforma = $plataforma["Nome"];
                
                                                echo '<h4 class="bg-light-danger p-1 mr-2 mb-0" style="border-radius: 5px;">'.$nomePlataforma.'</h4>';                                        
                                            }
                                        ?>                                                    
                                    </div>

                                    <div class="form-group"><?php echo $notaFilme; ?></div>

                                    <div class="form-group"><?php echo substr($sinopseFilme, 0, 600).'...'; ?></div>
                                                                                    
                                </div>
                            
                            </div>
                            
                        </td>
                    </tr>
                <?php
            }

        ?>         

    </tbody>
</table>

              
            
                    
               