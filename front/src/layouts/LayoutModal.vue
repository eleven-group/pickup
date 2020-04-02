<template>
  <el-container class="container">
    <el-main class="main">
      <router-view />
    </el-main>
  </el-container>
</template>

<script>
export default {
  name: 'LayoutModal'
};
</script>

<style scoped>
.container,
.main {
  height: 100vh;
}
</style>
