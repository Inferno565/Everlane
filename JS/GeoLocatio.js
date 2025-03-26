// Creating map options
var mapOptions = {
    center: [43.01325328421298, -73.29163203350883],
    zoom: 10
}

// Creating a map object
var map = new L.map('map', mapOptions);

// Creating a Layer object
var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

// Adding layer to the map
map.addLayer(layer);

// Creating a marker
var marker = L.marker([43.01325328421298, -73.29163203350883]);

// Adding marker to the map
marker.addTo(map);
var circle = L.circle([43.01325328421298, -73.29163203350883], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);