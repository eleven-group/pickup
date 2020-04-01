<template>
  <div>
    <el-row>
      <h1>Tous les produits du restaurant sélectionné :</h1>
    </el-row>
    <el-row :gutter="24">
      <el-col :span="6" :xs="24" :sm="12" :md="12" :lg="6" :xl="6">
        <el-card shadow="never">
          <img src="https://picsum.photos/id/10/250/150" class="image" />
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="details">
            <small class="quantity">3 restants</small>
            <h3>Prix : 99,9€</h3>
          </div>
          <div class="el-card--button">
            <el-button type="success" plain>Ajouter au panier</el-button>
          </div>
        </el-card>
      </el-col>
      <el-col :span="6" :xs="24" :sm="12" :md="12" :lg="6" :xl="6">
        <el-card shadow="never">
          <img src="https://picsum.photos/id/10/250/150" class="image" />
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="details">
            <small class="quantity">3 restants</small>
            <h3>Prix : 99,9€</h3>
          </div>
          <div class="el-card--button">
            <el-button type="success" plain>Ajouter au panier</el-button>
          </div>
        </el-card>
      </el-col>
      <el-col :span="6" :xs="24" :sm="12" :md="12" :lg="6" :xl="6">
        <el-card shadow="never">
          <img src="https://picsum.photos/id/10/250/150" class="image" />
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="details">
            <small class="quantity">3 restants</small>
            <h3>Prix : 99,9€</h3>
          </div>
          <div class="el-card--button">
            <el-button type="success" plain>Ajouter au panier</el-button>
          </div>
        </el-card>
      </el-col>
      <el-col :span="6" :xs="24" :sm="12" :md="12" :lg="6" :xl="6">
        <el-card shadow="never">
          <img src="https://picsum.photos/id/10/250/150" class="image" />
          <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
          <div class="details">
            <small class="quantity">3 restants</small>
            <h3>Prix : 99,9€</h3>
          </div>
          <div class="el-card--button">
            <el-button type="success" plain>Ajouter au panier</el-button>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'Products',
  computed: mapState({
    products: state => state.products.products
  }),
  methods: {
    ...mapActions('products', ['fetchProducts']),
    handleEdit (index, row) {
      this.$router.push({ name: 'products.edit', params: { id: row.id } });
    },
    handleView (index, row) {
      this.$router.push({ name: 'products.show', params: { id: row.id } });
    }
  },
  created () {
    this.fetchProducts();
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
