<template>
  <div class="aside sidebar">
    <el-menu :router="true" :collapse="windowWidth < 769">
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
            <span slot="title">Accueil</span>
          </el-menu-item>
          <el-menu-item route="/shops" index="2">
            <i class="el-icon-shopping-bag-1"></i>
            <span slot="title">Magasins</span>
          </el-menu-item>
          <el-menu-item route="/register" index="3">
            <i class="el-icon-user"></i>
            <span slot="title">Inscription</span>
          </el-menu-item>
          <el-submenu index="4">
            <template slot="title">
              <i class="el-icon-edit-outline"></i>
              <span slot="title">À propos</span>
            </template>
            <el-menu-item route="/about" index="6-1">
              <span slot="title">Qui-sommes-nous ?</span>
            </el-menu-item>
            <el-menu-item route="/cgu" index="6-2">
              <span slot="title">C.G.U</span>
            </el-menu-item>
          </el-submenu>
        </div>
        <div class="sidebar--bottom">
          <el-badge :value="productCounter">
            <el-button
              type="primary"
              icon="el-icon-shopping-cart-2"
              plain
              @click="$router.push('/order')"
            >Voir votre panier</el-button>
          </el-badge>
          <el-button icon="el-icon-lock" type="primary" @click="redirect">Accès producteurs</el-button>
        </div>
      </div>
    </el-menu>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: mapState({
    productCounter: state => state.cart.cartCounter
  }),
  data () {
    return {
      windowWidth: window.innerWidth
    };
  },
  mounted () {
    window.onresize = () => {
      this.windowWidth = window.innerWidth;
    };
  },
  methods: {
    redirect () {
      window.location.replace(`${process.env.VUE_APP_ADMIN_URL}/login`);
    }
  },
  name: 'Sidebar'
};
</script>

<style lang="scss" scoped>
$--aside-width: 250px;

.register-button {
  margin-top: 15px;
}

.aside {
  position: fixed;
  z-index: 0;

  @media (max-width: 768px) {
    width: auto !important;
  }

  .el-menu {
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
  }

  .el-menu-item,
  .title {
    display: flex;
    align-items: center;
    padding: 28px;
    padding-left: 20px;
    color: #171725;
    font-weight: 500;

    &:hover,
    &:active,
    &:focus {
      color: #0062ff !important;
    }

    i {
      padding-right: 20px;
    }
  }

  .el-submenu {
    &__title span {
      font-weight: 500;
      @media (max-width: 768px) {
        display: none;
      }
    }

    .el-menu-item {
      font-weight: 400;
      > span {
        padding-left: 28px;
      }
    }

    i {
      padding-right: 20px;
    }
  }

  .el-divider {
    margin: 0;
    background-color: #e2e2ea;
  }

  .sidebar {
    i {
      color: #e2e2ea;
    }

    &--header {
      margin: 20px;
      margin-top: 0;
      @media (max-width: 768px) {
        margin: 0 auto;
      }
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
        @media (max-width: 768px) {
          display: none;
        }
      }

      img {
        height: 48px;
        width: 48px;
        @media (max-width: 768px) {
          height: 36px;
          width: 36px;
        }
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

    /* &--links {
      @media (max-width: 768px) {
        width: 95%;
      }
    } */

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

      @media (max-width: 768px) {
        .el-badge,
        button {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 65%;
        }
      }
    }
  }
}
</style>
