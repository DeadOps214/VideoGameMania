<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map with Nearby Toy Stores</title>
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
    // Function to initialize the map
    function initMap(lat, lon) {
        // Show the loading spinner
        document.getElementById('loading-spinner').style.display = 'block';

        // Create a promise to handle the minimum display time for the spinner
        const spinnerTimeout = new Promise((resolve) => {
            setTimeout(resolve, 2000); // 2 seconds
        });

        // Create the map and set its view to the user's location
        var map = L.map('map').setView([lat, lon], 13);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Add a custom marker for the user's location
        var userIcon = L.icon({
            iconUrl: 'https://img.freepik.com/free-vector/3d-gradient-map-pin_78370-1524.jpg?t=st=1742939466~exp=1742943066~hmac=2004924faa03a9e5b7be56b211705ca5d9816bdeb8d156d58f8737abcf3b453d&w=900',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
        });

        // Create a marker for the user's location
        var userMarker = L.marker([lat, lon], { icon: userIcon }).addTo(map);
        userMarker.bindPopup("You are here!").openPopup();

        // Fetch nearby toy stores
        fetchNearbyStores(lat, lon, map);

        // Hide the loading spinner once the map is fully loaded
        map.on('load', function() {
            spinnerTimeout.then(() => {
                document.getElementById('loading-spinner').style.display = 'none';
            });
        });

        // Hide the spinner if the map fails to load
        map.on('error', function() {
            document.getElementById('loading-spinner').style.display = 'none';
        });
    }

    // Function to handle geolocation success
    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        initMap(lat, lon); // Initialize the map with user's location
    }

    // Function to handle geolocation errors
    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("User  denied the request for Geolocation.");
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

    // Function to fetch nearby toy stores
    function fetchNearbyStores(lat, lon, map) {
        // Define the Overpass API query to find toy stores within 5 miles (8046.72 meters)
        var query = `
            [out:json];
            (
              node["shop"="toys"](around:8046.72, ${lat}, ${lon});
              way["shop"="toys"](around:8046.72, ${lat}, ${lon});
              relation["shop"="toys"](around:8046.72, ${lat}, ${lon});
            );
            out body;
        `;

        var overpassUrl = 'https