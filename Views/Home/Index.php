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

<div class="container-fluid mt-20" style="height: 100%; width: 70% !important; border-radius: 20px; background-color: #f8f7ff; padding: 20px; border: 2px solid #5a00e0;">

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

<script src="/Noteflix/Scripts/Home/Index.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        IndexAPI.init();
    });
</script>

