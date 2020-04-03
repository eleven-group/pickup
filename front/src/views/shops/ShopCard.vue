<template>
      <el-card shadow="never">
          <img :src="imageUrl" class="image" />
          <p>{{description}}</p>
          <div class="details">
            <h3>{{name}}</h3>
          </div>
          <div class="el-card--button">
            <el-button type="success" v-on:click="() => goToProduct(index)" plain>See available products</el-button>
          </div>
        </el-card>
</template>

<script>

export default {
  name: 'ShopCard',
  props: {
    description: {
      type: String,
      required: true
    },
    imageUrl: {
      type: String
    },
    name: {
      type: String,
      required: true
    },
    index: {
      type: Number,
      required: true
    }
  },
  methods: {
    goToProduct (index) {
      this.$router.push(`/products/${index}`);
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
