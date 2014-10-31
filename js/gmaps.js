
var map;
var lat = 0;
var lon = -180;
var lastValidCenter;

google.maps.event.addDomListener(window, 'load', function(){
	var mapProp = {
		center:new google.maps.LatLng(lat,lon),
		zoom:3,
		draggable:false,
		disableDoubleClickZoom:true,
		scrollwheel:false,
		mapTypeId:google.maps.MapTypeId.SATELLITE,
		disableDefaultUI: true
	};
	map = new google.maps.Map(document.getElementById("googleMaps"),mapProp);
	
});

setInterval(autopan, 100);
function autopan(){
	lon += 0.5;
	console.log(lat+":"+lon);
	map.panTo(new google.maps.LatLng(lat,lon));
}

