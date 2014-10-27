
var map;

var lastValidCenter;

var allowedBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(-90, -180), 
		new google.maps.LatLng(90, 180)
);

google.maps.event.addDomListener(window, 'load', function(){
	var mapProp = {
		center:new google.maps.LatLng(0,0),
		zoom:2,
		draggable:true,
		disableDoubleClickZoom:true,
		scrollwheel:false,
		mapTypeId:google.maps.MapTypeId.SATELLITE,
		disableDefaultUI: true
	};
	map = new google.maps.Map(document.getElementById("googleMaps"),mapProp);
	lastValidCenter = map.getCenter();

	google.maps.event.addListener(map, 'center_changed', function() {
		if (allowedBounds.contains(map.getCenter())) {
			lastValidCenter = map.getCenter();
			return; 
		}
		map.panTo(lastValidCenter);
	});
	
});


