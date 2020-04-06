<template>
  <el-card shadow="never">
    <h2>{{product.name}}</h2>
    <p>{{product.description}}</p>
    <div class="details">
      <b v-if="product.quantity > 0" class="quantity">{{product.quantity}} en stock</b>
      <b v-else class="quantity">En rupture de stock</b>
      <h3>Price : {{priceConverted}}</h3>
    </div>
    <div v-if="product.quantity > 0" class="el-card--button">
      <el-input-number v-model="num" :min="1" :max="product.quantity"></el-input-number>
      <el-button
        type="success"
        v-on:click="() => addProductToCart({...product, ordered: num, shop: {...shop}})"
        plain
      >Ajouter au panier</el-button>
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
      } else {
        this.$message({
          message: 'Le produit a bien été ajouté au panier.',
          type: 'success'
        });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.el-card {
  margin: 12px auto;
  max-height: 400px;

  .details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;

    p,
    small {
      font-weight: 600;
      margin: 0;
    }

    p {
      margin-top: 24px;
    }

    small {
      font-weight: 400;
      color: #696974;
    }
  }

  .description {
    margin-top: 12px;
    margin-bottom: 12px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }

  .el-card--button {
    text-align: right;
    > .el-button {
      margin-left: 12px;
    }
  }
}
</style>
