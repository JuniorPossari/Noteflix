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

    .filme-nome:hover{
        color: blue !important;
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

            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <div class="input-icon" style="margin-top: 25.39px;">
                        <input type="text" class="form-control" placeholder="Procurar..." id="FilmeNome" />
                        <span>
                            <i class="flaticon2-search-1 text-muted"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Diretor</label>
                    <select class="form-control select2" name="FilmeDiretor" id="FilmeDiretor">

                        <option value="0">Selecione...</option>
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
                <div class="col-md-3">
                    <label>Ator</label>
                    <select class="form-control select2" name="FilmeAtor" id="FilmeAtor">

                        <option value="0">Selecione...</option>
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
                <div class="col-md-3">       
                    <label>Gênero</label>
                    <select class="form-control select2" name="FilmeGenero" id="FilmeGenero">

                        <option value="0">Selecione...</option>
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
            </div>

            <div class="row align-items-center mb-10">
                <div class="col-md-3"> 
                    <label>Plataforma</label>
                    <select class="form-control select2" name="FilmePlataforma" id="FilmePlataforma">

                        <option value="0">Selecione...</option>
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
                <div class="col-md-3"> 
                    <label>Lançamento</label>
                    <div class="input-daterange input-group" id="FilmeDataLancamento">
                        <input type="text" class="form-control" placeholder="Início" id="FilmeDataInicio" name="Inicio" autocomplete="off"/>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Fim" id="FilmeDataFim" name="Fim" autocomplete="off"/>
                    </div>
                </div>  
                <div class="col-md-3"> 
                    <label>Ordem</label>
                    <select class="form-control select2" name="FilmeOrdem" id="FilmeOrdem">

                        <option value="0">Maior nota</option>
                        <option value="1">Menor nota</option>                        
                    
                    </select>
                </div>
                <div class="col-md-3">       
                    <div class="d-flex justify-content-center" style="margin-top: 25.39px;">
                        <a href="javascript:;" id="Pesquisar" class="btn btn-lg btn-primary font-weight-bold mr-2"><i class="la la-search icon-lg"></i>Pesquisar</a>
                        <a href="javascript:;" id="Limpar" class="btn btn-lg btn-secondary font-weight-bold"><i class="la la-broom icon-lg"></i>Limpar</a>       
                    </div>
                </div>             
            </div>
            
            <!--begin: Datatable-->
            <div id="Filmes">

                <?php
                    
                    require 'Views/Home/_ListarFilmes.php';

                ?>

            </div>            
            <!--end: Datatable-->

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

<script src="/Noteflix/Scripts/Home/Filme.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        FilmeAPI.initIndex();
    });
</script>