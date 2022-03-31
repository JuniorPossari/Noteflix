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
                    <a href="/Home/Index" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="/Serie/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Séries</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Séries</h3>
            </div>
            <div class="card-toolbar">
                <a href="/Serie/Cadastrar" class="btn btn-lg btn-light-dark font-weight-bold"><i class="flaticon2-add-square icon-md mb-1"></i>Cadastrar</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">

            <!--begin::Search Form-->
            <div class="row align-items-center mb-3">
                <div class="col-md-3">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Procurar..." id="kt_datatable_search_query" />
                        <span>
                            <i class="flaticon2-search-1 text-muted"></i>
                        </span>
                    </div>
                </div>                    
            </div>
            <!--end::Search Form-->
            
            <!--begin: Datatable-->
            <table class="d-none datatable-altura table-hover" id="kt_datatable">
                <thead>
                    <tr>
                        <th data-title="Id">
                            id
                        </th>
                        <th data-title="Nome">
                            nome
                        </th>
                        <th data-title="Primeiro EP">
                            primeiroep
                        </th>
                        <th data-title="N° Temporadas">
                            ntemporada
                        </th>
                        <th data-title="Criador">
                            criador
                        </th>
                        <th data-title="Ações">
                            action
                        </th>                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                        $serieService = new SerieService();

                        $series = $serieService->ObterTodos();                        

                        foreach ($series as $serie) {

                            $idSerie = $serie["Id"];
                            $nomeSerie = $serie["Nome"];
                            $primeiroepSerie = implode("/",array_reverse(explode("-", $serie["PrimeiroEpisodio"])));
                            $ntemporadaSerie = $serie["NumeroTemporada"];
                            $criadorSerie = $serie["Criador"];

                            ?>
                                <tr>
                                    <td>
                                        <?php echo $idSerie; ?>
                                    </td>
                                    <td>
                                        <?php echo $nomeSerie; ?>
                                    </td>
                                    <td>
                                        <?php echo $primeiroepSerie; ?>
                                    </td>
                                    <td>
                                        <?php echo $ntemporadaSerie; ?>
                                    </td>
                                    <td>
                                        <?php echo $criadorSerie; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 edit" data-id="<?php echo $idSerie; ?>" data-toggle="tooltip" title="Alterar">
                                            <i class="flaticon2-edit icon-md"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 delete" data-id="<?php echo $idSerie; ?>" data-toggle="tooltip" title="Excluir">
                                                <i class="flaticon2-trash icon-md"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon view" data-id="<?php echo $idSerie; ?>" data-toggle="tooltip" title="Visualizar">
                                                <i class="flaticon2-magnifier-tool icon-md"></i>
                                            </a>
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

<script src="/Scripts/Serie/Serie.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        SerieAPI.initIndex();
    });
</script>