$(".shop-brands-slider").slick({infinite:!0,mobileFirst:!0,slidesToShow:1,slidesToScroll:1,arrows:!0,prevArrow:'<img src="../wp-content/themes/franks/images/arrow-left.svg" class="left"/>',nextArrow:'<img src="../wp-content/themes/franks/images/arrow-right.svg" class="right" />',responsive:[{breakpoint:554,settings:{slidesToShow:2}},{breakpoint:769,settings:{slidesToShow:3}},{breakpoint:992,settings:{slidesToShow:5}}]}),



$(".delivery-button").click(function() {
    $(".delivery-booking").addClass("remove")
}

),

$(".home-banner").slick( {
    infinite: !0, autoplay: !0, slidesToShow: 1, slidesToScroll: 1, arrows: !1, dots: !0
}),

$(".dior-campaign-banner").slick( {
    infinite: !0, autoplay: !0, slidesToShow: 1, slidesToScroll: 1, arrows: !1, dots: !0
}

);
if(window.innerWidth < 768) {
    $(function() {
        $('.custom-product-slider-class').slick( {
            infinite: true, autoplay: true, slidesToShow: 1, slidesToScroll: 1, arrows: true, dots: false
        }
        );
    }
    );
}

else {
    $('.custom-product-slider-class').slick( {
        infinite: true, autoplay: true, slidesToShow: 3, slidesToScroll: 1, arrows: true, dots: false
    }
    );
}

if(window.innerWidth < 768) {
    $(function() {
        $('.custom-product-trending-slider-class').slick( {
            infinite: true, autoplay: false, slidesToShow: 1, slidesToScroll: 1, arrows: true, dots: false
        }
        );
    }
    );
}

$('.dior-expertise-products').slick({
    infinite: true,
    autoplay: true, 
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    mobileFirst: true,
    responsive: [
        {
            breakpoint: 492,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3
            }
        }
    ]
});