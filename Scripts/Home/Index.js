"use strict";

var IndexAPI = function() {
    
    var MontarSlickCarousel = function(){

        $('#FilmesLancamentos').not('.slick-initialized').slick({
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            variableWidth: true,
            adaptiveHeight: true,
            centerMode: true,       
        });

        $('#FilmesLancamentos').removeClass('d-none');

    }

    // Public Functions
    return {
        // public functions
        init: function() {

            MontarSlickCarousel();
            
        }
    };
}();
