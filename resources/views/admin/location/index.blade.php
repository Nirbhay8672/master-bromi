@extends('admin.layouts.app')
@push('page-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        canvas {
            border: 1px solid black;
        }
    </style>

@endpush
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Location</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h4>1 : Set Object using X and Y axis And set line between object</h4>
                                <div class="col">
                                    <canvas id="myCanvas" width="1211" height="500"></canvas>
                                </div>                
                            </div>
                            <div class="row mt-4">
                                <h4>2 : Create demo map with photoshop</h4>
                                <img src="{{ asset('/map.jpg') }}" usemap="#mymap" style="height: 100%;width:auto;"/>
                                <map name="mymap">
                                    <area
                                        shape="rect"
                                        coords="290,143,758,567"
                                        alt="Write"
                                        title=""
                                        href="https://write.geeksforgeeks.org/"
                                        onmouseover="myFunction('Write for Us!!')"
                                        onmouseout="myFunction('')"/>
                                    <area
                                        shape="rect"
                                        coords="148,423,382,500"
                                        alt="Practice"
                                        href="https://practice.geeksforgeeks.org/"
                                        onmouseover="myFunction('Practice and Learn')"
                                        onmouseout="myFunction('')"/>
                                    <area
                                        shape="circle"
                                        coords="115,260,40"
                                        alt="IDE"
                                        href="https://ide.geeksforgeeks.org/"
                                        onmouseover="myFunction('IDE')"
                                        onmouseout="myFunction('')"/>
                                </map>
                            </div>
                            <h4 class="mt-4">3 : Basic Practice</h4>
                            <strong>Current Location Details</strong>
                            @if($currentUserInfo)
                                <ul>
                                    <li>IP: {{ $currentUserInfo->ip }}</li>
                                    <li>Country Name: {{ $currentUserInfo->countryName }}</li>
                                    <li>Latitude: {{ $currentUserInfo->latitude }}</li>
                                    <li>Longitude: {{ $currentUserInfo->longitude }}</li>
                                </ul>
                            @endif
                            <div class="row p-3 mt-4">
                                <h4>4 : Set Coordinate in map</h4>
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
        $(document).ready(function() {
            // Define mall locations
            const mallLocations = [
                { name: "Paladium Mall", coordinates: [23.057992341538114, 72.52088408018972] }, // Replace with actual coordinates
                { name: "SP Stadium", coordinates: [23.042039571543285, 72.56426863817421] },   // Replace with actual coordinates
                { name: "Atal Bridge", coordinates: [23.01721107969132, 72.57531175859101] }, // Replace with actual coordinates
                { name: "My Home", coordinates: [23.062046271400384, 72.55614603068764] }, // Replace with actual coordinates
            ];

            // Initialize the map
            const map = L.map('map').setView([23.062046271400384, 72.55614603068764], 13); // Replace with a default view

            // Add a base layer (e.g., OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Loop through the mall locations and add markers
            mallLocations.forEach(mall => {
                L.marker(mall.coordinates).addTo(map)
                    .bindPopup(`<b>${mall.name}</b><br>Click for more information.`) // Custom popups
                    .on('click', () => {
                        // Handle click events (e.g., display additional information about the mall)
                        alert(`You clicked on ${mall.name}`);
                    });
            });
        })
    </script>

    <script>
        // Get a reference to the canvas element
        const canvas = document.getElementById('myCanvas');

        // Get the 2D rendering context
        const context = canvas.getContext('2d');

        // Define the coordinates of two objects
        const object1 = { name: '1', x: 50, y: 50, width: 50, radius: 10, color:'red' };
        const object2 = { name: '2', x: 200, y: 200 , width: 50, radius: 10, color:'blue' };
        const object3 = { name: '3', x: 400, y: 200 , width: 50, radius: 10, color:'green' };
        const object4 = { name: '4', x: 700, y: 400 , width: 50, radius: 10, color:'black' };

        // Function to set a rounded object on the canvas
        function setRoundedObjectOnCanvas(obj) {
            context.beginPath();
            context.arc(obj.x, obj.y, obj.radius, 0, Math.PI * 2);
            context.fillStyle = obj.color; // Set fill color
            context.fill();
        }

        // Call the function to set the rounded object on the canvas
        setRoundedObjectOnCanvas(object1);
        setRoundedObjectOnCanvas(object2);
        setRoundedObjectOnCanvas(object3);
        setRoundedObjectOnCanvas(object4);

        // Function to draw a line between two objects
        function drawLineBetweenObjectsFirst(obj1, obj2) {
            context.beginPath();
            context.moveTo(obj1.x, obj1.y);
            context.lineTo(obj2.x, obj2.y);
            context.strokeStyle = 'black'; // Set line color
            context.lineWidth = 2; // Set line width
            context.stroke();
        }

        // Call the function to draw the line
        drawLineBetweenObjectsFirst(object1, object2);

        // Function to draw a line between two objects
        function drawLineBetweenObjectsSecond(obj2, obj3) {
            context.beginPath();
            context.moveTo(obj2.x, obj2.y);
            context.lineTo(obj3.x, obj3.y);
            context.strokeStyle = 'black'; // Set line color
            context.lineWidth = 2; // Set line width
            context.stroke();
        }

        // Call the function to draw the line
        drawLineBetweenObjectsSecond(object2, object3);

        // Function to draw a line between two objects
        function drawLineBetweenObjectsThird(obj3, obj4) {
            context.beginPath();
            context.moveTo(obj3.x, obj3.y);
            context.lineTo(obj4.x, obj4.y);
            context.strokeStyle = 'black'; // Set line color
            context.lineWidth = 2; // Set line width
            context.stroke();
        }

        // Call the function to draw the line
        drawLineBetweenObjectsThird(object3, object4);
    </script>
    
@endpush
