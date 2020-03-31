<template>
  <el-container>
    <el-aside class="sidebar" width="250px">
      <el-menu :router="true">
        <div class="sidebar--header">
          <div class="sidebar--logo">
            <img src="@/assets/logo.png" alt="logo" />
            <p>FoodCollect</p>
          </div>
          <el-divider></el-divider>
        </div>
        <div class="sidebar--content">
          <div class="sidebar--links">
            <el-menu-item route="/" index="1">
              <i class="el-icon-house"></i>
              <span>Accueil</span>
            </el-menu-item>
            <el-menu-item route="/shops" index="2">
              <i class="el-icon-shopping-bag-1"></i>
              <span>Magasins</span>
            </el-menu-item>
            <el-menu-item route="/products" index="3">
              <i class="el-icon-shopping-cart-2"></i>
              <span>Produits</span>
            </el-menu-item>
            <el-menu-item route="/contact" index="4">
              <i class="el-icon-chat-line-round"></i>
              <span>Contactez-nous !</span>
            </el-menu-item>
          </div>
          <div class="sidebar--bottom">
            <el-badge :value="3" :max="10" class="item">
              <el-button
                type="primary"
                icon="el-icon-shopping-cart-2"
                plain
                @click="$router.push('confirmation')"
              >Voir votre panier</el-button>
            </el-badge>
            <el-button type="primary">Accès producteurs</el-button>
          </div>
        </div>
      </el-menu>
    </el-aside>
    <el-container class="main">
      <el-main>
        <router-view />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  name: 'LayoutDefault'
};
</script>

<style lang="scss" scoped>
$--aside-width: 250px;

.el-aside {
  position: fixed;
  z-index: 0;

  .el-menu {
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
  }

  .el-menu-item {
    display: flex;
    align-items: center;
    padding: 28px;
    padding-left: 20px;
    color: #171725;
    font-weight: 600;

    &:hover,
    &:active,
    &:focus {
      color: #0062ff !important;
    }

    > i {
      padding-right: 20px;
    }
  }

  .el-divider {
    margin: 0;
    background-color: #e2e2ea;
  }

  .sidebar {
    &--header {
      margin: 20px;
      margin-top: 0;
    }

    &--logo {
      display: flex;
      flex-direction: row;
      align-items: center;
      margin: 30px auto;

      p {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        margin-left: 12px;
      }

      img {
        height: 48px;
        width: 48px;
      }
    }

    &--content {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      margin-bottom: 28px;
      height: 100%;
      width: 100%;
    }

    &--bottom {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      align-self: center;
      width: 100%;

      .el-badge {
        width: 85%;
      }

      button {
        width: 85%;
        margin: auto;
        margin-top: 16px;
        &:first-child {
          margin-top: 0;
          width: 100%;
        }
      }
    }
  }
}

.el-main {
  padding: 40px;
  margin-left: $--aside-width;
  min-height: 100vh;
}
</style>
