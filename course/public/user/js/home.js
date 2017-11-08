$(function() {
  
  $(".full-bg-img,.hm-purple-slight").height($(window).height());
  $(window).on("resize", function() {
    $(".full-bg-img,.hm-purple-slight").height($(window).height());
  });

  $("body").niceScroll({cursorcolor:"#A028BF"});

});
