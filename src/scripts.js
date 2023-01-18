$(document).ready(function(){
    $(".list-group-item").click(function(){
        $(".list-group-item").removeClass("active");
        $(this).addClass("active");
    });
    });

$(document).ready(function(){
    var page = new URLSearchParams(window.location.search).get("category");
    $(".list-group-item").removeClass("active");
    $(".list-group-item[data-page='"+page+"']").addClass("active");
  });

$(document).ready(function(){
    $(".nav-link").click(function(){
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    });
    });