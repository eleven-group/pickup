<template>
  <el-card shadow="never">
    <img :src="imageUrl" class="image" />
    <div class="details">
      <p>{{name}}</p>
    </div>
    <p class="description">{{description}}</p>
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
  margin: 12px auto;
  max-height: 400px;

  img {
    object-fit: cover;
    height: 100px;
    width: auto;
    border-radius: 8px;
  }

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
  }

  img {
    width: 100%;
  }
}
</style>
