<?<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px; /* Set the height of the map */
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13); // Default view

// Load OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

// Get user's location
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var userLocation = [position.coords.latitude, position.coords.longitude];
        map.setView(userLocation, 13); // Center the map on user's location

        // Add a marker for the user's location
        L.marker(userLocation).addTo(map).bindPopup('You are here!').openPopup();

        // Fetch store locations from your API
        fetch('/path/to/your/api/for/stores?lat=' + position.coords.latitude + '&lng=' + position.coords.longitude)
            .then(response => response.json())
            .then(data => {
                data.forEach(store => {
                    var storeLocation = [store.latitude, store.longitude];
                    L.marker(storeLocation).addTo(map).bindPopup(store.name);
                });
            });
    }, function() {
        alert("Geolocation service failed.");
    });
} else {
    alert("Geolocation is not supported by this browser.");
}
    </script>
</body>
</html>
