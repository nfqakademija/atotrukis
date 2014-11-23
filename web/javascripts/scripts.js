$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(".attendButton").click(function(){
    var path = $(this).find(".jsRoute").text();
    var id = $(this).find(".eventID").text();
    $.ajax({
        type: "POST",
        url:path,
        data : { 'eventId' : id},
        dataType: 'json',
        success:function(data){
            alert(data.data);
        }
    });
});