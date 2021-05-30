"use strict";

// Class Definition
var IndexAPI = function() {
    
    var MontarSlickCarousel = function(){

        $('.carousel').not('.slick-initialized').slick({
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            variableWidth: true,
            adaptiveHeight: true,
            centerMode: true,       
        });

    }

    // Public Functions
    return {
        // public functions
        init: function() {

            MontarSlickCarousel();
            
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    IndexAPI.init();
});
