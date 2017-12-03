$(document).ready(function () {
    size_li = $("#myList li").size();
    x=6;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+3 <= size_li) ? x+3 : size_li;
        $('#myList li:lt('+x+')').show();
    });
    $('#showLess').click(function () {
        x=(x-3<0) ? 3 : x-3;
        $('#myList li').not(':lt('+x+')').hide();
    });
});

$(document).ready(function () {
    size_li = $("#xxx li").size();
    x=3;
    $('#xxx li:lt('+x+')').show();
    $('#loadMorex').click(function () {
        x= (x+3 <= size_li) ? x+3 : size_li;
        $('#xxx li:lt('+x+')').show();
    });
    $('#showLessx').click(function () {
        x=(x-3<0) ? 3 : x-3;
        $('#xxx li').not(':lt('+x+')').hide();
    });
});