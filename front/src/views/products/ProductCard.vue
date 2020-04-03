<template>
      <el-card shadow="never">
        <h2>{{product.name}}</h2>
          <img :src="product.imageUrl" class="image" />
          <p>{{product.description}}</p>
          <div class="details">
            <small class="quantity">{{product.quantity}} left</small>
            <h3>Price : {{priceConverted}}</h3>
          </div>
          <div class="el-card--button">
              <el-input-number v-model="num" :min="1" :max="product.quantity"></el-input-number>
              <el-button type="success" v-on:click="() => addProductToCart({...product, ordered: num, shop: {...shop}})" plain>Add to cart</el-button>
          </div>
        </el-card>
</template>

<script>
import getPriceConverted from '@/helpers/getPriceConverted';
import { mapState } from 'vuex';

export default {
  name: 'ProductCard',
  props: {
    product: {
      required: true
    },
    shop: {
      required: true
    }
  },
  computed: mapState({
    errorMsg: state => state.cart.cartError
  }),
  data () {
    return {
      priceConverted: getPriceConverted(this.product.price),
      num: 1
    };
  },
  methods: {
    addProductToCart (product) {
      this.$store.commit('cart/addCartProduct', product);
      if (this.errorMsg) {
        this.$message({
          showClose: true,
          message: this.errorMsg,
          type: 'error'
        });
      }
    }
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
