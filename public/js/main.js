$(document).ready(function () {
    //
    //
    //
    //
    //
    //                  SIDEBAR AND MAIN BODY TOGGLING SCRIPT START
    //
    //
    //
    //
    //
// Menu Toggle Script start
    $('#aside-toggler').click(function (e) {
        e.preventDefault();
        $('aside').toggleClass('hider');
        $('.top-navigation').toggleClass('toggled');
        $('.content-area').toggleClass('toggler');
    });

    $(window).on('resize load', function () {
        var width = $(window).width();

        if (width <= 768) {
            $('aside').addClass('hider');
            $('.top-navigation').addClass('toggled');
            $('.content-area').addClass('toggler');
        } else {
            $('aside').removeClass('hider');
            $('.top-navigation').removeClass('toggled');
            $('.content-area').removeClass('toggler');
        }
    });
// Menu Toggle Script end
    //
    //
    //
    //
    //
    //                   tag Editor script
    //
    //
    //
    //
    //
//tag Editor script start
    $(".tm-input").tagsManager({
        tagClass: 'tm-tag-info'
    });
//tag Editor script close

    $('[data-toggle="tooltip"]').tooltip();
});