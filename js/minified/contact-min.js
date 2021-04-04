var undone = false;
$(".button-text").on("click", function () {
    $(".show-map").removeClass("active"), $(".location").removeClass("active"), $(this).closest(".location").addClass("active");
    var o = $(this).closest(".location"),
        s = $(o).data("shop_img2");
        s2 = $(o).data("shop_img3");
    $("html, body").animate({
        scrollTop: "0"
    }),
        $(".inner-shop-sliderr").css("background-image", "url('" + s + "')")
    
    
    if (s2) {
        $(".inner-shop-sliderr2").css("background-image", "url('" + s2 + "')")
    } else {
        console.log('blank link')
        $(".inner-shop-sliderr2").css("background-image", "")
    }
    //$(".inner-shop-slider").attr("src", s )
    //$(".inner-shop-slider2").attr("src", s2)
    console.log('jello')

    
    
        
    if ($('.inner-shop-sliderr2').css('background-image') != 'none' && s2) {
        
            console.log('not undefiend: ' + s2);
            $('.my-slider').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                arrows: false,
                autoplay: true


                //autoplay: true
            });
            undone = false;
        
            
        
    } else if(!s2 && !undone) {
        console.log('background not found')
        console.log('error msg blank')
        $('.my-slider').slick('unslick');
        undone = true;
        $(".inner-shop-sliderr").css("background-image", "url('" + s + "')")
    }

}); 
