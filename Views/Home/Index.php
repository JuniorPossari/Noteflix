<style>
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
        opacity: 0.9;
    }

    .slick-slide {
        margin: 0 27px;        
    }

    .slick-slide img {

    }
    
    .slick-list {
        margin: 0 -27px;
    }

    .slick-prev{
        z-index: 9999;
    }

    .slick-prev:before{
        color: #5a00e0;
    }
    
    .slick-next:before {
        color: #5a00e0;
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
                    <a href="/Noteflix/Home/Index" class="text-white text-hover-white opacity-75 hover-opacity-100">Home</a>
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
                <h3 class="card-label font-weight-bolder text-dark">Home</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <div class="container">
                <div class="text-center mt-2">
                    <h1>Novos lançamentos</h1>
                </div>
                <div class="mt-20">
                    <div class="carousel">
                        <div class="previa"><img src="/Noteflix/Content/img/invocação-do-mal-3.jpg"></div>
                        <div class="previa"><img src="/Noteflix/Content/img/cruella.jpg"></div>
                        <div class="previa"><img src="/Noteflix/Content/img/aqueles-que-me-desejam-a-morte.jpg"></div>
                        <div class="previa"><img src="/Noteflix/Content/img/godzilla-vs-kong.jpg"></div>
                        <div class="previa"><img src="/Noteflix/Content/img/mortal-kombat.jpg"></div>
                    </div>
                </div>
            </div>
        </div>                    
        <!--end::Body-->
    </div>
    <!--end::Card-->        
</div>
<!--end::Container-->

<script src="/Noteflix/Scripts/Home/Index.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        IndexAPI.init();
    });
</script>

