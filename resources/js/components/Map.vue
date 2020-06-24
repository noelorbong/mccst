<template>
  <div>
    <div class="card">
      <div id="mapId"></div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      mymap: null,
      marker: null,
      LatestId: null,
      serial_no: "imeds0001"
    };
  },
  created: function() {
    var app = this;
    app.LoadMap();
    setInterval(function() {
      app.chartUpdate();
    }, 30000);
  },
  computed: {},
  methods: {
    LoadMap() {
      var app = this;
      var api_url =
        "http://imeds-hau.esy.es/api/v1/devicelocation/" + app.serial_no;

      $.ajax({
        url: api_url,
        success: function(responseData) {
          // console.log(responseData);

          if (responseData.location) {
            // console.log("latest Id: " + app.LatestId);
            // console.log("New Id: " + responseData.location.id);
            if (app.LatestId < responseData.location.id) {
              app.renderMap(
                responseData.location.latitude,
                responseData.location.longitude,
                responseData.location.created_at
              );
              app.LatestId = responseData.location.id;
            }
          }
        }
      });
    },
    renderMap(latitude, longitude, dateTime) {
      //   console.log("latitude: " + latitude);
      //   console.log("longitude: " + longitude);
      var app = this;
      var index = dateTime.indexOf(" ") + 1;
      var date = dateTime.substring(0, index - 1);
      var time = dateTime.substring(index, index + 8);
      var floatLatitude = parseFloat(latitude);
      var floatlongitude = parseFloat(longitude);
      app.mymap = L.map("mapId").setView([floatLatitude, floatlongitude], 15);
      app.marker = L.marker([floatLatitude, floatlongitude]).addTo(app.mymap);
      app.marker
        .bindPopup(
          '<p style="text-align: center;"><b>Device Location</b><br><br>Latitude: ' +
            floatLatitude +
            "<br>Longitude: " +
            floatlongitude +
            "<br>Date: " +
            date +
            "<br>Time: " +
            time +
            "</p>"
        )
        .openPopup();

      L.tileLayer(
        "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
        {
          maxZoom: 18,
          id: "mapbox.streets"
        }
      ).addTo(app.mymap);
    },
    updateMap(latitude, longitude, dateTime) {
      var app = this;
      app.mymap.removeLayer(app.marker);
      var index = dateTime.indexOf(" ") + 1;
      var date = dateTime.substring(0, index - 1);
      var time = dateTime.substring(index, index + 8);
      var floatLatitude = parseFloat(latitude);
      var floatlongitude = parseFloat(longitude);
      app.marker = L.marker([floatLatitude, floatlongitude]).addTo(app.mymap);
      app.marker
        .bindPopup(
          '<p style="text-align: center;"><b>Device Location</b><br><br>Latitude: ' +
            floatLatitude +
            "<br>Longitude: " +
            floatlongitude +
            "<br>Date: " +
            date +
            "<br>Time: " +
            time +
            "</p>"
        )
        .openPopup();
    },
    chartUpdate() {
      var app = this;
      var n_id;
      var n_latitude;
      var n_longitude;
      var n_car_shock;
      var n_created_at;
      var api_url =
        "http://imeds-hau.esy.es/api/v1/devicelocation/" + app.serial_no;

      $.ajax({
        url: api_url,
        success: function(responseData) {
          if (responseData.location) {
            // console.log("latest Id: " + app.LatestId);
            // console.log("New Id: " + responseData.location.id);
            if (app.LatestId < responseData.location.id) {
              app.updateMap(
                responseData.location.latitude,
                responseData.location.longitude,
                responseData.location.created_at
              );
              app.LatestId = responseData.location.id;
            }
          }
        }
      });
    }
  }
};
</script>
<style lang='scss' scoped>
#mapId {
  height: 80vh;
  width: 100%;
}
</style>
