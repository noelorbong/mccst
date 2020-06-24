@extends('layouts.admin2')
<style>
#mapId {
        /* position:absolute;
        top:0;
        right:0;
        bottom:0;
        left:0; */
        height: 80vh;
    width: 100%;
        }
</style>
@section('content')

    <div class="container">
    <div class="card">
        <div id="mapId"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
        var mainChart = null;
        var mymap;
        var marker;
        var LatestId = null;
        var arrayMaxSize = 100;
        var serial_no = "imeds0001";
        var id = [];
        var latitude = [];
        var longitude = [];
        var car_shock = [];
        var created_at = [];
        var bgColor = 'rgba(2, 101, 10, 0.2)';
        var bColor = 'rgba(2, 101, 10, 1)';

        $(function() {

            LoadMap();
            setInterval(function() {
                chartUpdate()
            }, 10000);
        });

 

        function LoadMap() {

            id = [];
            latitude = [];
            longitude = [];
            car_shock = [];
            created_at = [];

            var api_url =  "http://imeds-hau.esy.es/api/v1/devicelocation/"+serial_no;

            $.ajax({
                url: api_url,
                success: function(responseData) {
                    // console.log(responseData);

                    if(responseData.location){
                        console.log("latest Id: "+ LatestId);
                        console.log("New Id: "+responseData.location.id);
                        if (LatestId < responseData.location.id) {
                            renderMap(responseData.location.latitude, responseData.location.longitude, responseData.location.created_at)
                            LatestId = responseData.location.id;
                        }
                    }

                    
                }
            });
        }

        function renderMap(latitude, longitude, dateTime) {
            console.log("latitude: " + latitude);
            console.log("longitude: " + longitude);

            var index = dateTime.indexOf(" ") + 1;
            var date = dateTime.substring(0, index - 1);
            var time = dateTime.substring(index, index + 8);
            var floatLatitude = parseFloat(latitude);
            var floatlongitude = parseFloat(longitude);
            mymap = L.map('mapId').setView([floatLatitude, floatlongitude], 15);
            marker = L.marker([floatLatitude, floatlongitude]).addTo(mymap);
            marker.bindPopup("<p style=\"text-align: center;\"><b>Device Location</b><br><br>Latitude: " + floatLatitude + "<br>Longitude: " + floatlongitude + "<br>Date: " + date + "<br>Time: " + time + "</p>").openPopup();

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                id: 'mapbox.streets'
            }).addTo(mymap);

        }

        function updateMap(latitude, longitude, dateTime) {
            mymap.removeLayer(marker)
            var index = dateTime.indexOf(" ") + 1;
            var date = dateTime.substring(0, index - 1);
            var time = dateTime.substring(index, index + 8);
            var floatLatitude = parseFloat(latitude);
            var floatlongitude = parseFloat(longitude);
            marker = L.marker([floatLatitude, floatlongitude]).addTo(mymap);
            marker.bindPopup("<p style=\"text-align: center;\"><b>Device Location</b><br><br>Latitude: " + floatLatitude + "<br>Longitude: " + floatlongitude + "<br>Date: " + date + "<br>Time: " + time + "</p>").openPopup();
        }

        function chartUpdate() {
            var n_id;
            var n_latitude;
            var n_longitude;
            var n_car_shock;
            var n_created_at;
            var api_url = "http://imeds-hau.esy.es/api/v1/devicelocation/"+serial_no;

            $.ajax({
                url: api_url,
                success: function(responseData) {

                    if(responseData.location){
                        console.log("latest Id: "+ LatestId);
                        console.log("New Id: "+responseData.location.id);
                        if (LatestId < responseData.location.id) {
                            updateMap(responseData.location.latitude, responseData.location.longitude, responseData.location.created_at)
                            LatestId = responseData.location.id;
                        }
                    }
                   
                }
            });
        }

    





    </script>
@endSection