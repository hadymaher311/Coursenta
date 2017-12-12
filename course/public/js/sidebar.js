$(function() {
    $(".open-side").click(function() {
        $('.ui.sidebar').sidebar('toggle');
        $("html").removeClass('full-height');
    });
});