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
                    <a href="/Noteflix/Filme/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Filmes</a>
                    <!--end::Item--> 
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="/Noteflix/Filme/Cadastrar" class="text-white text-hover-white opacity-75 hover-opacity-100">Cadastrar</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Cadastrar Filme</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="FilmeNome" id="FilmeNome">
            </div>
            <div class="form-group">   
                <label>Duração</label>
                <input type="text" class="form-control" name="FilmeDuracao" id="FilmeDuracao" readonly placeholder="Selecione a hora" />
            </div>
            <div class="form-group"> 
                <label>Data de lançamento</label>
                <div class="input-group date">
                    <input type="text" class="form-control" name="FilmeDataLancamento" id="FilmeDataLancamento" readonly placeholder="Selecione uma data"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <label>Diretor</label>
                <select class="form-control select2" name="FilmeDiretor" id="FilmeDiretor">

                    <option value="">Selecione...</option>
                    <?php

                        $diretorService = new DiretorService();

                        $diretores = $diretorService->ObterTodos();                        

                        foreach ($diretores as $diretor) {

                            $idDiretor = $diretor["Id"];
                            $nomeDiretor = $diretor["Nome"];

                            ?>
                                <option value="<?php echo $idDiretor ?>"><?php echo $nomeDiretor ?></option>
                            <?php
                        }
                    
                    ?>
                
                </select>
            </div>
            <div class="form-group">       
                <label>Elenco</label>
                <select class="form-control select2" name="FilmeElenco" id="FilmeElenco" multiple="multiple">

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
                <label>Gênero</label>
                <select class="form-control select2" name="FilmeGenero" id="FilmeGenero" multiple="multiple">

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
                <select class="form-control select2" name="FilmePlataforma" id="FilmePlataforma" multiple="multiple">

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
                <input type="text" class="form-control" name="FilmeFoto" id="FilmeFoto">
            </div>
            <div class="form-group"> 
                <label>Sinopse</label>
                <textarea rows="5" class="form-control" name="FilmeSinopse" id="FilmeSinopse" maxlength="1000"></textarea>
            </div>
        </div>                    
        <!--end::Body-->
        <!--begin:Footer-->
        <div class="card-footer">
            <a href="/Noteflix/Filme/Index" class="btn btn-secondary font-weight-bold mr-2">Voltar</a>
            <a href="javascript:;" class="btn btn-primary font-weight-bold">Salvar</a>
        </div>
        <!--end:Footer-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Noteflix/Scripts/Filme/Filme.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        FilmeAPI.initCadastrar();
    });
</script>