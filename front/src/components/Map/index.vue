<template>
  <div>
    <!-- <iframe width="1000" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=2.386844158172608%2C48.847360032023104%2C2.393603324890137%2C48.85048411561242&amp;layer=mapnik&amp;marker=48.84892209818227%2C2.390223741531372" style="border: 1px solid black" />
    <br/>
    <small
      ><a href="https://www.openstreetmap.org/?mlat=48.84892&amp;mlon=2.39022#map=18/48.84892/2.39022">View Larger Map</a>
    </small>-->
    <div id="map" class="map" />
  </div>
</template>

<script>
import L from 'leaflet';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';

export default {
  name: 'Map',
  data: function () {
    return {
      map: null,
      tileLayer: null,
      layers: []
    };
  },
  methods: {
    initMap () {
      this.map = L.map('map').setView([48.85048411561242, 2.393603324890137], 16);
      this.tileLayer = L.tileLayer(
        'https://cartodb-basemaps-{s}.global.ssl.fastly.net/rastertiles/voyager/{z}/{x}/{y}.png',
        {
          maxZoom: 18,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, &copy; <a href="https://carto.com/attribution">CARTO</a>'
        }
      );
      this.tileLayer.addTo(this.map);
    },
    initLayers () {}
  },
  mounted () {
    this.initMap();
    this.initLayers();
  }
};
</script>

<style scoped>
  .map {
    height: 700px;
    width: 1000px;
    border: 1px solid black;
  }
</style>
