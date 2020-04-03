<template>
  <l-popup>
    <p class="name">{{ itemPopUp.name }}</p>
    <p class="description">{{ itemPopUp.description }}</p>
    <div class="button">
      <el-button type="primary">Voir le catalogue</el-button>
    </div>
  </l-popup>
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
  }
};
</script>

<style lang="scss" scoped>
.name {
  font-weight: 500;
}

.name,
.description {
  font-size: 14px;
}

.button {
  text-align: right;
  .el-button {
    margin-top: 16px;
  }
}
</style>
