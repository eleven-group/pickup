<template>
  <div>
    <l-popup>
      {{ itemPopUp.name }}
      <br />
      Description: {{ itemPopUp.description }}
    </l-popup>
  </div>
</template>

<script>
import { LPopup } from 'vue2-leaflet';

export default {
  name: 'Popup',
  props: ['item'],
  components: {
    LPopup
  },
  data () {
    return {
      itemPopUp: this.item
    };
  },
  methods: {
    initPopUp () {
      console.log(this.itemPopUp);
    }
  },
  mounted () {
    this.initPopUp();
  }
};
</script>
