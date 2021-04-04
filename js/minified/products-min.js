function image_fix(i, e) { for (var s = $(e), t = 0; t < s.length; t++) { var a = $(s[t]).height(), o = $(s[t]).width(), r = $(s[t]).parent(); "single" == i ? a > o ? $(r).addClass("img-portrait") : $(r).addClass("img-landscape") : $(r).width() > o ? $(r).addClass("img-portrait") : $(r).addClass("img-landscape"), $(s[t]).animate({ opacity: 1 }, 500) } console.log("img_height") } function variation_choose(i) { $(".variations-cont span").removeClass("active-var"), $(i).addClass("active-var"); var e = $(i).data("key"); if ($(".colour-tooltip").length > 0) var s = $(i).children(".colour-tooltip").children().text(); else s = $(i).text(); for ($i = 0; $i < $("#var-holder").data("product_variations").length; $i++)if ($("#var-holder").data("product_variations")[$i].variation_id == e) var t = $("#var-holder").data("product_variations")[$i]; $(".variations select").val(s), $(".single_variation").html(t.price_html), $(".images a").attr("href", t.image_link), $(".variation_id").attr("value", t.variation_id), $(".images img").attr("src", t.image.src).attr("srcset", t.image.src), $(".variations select").val(s), $(".single_variation").html(t.price_html), $(".slick-current .dior-single-image a").attr("href", t.image_link), $(".variation_id").attr("value", t.variation_id), $(".slick-current .dior-single-image img").attr("src", t.image.src).attr("srcset", t.image.src) } function select_img(i) { document.getElementsByClassName("change-img").value = i, document.getElementsByClassName("attachment-shop_single")[0].setAttribute("srcset", i), document.getElementsByClassName("woocommerce-main-image")[0].setAttribute("href", i) } $(document).ready(function () { $(".parent_filter").click(function () { }), $(".filter-trigger").click(function () { $(".shop-sidebar").addClass("show"), $(".overlay").addClass("initialise"), $(".tax-product_cat").css("overflow", "hidden") }), $(".close-sidebar").click(function () { $(".shop-sidebar").removeClass("show"), $(".overlay").removeClass("initialise"), $(".tax-product_cat").css("overflow", "auto") }); var i = window.location.href.slice(window.location.href.indexOf("?") + 1).split("&")[0].split("="), e = i[1]; void 0 !== e && "variant" == i[0] && "" !== e && variation_choose($('.variations-cont span[data-key="' + e + '"]')) }), $(".variations-cont span").click(function () { variation_choose($(this)); var i = $(this).attr("data-key"); $(".image-data-" + i).length && ($(".add-image-enrichment").not(this).removeClass("enable"), $(".image-data-" + i).addClass("enable")) }), $(document).ready(function () { $(".parent_filter").click(function () { }), $(".filter-trigger").click(function () { $(".shop-sidebar").addClass("show"), $(".overlay").addClass("initialise"), $(".tax-product_cat").css("overflow", "hidden") }), $(".close-sidebar").click(function () { $(".shop-sidebar").removeClass("show"), $(".overlay").removeClass("initialise"), $(".tax-product_cat").css("overflow", "auto") }), $(".gallery-images > div").length > 2 ? $(".gallery-images").slick({ infinite: !0, slidesToShow: 2, arrows: !0, prevArrow: '<i class="fas fa-angle-left prev-arrow"></i>', nextArrow: '<i class="fas fa-angle-right next-arrow"></i>', responsive: [{ breakpoint: 768, settings: { slidesToShow: 1 } }] }) : ($(".gallery-images").css("display", "grid"), $(".gallery-images").css("grid-template-columns", "repeat(2,1fr)")), $(".product_cat-dior").length > 0 && $(window).width() > 767 && $(".gallery-images").hasClass("slick-initialized") && $(".gallery-images").slick("unslick"), $(".colour-tooltip")[0] && $(".gallery-images").css("display", "none"), $(".dior-cat-filter").click(function () { $(".dior-cat-filter").not(this).removeClass("open"), $(this).toggleClass("open") }), $(".dior-cat-filter ul li a").click(function (i) { i.stopPropagation() }), $(".dior-single-image").click(function () { $(this).hasClass("show") || ($(this).toggleClass("show"), $(".dior-single-image").not(this).removeClass("show")) }), $(".category-button").click(function () { $(".navigation-area").toggleClass("allow") }), $(".dior-mob-filtering-button").click(function () { $(".mobile-dior-filtering").toggleClass("open") }), $(".term-makeup-dior-categories")[0] && $(".berocket_term_parent_12539").prepend("<h5>TEST</h5>"), $(".dior-single-image").length > 1 && $(window).width() < 768 && $(".images").css("display", "none"), $(".dior-gallery ul").children().length > 10 && $(".dior-gallery ul").css("display", "none"), $(".dior-sorting-container").length && ($(".orderby").find("option[value=menu_order]").removeAttr("selected"), $(".orderby").find("option[value=date]").attr("selected", "selected")) }); const settings = { infinite: !0, mobileFirst: !0, autoplay: !0, arrows: !1, slidesToShow: 1, dots: !0, responsive: [{ breakpoint: 420, settings: { slidesToShow: 2 } }, { breakpoint: 768, settings: "unslick" }] }, diorslide1 = $(".dior-new-slider").slick(settings), diorslide2 = $(".dior-best-sellers").slick(settings); $(window).on("resize", function () { $(window).width() < 768 && !diorslide1.hasClass("slick-initialized") && $(".dior-new-slider").slick(settings), $(window).width() < 768 && !diorslide2.hasClass("slick-initialized") && $(".dior-best-sellers").slick(settings) }); const gallery_settings = { infinite: !0, mobileFirst: !0, autoplay: !1, arrows: !1, slidesToShow: 1, dots: !0, responsive: [{ breakpoint: 768, settings: "unslick" }] }, diorgallery = $(".dior-gallery").slick(gallery_settings); $(window).on("resize", function () { $(window).width() < 768 && !diorgallery.hasClass("slick-initialized") && $(".dior-gallery").slick(gallery_settings), $(".dior-single-image").length > 1 && $(window).width() < 768 ? $(".images").css("display", "none") : $(".images").css("display", "block") }), $(document).ready(function () { $(".brw-product_cat-complexion-makeup-dior-categories").length && ($(".brw-product_cat-concealers").before($(".brw-product_cat-complexion-makeup-dior-categories")), $(".brw-product_cat-complexion-makeup-dior-categories").first().css("visibility", "hidden"), $(".brw-product_cat-complexion-makeup-dior-categories:eq(2)").css("visibility", "hidden")), $(".brw-product_cat-eyes-makeup-dior-categories").length && ($(".brw-product_cat-eyeshadows").before($(".brw-product_cat-eyes-makeup-dior-categories")), $(".brw-product_cat-eyes-makeup-dior-categories").first().css("visibility", "hidden"), $(".brw-product_cat-eyes-makeup-dior-categories:eq(2)").css("visibility", "hidden")), $(".brand-cat-filter").click(function () { $("a", this).toggleClass("show") }) }); const homepageDesktopSlickSettings = { slidesToShow: 1, arrows: !1, autoplay: !0, autoplaySpeed: 5e3, dots: !0, responsive: [{ breakpoint: 768, settings: "unslick" }] }, homepageMobileSlickSettings = { slidesToShow: 1, arrows: !1, dots: !0, autoplay: !0, autoplaySpeed: 5e3, mobileFirst: !0, responsive: [{ breakpoint: 768, settings: "unslick" }] }; $(document).ready(function () { $(".homepage-desktop-banners").slick(homepageDesktopSlickSettings), $(".homepage-mobile-banners").slick(homepageMobileSlickSettings) }); const homeDesk = $(".homepage-desktop-banners").slick(homepageDesktopSlickSettings), homeMob = $(".homepage-mobile-banners").slick(homepageMobileSlickSettings); $(window).on("resize", function () { $(window).width() < 768 && !homeMob.hasClass("slick-initialized") ? $(".homepage-mobile-banners").slick(homepageMobileSlickSettings) : $(window).width() >= 768 && !homeDesk.hasClass("slick-initialized") && $(".homepage-desktop-banners").slick(homepageDesktopSlickSettings) }), $(window).scroll(function () { $(this).scrollTop() > 0 ? $(".custom-free-delivery-class").addClass("move") : $(".custom-free-delivery-class").removeClass("move") }), $(".shop-sidebar").find(".filter-container:not(:last)").hide();