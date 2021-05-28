<style>
    .previa{
        background-color: #000;
        text-align: center;
        vertical-align: middle;
        line-height: 400px;
        font-size: 100px;
        color: #fff;
        height: 400px;
        width: 320px;

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

<div class="container">
    <div class="text-center mt-2">
        <h1>Novos lançamentos</h1>
    </div>
    <div class="mt-20">
        <div class="carousel">
            <div class="previa">1</div>
            <div class="previa">2</div>
            <div class="previa">3</div>
            <div class="previa">4</div>
            <div class="previa">5</div>
            <div class="previa">6</div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){
        $('.carousel').slick({
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            variableWidth: true,
            adaptiveHeight: true,
            centerMode: true,       
        });
    });

</script>

