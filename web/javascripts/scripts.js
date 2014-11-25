$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(".attendmentButton").on("click", ".attendButton", function(){
    $(this).prop('disabled', true);
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
    $(this).prop('disabled', true);
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

$(".attendmentButton").on("click", ".attendButton-sml", function(){
    $(this).prop('disabled', true);
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

$(".attendmentButton").on("click", ".attendingButton-sml", function(){
    $(this).prop('disabled', true);
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
$('[data-toggle="tooltip"]').tooltip()