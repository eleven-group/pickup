'<template>
  <el-container>
    <Sidebar />
    <el-container class="main">
      <el-main>
        <router-view />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
import Sidebar from '@/components/Sidebar';

export default {
  components: {
    Sidebar
  },
  name: 'LayoutDefault'
};
</script>

<style lang="scss" scoped>
$--aside-width: 250px;
$--aside-width-collapsed: 65px;

.el-main {
  padding: 32px;
  margin-left: $--aside-width;
  min-height: 100vh;
  @media (max-width: 768px) {
    padding: 24px;
    margin-left: $--aside-width-collapsed;
  }
}
</style>
'
