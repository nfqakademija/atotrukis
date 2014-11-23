$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(".attendmentButton").on("click", ".attendButton", function(){
    var path = $(this).find(".jsRoute").text();
    var id = $(this).find(".eventID").text();
    var current_element = $(this);
    $.ajax({
        type: "POST",
        url:path,
        data : { 'eventId' : id},
        dataType: 'json',
        success:function(data){
            current_element.replaceWith(data.data);
        }
    });
});
$(".attendmentButton").on("click", ".attendingButton", function(){
    var path = $(this).find(".jsRoute").text();
    var id = $(this).find(".eventID").text();
    var current_element = $(this);
    $.ajax({
        type: "POST",
        url: path,
        data : { 'eventId' : id},
        dataType: 'json',
        success:function(data){
            current_element.replaceWith(data.data);
        }
    });
});
