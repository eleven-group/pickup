<template>
<el-container>
  <el-aside width="200px">
    <el-menu :router=true class="app-container">
    <div class="sidebar-header">
      <p class="sidebar-sitename">The Forge</p>
      <p>Wizards Tech.</p>
    </div>
    <el-menu-item route="/"  index="1">
      Home
    </el-menu-item>
    <el-menu-item route="/invoices" index="2">
      Invoices
    </el-menu-item>
    <el-menu-item route="/absences"  index="3">
      Absences
    </el-menu-item>
    <el-menu-item route="/files"  index="4">
      My Files
    </el-menu-item>
    </el-menu>
  </el-aside>
  <el-container>
    <el-header>
      <el-menu :router=true class="el-menu-demo" mode="horizontal">
        <el-submenu index="6" class="right-menu-el">
          <template slot="title">
            <img v-if="user.avatar" class="navbar-avatar" :src="`http://api.test/public/files/${user.avatar}`"  :alt="`${user.username}'s avatar`"/>
            {{ user.username }}
          </template>
          <el-menu-item index="1-1" route="/profile">Profile</el-menu-item>
          <el-menu-item index="1-2">Settings</el-menu-item>
          <el-menu-item route="logout" index="1-3">Logout</el-menu-item>
        </el-submenu>
        <el-menu-item index="1-0" class="right-menu-el">
            <el-badge is-dot class="item badge-icon"/>
            <BellIcon />
        </el-menu-item>
      </el-menu>
    </el-header>
    <el-main>
      <router-view />
    </el-main>
  </el-container>
</el-container>
</template>

<script>
import BellIcon from 'vue-material-design-icons/Bell.vue';
import { mapState } from 'vuex';
export default {
  name: 'LayoutDefault',
  components: {
    BellIcon
  },
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
