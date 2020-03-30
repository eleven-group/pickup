<template>
      <div v-loading:pending>
        This product is typed as <b>{{ product.type }}</b>
      </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'ProductShow',
  computed: mapState({
    product: state => state.products.product
  }),
  methods: {
    ...mapActions('products', [
      'fetchProduct'
    ])
  },
  created () {
    this.fetchProduct(this.$route.params.id);
  }
};
</script>
