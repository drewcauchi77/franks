function image_fix(a, i) {
    for (var t = $(i), o = 0; o < t.length; o++) {
        var r = $(t[o]).height(),
            e = $(t[o]).width(),
            s = $(t[o]).parent();
        "single" == a ? r > e ? $(s).addClass("img-portrait") : $(s).addClass("img-landscape") : $(s).width() > e ? $(s).addClass("img-portrait") : $(s).addClass("img-landscape"), $(t[o]).animate({
            opacity: 1
        }, 500)
    }
    console.log("img_height")
}

function variation_choose(a) {
    $(".variations-cont span").removeClass("active-var"), $(a).addClass("active-var");
    var i = $(a).data("key");
    if ($(".colour-tooltip").length > 0) var t = $(a).children(".colour-tooltip").children().text();
    else t = $(a).text();
    for ($i = 0; $i < $("#var-holder").data("product_variations").length; $i++) {
        if ($("#var-holder").data("product_variations")[$i].variation_id == i) var o = $("#var-holder").data("product_variations")[$i]
    }
    $(".variations select").val(t), $(".single_variation").html(o.price_html), $(".images a").attr("href", o.image_link), $(".variation_id").attr("value", o.variation_id), $(".images img").attr("src", o.image.src).attr("srcset", o.image.src);

}
$(document).ready(function() {
    $(".parent_filter").click(function() {
        $(".brand-cat-filter").removeClass("active"), $(this).parent().addClass("active")
    }), $(".filter-trigger").click(function() {
        $(".shop-sidebar").addClass("show"), $(".overlay").addClass("initialise"), $(".tax-product_cat").css("overflow", "hidden")
    }), $(".close-sidebar").click(function() {
        $(".shop-sidebar").removeClass("show"), $(".overlay").removeClass("initialise"), $(".tax-product_cat").css("overflow", "auto")
    });
    var a = window.location.href.slice(window.location.href.indexOf("?") + 1).split("&")[0].split("="),
        i = a[1];
    void 0 !== i && "variant" == a[0] && "" !== i && variation_choose($('.variations-cont span[data-key="' + i + '"]'))
}), $(".variations-cont span").click(function() {
    variation_choose($(this))
});

$(document).ready(function(){
    $('.parent_filter').click(function() {
        $('.brand-cat-filter').removeClass('active');
        $(this).parent().addClass('active');
    });

    $('.filter-trigger').click(function(){
        $('.shop-sidebar').addClass('show');
        $('.overlay').addClass('initialise');
        $('.tax-product_cat').css('overflow', 'hidden');
    });

    $('.close-sidebar').click(function(){
        $('.shop-sidebar').removeClass('show');
        $('.overlay').removeClass('initialise');
        $('.tax-product_cat').css('overflow', 'auto');
    });
    
    if($('.gallery-images > div').length > 2){
        $('.gallery-images').slick({
            infinite: true,
            slidesToShow: 2,
            arrows: true,
            prevArrow: '<i class="fas fa-angle-left prev-arrow"></i>',
            nextArrow: '<i class="fas fa-angle-right next-arrow"></i>'
        });
    }else{
        $('.gallery-images').css("display", "grid");
        $('.gallery-images').css("grid-template-columns", "repeat(2,1fr)");
    }

    if($('.product_cat-dior').length > 0 && $(window).width() > 767){
        if($('.gallery-images').hasClass('slick-initialized')){
            $('.gallery-images').slick('unslick');
        }
    }

    if($('.colour-tooltip')[0]){
        $('.gallery-images').css("display", "none");
    }

    $('.brand-cat-filter').click(function(){
        $(".brand-cat-filter").not(this).removeClass('open');
        $(this).toggleClass('open');
    });

    $('.dior-single-image').click(function(){
        if(!$(this).hasClass('show')){
            $(this).toggleClass('show');
            $(".dior-single-image").not(this).removeClass('show');
        }
    });

});

function select_img(src){

    document.getElementsByClassName("change-img").value = src;
    document.getElementsByClassName("attachment-shop_single")[0].setAttribute("srcset", src);
    document.getElementsByClassName("woocommerce-main-image")[0].setAttribute("href", src);

}

const settings = {
    infinite: true,
    mobileFirst: true,
    autoplay: true, 
    arrows: false,
    slidesToShow: 1,
    dots: true,
    responsive:[{
        breakpoint: 420,
        settings: {slidesToShow: 2}
    },{
        breakpoint: 768,
        settings: "unslick"
    }]
};

const diorslide1 = $('.dior-new-slider').slick(settings);
const diorslide2 = $('.dior-best-sellers').slick(settings);

$(window).on('resize', function() {
    if( $(window).width() < 768 && !diorslide1.hasClass('slick-initialized')) {
        $('.dior-new-slider').slick(settings);
    }

    if( $(window).width() < 768 && !diorslide2.hasClass('slick-initialized')) {
        $('.dior-best-sellers').slick(settings);
    }
});

const gallery_settings = {
    infinite: true,
    mobileFirst: true,
    autoplay: false, 
    arrows: true,
    slidesToShow: 1,
    centerMode: true,
    dots: true,
    responsive:[{
        breakpoint: 768,
        settings: "unslick"
    }]
};

const diorgallery = $('.dior-gallery').slick(gallery_settings);

$(window).on('resize', function() {
    if( $(window).width() < 768 && !diorgallery.hasClass('slick-initialized')) {
        $('.dior-gallery').slick(gallery_settings);
    }
});