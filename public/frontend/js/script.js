$(document).ready(function() {
    'use strict';

    // fixing issue of stiky bar when reload
    $(this).scrollTop(0);

    // change background color for nav bar
    $(window).scroll(function() {

        if ($(this).scrollTop() > 250) {
            $('.navbar').addClass("newcolor");
        } else {
            $('.navbar').removeClass("newcolor");
        }

    });

    // sub menu in nav bar
    $('.navItem').on('click', function() {
        $(this).find('.dropdown-menu').toggleClass("show-sub-menu");
        $(this).siblings().find('.dropdown-menu').removeClass('show-sub-menu');

    });

    $(function() {
        $(".owl-carousel").owlCarousel();
    });

    // Slider header
    $('.slider-header').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        navigation: true,
        navigationText: ["<img src='myprevimage.png'>", "<img src='mynextimage.png'>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })

    // personal slider
    $('.owl-personal').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })

    // slider olw-coming 
    $('.owl-coming').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1

                }
            }
        })
        // change icon nav in owl
    $(".owl-prev").html('<i class="fa fa-angle-left"></i>');
    $(".owl-next").html('<i class="fa fa-angle-right"></i>');

    // toggle sadnav in mobile
    $('.mobile-toggle button').on('click', function() {
        $('.sidenav').toggleClass("open");

    });


    // animation
    var $animation_elements = $('.animation-element');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('in-view');
            } else {
                $element.removeClass('in-view');
            }
        });
    }
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');


    // full screen
    $('.navItem .fullscreen').on('click', function() {

        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    });

    $('.slider-idu').owlCarousel({
        loop: true,
        nav: true,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            }
        }
    });
    $('#applyNow').find("button").click(function(){
        if($('#applyNow').hasClass("applyNow2") ){
            window.location.href = "https://iduni.net/ar/register";
        }else{
            window.location.href = "https://iduni.net/register";
        }
    });
    // $('.applyNow2').find("button").click(function(){
    //     window.location.href = "https://iduni.net/ar/register";
    // });
});