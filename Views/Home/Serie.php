<?php

    $usuarioService = new UsuarioService();
    $serieService = new SerieService();
    $criadorService = new CriadorService();

    $isAuthenticated = $usuarioService->VerificarSeUsuarioEstaLogado();

    $temNota = false;
    $idUsuario = 0;
    $idSerie = $Id;
    $nomeSerie = $Nome;
    $ntemporadaSerie = $NumeroTemporada;
    $lancamentoSerie = implode("/",array_reverse(explode("-", $PrimeiroEpisodio)));
    $criadorSerie = $criadorService->ObterNomePorId($IdCriador);
    $fotoSerie = base64_encode($Foto);
    $notaSerie = $serieService->ObterNota($idSerie, "icon-xl", true, true);
    $sinopseSerie = $Sinopse;
    $trailerSerie = $Trailer;

    $atores = $serieService->ObterSerieAtores($idSerie);
    $generos = $serieService->ObterSerieGeneros($idSerie);
    $plataformas = $serieService->ObterSeriePlataformas($idSerie);

    if($isAuthenticated){
        $idUsuario = $usuarioService->ObterIdUsuarioLogado();
        $temNota = $serieService->VerificarSeUsuarioTemNota($idSerie, $idUsuario);
    }

?>  

<input type="hidden" class="d-none" id="hdnIdSerie" value="<?php echo $idSerie; ?>">

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
    }

    .nota-numerica{
        font-size: 20px !important;
    }

    #Avaliacoes .nota-numerica{
        font-size: 15px !important;
    }

    .modal-dialog {
        max-width: 600px !important;
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

    .foto-fixa{
        margin-top: -11px !important;
    }

    textarea {
        background-color: rgba(243, 243, 243, 0.30) !important;
        resize: none;
    }

    .usuario-imagem{
        border-width: 1px !important;
        height: 70px !important;
        width: 70px !important;
    }

    .usuario-imagem-background{
        height: 70px !important;
        width: 70px !important;
    }

    #kt_datatable tbody tr td span{
        width: 100% !important;        
    }

    #kt_datatable thead tr th span{
        width: 100% !important;
        text-align: center;        
    }

    #kt_datatable thead tr th{
        padding: 4px !important;
    }

</style>

<link rel="stylesheet" href="/Noteflix/Content/css/nota.css">

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
                    <a href="/Noteflix/Home/Serie/<?php echo $Id; ?>" class="text-white text-hover-white opacity-75 hover-opacity-100">Série</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Série</h3>
            </div>
            <div class="card-toolbar">
                <?php

                    if($isAuthenticated){
                        echo '<a href="javascript:;" class="btn btn-lg btn-light-dark font-weight-bold" id="btnAbrirModalNota"><i class="fa fa-star '.($temNota ? 'text-warning ' : '').'icon-md mb-1"></i>Avaliar</a>';
                    }
                    else{
                        echo '<a href="/Noteflix/Usuario/Login?url=Home/Serie/'.$idSerie.'" class="btn btn-lg btn-light-dark font-weight-bold"><i class="fa fa-star icon-md mb-1"></i>Avaliar</a>';
                    }

                ?>                
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
                    
            <div class="row align-items-center">

                <div class="col-md-5 d-flex justify-content-center">

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
                        <h2 class="font-weight-bold text-dark serie-nome d-inline p-0 m-0"><?php echo $nomeSerie.' ('.explode("/", $lancamentoSerie)[2].')'; ?></h2>                                       
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

                    <div id="ConteudoNotaGeral" class="form-group"><?php echo $notaSerie; ?></div>

                    <div class="d-flex align-items-center <?php if(count($plataformas) > 0) echo 'form-group'; ?>">
                        <?php
                            foreach ($plataformas as $plataforma) {

                                $idPlataforma = $plataforma["Id"];

                                echo '<img class="mr-2" src="/Noteflix/Content/img/plataformas/'. $idPlataforma .'.png" />';                                        
                            }
                        ?>                                                    
                    </div>

                    <div class="form-group"><?php echo $sinopseSerie; ?></div>
                                                                    
                </div>
            
            </div>

            <div id="Avaliacoes" class="mt-15 mb-10">

                <?php
                    
                    require 'Views/Home/_ListarAvaliacoesSerie.php';

                ?>
                
            </div>
            

        </div>                    
        <!--end::Body-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<!-- Modal Trailer-->
<div class="modal fade" id="modalTrailer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTrailerTitle">Assista o trailer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <iframe width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-secondary font-weight-bold" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php

    if($isAuthenticated){

        ?>
            <!-- Modal Nota-->
            <div class="modal fade" id="modalNota" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNotaTitle">Avalie essa série</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div id="ConteudoNota" class="modal-body">

                        </div>
                        <div class="modal-footer d-flex align-items-center">
                            <button type="button" id="btnSalvarNota" class="btn btn-lg btn-primary font-weight-bold mr-2">Salvar</button>
                            <button type="button" id="btnRemoverNota" class="btn btn-lg btn-danger font-weight-bold mr-2 d-none">Remover</button>
                            <button type="button" class="btn btn-lg btn-secondary font-weight-bold" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

?>

<script src="/Noteflix/Scripts/Home/Serie.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        SerieAPI.initIndex();
    });
</script>