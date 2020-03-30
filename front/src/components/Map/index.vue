<template>
  <div>
    <l-map class="map" :zoom="zoom" :center="center" @update:center="centerUpdate" @update:zoom="zoomUpdate">
      <l-tile-layer :url="url" :attribution="attribution" />
      <l-marker v-for="(item, index) in markers" :key="'marker-' + index" :latLng="item.location" :icon="getIcon()">
        <Popup :item="item"/>
      </l-marker>
    </l-map>
    <div v-for="layer in layers" :key="layer.id">
      <label class="form-check-label">
        <input
          class="form-check-input"
          type="checkbox"
          v-model="layer.active"
          @change="layerChanged(layer.id, layer.active)"
        />
        {{ layer.name }}
      </label>
    </div>
  </div>
</template>

<script>
import L, { latLng } from 'leaflet';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import { mapState, mapActions } from 'vuex';

import Popup from '@/components/PopUp/';

export default {
  name: 'Map',
  components: {
    LMap,
    LTileLayer,
    LMarker,
    Popup
  },
  data () {
    return {
      map: null,
      center: latLng(48.856274, 2.354124),
      currentCenter: latLng(48.856274, 2.354124),
      tileLayer: null,
      layers: [
        {
          id: 0,
          name: 'Restaurants',
          active: false,
          features: []
        }
      ],
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      zoom: 16,
      currentZoom: 11.5,
      markers: []
    };
  },
  computed: mapState({
    longitude: state => state.location.longitude,
    latitude: state => state.location.latitude,
    shops: state => state.shops
  }),
  created () {
    if (navigator.geolocation) {
      const success = ({ coords }) => {
        const { latitude, longitude } = coords;
        this.$store.commit('location/setLatitude', latitude);
        this.$store.commit('location/setLongitude', longitude);
      };

      const error = err => {
        console.warn(`ERROR(${err.code}): ${err.message}`);
      };

      navigator.geolocation.getCurrentPosition(success, error);
    } else {
      console.log('Geolocation is not supported for this Browser/OS.');
    }
  },
  methods: {
    ...mapActions('shops', [
      'fetchShops'
    ]),
    getIcon () {
      return L.divIcon({
        className: 'my-custom-pin',
        html: `<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="32" cy="32" r="12" fill="#0062FF"/>
                  <circle cx="32" cy="32" r="12" fill="#0062FF"/>
                  <circle cx="32" cy="32" r="32" fill="#0062FF" fill-opacity="0.18"/>
              </svg>`
      });
    },
    initMap () {
      const { latitude, longitude } = this.$store.state.location;
      this.center = latLng(latitude, longitude);
    },
    initLayers () {
      const { shops } = this.$store.state.shops;
      shops.forEach((shop, index) => {
        const geoCode = shop.geocode.split(',');
        this.layers.forEach(layer => {
          layer.features.push(
            {
              id: index,
              name: shop.name,
              description: shop.description,
              type: 'marker',
              coords: latLng(geoCode[0], geoCode[1])
            }
          );
        });
      });
      this.layers.forEach(layer => {
        const markerFeatures = layer.features.filter(feature => feature.type === 'marker');
        markerFeatures.forEach((feature) => {
          feature.leafletObject = L.marker(feature.coords).bindPopup(feature.name);
        });
      });
    },
    zoomUpdate (zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate (center) {
      this.currentCenter = center;
    },
    layerChanged (layerId, active) {
      const layer = this.layers.find(layer => layer.id === layerId);
      layer.features.forEach(feature => {
        if (active) {
          this.markers.push({
            name: feature.name,
            description: feature.description,
            location: latLng(feature.coords.lat, feature.coords.lng)
          });
        } else {
          this.markers = [];
        }
      });
    }
  },
  mounted () {
    this.fetchShops();
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

  .my-custom-pin{
    background-color: transparent;
  }
</style>
