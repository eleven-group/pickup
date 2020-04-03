<template>
  <div class="map-container">
    <el-row>
      <el-col :span="24" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
        <el-card>
          <el-checkbox
            v-for="category in categories"
            :key="category.id"
            v-model="category.active"
            @change="categoryChanged(category.id, category.active)"
          >{{ category.name }}</el-checkbox>
        </el-card>
      </el-col>
    </el-row>
    <el-row class="map">
      <l-map
        class="leaflet"
        :zoom="zoom"
        :center="center"
        @update:center="centerUpdate"
        @update:zoom="zoomUpdate"
      >
        <l-tile-layer :url="url" />
        <v-geosearch :options="geosearchOptions" />
        <l-marker
          v-for="(item, index) in markers"
          :key="'marker-' + index"
          :latLng="item.location"
          :icon="getIcon()"
        >
          <Popup :item="item" />
        </l-marker>
      </l-map>
    </el-row>
  </div>
</template>

<script>
import L, { latLng } from 'leaflet';
import { OpenStreetMapProvider } from 'leaflet-geosearch';
import { LMap, LTileLayer, LMarker, LControl } from 'vue2-leaflet';
import VGeosearch from 'vue2-leaflet-geosearch';
import { mapState, mapActions } from 'vuex';

import osmApi from '@/api/location/';
import Popup from '@/components/PopUp/';

export default {
  name: 'Map',
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LControl,
    Popup,
    VGeosearch
  },
  data () {
    return {
      input: '',
      map: null,
      center: latLng(48.856274, 2.354124),
      currentCenter: latLng(48.856274, 2.354124),
      tileLayer: null,
      categoriesShops: [
        'Baker',
        'Butcher',
        'Burger',
        'Pastry',
        'Pizza',
        'Producer',
        'Other'
      ],
      categories: [],
      geosearchOptions: {
        provider: new OpenStreetMapProvider(),
        position: 'topright',
        style: 'bar',
        showMarker: true,
        autoClose: true,
        animateZoom: true,
        searchLabel: 'Chercher votre adresse'
      },
      form: {
        streetAddress: ''
      },
      loading: false,
      url: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
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
    ...mapActions('shops', ['fetchShops']),
    getIcon () {
      return L.divIcon({
        className: 'marker',
        html: `<svg width="52" height="42" viewBox="0 0 52 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="21" cy="21" r="7.875" fill="#0062FF"/>
                <circle cx="21" cy="21" r="7.875" fill="#0062FF"/>
                <circle cx="21" cy="21" r="21" fill="#0062FF" fill-opacity="0.18"/>
                </svg>
              `
      });
    },
    initMap () {
      const { latitude, longitude } = this.$store.state.location;
      this.center = latLng(latitude, longitude);
    },
    initCategories () {
      this.categoriesShops.forEach((category, index) => {
        this.categories.push({
          id: index,
          name: category,
          active: false,
          features: null
        });
      });
    },
    retrieveShopsByCategories () {
      const { shops } = this.$store.state.shops;
      this.categories.forEach(category => {
        category.features = shops.filter(
          shop => shop.category === category.name.toLowerCase()
        );
      });
    },
    createMarkers () {
      this.categories.forEach(category => {
        category.features.forEach(feature => {
          const coords = latLng(feature.latitude, feature.longitude);
          feature.leafletObject = L.marker(coords).bindPopup(feature.name);
        });
      });
    },
    categoryChanged (categoryId, active) {
      const category = this.categories.find(
        category => category.id === categoryId
      );
      category.features.forEach(feature => {
        if (active) {
          this.markers.push({
            name: feature.name,
            category: category.name.toLowerCase(),
            description: feature.description,
            location: latLng(feature.latitude, feature.longitude)
          });
        } else {
          const removeMarkers = this.markers.filter(
            marker => marker.category === category.name.toLowerCase()
          );
          removeMarkers.forEach(removed =>
            this.markers.splice(
              this.markers.findIndex(
                marker => marker.category.toLowerCase() === removed.category.toLowerCase()
              ),
              1
            )
          );
        }
      });
    },
    zoomUpdate (zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate (center) {
      this.currentCenter = center;
    },
    async submitSearch () {
      const { streetAddress } = this.form;
      try {
        const geoResSearchBar = await osmApi.getGeocodeSearchBar(streetAddress);
        console.log(geoResSearchBar);
      } catch (e) {
        this.$message({
          showClose: true,
          message: "Oops, seems that your company adress can't be found !",
          type: 'error'
        });
        this.loading = false;
      }
    }
  },
  mounted () {
    this.fetchShops();
    this.initMap();
    this.initCategories();
    this.retrieveShopsByCategories();
    this.createMarkers();
  }
};
</script>

<style lang="scss" scoped>
.map-container {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
  height: 100%;
}

.map {
  width: 100%;
  flex-grow: 2;
  > .leaflet {
    border-radius: 20px;
    border: 1px solid #e2e2ea;
  }
}

.el-checkbox {
  @media (max-width: 992px) {
    margin: 12px 0;
  }
}

.marker {
  background-color: transparent;
}
</style>
