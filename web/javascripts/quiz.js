var current, next, previous;
$(".next").click(function() {
    current = $(this).parent().parent();
    next = $(this).parent().parent().next();
    next.show();
    current.hide();
});
$(".previous").click(function() {
    current = $(this).parent().parent();
    previous = $(this).parent().parent().prev();
    previous.show();
    current.hide();
});