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
            <table class="d-none datatable-altura" id="kt_datatable">
                <thead>
                    <tr>                        
                        <th data-title="Nome">
                            nome
                        </th>
                        <th data-title="Duração">
                            duracao
                        </th>
                        <th data-title="Lançamento">
                            lancamento
                        </th>
                        <th data-title="Diretor">
                            diretor
                        </th>                                               
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                        $filmeService = new FilmeService();

                        $filmees = $filmeService->ObterTodos();                        

                        foreach ($filmees as $filme) {

                            $idFilme = $filme["Id"];
                            $nomeFilme = $filme["Nome"];
                            $duracaoFilme = $filme["Duracao"];
                            $lancamentoFilme = implode("/",array_reverse(explode("-", $filme["DataLancamento"])));
                            $diretorFilme = $filme["Diretor"];

                            ?>
                                <tr>                                   
                                    <td>
                                        <?php echo $nomeFilme; ?>
                                    </td>
                                    <td>
                                        <?php echo $duracaoFilme; ?>
                                    </td>
                                    <td>
                                        <?php echo $lancamentoFilme; ?>
                                    </td>
                                    <td>
                                        <?php echo $diretorFilme; ?>
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

<script src="/Noteflix/Scripts/Filme/Filme.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        FilmeAPI.initIndex();
    });
</script>