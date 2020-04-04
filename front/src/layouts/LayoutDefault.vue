'<template>
  <el-container>
    <Sidebar />
    <el-container class="main">
      <el-main>
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
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

.fade-enter-active,
.fade-leave-active {
  transition-duration: 0.2s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}
</style>
'
