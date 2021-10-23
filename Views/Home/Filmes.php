<style>

    .slide-name {
        width: 310px;
        opacity: 0.8;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: white;
        font-size: 28px;
        -webkit-transition: all 300ms ease;
        transition: all 300ms ease;
        text-transform: uppercase;
        display: none;
        text-shadow: 1px 0 0 #000, -1px 0 0 #000, 0 1px 0 #000, 0 -1px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
    }

    .previa{
        background-color: #000;
        text-align: center;
        vertical-align: middle;
        line-height: 400px;
        font-size: 100px;
        color: #fff;
        height: 420px;
        width: 310px;
    }

    .previa:hover {
        cursor: pointer;
    }

    .previa:hover .slide-name{
        display: block; 
    }

    .previa:hover img {
        filter: brightness(30%); 
    }
</style>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <!--end::Mobile Toggle-->
            <!--begin::Heading-->
            <div class="d-flex flex-column">                
                <!--begin::Breadcrumb-->
                <div class="d-flex align-items-center font-weight-bold my-2">
                    <!--begin::Item-->
                    <a href="/Noteflix/Home/Index" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="/Noteflix/Home/Filmes" class="text-white text-hover-white opacity-75 hover-opacity-100">Filmes</a>
                    <!--end::Item-->                   
                </div>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Container-->
<div class="container-fluid fundo-padrao">
    <!--begin::Card-->
    <div class="card card-custom card-padrao">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Filmes</h3>
            </div>
            <div class="card-toolbar">
                
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">

            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Procurar..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            
            <!--begin: Datatable-->
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

                        $filmes = $filmeService->ObterTodos();                        

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
                                                            //echo '<img class="mr-2 mb-0" style="height: 35px; width: auto;" src="/Noteflix/Content/img/plataformas/netflix.png"> <img class="mr-2 mb-0" style="height: 35px; width: auto;" src="/Noteflix/Content/img/plataformas/prime-video.png"> <img class="mr-2 mb-0" style="height: 35px; width: auto;" src="/Noteflix/Content/img/plataformas/disney-plus.png">';
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
            <!--end: Datatable-->

        </div>                    
        <!--end::Body-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Noteflix/Scripts/Home/Filme.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        FilmeAPI.initIndex();
    });
</script>