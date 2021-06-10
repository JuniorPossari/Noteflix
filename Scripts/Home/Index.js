"use strict";

var IndexAPI = function() {
    
    var MontarSlickCarousel = function(){

        $('#FilmesRecentes').not('.slick-initialized').slick({
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            variableWidth: true,
            adaptiveHeight: true,
            centerMode: true,       
        });

        $('#SeriesRecentes').not('.slick-initialized').slick({
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            variableWidth: true,
            adaptiveHeight: true,
            centerMode: true,       
        });

        $('#FilmesRecentes').removeClass('d-none');
        $('#SeriesRecentes').removeClass('d-none');

    }

    // Public Functions
    return {
        // public functions
        init: function() {

            MontarSlickCarousel();
            
        }
    };
}();
