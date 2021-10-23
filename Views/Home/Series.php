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
                    <a href="/Noteflix/Home/Series" class="text-white text-hover-white opacity-75 hover-opacity-100">Séries</a>
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

<script src="/Noteflix/Scripts/Home/Serie.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        SerieAPI.initIndex();
    });
</script>