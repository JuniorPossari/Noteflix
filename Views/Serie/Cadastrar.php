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
                    <a href="/Noteflix/Serie/Cadastrar" class="text-white text-hover-white opacity-75 hover-opacity-100">Cadastrar</a>
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
<div class="container-fluid h-100" style="width: 80% !important;">
    <!--begin::Card-->
    <div class="card card-custom h-100" style="background-color: #f8f7ff; border-radius: 20px; border: 2px solid;">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Cadastrar Série</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="SerieNome" id="SerieNome">
            </div>
            <div class="form-group">   
                <label>Primeiro Episódio</label>
                <div class="input-group date">
                    <input type="text" class="form-control" name="SeriePrimeiroEp" id="SeriePrimeiroEp" readonly placeholder="Selecione uma data"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <label>Numero de Temporadas</label>
                <input type="number" class="form-control" min="1" name="SerieNumeroTemp" id="SerieNumeroTemp">
            </div>
            <div class="form-group"> 
                <label>Data de Termino</label>
                <div class="input-group date">
                    <input type="text" class="form-control" name="SerieDataTermino" id="SerieDataTermino" readonly placeholder="Selecione uma data"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <label>Criador</label>
                <select class="form-control select2" name="SerieCriador" id="SerieCriador">

                    <option value="">Selecione...</option>
                    <?php

                        $criadorService = new CriadorService();

                        $criadores = $criadorService->ObterTodos();                        

                        foreach ($criadores as $criador) {

                            $idCriador = $criador["Id"];
                            $nomeCriador = $criador["Nome"];

                            ?>
                                <option value="<?php echo $idCriador ?>"><?php echo $nomeCriador ?></option>
                            <?php
                        }
                    
                    ?>
                
                </select>
            </div>
            <div class="form-group">       
                <label>Elenco</label>
                <select class="form-control select2" name="SerieElenco" id="SerieElenco" multiple="multiple">

                    <option value="">Selecione...</option>
                    <?php

                        $atorService = new AtorService();

                        $atores = $atorService->ObterTodos();                        

                        foreach ($atores as $ator) {

                            $idAtor = $ator["Id"];
                            $nomeAtor = $ator["Nome"];

                            ?>
                                <option value="<?php echo $idAtor ?>"><?php echo $nomeAtor ?></option>
                            <?php
                        }
                    
                    ?>
                
                </select>
            </div>
            <div class="form-group">       
                <label>Genero</label>
                <select class="form-control select2" name="SerieGenero" id="SerieGenero" multiple="multiple">

                    <option value="">Selecione...</option>
                    <?php

                        $generoService = new GeneroService();

                        $generos = $generoService->ObterTodos();                        

                        foreach ($generos as $genero) {

                            $idGenero = $genero["Id"];
                            $nomeGenero = $genero["Nome"];

                            ?>
                                <option value="<?php echo $idGenero ?>"><?php echo $nomeGenero ?></option>
                            <?php
                        }
                    
                    ?>
                
                </select>
            </div>
            <div class="form-group"> 
                <label>Plataforma</label>
                <select class="form-control select2" name="SeriePlataforma" id="SeriePlataforma" multiple="multiple">

                    <option value="">Selecione...</option>
                    <?php

                        $plataformaService = new PlataformaService();

                        $plataformas = $plataformaService->ObterTodos();                        

                        foreach ($plataformas as $plataforma) {

                            $idPlataforma = $plataforma["Id"];
                            $nomePlataforma = $plataforma["Nome"];

                            ?>
                                <option value="<?php echo $idPlataforma ?>"><?php echo $nomePlataforma ?></option>
                            <?php
                        }
                    
                    ?>
                
                </select>
            </div>
            <div class="form-group"> 
                <label>Foto</label>
                <input type="text" class="form-control" name="SerieFoto" id="SerieFoto">
            </div>
            <div class="form-group"> 
                <label>Sinopse</label>
                <textarea rows="5" class="form-control" name="SerieSinopse" id="SerieSinopse" maxlength="1000"></textarea>
            </div>
        </div>                                      
        <!--end::Body-->
        <!--begin:Footer-->
        <div class="card-footer">
            <a href="/Noteflix/Serie/Index" class="btn btn-secondary font-weight-bold mr-2">Voltar</a>
            <a href="javascript:;" class="btn btn-primary font-weight-bold">Salvar</a>
        </div>
        <!--end:Footer-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Noteflix/Scripts/Serie/Serie.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        SerieAPI.initCadastrar();
    });
</script>