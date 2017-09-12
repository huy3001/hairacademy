/* Custom js */
(function($) {
    // Global variables
    var $fullDesktop = 1920,
        $hugeDesktop = 1600,
        $desktop = 1200,
        $laptop = 992,
        $tablet = 768,
        $mobile = 480;

    // Product detail functions
    var imageList = $('.image-list'),
        thumbList = $('.thumb-list'),
        productContainer = $('.product-container');
    var productDetail = {
        // Add zoom to product slider
        addZoom: function(imageList) {
            setTimeout(function() {
                var activeLink = imageList.find('.slick-active a'),
                    zoomOption = {
                        zoomType: 'inner',
                        cursor: 'crosshair',
                        easing: true,
                        easingType: 'linear'
                    };

                function makeZoom(imageLink) {
                    imageLink.off('click').on('click', function(e) {
                        e.preventDefault();
                        var image = $(this).find('img');
                        if(image.hasClass('zoomed')) {
                            image.removeClass('zoomed');
                            image.removeData('elevateZoom'); // remove zoom instance from image
                            $('.zoomContainer').remove(); // remove zoom container from DOM
                            productContainer.removeAttr('style');
                        }
                        else {
                            image.addClass('zoomed');
                            productContainer.css('opacity', 0);
                            if($(window).width() < $desktop) {
                                $('body').append('<div class="zoomContainer"><div class="panzoom"><img src="'+ image.attr('src') +'" alt="'+ image.attr('alt') +'"></div></div>'); // add zoom container to body
                                var zoomContainer = $('.zoomContainer'),
                                    panZoom = $('.panzoom', zoomContainer),
                                    imgZoom = $('img', zoomContainer);
                                panZoom.panzoom({
                                    contain: 'invert',
                                    minScale: 1,
                                    maxScale: 3,
                                    increment: 0.5,
                                    startTransform: 'scale(1,1)',
                                    transition: true
                                });
                                zoomContainer.animate({
                                    opacity: 1
                                }, 300);
                                setTimeout(function() {
                                    $('body').css('position', 'fixed');
                                    panZoom.on('tap', function() {
                                        image.removeClass('zoomed');
                                        zoomContainer.remove(); // remove zoom container from DOM
                                        productContainer.removeAttr('style');
                                        $('body').removeAttr('style');
                                    });
                                }, 500);
                            }
                            else {
                                $('.zoomContainer').show();
                                image.elevateZoom(zoomOption); // init zoom
                            }
                        }
                    });
                }

                // First active image zoom
                makeZoom(activeLink);

                // Remove zoom before slide change
                imageList.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                    var currentImg = imageList.find('li[data-slick-index="'+ currentSlide +'"] img');
                    currentImg.removeClass('zoomed');
                    currentImg.removeData('elevateZoom'); // remove zoom instance from image
                    $('.zoomContainer').remove(); // remove zoom container from DOM
                });

                // Zoom after slide change
                imageList.on('afterChange', function(event, slick, currentSlide) {
                    var currentLink = imageList.find('li[data-slick-index="'+ currentSlide +'"] a');
                    makeZoom(currentLink);
                });
            }, 100);
        },

        // Init product slider
        sliderInit: function(imageList, thumbList) {
            var thumbCount = thumbList.find('li').length,
                slideToScroll = 0,
                arrow = false;
            if(thumbCount > 8) {
                arrow = true;
                slideToScroll = 1;
                thumbCount = 8;
            }
            if(imageList.length) {
                imageList.slick({
                    arrows: false,
                    asNavFor: '.thumb-list',
                    fade: true,
                    speed: 500,
                    slide: 'li',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    swipe: false,
                    responsive: [
                        {
                            breakpoint: $desktop,
                            settings: {
                                arrows: true,
                                fade: false,
                                swipe: true
                            }
                        },
                        {
                            breakpoint: $tablet,
                            settings: {
                                arrows: true,
                                asNavFor: '',
                                fade: false,
                                swipe: true
                            }
                        }
                    ]
                });
                $('li a', imageList).on('click', function(e) {
                    e.preventDefault();
                });
            }

            if(thumbList.length) {
                thumbList.slick({
                    accessibility: false,
                    arrows: arrow,
                    asNavFor: '.image-list',
                    focusOnSelect: true,
                    slide: 'li',
                    slidesToShow: thumbCount,
                    slidesToScroll: slideToScroll,
                    swipe: false,
                    vertical: true
                });
                $('li a', thumbList).on('click', function(e) {
                    e.preventDefault();
                });
            }

            // Call zoom function
            productDetail.addZoom(imageList);
        },

        // Reinit product slider
        sliderReinit: function(imageList, thumbList) {
            if(imageList.length) {
                imageList.slick('unslick');
            }

            if(thumbList.length) {
                thumbList.slick('unslick')
            }

            setTimeout(function() {
                // Call slider init
                productDetail.sliderInit(imageList, thumbList);
            }, 300);
        },

        // Summary centering
        summaryCenter: function() {
            var summary = $('.product .summary');
            if(summary.length) {
                if ($(window).width() > $desktop - 1) {
                    summary.css('margin-top', -summary.outerHeight()/2);
                    setTimeout(function() {
                        summary.css('opacity', 1);
                    }, 300);
                }
                else {
                    summary.removeAttr('style');
                }
            }
        },

        // Thumbnail centering
        thumbnailCenter: function() {
            var thumbnail = $('.product .thumbnails');
            if(thumbnail.length) {
                if ($(window).width() > $tablet - 1) {
                    thumbnail.css('margin-top', -thumbnail.outerHeight()/2);
                    setTimeout(function() {
                        thumbnail.css('opacity', 1);
                    }, 300);
                }
                else {
                    thumbnail.removeAttr('style');
                }
            }
        }
    };

    // Global functions
    var customJS = {
        customScrollbar: function() {
            if($(window).width() > $desktop - 1) {
                $('body').niceScroll({
                    cursorcolor: '#00a2ff',
                    cursorborder: 'none',
                    cursorborderradius: '0px',
                    mousescrollstep: 60,
                    scrollspeed: 60,
                    zindex: 999
                });
            }
        },

        accordionMenu: function() {
            var itemHasChild = $('.menu-item-has-children > a');
            if(itemHasChild.length) {
                itemHasChild.off('click').on('click', function(e) {
                    e.preventDefault();
                    if($(this).hasClass('open-sub')) {
                        $(this).removeClass('open-sub');
                    }
                    else {
                        $(this).addClass('open-sub');
                    }
                    $(this).parent().siblings().find('.open-sub').removeClass('open-sub');
                    $(this).parent().siblings().find('.sub-menu').slideUp(300);
                    $(this).parent().find('.sub-menu').slideUp(300);
                    if(!$(this).next('.sub-menu').is(':visible')) {
                        $(this).next('.sub-menu').slideDown(300);
                    }
                });
            }
        },

        backTop: function() {
            var windowHeight = $(window).height(),
                backTopBtn = $('.back-top');
            if(backTopBtn.length) {
                backTopBtn.on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $(window).on('scroll', function() {
                    if($(window).scrollTop() > windowHeight) {
                        backTopBtn.css('bottom', 0);
                    }
                    else {
                        backTopBtn.css('bottom', '-40px');
                    }
                });
            }
        },

        bootstrapSelect: function() {
            var select = $('select');
            if(select.length) {
                select.selectpicker();
            }
        },

        searchToggle: function() {
            var toggleSearch = $('.search-form .toggle-search'),
                searchItem = $('.search-form .search-item'),
                searchTarget = $('.search-form .toggle-search, .search-form .search-item');
            if(toggleSearch.length) {
                if($(window).width() < $desktop - 1) {
                    toggleSearch.removeAttr('style');
                    toggleSearch.off('click').on('click', function() {
                        $(this).next('.search-item').slideToggle(300);
                        $(this).next('.search-item').find('.form-text').focus();
                    });
                    setTimeout(function() {
                        var formClose = $('.form-close');
                        if(formClose.length) {
                            formClose.off('click').on('click', function() {
                                $(this).parents('.search-item').slideUp(300);
                                $(this).parents('.search-item').find('.form-text').val('');
                            });
                        }
                    }, 300);
                    $(document).on('click', function(e) {
                        var target = e.target;
                        if (!$(target).is(searchTarget) && !$(target).parents().is(searchTarget)) {
                            searchItem.slideUp(300);
                            searchItem.find('.form-text').val('');
                        }
                    });
                }
                else {
                    searchItem.removeAttr('style');
                    toggleSearch.off('click').on('click', function() {
                        $(this).fadeOut(300);
                        $(this).next('.search-item').find('.form-text').addClass('expand').focus();
                    });
                    $(document).on('click', function(e) {
                        var target = e.target;
                        if (!$(target).is(searchTarget) && !$(target).parents().is(searchTarget)) {
                            toggleSearch.fadeIn(300);
                            searchItem.find('.form-text').removeClass('expand');
                            searchItem.find('.form-text').val('');
                        }
                    });
                }
            }
        },

        closeSidebar: function() {
            var body = $('body'),
                rightContent = $('.right-content');
            if($(window).width() < $tablet - 1) {
                rightContent.off('lick').on('click', function() {
                    if(!body.hasClass('no-sidebar')) {
                        body.addClass('no-sidebar');
                    }
                });
            }
        },

        homeUpbarSlider: function() {
            var upbarList = $('.upsbar-list');
            if(upbarList.length) {
                if($(window).width() < $desktop) {
                    if(!upbarList.hasClass('slick-slider')) {
                        upbarList.slick({
                            arrows: false,
                            autoplay: true,
                            autoplaySpeed: 5000,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            responsive: [
                                {
                                    breakpoint: $laptop,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: $tablet,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: $mobile,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });
                    }
                }
                else {
                    if(upbarList.hasClass('slick-slider')) {
                        upbarList.slick('unslick');
                    }
                }
            }
        },

        homeMainSlider: function() {
            var sliderBlock = $('.slider-block');
            if(sliderBlock.length) {
                sliderBlock.slick({
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: $tablet,
                            settings: {
                                arrows: false
                            }
                        }
                    ]
                });
            }
        },

        homePromotion: function() {
            var promotionImg = $('.promotion-block img');
            if(promotionImg.length) {
                promotionImg.imgCentering();
            }
        },

        moreImageProduct: function () {
            $( '.thumbnails a img').off('click').on('click', function() {
                    var photo_fullsize = $(this).attr('srcset');
                    $('.woocommerce-main-image img').attr( 'srcset', photo_fullsize );
                }
            );
        },

        productImageHeight: function() {
            var productImage = $('#product-category li.product .image');
            if($(window).width() > $desktop - 1) {
                if(productImage.length) {
                    productImage.each(function() {
                        $(this).height($(this).width()*1.3);
                    });
                }
            }
        },

        productMatchHeight: function() {
            var productItem = $('.tax-product_cat #product-category li.product');
            if($(window).width() > $desktop - 1) {
                if(productItem.length) {
                    productItem.matchHeight();
                }
            }
        },

        touchLink: function() {
            var hoverLink = $('#product-category li.product .hover-image, #product-category li.product .info, .content-block-body a, .cat-list .swiper-slide');
            if(hoverLink.length) {
                if($(window).width() < $desktop) {
                    hoverLink.on('touchstart', function () {
                        $(this).trigger('hover');
                    }).on('touchend', function () {
                        $(this).trigger('hover');
                    });
                }
            }
        },

        filterBarFixed: function() {
            var filterBar = $('.filter-bar');
            if(filterBar.length) {
                filterBar.sticky({
                    topSpacing: 0,
                    zIndex: 111
                });
            }
        },

        filterProduct: function () {
            var resetFilter = $('div.reset-filter');
            var brand = [];
            var style = [];
            var size = [];
            var material = [];
            var color = [];
            var price = [];
            $("#legend p").each(function(){
                if($(this).attr('data-title') == 'nhãn hiệu'){
                    brand.push($(this).text());
                }
                if($(this).attr('data-title') == 'kiểu dáng'){
                    style.push($(this).text());
                }
                if($(this).attr('data-title') == 'chất liệu'){
                    material.push($(this).text());
                }
                if($(this).attr('data-title') == 'màu sắc'){
                    color.push($(this).text());
                }
                if($(this).attr('data-title') == 'size'){
                    size.push($(this).text());
                }
                if($(this).attr('data-title') == 'giá'){
                    price.push($(this).text());
                }
            });
            var ft = $.filtrify('product-category', 'placeHolder', {
                close : true,
                query : {
                    "nhãn hiệu" : brand,
                    "kiểu dáng" : style,
                    "chất liệu" : material,
                    "màu sắc" : color,
                    "size" : size,
                    "giá" : price
                },
                callback : function( query, match, mismatch ) {
                    if ( mismatch.length ) {
                        resetFilter.show();
                        var count = $('#product-category .product:not("li.ft-hidden")').length;
                        if(count == 0){
                            count = 'Không tìm thấy';
                        }
                        $(".product-count span").html(count);
                        var category, tags, i, tag, legend = "";
                        for (category in query) {
                            tags = query[category];
                            if (tags.length) {
                                for (i = 0; i < tags.length; i++) {
                                    tag = tags[i];
                                    legend += "<p data-title='"+category +"'>" + tag + "</p>";
                                }
                            }
                        }
                        legend = legend.substring(0,legend.length -1);
                        $("#legend").html(legend);
                    }
                    else{
                        $("#legend").html("");
                        resetFilter.hide();
                    }
                }
            });

            resetFilter.on('click', function() {
                ft.reset();
                var count = $('#product-category .product:not("li.ft-hidden")').length;
                if(count == 0){
                    count = 'Không tìm thấy';
                }
                $(".product-count span").html(count);
                customJS.productMatchHeight();
            });
            
            setTimeout(function() {
                var filterPanel = $('.filter-container'),
                    ftMenu = $('.ft-menu'),
                    ftLabel= $('.ft-label', ftMenu),
                    ftPanel = $('.ft-panel', ftMenu),
                    ftTags = $('.ft-tags', ftPanel),
                    ftTarget = $('.ft-label, .ft-panel', ftMenu),
                    sortingBtn = $('.woocommerce-ordering .dropdown-toggle'),
                    closeBtn = $('.btn-close'),
                    filterBtn = $('.btn-filter'),
                    filterTarget = $('.btn-filter, .filter-container');
                if(ftMenu.length) {
                    ftLabel.off('click').on('click', function() {
                        if($(this).hasClass('ft-clicked')) {
                            $(this).removeClass('ft-clicked');
                        }
                        else {
                            $(this).addClass('ft-clicked');
                        }
                        $(this).parent().siblings().find('.ft-clicked').removeClass('ft-clicked');
                        $(this).parent().siblings().find('.ft-panel').slideUp(300);
                        $(this).parent().find('.ft-panel').slideUp(300);
                        if(!$(this).next('.ft-panel').is(':visible')) {
                            $(this).next('.ft-panel').slideDown(300);
                        }
                        sortingBtn.parents('.bootstrap-select').removeClass('open');
                    });

                    ftTags.each(function() {
                        if($(this).find('li').length > 10) {
                            $(this).addClass('ft-columns');
                        }
                    });
                }

                if(sortingBtn.length) {
                    sortingBtn.on('click', function() {
                        ftLabel.removeClass('ft-clicked');
                        ftPanel.slideUp(300);
                    });
                }

                if($(window).width() > $laptop - 1) {
                    filterPanel.removeAttr('style');
                    filterBtn.removeClass('clicked');
                }
                else {
                    filterBtn.off('click').on('click', function() {
                        if($(this).hasClass('clicked')) {
                            filterPanel.slideUp(300);
                            $(this).removeClass('clicked');
                        }
                        else {
                            filterPanel.slideDown(300);
                            $(this).addClass('clicked');
                        }
                    });
                    closeBtn.off('click').on('click', function() {
                        filterPanel.slideUp(300);
                        filterBtn.removeClass('clicked');
                    });
                }

                $(document).on('click', function(e) {
                    var target = e.target;
                    if($(window).width() > $laptop - 1) {
                        if (!$(target).is(ftTarget) && !$(target).parents().is(ftTarget)) {
                            ftLabel.removeClass('ft-clicked');
                            ftPanel.slideUp(300);
                        }
                    }
                    else {
                        if (!$(target).is(filterTarget) && !$(target).parents().is(filterTarget)) {
                            filterPanel.slideUp(300);
                            filterBtn.removeClass('clicked');
                        }
                    }
                });
            }, 100);
        },
        
        showAllProducts: function () {
            $('.show-products').click(function(e) {
                $('.product').removeClass('hide');
                $(this).hide();
            })
        },

        relateProductSlider: function() {
            var relateProduct = $('.single-product ul.products');
            if(relateProduct.length) {
                relateProduct.slick({
                    easing: 'ease',
                    infinite: false,
                    slide: 'li',
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    swipeToSlide: true,
                    responsive: [
                        {
                            breakpoint: $fullDesktop + 1,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: $hugeDesktop + 1,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: $laptop,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: $mobile,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        },

        footerMobileMenu: function() {
            var footerTitle = $('.footer-title');
            if(footerTitle.length) {
                if($(window).width() < $mobile + 1) {
                    footerTitle.off('click').on('click', function() {
                        if($(this).hasClass('open-menu')) {
                            $(this).removeClass('open-menu');
                        }
                        else {
                            $(this).addClass('open-menu');
                        }
                        $(this).parent().siblings().find('.open-menu').removeClass('open-menu');
                        $(this).parent().siblings().find('.menu').slideUp(300);
                        $(this).parent().find('.menu').slideUp(300);
                        if(!$(this).parent().find('.menu').is(':visible')) {
                            $(this).parent().find('.menu').slideDown(300);
                        }
                    });
                }
                else {
                    footerTitle.off('click').on('click', function() {
                        return false;
                    });
                    footerTitle.parent().find('.menu').removeAttr('style');
                }
            }
        },

        subCategory: function() {
            var catSubList = $('.cat-sub-list'),
                catList = $('.cat-list', catSubList),
                catItem = $('.swiper-slide', catList),
                catLink = $('a', catItem),
                catItemWidth = catLink.outerWidth(),
                catContainerWidth = $('.cat-sub-list .container').outerWidth();
            if(catList.length) {
                catList.addClass('rightIn');
                var catSwiper = '';
                if($(window).width() > $desktop - 1) {
                    var sumCatList = catItem.length * catItemWidth,
                        itemCount = Math.floor(catContainerWidth/catItemWidth);
                    if(catSwiper == '') {
                        catSwiper = new Swiper(catList, {
                            slidesPerView: itemCount,
                            spaceBetween: 0,
                            autoplay: 5000,
                            autoplayDisableOnInteraction: false,
                            mousewheelControl: true,
                            freeMode: true
                        });
                    }
                    catLink.on('click', function() {
                        window.location = $(this).attr('href');
                    });
                }
                else {
                    if(catSwiper != '') {
                        catSwiper.destroy();
                        catSwiper = '';
                    }
                    setTimeout(function() {
                        catItem.each(function() {
                            if($(this).hasClass('active')) {
                                catList.animate({
                                    scrollLeft: $(this).position().left
                                }, 100);
                            }
                        });
                    }, 100);
                }
            }
        },

        sidebarToggle: function () {
            var toggleBtn = $('.toggle-menu'),
                sidebar = $('.left-content'),
                body = $('body');
            if(toggleBtn.length) {
                toggleBtn.off('click').on('click', function() {
                    if(body.hasClass('no-sidebar')) {
                        body.removeClass('no-sidebar');
                        customJS.productMatchHeight();
                        productDetail.sliderReinit(imageList, thumbList);
                    }
                    else {
                        body.addClass('no-sidebar');
                        customJS.productMatchHeight();
                        productDetail.sliderReinit(imageList, thumbList);
                    }
                });
            }
        },

        snowEffect: function() {
            var snowComtainer = $('#snowContainer');
            if($('body').hasClass('home')) {
                if($(window).width() > $desktop - 1) {
                    snowComtainer.css('display', 'block');
                    setTimeout(function() {
                        var snowImg = $('div > img', snowComtainer);
                        snowImg.each(function() {
                            var imgUrl = $(this).attr('src'),
                                imgName = imgUrl.substr(imgUrl.indexOf('/') + 1, 5);
                            if (imgName == 'snow1') {
                                $(this).parent().width(18);
                                $(this).parent().height(18);
                            }
                            else if (imgName == 'snow2') {
                                $(this).parent().width(10);
                                $(this).parent().height(10);
                            }
                            else if (imgName == 'snow3') {
                                $(this).parent().width(22);
                                $(this).parent().height(24);
                            }
                            else if (imgName == 'snow4') {
                                $(this).parent().width(14);
                                $(this).parent().height(14);
                            }
                            else {
                                $(this).parent().width(454);
                                $(this).parent().height(340);
                            }
                        });
                    }, 300);
                    snowComtainer.on('click', function() {
                        $(this).css('display', 'none');
                    });
                }
            }
        }
    };

    /* Window ready function */
    $(window).ready(function () {
        // Custom scrollbar
        //customJS.customScrollbar();

        // Close sidebar
        customJS.closeSidebar();

        // Sidebar toggle
        customJS.sidebarToggle();

        // Bootstrap select
        customJS.bootstrapSelect();
        
        // Hover product image
        customJS.moreImageProduct();

        // Filter bar fixed
        customJS.filterBarFixed();

        // Filter product
        customJS.filterProduct();

        // Show all products
        customJS.showAllProducts();
    });

    /* Window load function */
    $(window).load(function () {
        // Accordion menu
        customJS.accordionMenu();

        // Back top button
        customJS.backTop();

        // Search toggle
        customJS.searchToggle();

        // Home upbar slider
        customJS.homeUpbarSlider();

        // Home main slider
        customJS.homeMainSlider();

        // Home promotion
        //customJS.homePromotion();

        // Product image height
        customJS.productImageHeight();

        // Product match height
        customJS.productMatchHeight();

        // Product tab index
        customJS.touchLink();

        // Relate product slider
        customJS.relateProductSlider();

        // Sub category
        customJS.subCategory();

        // Footer mobile menu
        customJS.footerMobileMenu();

        // Snow effect
        customJS.snowEffect();

        // Product detail slider
        productDetail.sliderInit(imageList, thumbList);

        // Product summary centering
        productDetail.summaryCenter();

        // Product thumbnail centering
        productDetail.thumbnailCenter();
    });

    /* Window resize function */
    var width = $(window).width();
    var resize = 0;
    $(window).resize(function() {
        var _self = $(this);
        resize++;
        setTimeout(function() {
            resize--;
            if (resize === 0) {
                // Done resize ...
                // Close sidebar
                customJS.closeSidebar();

                // Search toggle
                customJS.searchToggle();

                // Home upbar slider
                customJS.homeUpbarSlider();

                // Home promotion
                //customJS.homePromotion();

                // Product image height
                customJS.productImageHeight();

                // Product match height
                customJS.productMatchHeight();

                // Sub category
                customJS.subCategory();

                // Footer mobile menu
                customJS.footerMobileMenu();

                // Product summary centering
                productDetail.summaryCenter();

                // Product thumbnail centering
                productDetail.thumbnailCenter();

                if (_self.width() !== width) {
                    width = _self.width();
                    // Done resize width ...
                    // Filter product
                    customJS.filterProduct();
                }
            }
        }, 100);
    });
})(jQuery);