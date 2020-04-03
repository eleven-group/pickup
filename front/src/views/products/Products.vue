<template>
  <div>
    <el-row>
      <h1>Every product from {{companyName}} :</h1>
    </el-row>
    <el-row :gutter="24">
      <el-col v-for="product in products" v-bind:key="product.id" :span="6" :xs="24" :sm="12" :md="12" :lg="6" :xl="6">
        <ProductCard
          :product="product"
          :shop="shop" />
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import ProductCard from './ProductCard';

export default {
  name: 'Products',
  components: {
    ProductCard
  },
  computed: mapState({
    products: function (state) { return state.shops.shops[this.$route.params.index].products; },
    shop: function (state) { return state.shops.shops[this.$route.params.index]; },
    companyName: function (state) { return state.shops.shops[this.$route.params.index].name; }
  })
};
</script>

<style lang="scss" scoped>
.el-card {
  .details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;

    h3,
    small {
      font-weight: 600;
      margin: 0;
    }

    small {
      font-weight: 400;
      color: #696974;
    }
  }

  .el-card--button,
  h3 {
    text-align: right;
  }

  img {
    width: 100%;
  }
}
</style>
