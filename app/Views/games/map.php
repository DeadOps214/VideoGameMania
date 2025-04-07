<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearby Electronic Game Stores</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 100vh; /* Full height for the map */
        }
        #loading-spinner {
            display: none; /* Initially hidden */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px; /* Adjust font size as needed */
        }
    </style>
</head>
<body>

<div id="loading-spinner">Loading...</div>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    function initMap(lat, lon) {
        document.getElementById('loading-spinner').style.display = 'block';

        // Create a promise to handle the minimum display time for the spinner
        const spinnerTimeout = new Promise((resolve) => {
            setTimeout(resolve, 2000); // Wait for 2 seconds
        });

        // Create the map and set its view to the user's location
        var map = L.map('map').setView([lat, lon], 13);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Custom user location icon
        var userIcon = L.icon({
            iconUrl: 'https://img.icons8.com/ios/50/000000/user-location.png', 
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var userMarker = L.marker([lat, lon], { icon: userIcon }).addTo(map);
        userMarker.bindPopup("You are here!").openPopup();

        // Fetch nearby game stores
        fetchNearbyStores(lat, lon, map);

        map.on('load', function() {
            spinnerTimeout.then(() => {
                document.getElementById('loading-spinner').style.display = 'none';
            });
        });

        map.on('error', function() {
            document.getElementById('loading-spinner').style.display = 'none';
        });
    }

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        initMap(lat, lon); // Initialize map with user's location
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    // Corrected function syntax (removed extra parenthesis)
    function fetchNearbyStores(lat, lon, map) {
        var query = `
        [out:json];
        (
          node["shop"="electronics"](around:16093.44, ${lat}, ${lon});
          way["shop"="electronics"](around:16093.44, ${lat}, ${lon});
          relation["shop"="electronics"](around:16093.44, ${lat}, ${lon});
        );
        out body;
        `;

        var overpassUrl = 'https://overpass-api.de/api/interpreter?data=' + encodeURIComponent(query);

        fetch(overpassUrl)
            .then(response => response.json())
            .then(data => {
                displayStores(data.elements, map);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function displayStores(stores, map) {
        stores.forEach(store => {
            if (store.type === 'node') {
                var marker = L.marker([store.lat, store.lon]).addTo(map);
                marker.bindPopup(store.tags.name || 'Store').openPopup();
            }
        });
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
</script>

</body>
</html>
