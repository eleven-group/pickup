<template>
  <l-popup>
    <p class="name">{{ item.name }}</p>
    <p class="description">{{ item.description }}</p>
    <div class="button">
      <el-button type="primary" v-on:click="$router.push(`/products/${index}`)" >Voir le catalogue</el-button>
    </div>
  </l-popup>
</template>

<script>
import { LPopup } from 'vue2-leaflet';
import shopGetIndex from '@/helpers/shopGetIndex';

export default {
  name: 'Popup',
  props: ['item', 'shops'],
  components: {
    LPopup
  },
  created () {
    const { name, location } = this.item;
    const { lng, lat } = location;
    this.index = shopGetIndex(this.shops, { name, lng, lat });
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
