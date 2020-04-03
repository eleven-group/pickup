<template>
      <el-card shadow="never">
          <img :src="product.imageUrl" class="image" />
          <p>{{product.description}}</p>
          <div class="details">
            <small class="quantity">{{product.quantity}} left</small>
            <h3>Price : {{priceConverted}}</h3>
          </div>
          <div class="el-card--button">
              <el-input-number v-model="num" :min="1" :max="product.quantity"></el-input-number>
              <el-button type="success" v-on:click="() => addProductToCart({...product, quantity: num, totalPrice: (product.price*num), shop: {...shop}})" plain>Add to cart</el-button>
          </div>
        </el-card>
</template>

<script>
import getPriceConverted from '@/helpers/getPriceConverted';

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
  data () {
    return {
      priceConverted: getPriceConverted(this.product.price),
      num: 1
    };
  },
  methods: {
    addProductToCart (product) {
      this.$store.commit('cart/addCartProduct', product);
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
