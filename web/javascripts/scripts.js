    $.ajax({
        type: "POST",
        url: "/app_dev.php/setCity",
        data: {},
        dataType: 'json',
        success: function (data) {
            alert(data.data);
        }
    });
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
$('[data-toggle="tooltip"]').tooltip();

// quiz steps
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

function initialize(lat, lng) {
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: new google.maps.LatLng(lat, lng) ,
        zoom: 16
    });

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map,
    });
    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);

    service.getDetails(request, function(place, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
    });
}
google.maps.event.addDomListener(window, 'load', function(){initialize(lat, lng);});