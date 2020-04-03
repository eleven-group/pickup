<template>
  <div>
    <el-row>
      <h1>Tous les magasins autour de vous :</h1>
    </el-row>
    <el-row :gutter="24" justify="center">
      <el-col
        v-for="(shop, index) in shops"
        v-bind:key="shop.id"
        :span="6"
        :xs="24"
        :sm="12"
        :md="12"
        :lg="8"
        :xl="6"
      >
        <ShopCard
          :name="shop.name"
          :description="shop.description"
          :imageUrl="shop.imageUrl"
          :index="index"
        />
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ShopCard from './ShopCard';

export default {
  name: 'Shops',
  components: {
    ShopCard
  },
  computed: mapState({
    shops: state => state.shops.shops
  }),
  methods: {
    ...mapActions('shops', ['fetchShops'])
  },
  created () {
    this.fetchShops();
  }
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
