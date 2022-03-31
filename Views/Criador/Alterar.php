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
                    <a href="/Criador/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Criadores</a>
                    <!--end::Item--> 
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="/Criador/Alterar" class="text-white text-hover-white opacity-75 hover-opacity-100">Alterar</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Alterar Criador</h3>
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
                    <input type="text" name="CriadorNome" class="form-control" id="CriadorNome" value="<?php echo $Nome; ?>">
                </div>
            </form>            
        </div>                    
        <!--end::Body-->
        <!--begin:Footer-->
        <div class="card-footer">
            <a href="/Criador/Index" class="btn btn-lg btn-secondary font-weight-bold mr-2">Voltar</a>
            <a href="javascript:;" id="Salvar" class="btn btn-lg btn-primary font-weight-bold">Salvar</a>
        </div>
        <!--end:Footer-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Scripts/Criador/Criador.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        CriadorAPI.initAlterar();
    });
</script>