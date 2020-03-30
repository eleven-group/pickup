<template>
  <div>
    <el-row>
      <h1 class="header">
        Bienvenue sur FoodCollect, un site francophone et communautaire
        <br />dédié au Click &amp; Collect.
      </h1>
    </el-row>
    <el-row :gutter="40">
      <el-col :span="6" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
        <el-card>
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="el-card--button">
            <el-button type="primary" plain>Explorer</el-button>
          </div>
        </el-card>
      </el-col>
      <el-col :span="6" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
        <el-card>
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="el-card--button">
            <el-button type="primary" plain>Explorer</el-button>
          </div>
        </el-card>
      </el-col>
      <el-col :span="12" :xs="24" :sm="24" :md="24" :lg="12" :xl="12">
        <el-alert
          title="Attention, COVID-19 !"
          type="error"
          description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi."
          show-icon
          :closable="false"
        ></el-alert>
      </el-col>
    </el-row>

    <!-- To be changed. Placed here as placeholder for demo purposes. -->

    <el-row>
      <el-col :span="24" class="map">
        <Map />
      </el-col>
    </el-row>
    <!-- To be changed. Placed here as placeholder for demo purposes. -->
  </div>
</template>

<script>
import { mapState } from 'vuex';
import Map from '@/components/Map/';

export default {
  name: 'Home',
  components: {
    Map
  },
  computed: mapState({
    longitude: state => state.location.longitude,
    latitude: state => state.location.latitude
  }),
  created: function () {
    if (navigator.geolocation) {
      const success = ({coords}) => {
        const {latitude, longitude} = coords;
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
  }
};
</script>

<style lang="scss" scoped>
.el-card {
  &--button {
    display: flex;
    justify-content: flex-end;
    width: 100%;
  }
}

.el-alert {
  border-radius: 20px;
  padding: 24px;
  &__content {
    padding-left: 50px !important;
  }
}

/* To be changed. Placed here as placeholder for demo purposes. */

.map {
  filter: saturate(0);
  iframe {
    width: 100%;
    border: 0;
    border-radius: 20px;
  }
}

/* <!-- To be changed. Placed here as placeholder for demo purposes. --> */
</style>
