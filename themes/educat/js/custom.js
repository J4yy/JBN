// Search form for educat template
$("#search-form button").on("click", function() {
    console.log('test');
    if ("n" == $(this).attr("data-click")) {
        return !1;
    }
    console.log('test');
    $(this).attr("data-click", "n");
    var a = $("#search-form input"),
        c = a.attr("maxlength"),
        b = strip_tags(a.val()),
        d = $(this).attr("data-minlength");
    a.parent().removeClass("has-error");
    "" == b || b.length < d || b.length > c ? (a.parent().addClass("has-error"), a.val(b).focus(), $(this).attr("data-click", "y")) : window.location.href = $(this).attr("data-url") + rawurlencode(b);
    return !1
});
$("#search-form input").on("keypress", function(a) {
    13 != a.which || a.shiftKey || (a.preventDefault(), $("#search-form button").trigger("click"))
});

function put_banner_after_top(header_height) {
    $('.fix_banner_left').css('margin-top', header_height + 'px');
    $('.fix_banner_right').css('margin-top', header_height + 'px');
}

$(window).scroll(function() {
    put_banner_after_top($('header').outerHeight());
});

$(document).ready(function() {
    console.log($('header').outerHeight())
    put_banner_after_top($('header').outerHeight());
});