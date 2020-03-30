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
