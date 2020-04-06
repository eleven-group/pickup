<template>
  <div>
    <div v-if="products.length == 0">
      <NoData
        v-bind:title="'Il n\'y a malheureusement aucun produit chez' + companyName + ' actuellement.'"
      />
    </div>
    <el-row v-else>
      <h1>Tous les produits de {{companyName}} :</h1>
    </el-row>
    <el-row :gutter="24">
      <el-col
        v-for="product in products"
        v-bind:key="product.id"
        :span="12"
        :xs="24"
        :sm="24"
        :md="24"
        :lg="12"
        :xl="12"
      >
        <ProductCard :product="product" :shop="shop" />
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import ProductCard from './ProductCard';
import NoData from '@/components/NoData/NoData';

export default {
  name: 'Products',
  components: {
    ProductCard,
    NoData
  },
  computed: mapState({
    products: function (state) {
      return state.shops.shops[this.$route.params.index].products;
    },
    shop: function (state) {
      return state.shops.shops[this.$route.params.index];
    },
    companyName: function (state) {
      return state.shops.shops[this.$route.params.index].name;
    }
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
