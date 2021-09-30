<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MCCSto.Tomas MaP</title>
    <link rel="shortcut icon" href="/img/brand/favicon.png" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <!-- Styles -->
    <style>
        html,
        body {
            margin: 0px;
            padding: 0px;
        }

        #mapId {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <div id="mapId"></div>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
        integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
        crossorigin=""></script>

    <script>
        var mymap;
        var marker;
        var maplatestId = 0;
        var markers = [];
        var audio = new Audio('/music/AirHornSoundBible.mp3');

        $(function() {
            setInterval(function() {
                getCurrentLocation(false);
            }, 10000);
            loadMap();
        });

        function loadMap_old(){

            mymap = L.map('mapId').setView([14.998441, 120.710790], 15);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                id: 'mapbox.streets'
            }).addTo(mymap);
            getCurrentLocation(true);
        }

        function loadMap(){
        
        mymap = L.map('mapId').setView([14.998441, 120.710790], 15);
       L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
        {
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        }).addTo(mymap);
        getCurrentLocation(true);
        }
        

        function getCurrentLocation(isFirstLoad) {
            var api_url = "/report/list";
            audio = new Audio('/music/AirHornSoundBible.mp3');
            
            var id;
            var latitude;
            var longitude;
            var created_at;
            var name;
            var emergency_type;
            var hasMoreThan = true;
            $.ajax({
                url: api_url,
                success: function(responseData) {
                    // console.log(responseData);

                    if (!isFirstLoad){
                        // markers.length;
                        // console.log(markers.length);
                        var inc = 0
                        while(markers.length>inc){
                            mymap.removeLayer(markers[inc]);
                            inc = inc+1;
                        }
                        markers = [];
                        
                    }
                    
                    if(responseData.records.length > 0){
                        audio.play();
                    }else{
                        audio.pause();
                        audio.currentTime = 0;
                    }

                    // console.log(responseData.records.length);

                    $.each(responseData.records, function(i, item) {
                        id = item.id;
                        name = item.name
                        latitude = item.latitude;
                        longitude = item.longitude;
                        emergency_type = item.emergency_type
                        created_at = item.created_at;

                        addMap(item,i);
                    });

                }
            });
        }

       
        function addMap(item,i) {

            var default_icon = "/img/icons/police.gif";
            if(item.emergency_type ==0){
                default_icon = "/img/icons/ambulance.gif";
            }else if(item.emergency_type == 1){
                default_icon = "/img/icons/fire.gif";
            }

            var index = item.created_at.indexOf(" ") + 1;
            var date = item.created_at.substring(0, index - 1);
            var time = item.created_at.substring(index, index + 8);
            var floatLatitude = parseFloat(item.latitude);
            var floatlongitude = parseFloat(item.longitude);

            var hazardIconHighlight = L.icon({
                iconUrl: default_icon,
                iconSize: [40, 40],
                iconAnchor: [20, 20],
                popupAnchor: [0, 0],
                shadowSize: [45, 45],
                shadowAnchor: [12, 12]
            });

            var title ="<p style=\"text-align: center;\"><b>"+item.title+" Request</b><br><br>"
            var name = "User Name: " + item.name + "<br>"
            var quantity = "Quantity: " + item.quantity + "<br>"
            var note = "Note: " + item.note + "</p>";
            var number = "Number: " + item.number + "<br>"
            var coordinates = "Latitude: " + floatLatitude + "<br>Longitude: " + floatlongitude + "<br>"
            var datetime = "Date: " + date + "<br>Time: " + time  + "<br>"
            var  popUp_description = title + name +number+ quantity + coordinates + datetime+ note;
            marker = L.marker([floatLatitude, floatlongitude]).addTo(mymap);
            // marker.setIcon(hazardIcon);
            marker.setIcon(hazardIconHighlight);
            marker.bindPopup(popUp_description).closePopup();
            markers[i] = marker;
        }  

    </script>
</body>

</html>