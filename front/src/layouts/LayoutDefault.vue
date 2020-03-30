<template>
<el-container>
  <el-aside width="200px">
    <el-menu :router=true class="app-container">
    <div class="sidebar-header">
      <p class="sidebar-sitename">Pickup</p>
      <p>Click & Collect</p>
    </div>
    <el-menu-item route="/"  index="1">
      Home
    </el-menu-item>
    <el-menu-item route="/shops" index="2">
      Shops
    </el-menu-item>
    <el-menu-item route="/products"  index="3">
      Products
    </el-menu-item>
    <el-menu-item route="/map"  index="4">
      Map
    </el-menu-item>
    </el-menu>
  </el-aside>
  <el-container>
    <el-header>
      <el-menu :router=true class="el-menu-demo" mode="horizontal">
        <el-submenu index="6" class="right-menu-el">
          <template slot="title">
            {{ user.username }}
          </template>
          <el-menu-item index="1-1" route="/profile">Profile</el-menu-item>
          <el-menu-item index="1-2">Settings</el-menu-item>
          <el-menu-item route="logout" index="1-3">Logout</el-menu-item>
        </el-submenu>
      </el-menu>
    </el-header>
    <el-main>
      <router-view />
    </el-main>
  </el-container>
</el-container>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'LayoutDefault',
  computed: mapState({
    user: state => state.auth.user
  })
};
</script>

<style scoped>
  .right-menu-el{
    float: right !important;
  }
  .sidebar-header{
    margin: 20px;
  }
  .sidebar-logo{
    width: 60px;
  }
  .sidebar-sitename{
    margin-top: 0px;
    font-weight: 600;
  }
  .badge-icon{
    position: absolute;
    right: 10px;
    top: -10px;
  }
  .navbar-avatar{
    width: 30px;
    border-radius: 50px;
  }
</style>
