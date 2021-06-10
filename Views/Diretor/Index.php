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
                    <a href="/Noteflix/Diretor/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Diretores</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Diretores</h3>
            </div>
            <div class="card-toolbar">
                <a href="/Noteflix/Diretor/Cadastrar" class="btn btn-light-dark font-weight-bold"><i class="flaticon2-add-square icon-md mb-1"></i>Cadastrar</a>
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
                        <th data-title="Id">
                            id
                        </th>
                        <th data-title="Nome">
                            nome
                        </th>
                        <th data-title="Ações">
                            action
                        </th>                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                        $diretorService = new DiretorService();

                        $diretores = $diretorService->ObterTodos();                        

                        foreach ($diretores as $diretor) {

                            $idDiretor = $diretor["Id"];
                            $nomeDiretor = $diretor["Nome"];

                            ?>
                                <tr>
                                    <td>
                                        <?php echo $idDiretor; ?>
                                    </td>
                                    <td>
                                        <?php echo $nomeDiretor; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 edit" data-id="<?php echo $idDiretor; ?>" data-toggle="tooltip" title="Alterar">
                                            <i class="flaticon2-edit icon-md"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 delete" data-id="<?php echo $idDiretor; ?>" data-toggle="tooltip" title="Excluir">
                                                <i class="flaticon2-trash icon-md"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon view" data-id="<?php echo $idDiretor; ?>" data-toggle="tooltip" title="Visualizar">
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

<script src="/Noteflix/Scripts/Diretor/Diretor.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        DiretorAPI.initIndex();
    });
</script>