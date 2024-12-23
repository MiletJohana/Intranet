<!-- Se determina y escribe la localizacion 
<div id='ubicacion'></div>
<script type="text/javascript">
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(mostrarUbicacion);
	} else {alert("¡Error! Este navegador no soporta la Geolocalización.");}
function mostrarUbicacion(position) {
    var times = position.timestamp;
	var latitud = position.coords.latitude;
	var longitud = position.coords.longitude;
    var altitud = position.coords.altitude;	
	var exactitud = position.coords.accuracy;	
	var div = document.getElementById("ubicacion");
	div.innerHTML = "Timestamp: " + times + "<br>Latitud: " + latitud + "<br>Longitud: " + longitud + "<br>Altura en metros: " + altitud + "<br>Exactitud: " + exactitud;
  //$('#pag').attr("href","https://www.coordenadas-gps.com/latitud-longitud/"+latitud+"/"+longitud+"/10/roadmap");
}
  function refrescarUbicacion() {	
	navigator.geolocation.watchPosition(mostrarUbicacion);}	
</script>
	-->



<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<div id="map" style="height: 180px"></div>

<script>
	var lat_ini = $('#lat_ini2').val(),
		lon_ini = $('#lon_ini2').val(),
		lat_fin = $('#lat_fin2').val(),
		lon_fin = $('#lon_fin2').val();
	var map = L.map('map').
	setView([lat_ini, lon_ini],20);
	L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=36VFe2Hg2HmBcsfB39Kr', {
		attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
	}).addTo(map);
	var marker = L.marker([lat_ini, lon_ini]).addTo(map);
	var marker2 = L.marker([lat_fin, lon_fin]).addTo(map);
	marker.bindPopup('Inicial');
	marker2.bindPopup('Final');


/*
var mymap = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
		'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="http://mapbox.com">Mapbox</a>',
	id: 'mapbox.streets'
}).addTo(mymap);
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
           attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
       }).addTo(mymap);

*/


/*var map = L.map('map').
     setView([4.6740842, -74.0778472],
		 14);
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
maxZoom: 18
}).addTo(map);
L.control.scale().addTo(map);
var ini=L.marker([4.6740842, -74.0778472]).bindPopup('Inicial').addTo(map),
		fin=L.marker([4.6740836,-74.077]).bindPopup('Final').addTo(map);
		*/
</script>
