<?php

    $serieService = new SerieService();

?>

<style>
    textarea {
        resize: none;
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
                    <a href="/Noteflix/Serie/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Séries</a>
                    <!--end::Item--> 
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="/Noteflix/Serie/Alterar" class="text-white text-hover-white opacity-75 hover-opacity-100">Alterar</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Alterar Série</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <form id="Form">
                <input type="hidden" name="IdElement" class="d-none" id="IdElement" value="<?php echo $Id; ?>">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="SerieNome" id="SerieNome" value="<?php echo $Nome; ?>" >
                </div>
                <div class="form-group">   
                    <label>Primeiro Episódio</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" name="SeriePrimeiroEp" id="SeriePrimeiroEp" placeholder="Defina a data" autocomplete="off" value="<?php echo implode("/",array_reverse(explode("-", $PrimeiroEpisodio))); ?>" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <label>Numero de Temporadas</label>
                    <input type="number" class="form-control" min="1" name="SerieNumeroTemp" id="SerieNumeroTemp" value="<?php echo $NumeroTemporada; ?>" />
                </div>
                <div class="form-group"> 
                    <label>Data de Termino</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" name="SerieDataTermino" id="SerieDataTermino" placeholder="Defina a data" autocomplete="off" value="<?php if(isset($DataTermino) && $DataTermino != "0000-00-00"){ echo implode("/",array_reverse(explode("-", $DataTermino))); }  ?>" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <label>Criador</label>
                    <select class="form-control select2" name="SerieCriador" id="SerieCriador" >

                        <option value="">Selecione...</option>
                        <?php

                            $criadorService = new CriadorService();

                            $criadores = $criadorService->ObterTodos();                        

                            foreach ($criadores as $criador) {

                                $idCriador = $criador["Id"];
                                $nomeCriador = $criador["Nome"];

                                ?>
                                    <option value="<?php echo $idCriador ?>" <?php if($idCriador == $IdCriador){ echo "selected"; } ?> ><?php echo $nomeCriador; ?></option>
                                <?php
                            }
                        
                        ?>
                    
                    </select>
                </div>
                <div class="form-group">       
                    <label>Elenco</label>
                    <select class="form-control select2" name="SerieElenco" id="SerieElenco" multiple="multiple" >

                        <option value="">Selecione...</option>
                        <?php

                            $atorService = new AtorService();                          

                            $atores = $atorService->ObterTodos();

                            $atoresIds = $serieService->ObterSerieAtorIds($Id); 

                            foreach ($atores as $ator) {

                                $idAtor = $ator["Id"];
                                $nomeAtor = $ator["Nome"];

                                ?>
                                    <option value="<?php echo $idAtor ?>" <?php if(in_array($idAtor, $atoresIds)){ echo "selected"; } ?> ><?php echo $nomeAtor; ?></option>
                                <?php
                            }
                        
                        ?>
                    
                    </select>
                </div>
                <div class="form-group">       
                    <label>Gênero</label>
                    <select class="form-control select2" name="SerieGenero" id="SerieGenero" multiple="multiple" >

                        <option value="">Selecione...</option>
                        <?php

                            $generoService = new GeneroService();

                            $generos = $generoService->ObterTodos();

                            $generosIds = $serieService->ObterSerieGeneroIds($Id);

                            foreach ($generos as $genero) {

                                $idGenero = $genero["Id"];
                                $nomeGenero = $genero["Nome"];

                                ?>
                                    <option value="<?php echo $idGenero ?>" <?php if(in_array($idGenero, $generosIds)){ echo "selected"; } ?> ><?php echo $nomeGenero; ?></option>
                                <?php
                            }
                        
                        ?>
                    
                    </select>
                </div>
                <div class="form-group"> 
                    <label>Plataforma</label>
                    <select class="form-control select2" name="SeriePlataforma" id="SeriePlataforma" multiple="multiple" >

                        <option value="">Selecione...</option>
                        <?php

                            $plataformaService = new PlataformaService();

                            $plataformas = $plataformaService->ObterTodos();

                            $plataformasIds = $serieService->ObterSeriePlataformaIds($Id);

                            foreach ($plataformas as $plataforma) {

                                $idPlataforma = $plataforma["Id"];
                                $nomePlataforma = $plataforma["Nome"];

                                ?>
                                    <option value="<?php echo $idPlataforma ?>" <?php if(in_array($idPlataforma, $plataformasIds)){ echo "selected"; } ?> ><?php echo $nomePlataforma; ?></option>
                                <?php
                            }
                        
                        ?>
                    
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto</label>                               
                    <div class="drop-zone dropzone dropzone-default d-flex align-items-center justify-content-center">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">Arraste a imagem ou clique aqui para fazer o upload ( Apenas .jpg ) </h3>
                            <span class="dropzone-msg-desc">

                            </span>
                        </div>
                    </div>
                    <input class="d-none" name="SerieFoto" id="SerieFoto" value="">
                </div>
                <div class="form-group"> 
                    <label>Sinopse</label>
                    <textarea rows="5" class="form-control" name="SerieSinopse" id="SerieSinopse" maxlength="1000" ><?php echo $Sinopse; ?></textarea>
                </div>
            
            </form>
            
        </div>                    
        <!--end::Body-->
        <!--begin:Footer-->
        <div class="card-footer">
            <a href="/Noteflix/Serie/Index" class="btn btn-secondary font-weight-bold mr-2">Voltar</a>
            <a href="javascript:;" id="Salvar" class="btn btn-primary font-weight-bold">Salvar</a>
        </div>
        <!--end:Footer-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Noteflix/Scripts/Serie/Serie.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        SerieAPI.initAlterar();
    });
</script>