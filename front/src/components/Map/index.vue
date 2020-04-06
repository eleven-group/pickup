<template>
  <div class="map-container">
    <el-row>
      <el-card>
        <el-row align="middle" justify="space-between" type="flex" class="header-row">
          <el-col :span="18" :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
            <el-checkbox
              v-for="category in categories"
              :key="category.id"
              v-model="category.active"
              @change="categoryChanged(category.id, category.active)"
            >{{ category.formatted }}</el-checkbox>
          </el-col>
          <el-col
            v-if="!getLocationActive"
            type="flex"
            :span="6"
            :xs="24"
            :sm="24"
            :md="24"
            :lg="8"
            :xl="8"
          >
            <el-button
              v-if="!getLocationActive"
              @click="getLocation"
              plain
            >Trouver ma localisation automatiquement</el-button>
          </el-col>
        </el-row>
      </el-card>
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
        <l-geo-search :options="geoSearchOptions" />
        <l-marker
          v-for="(item, index) in markers"
          :key="'marker-' + index"
          :latLng="item.location"
          :icon="icon"
        >
          <Popup :item="item" :shops="shops" />
        </l-marker>
      </l-map>
    </el-row>
  </div>
</template>

<script>
import L, { latLng } from 'leaflet';
import { OpenStreetMapProvider } from 'leaflet-geosearch';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import LGeoSearch from 'vue2-leaflet-geosearch';
import { mapState, mapActions } from 'vuex';
import { categoriesName } from '@/constants';

import Popup from '@/components/PopUp/';

export default {
  name: 'Map',
  components: {
    LMap,
    LTileLayer,
    LMarker,
    Popup,
    LGeoSearch
  },
  data () {
    return {
      center: latLng(this.latitude, this.longitude),
      currentCenter: latLng(this.latitude, this.longitude),
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
      geoSearchOptions: {
        provider: new OpenStreetMapProvider(),
        style: 'bar',
        marker: {
          icon: new L.Icon({
            iconUrl: require('@/assets/images/findMeMarker.svg')
          })
        },
        autoComplete: false,
        searchLabel: 'Chercher votre adresse'
      },
      icon: L.icon({
        iconUrl: require('@/assets/images/shopsMarker.svg')
      }),
      url: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
      zoom: 16,
      currentZoom: 11.5,
      markers: [],
      getLocationActive: false
    };
  },
  computed: mapState({
    longitude: state => state.location.longitude,
    latitude: state => state.location.latitude,
    shops: state => state.shops,
    automatedGeolocation: state => state.automatedGeolocation
  }),
  methods: {
    ...mapActions('shops', ['fetchShops']),
    getLocation () {
      if (navigator.geolocation) {
        const success = ({ coords }) => {
          const { latitude, longitude } = coords;
          this.$store.commit('location/setLatitude', latitude);
          this.$store.commit('location/setLongitude', longitude);
          this.center = latLng(this.latitude, this.longitude);
        };

        const error = err => {
          console.warn(`ERROR(${err.code}): ${err.message}`);
        };

        navigator.geolocation.getCurrentPosition(success, error);
        this.getLocationActive = true;
      } else {
        console.log('Geolocation is not supported for this Browser/OS.');
      }
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
          formatted: categoriesName[category.toLowerCase()],
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
                marker =>
                  marker.category.toLowerCase() ===
                  removed.category.toLowerCase()
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
  .header-row {
    .el-col:nth-child(2) {
      display: flex;
      justify-content: flex-end;
    }

    @media (max-width: 1200px) {
      flex-direction: column;
      align-items: center;
      justify-content: center;

      .el-card-body {
        padding-bottom: 0;
      }

      .el-col {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 12px;
      }

      .el-col:nth-child(2) {
        justify-content: center;
      }
    }
  }
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
    margin: 12px;
  }
}

.el-button {
  margin-left: 20px;
}

.marker {
  background-color: transparent;
}
</style>
