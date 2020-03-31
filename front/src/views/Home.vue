<template>
  <div>
    <div> Welcome to <strong>pickup app</strong></div>
      <iframe width="1000" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" :src="`https://www.openstreetmap.org/export/embed.html?bbox=${longitude}%2C${latitude}%2C${longitude}%2C${latitude}&amp;layer=mapnik&amp;marker=${latitude}%2C${longitude}`" style="border: 1px solid black"></iframe><br/><small><a :href="`https://www.openstreetmap.org/?mlat=${latitude}&amp;mlon=${longitude}#map=18/${latitude}/${longitude}`">View Larger Map</a></small>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'Home',
  computed: mapState({
    longitude: state => state.location.longitude,
    latitude: state => state.location.latitude
  }),
  created: function () {
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
  }
};
</script>
