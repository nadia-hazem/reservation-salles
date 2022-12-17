$(document).ready(function(){

    if($('.brands_slider').length)
        {
            var brandsSlider = $('.brands_slider');

            brandsSlider.owlCarousel(
            {
                loop:true,
                autoplay:true,
                autoplayTimeout: 100,
                autoplayHoverPause:true,
                autoWidth:true,
                items:8,
                margin:42
            });

        }


    });