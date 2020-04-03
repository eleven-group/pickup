<template>
  <div>
    <div v-for="product in products" v-bind:key="product.id">
      <p> {{product}}</p>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'ProductShow',
  computed: mapState({
    products: state => state.shops[this.$route.params.index].products
  })
};
</script>
