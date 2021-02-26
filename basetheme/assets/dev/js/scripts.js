$(document).ready(function(){
    // PLACEHOLDER SEARCH MAIN
    //--------------------------------------
    $('#s').attr('placeholder','O que você procura?');

    // DOT DOT DOT - ELLIPSIS BLOG
    //--------------------------------------
    $(".ellipsis").dotdotdot({
        height: 100,
        fallbackToLetter: true,
        watch: true,
    });


    // OPEN MENU MOBILE
    //--------------------------------------
    $('.bnt-open-menu').click(function(){
        var nav = $('header .main-menu');

        nav.fadeIn(400);
        nav.css('display', 'flex');
        nav.append('<div class="btn-close-menu"><span></span><span></span></div>');
    });


    // CLOSE MENU MOBILE
    //--------------------------------------
    $(document).on('click', '.btn-close-menu', function () {
        var nav = $('header .main-menu');
        nav.fadeOut(400);
    });
});
