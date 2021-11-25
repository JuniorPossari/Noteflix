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
        /*text-shadow: 1px 0 0 #000, -1px 0 0 #000, 0 1px 0 #000, 0 -1px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;*/
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

    .previa:hover h2 {
        display: block; 
    }

    .previa:hover img {
        filter: brightness(30%); 
    }

    .slick-slide {
        margin: 0 27px;  
        position: relative;      
    }

    .slick-slide img {

    }
    
    .slick-list {
        margin: 0 -27px;
    }

    .slick-prev{
        z-index: 9999;
    }    

    .slick-prev {
        left: -15px;
    }

    .slick-next {
        right: 15px;
    }

    .slick-prev:before {
        color: black;
        font-size: 50px;
        text-shadow: 0.8px 0 0 #FFF, -0.8px 0 0 #FFF, 0 0.8px 0 #FFF, 0 -0.8px 0 #FFF, 0.8px 0.8px #FFF, -0.8px -0.8px 0 #FFF, 0.8px -0.8px 0 #FFF, -0.8px 0.8px 0 #FFF;
    }

    .slick-next:before {
        color: black;
        font-size: 50px;
        text-shadow: 0.8px 0 0 #FFF, -0.8px 0 0 #FFF, 0 0.8px 0 #FFF, 0 -0.8px 0 #FFF, 0.8px 0.8px #FFF, -0.8px -0.8px 0 #FFF, 0.8px -0.8px 0 #FFF, -0.8px 0.8px 0 #FFF;
    }
</style>

<!--begin::Container-->
<div class="container-fluid fundo-padrao" style="margin-top: 44.86px;">
    <!--begin::Card-->
    <div class="card card-custom card-padrao">
        <!--begin::Header-->
        <!-- <div class="card-header">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Início</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div> -->
        <!--end::Header-->
        <!--begin::Body-->                    
        <div class="card-body">
            <div class="container-xxl">
                <!--begin::Filmes-->
                <div class="text-center mt-10">
                    <h3 class="font-weight-bolder">FILMES RECENTES</h3>
                </div>
                <div class="mt-10">
                    <div id="FilmesRecentes" class="d-none">

                        <?php
                        
                            $filmeService = new FilmeService();

                            $filmes = $filmeService->ObterTop5Recentes();                            

                            if(isset($filmes) && !empty($filmes)){

                                foreach($filmes as $filme){

                                    $foto = base64_encode($filme["Foto"]);

                                    $nota = $filmeService->ObterNota($filme["Id"]);

                                    echo    '<div class="previa">
                                                <a href="/Noteflix/Home/Filme/'.$filme["Id"].'">
                                                    <img class="foto-fixa" src="data:image/jpeg;base64,'.$foto.'">
                                                    <h2 class="slide-name">'.$filme["Nome"].'
                                                        <span class="d-block">
                                                            '.$nota.'
                                                        </span>
                                                    </h2>
                                                </a> 
                                            </div>';

                                }                                

                            }

                        
                        ?>
                        
                    </div>
                </div>
                <!--end::Filmes-->

                <div class="separator separator-solid separator-border-4 border-dark mt-20 mb-10" style="opacity: 0.8;"></div>

                <!--begin::Series-->
                <div class="text-center">
                    <h3 class="font-weight-bolder">SÉRIES RECENTES</h3>
                </div>
                <div class="mt-10">
                    <div id="SeriesRecentes" class="d-none">
                        
                    <?php
                        
                        $serieService = new SerieService();

                        $series = $serieService->ObterTop5Recentes();                            

                        if(isset($series) && !empty($series)){

                            foreach($series as $serie){

                                $foto = base64_encode($serie["Foto"]);

                                $nota = $serieService->ObterNota($serie["Id"]);

                                echo    '<div class="previa">
                                            <a href="/Noteflix/Home/Filme/'.$serie["Id"].'">
                                                <img src="data:image/jpeg;base64,'.$foto.'">
                                                <h2 class="slide-name">'.$serie["Nome"].'
                                                    <span class="d-block">
                                                        '.$nota.'
                                                    </span>
                                                </h2>
                                            </a> 
                                        </div>';

                            }                                

                        }

                    
                    ?>

                    </div>
                </div>
                <!--end::Series-->

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

